<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
}
