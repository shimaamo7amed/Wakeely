<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;
use Modules\Admin\Entities\Model as Admin;

class HomeController extends BasicController
{
    public function home(Request $request)
    {
        $adminsCount = Admin::count();

        return view('Admin.home')->with(get_defined_vars());
    }
}
