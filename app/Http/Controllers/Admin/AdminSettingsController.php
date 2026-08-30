<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings', ['user' => Auth::user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'current_password'  => ['nullable', 'required_with:password', 'current_password'],
            'password'          => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Your profile has been updated.');
    }
}