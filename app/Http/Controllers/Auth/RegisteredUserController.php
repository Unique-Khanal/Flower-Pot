<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'   => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'gender' => [
                'required',
                'in:male,female',
            ],
            'email'  => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'regex:/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/',
                'unique:'.User::class,
            ],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ], [
            'name.required'   => 'Full name is required.',
            'name.min'        => 'Name must be at least 3 characters.',
            'gender.required' => 'Please select your gender.',
            'email.required'  => 'Email address is required.',
            'email.email'     => 'Please enter a valid email address with @ symbol.',
            'email.regex'     => 'Email must be like name@gmail.com',
            'email.unique'    => 'This email is already registered. Please login instead.',
            'password.required' => 'Password is required.',
        ]);

        // Auto assign avatar based on gender
        $avatar = $request->gender === 'female' ? 'F5' : 'M2';

        $user = User::create([
            'name'     => $request->name,
            'gender'   => $request->gender,
            'avatar'   => $avatar,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
                         ->with('status', 'Account created successfully! Please sign in.');
    }
}