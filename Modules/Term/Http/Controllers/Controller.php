<?php

namespace Modules\Term\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Term\Entities\Model;

class Controller extends BasicController
{
    public function index(Request $request)
    {
        $Models = Model::orderBy('arrangement')->get();

        return view('term::index', compact('Models'));
    }

    public function create()
    {
        return view('term::create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'slug' => 'required|string|unique:terms,slug',
            'arrangement' => 'required|integer',
            'sections_ar' => 'required',
            'sections_en' => 'required',
        ]);

        Model::create([
            'slug' => \Str::slug($data['slug']),
            'arrangement' => $data['arrangement'],
            'sections_ar' => json_decode($data['sections_ar'], true),
            'sections_en' => json_decode($data['sections_en'], true),
        ]);

        return back()->with('success', 'Created');
    }

    public function show($id)
    {
        $Model = Model::findOrFail($id);
        return view('term::show', compact('Model'));
    }

    public function edit($id)
    {
        $Model = Model::findOrFail($id);

        return view('term::edit', compact('Model'));
    }

    public function update(Request $request, $id)
    {
        $Model = Model::findOrFail($id);

        $data = $request->validate([
            'slug' => 'required|string|unique:terms,slug,' . $id,
            'arrangement' => 'required|integer',
            'sections_ar' => 'required',
            'sections_en' => 'required',
        ]);

        $Model->update([
            'slug' => \Str::slug($data['slug']),
            'arrangement' => $data['arrangement'],
            'sections_ar' => json_decode($data['sections_ar'], true),
            'sections_en' => json_decode($data['sections_en'], true),
        ]);

        return back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        Model::findOrFail($id)->delete();

        alert()->success(__('trans.deletedSuccessfully'));
        return redirect()->back();
    }
}
