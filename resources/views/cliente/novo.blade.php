@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('clientes') }}">Clientes</a></li>
<li class="breadcrumb-item active" aria-current="page">Novo</li>
@endsection

@section('content')
<div class="container">
    <h2>Novo Cliente</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('clientes.cadastrar') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input tp_pessoa" name="tipo_pessoa" value="{{ $tipos_pessoa['pessoa_fisica'] }}" 
                            {{ old('tipo_pessoa') == null || old('tipo_pessoa') == $tipos_pessoa['pessoa_fisica'] ? 'checked' : '' }} id="tipo_pessoa_fisica">
                            <label class="form-check-label" for="tipo_pessoa_fisica">
                                Pessoa Física
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input tp_pessoa" name="tipo_pessoa" value="{{ $tipos_pessoa['pessoa_juridica'] }}" 
                            {{ old('tipo_pessoa') == $tipos_pessoa['pessoa_juridica'] ? 'checked' : '' }} id="tipo_pessoa_juridica">
                            <label class="form-check-label" for="tipo_pessoa_juridica">
                                Pessoa Jurídica
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nome" class="col-form-label col-md-4 text-md-right">Nome</label>
                    <div class="col-md-6">
                        <input id="nome" type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" value="{{ old('nome') }}" 
                        required autocomplete="nome" autofocus size="180">
                        @error('nome')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="email" class="col-form-label col-md-4 text-md-right">E-mail</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                        required autocomplete="email" autofocus size="180">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>            
                </div>
                <div class="form-group row" id="div_cpf">
                    <label for="cpf" class="col-form-label col-md-4 text-md-right">CPF</label>
                    <div class="col-md-3">
                        <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror cpf" name="cpf" value="{{ old('cpf') }}" 
                        autocomplete="cpf">
                    </div>                            
                </div>
                <div class="form-group row" id="div_cnpj">
                    <label for="cnpj" class="col-form-label col-md-4 text-md-right">CNPJ</label>
                    <div class="col-md-3">
                        <input id="cnpj" type="text" class="form-control @error('cnpj') is-invalid @enderror cnpj" name="cnpj" value="{{ old('cnpj') }}" 
                        autocomplete="cnpj">
                    </div>                            
                </div>
                <div class="form-group row">
                    <label for="data_nascimento" class="col-form-label col-md-4 text-md-right">Data de Nascimento</label>
                    <div class="col-md-3">
                        <input id="data_nascimento" type="text" class="form-control @error('data_nascimento') is-invalid @enderror data" name="data_nascimento" value="{{ old('data_nascimento') }}">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="nacionalidade" class="col-form-label col-md-4 text-md-right">Nacionalidade</label>
                    <div class="col-md-4">
                        <input id="nacionalidade" type="text" class="form-control @error('nascionalidade') is-invalid @enderror" name="nacionalidade" value="{{ old('nacionalidade') }}"
                        autocomplete="nacionalidade" size="100">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="estado_civil" class="col-form-label col-md-4 text-md-right">Estado Civil</label>
                    <div class="col-md-4">
                        <input id="estado_civil" type="text" class="form-control @error('estado_civil') is-invalid @enderror" name="estado_civil" value="{{ old('estado_civil') }}"
                        autocomplete="estado_civil" size="50">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="nome_mae" class="col-form-label col-md-4 text-md-right">Nome da Mãe</label>
                    <div class="col-md-6">
                        <input id="nome_mae" type="text" class="form-control @error('nome_mae') is-invalid @enderror" name="nome_mae" value="{{ old('nome_mae') }}"
                        autocomplete="nome_mae" size="180">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="nome_pai" class="col-form-label col-md-4 text-md-right">Nome da Pai</label>
                    <div class="col-md-6">
                        <input id="nome_pai" type="text" class="form-control @error('nome_pai') is-invalid @enderror" name="nome_pai" value="{{ old('nome_pai') }}"
                        autocomplete="nome_pai" size="180">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="profissao" class="col-form-label col-md-4 text-md-right">Profissão</label>
                    <div class="col-md-6">
                        <input id="profissao" type="text" class="form-control @error('profissao') is-invalid @enderror" name="profissao" value="{{ old('profissao') }}"
                        autocomplete="profissao" size="100">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="beneficio" class="col-form-label col-md-4 text-md-right">Benefício</label>
                    <div class="col-md-6">
                        <textarea id="beneficio"  class="form-control @error('profissao') is-invalid @enderror" name="beneficio" value="{{ old('beneficio') }}"
                        autocomplete="beneficio" size="500" rows="3"></textarea>
                    </div>      
                </div>
                <hr>
                <div class="form-group row">
                    <label for="cep" class="col-form-label col-md-4 text-md-right">CEP</label>
                    <div class="col-md-3">
                        <input id="cep" type="text" class="form-control @error('cep') is-invalid @enderror cep" name="cep" value="{{ old('cep') }}"
                        autocomplete="cep">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="endereco" class="col-form-label col-md-4 text-md-right">Endereço</label>
                    <div class="col-md-6">
                        <input id="endereco" type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ old('endereco') }}"
                        autocomplete="endereco" size="180">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="bairro" class="col-form-label col-md-4 text-md-right">Bairro</label>
                    <div class="col-md-6">
                        <input id="bairro" type="text" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro') }}"
                        autocomplete="bairro" size="180">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="cidade" class="col-form-label col-md-4 text-md-right">Cidade</label>
                    <div class="col-md-6">
                        <input id="cidade" type="text" class="form-control @error('cidade') is-invalid @enderror" name="cidade" value="{{ old('cidade') }}"
                        autocomplete="cidade" size="180">
                    </div>            
                </div>
                <div class="form-group row">
                    <label for="uf" class="col-form-label col-md-4 text-md-right">UF</label>
                    <div class="col-md-3">
                        <input id="uf" type="text" class="form-control @error('uf') is-invalid @enderror" name="uf" value="{{ old('uf') }}"
                        autocomplete="uf" size="2">
                    </div>            
                </div>
                <hr>
                <div class="form-group row">
                    <label for="" class="col-form-label col-md-4 text-md-right">Telefones</label>
                    <div class="col-md-3">
                        <input id="celular" type="text" class="form-control @error('celular') is-invalid @enderror celular" name="celular" value="{{ old('celular') }}"
                        autocomplete="celular">
                    </div>  
                    <div class="col-md-3">
                        <input id="fixo" type="text" class="form-control @error('fixo') is-invalid @enderror fixo" name="fixo" value="{{ old('fixo') }}"
                        autocomplete="fixo">
                    </div>          
                </div>
                <div class="mt-3 text-right">
                <button class="btn btn-primary" type="submit">Cadastrar</button>
                <a class="btn btn-secondary" href="{{ route('clientes') }}">Cancelar</a>
                </div>            
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$('#div_cnpj').hide();

$('.tp_pessoa').change(function(){

    var tp_pessoa_val = $(this).val();
    $('#cpf').val("");    
    $('#cnpj').val("");

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
