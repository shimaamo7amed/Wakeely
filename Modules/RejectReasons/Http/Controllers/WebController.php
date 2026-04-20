<?php

namespace Modules\RejectReasons\Http\Controllers;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Client\Entities\Model;
use Yajra\DataTables\DataTables;
use Modules\Country\Entities\Country;
// use Modules\RejectReasons\Http\Requests\Admin\StoreRequest;
// use Modules\RejectReasons\Http\Requests\Admin\UpdateRequest;

class WebController extends BasicController
{
    public function index(Request $request)
    {
        return view('reject-reasons::index');
    }


    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        return view('reject-reasons::show', compact('Model'));
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }

    public function datatable(Request $request)
    {
        $query = Model::query()
            ->latest()
            ->withTrashed()
            ->when(request()->sort_column && request()->sort_direction, function ($query) {
                return $query->orderBy(request()->sort_column, request()->sort_direction);
            });
        return DataTables::of($query)
            ->addColumn('actions', function ($Model) {
                return view('client::layouts.actions', ['Model' => $Model]);
            })
            ->editColumn('name', function ($Model) {
                return view('client::layouts.name', ['Model' => $Model]);
            })
            ->editColumn('status', function ($Model) {
                return $Model->status == 1 ? __('trans.active') : __('trans.inactive');
            })
            ->editColumn('image', function ($Model) {
                return view('client::layouts.image', ['Model' => $Model]);
            })
            ->editColumn('phone', function ($Model) {
                return $Model->phone_code.$Model->phone;
            })
            ->editColumn('created_at', function ($Model) {
                if ($Model->created_at) {
                    return $Model->created_at->translatedFormat("F j, Y, g:i a");
                }
            })
            ->addIndexColumn()
            ->rawColumns(['status', 'actions'])
            ->make(true);
    }

}
