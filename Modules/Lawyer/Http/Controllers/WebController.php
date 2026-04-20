<?php

namespace Modules\Lawyer\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Client\Entities\Model;
use Modules\Country\Entities\Country;
use Yajra\DataTables\Facades\DataTables;

class WebController extends BasicController
{
    public function index(Request $request)
    {
        return view('lawyer::index');
    }


    public function show($id)
    {
        $Model = Model::with([
            'legalProfile.barAssociation',
            'legalProfile.subAssociation',
            'legalProfile.qualifications.degreeType',
            'legalProfile.qualifications.university',
            'legalProfile.workAreas',
            'legalProfile.expertises',
            'legalProfile.languages',
            'cardId',
            'legalProfile.year_of_experiance',
            'LegalCardId',
            'rejectionReasons'
        ])->findOrFail($id);
        return view('lawyer::show', compact('Model'));
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }

    public function edit($id)
    {
        // dd($id);
        $Model = \Modules\Client\Entities\Model::with([
            'legalProfile.barAssociation',
            'legalProfile.subAssociation',
            'legalProfile.qualifications.degreeType',
            'legalProfile.qualifications.university',
            'legalProfile.workAreas',
            'legalProfile.expertises',
            'legalProfile.languages',
            'legalProfile.year_of_experiance',
            'cardId',
            'LegalCardId',
            'rejectionReasons'
        ])->findOrFail($id);

        // dd($Model->legalProfile);

        return view('lawyer::edit', compact('Model'));
    }
    public function update(Request $request, $id)
    {
        $lawyer = \Modules\Client\Entities\Model::findOrFail($id);

        if ($lawyer->type !== 'lawyer') {
            return redirect()->back()->with('error', 'Invalid user type');
        }

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $lawyer->status = $request->status;

        if ($request->status == 'rejected') {
            $syncData = [];
            $steps = [];

            if ($request->has('reject_reasons')) {
                $selectedReasons = array_filter($request->reject_reasons, function ($item) {
                    return isset($item['id']);
                });
                $reasonsCount = count($selectedReasons);
                $lawyer->is_submitted = ($reasonsCount <= 1) ? true : false;

                foreach ($selectedReasons as $reasonId => $data) {
                    $reasonDetail = \Modules\RejectReasons\Entities\Model::find($reasonId);
                    if (!$reasonDetail) continue;
                    $finalComment = !empty($data['comment'])
                        ? $data['comment']
                        : (app()->getLocale() == 'ar' ? $reasonDetail->name_ar : $reasonDetail->name_en);

                    $syncData[$reasonId] = ['custom_comment' => $finalComment];
                    if ($reasonDetail->key == 'legal_info') {
                        $steps[] = 1;
                        if ($lawyer->legalProfile) {
                            $lawyer->legalProfile->workAreas()->detach();
                            $lawyer->legalProfile->expertises()->detach();
                            $lawyer->legalProfile->languages()->detach();
                            $lawyer->legalProfile->qualifications()->delete();
                            $lawyer->legalProfile->delete();
                        }
                    }
                    
                    if ($reasonDetail->key == 'id_card') {
                        $steps[] = 2;
                        if ($lawyer->cardId) {
                            $lawyer->cardId->delete();
                        }
                    }
                    
                    if ($reasonDetail->key == 'legal_card') {
                        $steps[] = 3;
                        if ($lawyer->LegalCardId) {
                            $lawyer->LegalCardId->delete();
                        }
                    }
                }
            }

            $lawyer->rejectionReasons()->sync($syncData);
            $lawyer->current_step = count($steps) > 0 ? min($steps) : 1;

        }else {
            $lawyer->is_submitted = true;
            $lawyer->current_step = 3;
            $lawyer->rejectionReasons()->detach();

            $wallet = $lawyer->tokenWallet;

            if (!$wallet) {
                $lawyer->tokenWallet()->create([
                    'lawyer_id' => $lawyer->id,
                    'balance' => 10,
                    'free_balance' => 10,
                    'free_expires_at' => now()->addMonths(2),
                ]);
            } else {
                if (!$wallet->free_given) {
                    $wallet->update([
                        'balance' => $wallet->balance + 10,
                        'free_balance' => 10,
                        'free_expires_at' => now()->addMonths(2),
                    ]);
                }
            }
        }
        $lawyer->save();

        alert()->success(__('trans.updatedSuccessfully'));
        return redirect()->route(activeGuard() . '.lawyers.index');
    }

    public function datatable(Request $request)
    {
        $query = Model::query()
            ->latest()
            ->where('type', 'lawyer')
            ->when(request()->sort_column && request()->sort_direction, function ($query) {
                return $query->orderBy(request()->sort_column, request()->sort_direction);
            });
        return DataTables::of($query)
            ->addColumn('actions', function ($Model) {
                return view('lawyer::layouts.actions', ['Model' => $Model]);
            })
            ->editColumn('name', function ($Model) {
                return view('lawyer::layouts.name', ['Model' => $Model]);
            })
            ->editColumn('status', function ($Model) {
                return $Model->status ;
            })
            ->editColumn('email', function ($Model) {
                return $Model->email; ;

            })
            ->editColumn('type', function ($Model) {
                return $Model->type;

            })
            // ->editColumn('image', function ($Model) {
            //     return view('client::layouts.image', ['Model' => $Model]);
            // })
            ->editColumn('phone', function ($Model) {
                return $Model->phone_code.$Model->phone;
            })
            ->editColumn('created_at', function ($Model) {
                if ($Model->created_at) {
                    return $Model->created_at->translatedFormat("F j, Y, g:i a");
                }
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'actions','name','email','type','phone'])
            ->make(true);
    }

}
