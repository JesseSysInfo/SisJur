<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosTrabalhistas extends Model
{
    protected $fillable = ['ctps', 'serie', 'pis_pasep', 'cliente_id'];
}
