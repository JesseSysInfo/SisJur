@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('clientes') }}">Clientes</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ $visualizar == 1 ? 'Visualizar' : 'Editar' }}</li>
@endsection

@section('content')
<div class="container">
    <h2>{{ $visualizar == 1 ? 'Visualizar' : 'Editar' }}</h2>
    <div>
        <em><small>Alterado em: {{ $cliente->updated_at }} por {{ $cliente->getUsuarioAlteracao != null ? $cliente->getUsuarioAlteracao->name : 'Usuário não registrado' }}</small></em>
    </div>
    <div class="card">
        <div class="card-body">
            @include('cliente.form_edicao')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
if({{ $cliente->tipo_pessoa }} == 1)
{
    $('#div_cpf').show();
    $('#div_cnpj').hide();
}
if({{ $cliente->tipo_pessoa }} == 2)
{
    $('#div_cpf').hide();
    $('#div_cnpj').show();
}

$('.tp_pessoa').change(function(){

    var tp_pessoa_val = $(this).val();
    $('#cpf').val('{{ $cliente->cpf }}');    
    $('#cnpj').val('{{ $cliente->cnpj }}');

    if(tp_pessoa_val == 1)
    {
        $('#div_cpf').show();
        $('#div_cnpj').hide();
    }
    if(tp_pessoa_val == 2)
    {
        $('#div_cpf').hide();
        $('#div_cnpj').show();
    }
});

function setEndereco(endereco, bairro, cidade, uf)
{
    $('#endereco').val(endereco);
    $('#bairro').val(bairro);
    $('#cidade').val(cidade);
    $('#uf').val(uf);
}

$('#cep').keyup(function(){
    var cep = $(this).val().replace('.', '').replace('-', '');

    if(cep.length == 8)
    {
        $.ajax({
            type: 'GET',
            url: 'https://viacep.com.br/ws/'+cep+'/json/',
            dataType: 'json'
        }).done(function(resposta){
            setEndereco(resposta['logradouro'], resposta['bairro'], resposta['localidade'], resposta['uf']);
        }).fail(function(jqXHR, textStatus){
            alert('Error ao buscar endereço: ' + textStatus);
        });
    }
    else
    {
        setEndereco('','','','');
    }
});
</script>
@endpush
