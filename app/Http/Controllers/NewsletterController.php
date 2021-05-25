<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;



class NewsletterController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'news_email' => 'required|email'
        ]);
        if (!Newsletter::isSubscribed($request->news_email)) {

            Newsletter::subscribePending($request->news_email);

            return back()->with('news_success', "Thanks for subscribe Check your email!!");
        }
        return back()->with('news_fail', "You have already subscribed !!");
    }
}