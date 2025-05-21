<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index()
    {
        //        $routes = Route::getRoutes()->getRoutesByName();
        //
        //        $routeNames = array_keys($routes);
        //
        //        $remove = ['home', 'contact', 'shop', 'register', 'login'];
        //
        //        $routeNames = array_diff($routeNames, $remove);
        //
        //        $routeNames = array_values($routeNames);


        //        dd($routeNames);

        $members = User::count();
        return view('panel.dashboard');
    }
}
