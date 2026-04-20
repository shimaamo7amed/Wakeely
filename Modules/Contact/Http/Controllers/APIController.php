<?php

namespace Modules\Contact\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Contact\Entities\Model;
use Modules\Contact\Http\Requests\ContactRequest;

namespace Modules\Contact\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Contact\Entities\Model;
use Modules\Contact\Http\Requests\ContactRequest;

class APIController extends BasicController
{
    public function store(ContactRequest $request)
    {
        Model::create($request->all());

        if ($request->wantsJson()) {
            return ResponseHelper::make(null, __('trans.addedSuccessfully'));
        }

        return redirect()->back()->with('success', __('trans.addedSuccessfully'));

    }
}
