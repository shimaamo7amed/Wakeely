<?php

namespace Modules\Faq\Http\Controllers;

use App\Functions\Upload;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::get();

        return view('faq::index', compact('Models'));
    }

    public function create()
    {
        return view('faq::create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'question_ar',
            'question_en',
            'answer_ar',
            'answer_en',
        ]);

        $Model = Model::create($data);
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->back();
    }

    public function show($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('faq::show', compact('Model'));
    }

    public function edit($id)
    {
        $Model = Model::where('id', $id)->firstorfail();

        return view('faq::edit', compact('Model'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::where('id', $id)->firstOrFail();
        
        $data = $request->only([
            'question_ar',
            'question_en',
            'answer_ar',
            'answer_en',
        ]);

        $Model->update($data);
        
        alert()->success(__('trans.updatedSuccessfully'));
        return redirect()->back();
    }

    public function destroy($id)
    {
        $Model = Model::where('id', $id)->delete();
    }
}
