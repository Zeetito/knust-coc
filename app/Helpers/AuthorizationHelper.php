<?php

// app/Helpers/AuthorizationHelper.php -->

namespace App\Helpers;

class AuthorizationHelper
{
    public static function allowedTo($permissions)
    {
        if (auth()->user()->hasPermissionTo($permissions)) {
            return true; // Replace this with your custom logic
        }
    }
}
