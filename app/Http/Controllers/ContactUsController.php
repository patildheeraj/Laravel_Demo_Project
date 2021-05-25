<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ContactUsController extends Controller
{
    public function userFeedback()
    {
        $feedback = ContactUs::all();

        return view('users.feedback', compact('feedback'));
    }

    public function deleteFeedback($id)
    {
        DB::table('contact_us')->where(['id' => $id])->delete();
        return back()->with('fail', 'Feedback deleted successfully!!');
    }

    public function contactForm()
    {
        return view('front_end.contact');
    }

    public function submitContactForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|integer',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        return back()->with('success', 'Thank you for your feedback!!');
    }
}