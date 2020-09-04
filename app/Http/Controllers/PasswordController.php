<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function passwordReset($email)
    {
        $user = User::where('email', '=', $email)
        ->count();

        if($user == 1)
        {
            $password_reset = [
                'email' => $email,
                'token' => Hash::make(Str::random(8)),
                'created_at' => Carbon::now()
            ];

            DB::table('password_resets')
            ->where('email', '=', $email)
            ->delete();

            DB::table('password_resets')
            ->insert($password_reset);
        }

        // falta enviar e-mail
    }
}
