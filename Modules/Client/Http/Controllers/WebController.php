<?php

namespace Modules\Client\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Client\Entities\Model;
use Modules\Client\Http\Requests\Admin\StoreRequest;
use Modules\Client\Http\Requests\Admin\UpdateRequest;
use Modules\Country\Entities\Country;
use Yajra\DataTables\Facades\DataTables;

class WebController extends BasicController
{
    public function index(Request $request)
    {
        return view('client::index');
    }


    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        return view('client::show', compact('Model'));
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }

    public function datatable(Request $request)
    {
        $query = Model::select('id', 'first_name', 'last_name', 'email', 'type', 'phone_code', 'phone', 'status', 'created_at')
            ->latest()
            ->where('type', 'user')
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
