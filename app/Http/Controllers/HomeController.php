<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        $key_peoples = User::where('hasKey', true)->get();
        return view('home', compact('key_peoples'));
        // return view('home');
    }
}
