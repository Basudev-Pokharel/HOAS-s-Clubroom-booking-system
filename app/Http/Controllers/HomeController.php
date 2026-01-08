<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        $key_peoples = User::where('hasKey', true)->get();
        $userAddress = session('user_address');
        return view('home', compact('key_peoples', 'userAddress'));
        // return view('home');
    }
}
