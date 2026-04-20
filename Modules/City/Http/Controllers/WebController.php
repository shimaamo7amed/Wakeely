<?php

namespace Modules\City\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\City\Entities\Model as City;
use Modules\Governorate\Entities\Model as Governorate;

class WebController extends BasicController
{
    public function index(Request $request)
    {
        $cities = City::get();

        return view('city::index', compact('cities'));
    }

    public function create()
    {
        $Cities = City::get();
        $governorates = Governorate::get();

        return view('city::create', compact('Cities', 'governorates'));
    }

    public function store(Request $request)
    {
        abort(404);
        $City = City::create($request->all());
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route(activeGuard().'.Cities.index');
    }

    public function show($id)
    {
        $City = City::with('governorate')->where('id', $id)->firstorfail();

        return view('city::show', compact('City'));
    }

    public function edit($id)
    {
        $Cities = City::get();
        $City = City::where('id', $id)->firstorfail();
        $governorates = Governorate::get();

        return view('city::edit', compact('City', 'Cities', 'governorates'));
    }

    public function update(Request $request, $id)
    {
        $City = City::where('id', $id)->firstorfail();
        $City->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route(activeGuard().'.Cities.index');
    }

    public function destroy($id)
    {
        $City = City::where('id', $id)->delete();

    }
}
