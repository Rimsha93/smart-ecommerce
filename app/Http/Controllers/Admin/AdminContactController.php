<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminContactController extends Controller {

    public function index(Request $request) {
        if ($request->ajax()) {
            $contacts = Contact::with('user')->select('contacts.*');

            return DataTables::of($contacts)
                ->addIndexColumn()
                ->addColumn('customer', function($contact) {
                    $initial = strtoupper(substr($contact->user->name, 0, 1));
                    return '<div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center 
                                    text-white fw-700" 
                                    style="width:32px;height:32px;background:#e94560;font-size:.8rem">
                                    '.$initial.'
                                </div>
                                <div>
                                    <div class="fw-600">'.$contact->user->name.'</div>
                                    <div class="text-muted small">'.$contact->user->email.'</div>
                                </div>
                            </div>';
                })
                ->addColumn('status_badge', function($contact) {
                    if ($contact->status == 'replied') {
                        return '<span class="badge bg-success px-3 py-2" 
                                    style="border-radius:50px">✓ Replied</span>';
                    }
                    return '<span class="badge bg-danger px-3 py-2" 
                                style="border-radius:50px">● Open</span>';
                })
                ->addColumn('date', function($contact) {
                    return $contact->created_at->format('M d, Y');
                })
                ->addColumn('actions', function($contact) {
                    $url = route('admin.contacts.show', $contact);
                    return '<a href="'.$url.'" class="btn btn-sm btn-outline-primary">
                                View & Reply
                            </a>';
                })
                ->rawColumns(['customer', 'status_badge', 'actions'])
                ->make(true);
        }

        return view('admin.contacts.index');
    }

    public function show(Contact $contact) {
        $contact->load('user');
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, Contact $contact) {
        $request->validate(['reply' => 'required|string']);
        $contact->update([
            'admin_reply' => $request->reply,
            'replied_at'  => now(),
            'status'      => 'replied',
        ]);
        return back()->with('success', 'Reply sent!');
    }
}