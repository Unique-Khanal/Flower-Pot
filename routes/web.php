<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', function () {
    return view('home.index'); 
});





Route::view('/about', 'about')->name('about');



