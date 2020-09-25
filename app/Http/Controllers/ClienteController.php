<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Cliente;
use App\TipoPessoa;
use App\Endereco;
use App\Contato;
use Auth;

class ClienteController extends Controller
{
    public function clientes()
    {

        return view('cliente.clientes', ['clientes' => Cliente::paginate(20)]);
    }

    public function novo()
    {
        return view('cliente.novo', ['tipos_pessoa' => TipoPessoa::getTiposPessoa()]);
    }

    public function cadastrar(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'nome' => ['required', 'min:3', 'string'],
            'email' => ['required', 'email', 'unique:clientes'],
        ]);

        if($validateData->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validateData)
            ->withInput();
        }

        $data_nascimento = Carbon::createFromFormat('d/m/Y', $request->data_nascimento);        

        $cliente = new Cliente([
            'user_id' => Auth::user()->id,
            'tipo_pessoa' => $request->tipo_pessoa,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'data_nascimento' => $data_nascimento->format('Y-m-d'),
            'nacionalidade' => $request->nacionalidade,
            'nome_pai' => $request->nome_pai,
            'nome_mae' => $request->nome_mae,
            'estado_civil' => $request->estado_civil,
            'profissao' => $request->profissao,
            'beneficio' => $request->beneficio,
        ]);

        $cliente->save();

        $endereco = new Endereco([
            'cep' => $request->cep, 
            'endereco' => $request->endereco, 
            'bairro' => $request->bairro, 
            'cidade' => $request->cidade, 
            'uf' => $request->uf, 
            'cliente_id' => $cliente->id
        ]);

        $endereco->save();

        $contato = new Contato([
            'celular' => $request->celular,
            'fixo' => $request->fixo,
            'cliente_id' => $cliente->id
        ]);

        $contato->save();

        $request->session()->flash('success', 'Cadastro criado com sucesso!');

        return redirect()->back();
    }
}
