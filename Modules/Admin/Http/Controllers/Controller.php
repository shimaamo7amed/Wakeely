<?php

namespace Modules\Admin\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('admin::index', compact('Models'));
    }

    public function create()
    {
        return view('admin::create');
    }

    public function store(Request $request)
    {
        $Model = Model::create(['phone' => str_replace(' ', '', $request->phone)] + $request->except(['image', 'password', 'password_confirmation', 'phone']));
        $Model->password = bcrypt($request->password);
        if ($request->hasFile('image')) {
            $Model->image = Upload::UploadFile($request->image, 'Admins');
        }
        $Model->save();
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route(activeGuard().'.admins.index');
    }

    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('admin::show', compact('Model'));
    }

    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('admin::edit', compact('Model'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstorfail();
        $Model->update($request->except(['phone' => str_replace(' ', '', $request->phone)] + ['image', 'password', 'password_confirmation', 'phone']));
        if ($request->hasFile('image')) {
            $Model->image = Upload::UploadFile($request->image, 'Admins');
        }
        if ($request->password) {
            $Model->password = bcrypt($request->password);
        }
        $Model->save();
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route(activeGuard().'.admins.index');
    }

    public function destroy($id)
    {
        if (Model::count()) {
            Model::where('id', $id)->delete();
        }
    }
}
