<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = [
        'tipo_pessoa', 'nome', 'cpf', 'cnpj', 'email', 'data_nascimento', 'nacionalidade', 'estado_civil', 'nome_mae', 'nome_pai', 'profissao', 'beneficio',
        'user_id',
    ];

    public function getEndereco()
    {

        return $this->hasOne('App\Endereco');
    }

    public function getContato()
    {

        return $this->hasOne('App\Contato');
    }

    public function getDadosTrabalhistas()
    {

        return $this->hasOne('App\DadosTrabalhistas');
    }

    public function getUsuarioAlteracao()
    {

        return $this->hasOne('App\User', 'id');
    }
}
