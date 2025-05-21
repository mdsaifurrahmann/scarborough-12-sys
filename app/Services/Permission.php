<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


class Permission
{
    public static function check($permission, $message = 'You do not have permission to perform this action')
    {
        if (!Auth::user()->can($permission)) {
            // Redirect back with an error message if permission check fails
            Session::flash('error', $message);
            return back();
        }

        return null;  // Indicate that permission check passed
    }
}
