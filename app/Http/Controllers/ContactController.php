<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller {
    public function index() {
        return view('contact');
    }

    public function store(Request $request) {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent! We will reply soon.');
    }

    public function myMessages() {
        $messages = Contact::where('user_id', auth()->id())->latest()->get();
        return view('contact_messages', compact('messages'));
    }
}