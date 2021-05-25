<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public static function cartCount()
    {
        $user_email = Session::get('FRONT_Email');
        $session_id = Session::get('session_id');
        $cartCount = 0;
        if (empty($user_email)) {
            $cartCount = DB::table('carts')->where(['session_id' => $session_id])->sum('quantity');
        } else {
            $cartCount = DB::table('carts')->where(['user_email' => $user_email])->sum('quantity');
        }
        return $cartCount;
    }
}