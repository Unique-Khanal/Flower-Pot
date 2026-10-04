<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all'); // all | unread | read
        $search = trim((string) $request->query('search', ''));

        $query = Contact::latest();

        match ($status) {
            'unread' => $query->where('is_read', false),
            'read'   => $query->where('is_read', true),
            default  => null,
        };

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(15)->withQueryString();

        $counts = [
            'all'    => Contact::count(),
            'unread' => Contact::where('is_read', false)->count(),
            'read'   => Contact::where('is_read', true)->count(),
        ];

        return view('admin.contacts.index', compact('contacts', 'status', 'search', 'counts'));
    }

    /** Toggles read/unread — used both for the explicit button and auto-mark-on-expand. */
    public function toggleRead(Contact $contact): RedirectResponse
    {
        $contact->update(['is_read' => ! $contact->is_read]);

        return back();
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back()->with('success', 'Message deleted.');
    }
}