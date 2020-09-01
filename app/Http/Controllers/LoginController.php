<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{


    public function entrar(Request $request)
    {
        if(Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'ativo' => 1]))
        {
            return redirect()->route('home');
        }

        $user = User::where('email', $request['email'])
        ->first();

        if($user != null && $user['ativo'] == 0){
            Auth::logout();
            $request->session()->flash('error', 'Seu cadastro ainda não está ativo. Aguarde a confirmação da ativação.');
            return redirect()->back();            
        }
        else
        {
            $request->session()->flash('error', 'Usuário ou senha inválido.');
            return redirect()
            ->back()
            ->withInput();
        }
    }

    public function sair()
    {
        Auth::logout();
        return redirect('/');
    }
    
}
