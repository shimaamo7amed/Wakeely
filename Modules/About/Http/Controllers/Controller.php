<?php

namespace Modules\About\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\About\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('about::index', compact('Models'));
    }

    public function create()
    {
        return view('about::create');
    }

    public function store(Request $request)
{
    $data = $request->all();
    if ($request->hasFile('image')) {
        $data['image'] = Upload::uploadFile($request->image, 'about');
    }
    $Model = Model::create($data);

    alert()->success(__('trans.addedSuccessfully'));

    return redirect()->back();
}

    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('about::show', compact('Model'));
    }

    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('about::edit', compact('Model'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstOrFail();
        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($Model->image) {
                Upload::deleteImage($Model->image);
            }
            
            $data['image'] = Upload::uploadFile($request->image, 'about');
        }
        $Model->update($data);

        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->back();
    }


    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }
}
