<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view ('home.index')->with('name', 'John Doe')
            ->with('age', 30)
            ->with('city', 'New York')
            ->with('country', 'ge')
            ->with('job','<b>Developer</b>')
            ->with('hobbies', ['Programming', 'Traveling', 'Cooking', 'Reading', 'Gaming']);

    }
    //
}
