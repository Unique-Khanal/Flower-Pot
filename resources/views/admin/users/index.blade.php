@extends('layouts.admin')
@section('title', 'Manage Users')
@section('content')

<section class="py-10 px-4 bg-stone-50 min-h-screen">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-stone-800 mb-6">User & Role Management</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form method="GET" class="mb-6">
            <input type="text" name="search" value="{{ $search }}"
                   placeholder="Search by name or email..."
                   class="w-full max-w-sm rounded-lg border-stone-300 text-sm px-4 py-2">
        </form>

                <div class="bg-white rounded-2xl shadow-sm overflow-x-auto">
            <table class="w-full text-sm min-w-[640px]">
                <thead style="background:#f0fdf4;">
                    <tr>
                        <th class="text-left px-4 py-3 text-xs font-bold text-green-700 uppercase">Name</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-green-700 uppercase">Email</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-green-700 uppercase">Current Role</th>
                        <th class="text-left px-4 py-3 text-xs font-bold text-green-700 uppercase">Change Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-stone-100">
                            <td class="px-4 py-3 font-semibold text-stone-800">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-stone-500">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="text-xs font-bold px-2 py-1 rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' :
                                       ($user->role === 'vendor' ? 'bg-amber-100 text-amber-700' :
                                       'bg-green-100 text-green-700') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <form method="POST" action="{{ route('admin.users.updateRole', $user) }}"
                                      class="flex items-center gap-2"
                                      onsubmit="return confirm('Change {{ $user->name }}\'s role to ' + this.role.value + '?');">
                                    @csrf
                                    <select name="role" class="text-xs rounded-lg border-stone-300">
                                        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                                        <option value="vendor" {{ $user->role === 'vendor' ? 'selected' : '' }}>Vendor</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    <button type="submit"
                                            class="text-xs bg-green-700 text-white font-semibold px-3 py-1.5 rounded-lg">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</section>

@endsection