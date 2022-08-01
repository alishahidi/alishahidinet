<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ContactAnswerRequest;
use App\Http\Services\Mail;
use App\Models\Contact;
use App\Models\ContactAnswer;
use System\Auth\Auth;
use System\Request\Request;

class ContactController extends AdminController
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->get();

        return view('admin.contact.index', compact('contacts'));
    }

    public function view($id)
    {
        $contact = Contact::find($id);

        return view('admin.contact.view', compact('contact'));
    }

    public function answer($id)
    {
        $request = new ContactAnswerRequest();
        $inputs = $request->all();
        $inputs['user_id'] = Auth::user()->id;
        $inputs['contact_id'] = $id;
        ContactAnswer::create($inputs);
        $contact = Contact::find($id);
        Mail::sendTemplateMail($contact->email, ' پاسخ به تماس شما'.e($contact->subject), $inputs['text'], 'mail/mail.jpg');

        return redirect(route('admin.contact.view', [$id]));
    }

    public function answerDestroy($id)
    {
        new Request();
        ContactAnswer::delete($id);

        return back();
    }
}
