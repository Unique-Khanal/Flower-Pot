<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Mail\VendorApplicationSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class VendorRegistrationController extends Controller
{
    public function create()
    {
        return view('vendor.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()],
            'business_name'         => ['required', 'string', 'max:255'],
            'business_phone'        => ['required', 'string', 'max:20'],
            'business_address'      => ['required', 'string'],
            'pan_number'            => ['required', 'string', 'max:20'],
            'pan_document'          => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
            'bank_name'             => ['nullable', 'string', 'max:255'],
            'bank_account_no'       => ['nullable', 'string', 'max:50'],
            'agreement'             => ['accepted'],
            'sample_photos'         => ['required', 'array', 'min:1', 'max:5'],
            'sample_photos.*'       => ['image', 'max:4096'], // 4MB each
        ], [
            'agreement.accepted'    => 'You must agree to the Vendor Agreement to apply.',
            'sample_photos.required' => 'Please upload at least one sample product photo.',
            'pan_document.required' => 'Please upload a photo or scan of your PAN certificate.',
        ]);

        $vendor = DB::transaction(function () use ($request) {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'vendor',
            ]);

            $photoPaths = [];
            foreach ($request->file('sample_photos', []) as $photo) {
                $photoPaths[] = $photo->store('vendor-applications', 'public');
            }

            $panDocumentPath = $request->file('pan_document')->store('vendor-applications/pan', 'public');

            return Vendor::create([
                'user_id'               => $user->id,
                'business_name'         => $request->business_name,
                'business_phone'        => $request->business_phone,
                'business_address'      => $request->business_address,
                'pan_number'            => $request->pan_number,
                'pan_document'          => $panDocumentPath,
                'bank_name'             => $request->bank_name,
                'bank_account_no'       => $request->bank_account_no,
                'sample_product_photos' => $photoPaths,
                'status'                => 'pending',
            ]);
        });

        // Notify every admin — both by email and (implicitly) in-system, since
        // the pending Vendor row itself is what the admin dashboard lists.
        User::where('role', 'admin')->get()->each(
            fn ($admin) => Mail::to($admin->email)->send(new VendorApplicationSubmitted($vendor))
        );

        return redirect()->route('login')->with('status',
            '🎉 Your vendor application has been submitted! We\'ll email you once it\'s reviewed.'
        );
    }
}