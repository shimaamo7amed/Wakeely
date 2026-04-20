<?php

namespace Modules\Governorate\Http\Controllers;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Governorate\Entities\Model as Governorate;
use Modules\Country\Entities\Model as Country;

class WebController extends BasicController
{
    public function index(Request $request)
    {
        $Governorates = Governorate::get();
        $Country=Country::get();

        return view('governorate::index', compact('Governorates','Country'));
    }

    public function create()
    {
        $Governorates= Governorate::get();
        $countries = Country::get();

        return view('governorate::create', compact('Governorates', 'countries'));
    }

    public function store(Request $request)
    {
        $Governorate = Governorate::create($request->all());
        alert()->success(__('trans.addedSuccessfully'));

        return redirect()->route(activeGuard().'.governorates.index');
    }

    public function show($id)
    {
        $Governorate = Governorate::with('country')->where('id', $id)->firstorfail();

        return view('governorate::show', compact('Governorate'));
    }

    public function edit($id)
    {
        $countries = Country::get();
        $Governorate = Governorate::where('id', $id)->firstorfail();

        return view('governorate::edit', compact('Governorate', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $Governorate = Governorate::where('id', $id)->firstorfail();
        $Governorate->update($request->all());
        alert()->success(__('trans.updatedSuccessfully'));

        return redirect()->route(activeGuard().'.governorates.index');
    }

    public function destroy($id)
    {
        $Governorate = Governorate::where('id', $id)->delete();

    }
}
