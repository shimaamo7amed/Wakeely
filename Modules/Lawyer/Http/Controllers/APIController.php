<?php

namespace Modules\Lawyer\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Lawyer\Entities\CardId;
use Modules\Lawyer\Entities\LegalCardId;
use Modules\Lawyer\Entities\LegalProfile;
use Modules\Lawyer\Http\Requests\LawyerCardIDRequest;
use Modules\Lawyer\Http\Requests\LawyerLegalCardRequest;
use Modules\Lawyer\Http\Requests\LawyerRegisterRequest;
use Modules\Lawyer\Http\Resources\LawyerResource;

class APIController extends BasicController
{
    public function store(LawyerRegisterRequest $request)
    {
        $lawyer = $this->ClientAuth();

        if (!$lawyer || $lawyer->type !== 'lawyer') {

            return ResponseHelper::make(
                null,
                __('client::messages.unauthenticated'),
                false,
                401
            );
        }
        // dd($request->all());

        DB::beginTransaction();

        try {
            $profile = LegalProfile::create([
                'lawyer_id'           => $lawyer->id,
                'bar_association_id'  => $request->bar_association_id,
                'registration_number' => $request->registration_number,
                'registration_date'   => $request->registration_date,
                'sub_associations_id' => $request->sub_associations_id,
                'experience_id'       => $request->experience_id,
                'consultation_price'  => $request->consultation_price,
                'summary'             => $request->summary,
            ]);

            if ($request->filled('qualifications')) {
                $profile->qualifications()->createMany(
                    collect($request->qualifications)->map(fn($q) => [
                        'degree_type_id' => $q['degree_type_id'],
                        'university_id'  => $q['university_id'],
                        'year'           => $q['year'],
                    ])->toArray()
                );
            }

            if ($request->filled('work_areas')) {
                $profile->workAreas()->sync($request->work_areas);
            }

            if ($request->filled('expertises')) {
                $profile->expertises()->sync($request->expertises);
            }

            if ($request->filled('languages')) {
                $profile->languages()->sync($request->languages);
            }

            DB::commit();

            $lawyer->load('legalProfile.qualifications.degreeType', 'legalProfile.qualifications.university');
            // dd($lawyer);
            $token = $lawyer->createToken('lawyer-token')->plainTextToken;

            return ResponseHelper::make(
                [
                    'token'  => $token,
                    'lawyer' => new LawyerResource($lawyer),
                ],
                __('client::messages.created_successfully'),
                true,
                201
            );

        } catch (\Illuminate\Http\Exceptions\HttpResponseException $e) {
            throw $e;
        } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('LegalProfile creation failed: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'line'  => $e->getLine(),
            'file'  => $e->getFile(),
        ]);
        return ResponseHelper::make(
            null,
            $e->getMessage(), // temporary: show real error in response
            false,
            500
        );
    }
    }
    public function storeCardID(LawyerCardIDRequest $request)
    {
        $lawyer = $this->ClientAuth();

        if (!$lawyer || $lawyer->type !== 'lawyer') {
            return ResponseHelper::make(
                null,
                __('client::messages.unauthenticated'),
                false,
                401
            );
        }
        if ($request->hasFile('front_id_card')) {
            $frontPath = Upload::uploadFile($request->file('front_id_card'), 'lawyer_id_cards');
        }
        if($request->hasFile('back_id_card')){
            $backPath = Upload::uploadFile($request->file('back_id_card'), 'lawyer_id_cards'); 
        }
        CardId::create([
            'lawyer_id' => $lawyer->id,
            'front_id_card' => $frontPath ?? null,
            'back_id_card' => $backPath ?? null,
        ]);
        $lawyer->update(['current_step' => 2]);
        $lawyer->refresh(); 

$token = $lawyer->createToken('lawyer-token')->plainTextToken;

        return ResponseHelper::make(
                [
                    'token'  => $token,
                    'lawyer' => new LawyerResource($lawyer),
                ],
            __('client::messages.uploaded_successfully'),
            true,
            200
        );

    }

    public function storeLegalCard(LawyerLegalCardRequest $request)
    {
        // dd($request->all());
        $lawyer = $this->ClientAuth();

        if (!$lawyer || $lawyer->type !== 'lawyer') {
            return ResponseHelper::make(
                null,
                __('client::messages.unauthenticated'),
                false,
                401
            );
        }
        if ($request->hasFile('front_legal_card')) {
            $frontPath = Upload::uploadFile($request->file('front_legal_card'), 'lawyer_legal_cards');
        }
        if($request->hasFile('back_legal_card')){
            $backPath = Upload::uploadFile($request->file('back_legal_card'), 'lawyer_legal_cards'); 
        }
        LegalCardId::create([
            'lawyer_id' => $lawyer->id,
            'front_legal_card' => $frontPath ?? null,
            'back_legal_card' => $backPath ?? null,
        ]);
        $lawyer->update([
            'current_step' => 3,
            'status' => 'pending',
            'is_submitted' => true,
            ]);
        $lawyer->refresh();
        $token=$lawyer->createToken('lawyer-token')->plainTextToken;
        return ResponseHelper::make(
                [
                    'token'  => $token,
                    'lawyer' => new LawyerResource($lawyer),
                ],
            __('client::messages.uploaded_successfully'),
            true,
            200
        );

    }

    public function ClientAuth()
    {
        return auth('client')->user();
    }
}
