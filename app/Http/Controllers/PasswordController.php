<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function passwordReset($email)
    {
        $user = User::where('email', '=', $email);

        $response = ['msg' => 'Usuário não encontrado!'];

        if($user->count() == 1)
        {
            $password_reset = [
                'email' => $email,
                'token' => Str::of(Hash::make(Str::random(8)))->replace('/', ''),
                'created_at' => Carbon::now()
            ];

            DB::table('password_resets')
            ->where('email', '=', $email)
            ->delete();

            DB::table('password_resets')
            ->insert($password_reset);

            $details = [
                'title' => 'Alterar senha', 
                'body' => 'Sr(a).: ' . $user->first()->name . ', foi solicitada a alteração da sua senha no sistema.
                 O link tem validade de 24 horas, após expirado será necessário solicitar novamente. Para alteração da senha clique no link abaixo.', 
                'btn_link_alterar' => route('usuarios.alterar_senha', $password_reset['token']),
            ];

            \Mail::to($email)->send(new ResetPassword($details));

            $response = ['msg' => 'Link para alterar senha enviado com sucesso!'];
        }

        echo json_encode($response);

    }

    public function alteraSenha(Request $request, User $user)
    {
        
        $validate = Validator::make($request->all(), [
            'password' => ['required', 'min:8', 'string', 'confirmed'],
        ]);

        if($validate->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validate);
        }

        $user->password = Hash::make($request->password);

        $user->update();

        $request->session()->flash('success', 'Senha alterada com sucesso!');

        return redirect()
        ->back();
    }
}
