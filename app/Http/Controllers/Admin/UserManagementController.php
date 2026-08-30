<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');

        $users = User::query()
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%"))
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users', 'search'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:customer,vendor,admin'],
        ]);

        if ($user->id === Auth::id() && $request->role !== 'admin') {
            return back()->with('error', 'You cannot remove your own admin access.');
        }

        $oldRole = $user->role;
        $user->update(['role' => $request->role]);

        return back()->with('success',
            "{$user->name}'s role changed from {$oldRole} to {$request->role}."
        );
    }
}