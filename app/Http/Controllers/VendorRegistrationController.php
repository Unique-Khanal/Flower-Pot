<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use App\Mail\VendorApplicationSubmitted;
use App\Rules\ValidRealEmail;
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

    /**
     * Live AJAX duplicate check — called while the vendor is still typing,
     * so "already registered" / "already used" shows inline immediately
     * instead of only after a full form submit.
     */
    public function checkDuplicate(Request $request)
    {
        $field = $request->query('field');
        $value = trim((string) $request->query('value', ''));

        if ($value === '') {
            return response()->json(['status' => 'empty']);
        }

        $checks = [
            'email' => fn () => User::where('email', strtolower($value))->exists()
                ? 'This email is already registered. Please log in instead.'
                : null,

            'pan_number' => fn () => Vendor::where('pan_number', $value)->exists()
                ? 'This PAN number is already registered with another vendor account.'
                : null,

            'business_name' => fn () => Vendor::whereRaw('LOWER(business_name) = ?', [strtolower($value)])->exists()
                ? 'A vendor with this business name already exists.'
                : null,
        ];

        if (! isset($checks[$field])) {
            return response()->json(['status' => 'unknown_field'], 400);
        }

        $message = $checks[$field]();

        return response()->json([
            'status'  => $message ? 'taken' : 'available',
            'message' => $message,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users,email', new ValidRealEmail],
            'password'              => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->numbers()],
            'business_name'         => ['required', 'string', 'max:255'],
            'business_phone'        => ['required', 'string', 'max:20'],
            'business_address'      => ['required', 'string'],
            'pan_number'            => ['required', 'string', 'max:20', 'unique:vendors,pan_number'],
            'pan_document'          => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:4096'],
            'bank_name'             => ['nullable', 'string', 'max:255'],
            'bank_account_no'       => ['nullable', 'string', 'max:50'],
            'agreement'             => ['accepted'],
            'sample_photos'         => ['required', 'array', 'min:1', 'max:5'],
            'sample_photos.*'       => ['image', 'max:4096'],
        ], [
            'agreement.accepted'    => 'You must agree to the Vendor Agreement to apply.',
            'sample_photos.required' => 'Please upload at least one sample product photo.',
            'pan_document.required' => 'Please upload a photo or scan of your PAN certificate.',
            'pan_number.unique'     => 'This PAN number is already registered with another vendor account.',
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
                // Stored on the private disk — these are business documents,
                // not public storefront assets. Served only via the
                // admin-authenticated route, never a direct public URL.
                $photoPaths[] = $photo->store('vendor-applications', 'local');
            }

            $panDocumentPath = $request->file('pan_document')->store('vendor-applications/pan', 'local');

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

        User::where('role', 'admin')->get()->each(
            fn ($admin) => Mail::to($admin->email)->send(new VendorApplicationSubmitted($vendor))
        );

        return redirect()->route('vendor.login')->with('vendor_application_submitted',
            'Your vendor application has been submitted! We\'ll email you once it\'s reviewed.'
        );
    }
}