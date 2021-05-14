<?php

namespace App\Http\Controllers;

use App\Models\FrontUser;
use App\Models\User;
use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use Socialite;
use Auth;
use Illuminate\Support\Facades\Hash;



class SocialController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $data = Socialite::driver('google')->user();
            echo '<pre>';
            print_r($data);
            die();
            $user = FrontUser::where('google_id', $data->id)->first();

            if ($user) {
                Auth::login($user);
                return redirect('/');
            } else {
                $user = new User();
                $user->name = $data->name;
                $user->email = $data->email;
                $user->github_id = $data->id;
                $user->avatar = $data->avatar;
                $user->password = Hash::make('123');
                $user->save();
                Auth::login($user);
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function facebookSubmit()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookResponse()
    {
        $data = Socialite::driver('facebook')->user();
        echo '<pre>';
        print_r($data);

        $user = FrontUser::where('google_id', $data->id)->first();

        if ($user) {
            Auth::login($user);
            return redirect('/');
        } else {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->github_id = $data->id;
            $user->avatar = $data->avatar;
            $user->password = Hash::make('123');
            $user->save();
            Auth::login($user);
            return redirect('/');
        }
    }

    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }
    public function handleGithubCallback()
    {
        $data = Socialite::driver('github')->user();
        echo '<pre>';
        print_r($data);
        die();
        //$this->_registerOrLoginUser($user);
        $user = FrontUser::where('email', '=', $data->email)->first();

        // echo '<pre>';
        // print_r($user);
        // die();
        // if (!$user) {
        //     $user = new User();
        //     $user->name = $data->name;
        //     $user->email = $data->email;
        //     $user->github_id = $data->id;
        //     $user->avatar = $data->avatar;
        //     $user->password = Hash::make('123');
        //     $user->save();
        // }

        // Auth::login($user);
        // return redirect()->route('home');
    }
}