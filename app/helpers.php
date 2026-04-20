<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('hasPermission')) {

    function hasPermission($permission)
    {
        $user = Auth::guard(activeGuard())->user();

        if (!$user) {
            return false;
        }

        return $user->can($permission);
    }
}