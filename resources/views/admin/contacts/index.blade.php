@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
<div class="max-w-5xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-extrabold text-[#1B3B2F]">Contact Messages</h1>
        <p class="text-sm text-stone-500 mt-1">Messages submitted through the public Contact page.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm">{{ session('success') }}</div>
    @endif

    <div class="flex flex-wrap items-center gap-4 mb-5">
        <div class="flex gap-2 text-sm flex-wrap">
            @foreach (['all' => 'All', 'unread' => 'Unread', 'read' => 'Read'] as $key => $label)
                <a href="{{ route('admin.contacts.index', ['status' => $key]) }}"
                   class="px-3 py-1.5 rounded-lg font-semibold
                          {{ $status === $key ? 'bg-green-700 text-white' : 'bg-stone-100 text-stone-600 hover:bg-stone-200' }}">
                    {{ $label }}
                    @if ($counts[$key] > 0)
                        <span class="ml-1 {{ $status === $key ? 'bg-white/25' : 'bg-stone-400 text-white' }} text-[10px] px-1.5 py-0.5 rounded-full">{{ $counts[$key] }}</span>
                    @endif
                </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('admin.contacts.index') }}" class="flex-1 min-w-[200px] flex gap-2">
            <input type="hidden" name="status" value="{{ $status }}">
            <input type="text" name="search" value="{{ $search }}" placeholder="Search name, email, subject…"
                   class="w-full text-sm rounded-lg border-stone-300">
            <button class="bg-[#1B3B2F] hover:bg-[#12281F] text-white text-sm font-bold px-4 py-2 rounded-lg">Search</button>
        </form>
    </div>

    @if ($contacts->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm p-16 text-center text-stone-400">
            No {{ $status === 'all' ? '' : $status . ' ' }}messages.
        </div>
    @else
        <div class="space-y-3">
            @foreach ($contacts as $contact)
                <details class="bg-white rounded-2xl shadow-sm overflow-hidden group"
                          {{ request('open') == $contact->id ? 'open' : '' }}
                          ontoggle="if(this.open && {{ $contact->is_read ? 'false' : 'true' }}) document.getElementById('read-form-{{ $contact->id }}').requestSubmit()">
                    <summary class="list-none cursor-pointer px-5 py-4 flex items-center justify-between gap-3 flex-wrap">
                        <div class="flex items-center gap-3 min-w-0">
                            @unless ($contact->is_read)
                                <span class="w-2 h-2 rounded-full bg-amber-500 flex-shrink-0"></span>
                            @endunless
                            <div class="min-w-0">
                                <p class="font-bold text-stone-800 truncate">{{ $contact->subject }}</p>
                                <p class="text-xs text-stone-400 truncate">{{ $contact->full_name }} &middot; {{ $contact->email }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-stone-400 flex-shrink-0">{{ $contact->created_at->diffForHumans() }}</span>
                    </summary>

                    <div class="px-5 pb-5 pt-1 border-t border-stone-100">
                        <p class="text-sm text-stone-600 whitespace-pre-line mb-4">{{ $contact->message }}</p>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-stone-400">
                            @if ($contact->phone_no)
                                <span>📞 {{ $contact->phone_no }}</span>
                            @endif
                                                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ rawurlencode($contact->email) }}&su={{ rawurlencode('Re: ' . $contact->subject) }}"
                               target="_blank" rel="noopener"
                               class="text-[#2F6B4F] font-semibold hover:underline">✉ Reply by email</a>
                            <a href="mailto:{{ $contact->email }}?subject={{ rawurlencode('Re: ' . $contact->subject) }}"
                               class="text-stone-400 hover:text-stone-600 hover:underline">(use mail app)</a>

                            <form id="read-form-{{ $contact->id }}" action="{{ route('admin.contacts.toggleRead', $contact) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-stone-500 hover:text-stone-700 font-semibold">
                                    Mark as {{ $contact->is_read ? 'unread' : 'read' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline"
                                  onsubmit="return confirmDelete(this, 'Delete this message?', 'This will permanently delete the message from {{ addslashes($contact->full_name) }}.', 'Yes, delete');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Delete</button>
                            </form>
                        </div>
                    </div>
                </details>
            @endforeach
        </div>

        <div class="mt-8">{{ $contacts->links() }}</div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function confirmDelete(form, title, text, confirmText) {
        // If SweetAlert failed to load, fall back to the browser dialog
        // so the Delete button never becomes dead.
        if (typeof Swal === 'undefined') {
            if (window.confirm(title + '\n' + text)) {
                form.submit();
            }
            return false;
        }

        Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText || 'Yes, delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#3F6B54',
            customClass: {
                popup:         'rounded-2xl',
                confirmButton: 'rounded-xl',
                cancelButton:  'rounded-xl',
            }
        }).then(function (result) {
            if (result.isConfirmed) {
                form.submit();
            }
        });

        return false; // always block the normal submit; we submit manually above
    }
</script>
@endpush