<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\ContactRequest;
use App\Http\Requests\Home\ContactShowRequest;
use App\Http\Services\Mail;
use App\Models\Contact;
use System\Config\Config;

class ContactController extends Controller
{
    public function index()
    {
        return view('app.contact');
    }

    public function store()
    {
        $request = new ContactRequest();
        $inputs = $request->all();
        $inputs['support_key'] = get_rand_key();
        Mail::sendTemplateMail($inputs['email'], ' : ارسال پیام', 'پیام شما دریافت شد کد پشتیبانی شما'.$inputs['support_key'], 'mail/mail.jpg');
        Mail::sendTemplateMail(Config::get('mail.SMTP.TO.MAIL'), 'پیام از طرف '.$inputs['name'].' '.$inputs['subject'], $inputs['text'], 'mail/mail1.jpg');
        Contact::create($inputs);
        flash('Support Key', 'با موفقیت ذخیره و ارسال شد. کد پشتیبانی شما: '.$inputs['support_key']);

        return back();
    }

    public function sendShow()
    {
        $request = new ContactShowRequest();
        $inputs = $request->all();

        return redirect(route('home.contact.show', [$inputs['support_key']]));
    }

    public function show($supportKey)
    {
        $contact = Contact::where('support_key', $supportKey)->get()[0];
        if ($contact) {
            return view('app.show-contact', compact('contact'));
        } else {
            return redirect(route('home.contact.index'));
        }
    }
}
