<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function usuarios()
    {
        return view('usuario.usuarios', ['users' => User::paginate(20)]);
    }

    public function novo()
    {
        return view('usuario.novo', ['roles' => Role::all()]);
    }

    public function criar(Request $request)
    {
        
        $validateData = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'role_id' => ['required', 'integer'],
            'password' => ['required', 'min:8', 'string', 'confirmed'],
        ]);

        if($validateData->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validateData)
            ->withInput();
        }

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'ativo' => $request->ativo == 'on' ? true : false,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);

        $user->save();

        $request->session()->flash('success', 'Cadastro criado com sucesso!');

        return redirect()->back();

    }

    public function edicao(User $user)
    {
        return view('usuario.edicao', ['roles' => Role::all(), 'user' => $user]);
    }

    protected function validaEmail($validator, $user_id, $email)
    {
        $result = User::where('id', '<>', $user_id)
        ->where('email', '=', $email)
        ->count();

        if($result > 0)
        {
            $validator->after(function($validator){
                $validator->errors()->add('email', 'E-mail já utilizado!');
            });
            
        }
    }

    public function editar(User $user, Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'string'],
            'email' => ['required', 'email'],
            'role_id' => ['required', 'integer']
        ]);

       $this->validaEmail($validateData, $user->id, $request->email);

        if($validateData->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validateData)
            ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->ativo = $request->ativo == 'on' ? true : false;
        $user->role_id = $request->role_id;

        $user->update();

        $request->session()->flash('success', 'Cadastro editado com sucesso!');

        return redirect()
        ->back()
        ->withInput();

    }
}
