<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class VendorSettingsController extends Controller
{
    public function edit(): View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('vendor.settings', [
            'user'   => $user,
            'vendor' => $user->vendor,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Vendor $vendor */
        $vendor = $user->vendor;

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'business_name'     => ['required', 'string', 'max:255'],
            'business_phone'    => ['required', 'string', 'max:20'],
            'business_address'  => ['required', 'string'],
            'bank_name'         => ['nullable', 'string', 'max:255'],
            'bank_account_no'   => ['nullable', 'string', 'max:50'],
            'current_password'  => ['nullable', 'required_with:password', 'current_password'],
            'password'          => ['nullable', 'confirmed', Password::defaults()],
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $vendor->update([
            'business_name'    => $request->business_name,
            'business_phone'   => $request->business_phone,
            'business_address' => $request->business_address,
            'bank_name'        => $request->bank_name,
            'bank_account_no'  => $request->bank_account_no,
        ]);

        return back()->with('success', 'Your store settings have been updated.');
    }
}