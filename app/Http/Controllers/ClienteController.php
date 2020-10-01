<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Cliente;
use App\TipoPessoa;
use App\Endereco;
use App\Contato;
use App\DadosTrabalhistas;
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

        $data_nascimento = $request->data_nascimento != null ? Carbon::createFromFormat('d/m/Y', $request->data_nascimento) : $request->data_nascimento;        

        $cliente = new Cliente([
            'user_id' => Auth::user()->id,
            'tipo_pessoa' => $request->tipo_pessoa,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'data_nascimento' => $data_nascimento != null ? $data_nascimento->format('Y-m-d') : $data_nascimento,
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

        $dadosTrabalhistas = new DadosTrabalhistas([
            'ctps' => $request->ctps, 
            'serie' => $request->serie, 
            'pis_pasep' => $request->pis_pasep, 
            'cliente_id' => $cliente->id
        ]);

        $dadosTrabalhistas->save();

        $request->session()->flash('success', 'Cadastro criado com sucesso!');

        return redirect()->back();
    }

    public function edicao(Cliente $cliente, $visualizar)
    {

        If($cliente->data_nascimento != null)
        {
            $cliente->data_nascimento = Carbon::createFromFormat('Y-m-d', $cliente->data_nascimento)->format('d/m/Y');
        }

        return view('cliente.edicao', ['cliente' => $cliente, 'tipos_pessoa' => TipoPessoa::getTiposPessoa(), 'visualizar' => $visualizar]);
    }

    protected function validaEdicao($validator, $cliente_id, $cliente_email, $cliente_tipo_pessoa, $cliente_cpf)
    {

        $email_cadastrado = Cliente::where('id','<>', $cliente_id)
        ->where('email', '=', $cliente_email)
        ->count();

        if($email_cadastrado != 0)
        {
            $validator->after(function($validator){
                $validator->errors()->add('email', 'E-mail já utilizado!');
            });
        }

        $cpf_cadastrado = Cliente::where('id', '<>', $cliente_id)
        ->where('cpf', '=', $cliente_cpf)
        ->count();

        if($cliente_tipo_pessoa == 1 && $cliente_cpf != null && $cpf_cadastrado != 0)
        {
            $validator->after(function($validator){
                $validator->errors()->add('cpf', 'CPF já utilizado!');
            });
        }
    }

    public function editar(Cliente $cliente, Request $request)
    {

        $validateData = Validator::make($request->all(), [
            'nome' => ['required', 'min:3', 'string'],
            'email' => ['required', 'email'],
        ]);

        $this->validaEdicao($validateData, $cliente->id, $request->email, $request->tipo_pessoa, $request->cpf);

        if($validateData->fails())
        {
            return redirect()
            ->back()
            ->withErrors($validateData)
            ->withInput();
        }

        $data_nascimento = $request->data_nascimento != null ? Carbon::createFromFormat('d/m/Y', $request->data_nascimento) : $request->data_nascimento;

        $cliente->update([
            'user_id' => Auth::user()->id,
            'tipo_pessoa' => $request->tipo_pessoa,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'cnpj' => $request->cnpj,
            'email' => $request->email,
            'data_nascimento' => $data_nascimento != null ? $data_nascimento->format('Y-m-d') : $data_nascimento,
            'nacionalidade' => $request->nacionalidade,
            'nome_pai' => $request->nome_pai,
            'nome_mae' => $request->nome_mae,
            'estado_civil' => $request->estado_civil,
            'profissao' => $request->profissao,
            'beneficio' => $request->beneficio,
        ]);

        $endereco = $cliente->getEndereco;

        $endereco->update([
            'cep' => $request->cep, 
            'endereco' => $request->endereco, 
            'bairro' => $request->bairro, 
            'cidade' => $request->cidade, 
            'uf' => $request->uf
        ]);

        $contato = $cliente->getContato;

        $contato->update([
            'celular' => $request->celular,
            'fixo' => $request->fixo
        ]);

        $dadosTrabalhistas = $cliente->getDadosTrabalhistas;

        $dadosTrabalhistas->update([
            'ctps' => $request->ctps, 
            'serie' => $request->serie, 
            'pis_pasep' => $request->pis_pasep
        ]);

        $request->session()->flash('success', 'Cadastro editado com sucesso!');

        return redirect()->back();
    }
}
