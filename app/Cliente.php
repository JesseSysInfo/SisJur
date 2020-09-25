<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $fillable = [
        'tipo_pessoa', 'nome', 'cpf', 'cnpj', 'email', 'data_nascimento', 'nacionalidade', 'estado_civil', 'nome_mae', 'nome_pai', 'profissao', 'beneficio',
        'user_id',
    ];
}
