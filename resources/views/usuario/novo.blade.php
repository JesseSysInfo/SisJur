@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Usuários</a></li>
<li class="breadcrumb-item active" aria-current="page">Novo</li>
@endsection

@section('content')
<div class="container">
<h2>Novo Usuário</h2>
<div class="card">
    <div class="card-body">
        <form action="{{ route('usuarios.criar') }}" method="post">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-form-label col-md-4 text-md-right">Nome</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-form-label col-md-4 text-md-right">E-mail</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 text-md-right">
                    <label for="ativo" class="form-check-label">Ativo</label>                    
                </div>
                <div class="col-md-6">                 
                    <input type="checkbox" class="form-check-input ml-1" id="ativo" name="ativo" {{ old('ativo') == 'on' ? 'checked' : '' }}>
                </div>               
            </div>
            <div class="form-group row">
                <label for="role_id" class="col-form-label col-md-4 text-md-right">Perfil</label>
                <div class="col-md-6">
                    <select name="role_id" id="role_id" class="custom-select @error('role_id') is-invalid @enderror" required>
                        <option value="">-Selecione-</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->nome }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>                
            </div>
            <div class="form-group row">
                <label for="password" class="col-form-label col-md-4 text-md-right">Senha</label>
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmação da Senha</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="text-md-right col-md-10">
                <button class="btn btn-primary" type="submit">Cadastrar</button>
                <a href="{{ route('usuarios') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection