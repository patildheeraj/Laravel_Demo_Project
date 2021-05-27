<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\FrontUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        $contact->reply = '';
        $contact->save();
        return back()->with('success', 'Thank you for your feedback. I will respond you soon!!');
    }

    public function reply(Request $request)
    {
        $request->validate([
            'reply' => 'required',
        ]);
        DB::table('contact_us')->where(['id' => $request->id])->update(['reply' => $request->reply]);
        $data = json_decode(json_encode(ContactUs::where(['id' => $request->id])->first()));

        $email = $data->email;
        $messageData = [
            'data' => $data,
        ];
        // echo '<pre>';
        // print_r($messageData);
        // die();
        Mail::send('emails.feedback_reply', $messageData, function ($mail) use ($email) {
            $mail->to($email)->subject('Reply to your feedback- E-shopper Website');
        });

        return back()->with('success', 'Reply send to user Email!!');
    }
}