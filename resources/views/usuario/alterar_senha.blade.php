@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page">Alterar Senha</li>
@endsection

@section('content')
<div class='container'>
    <h2>Alterar Senha</h2>
    <div class="card">
        <div class="card-body">
        @if($enable == false)
        <div class="alert alert-danger" role="alert">
            O pedido de alteração de senha está expirado, solicite uma nova alteração de senha!
        </div>
        @else

        <form action="{{ route('senha.alterar', $user) }}" method="post">
        @csrf
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
                <button class="btn btn-primary" type="submit">Alterar</button>
                <a href="{{ route('welcome') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>

        @endif        
        </div>
    </div>
</div>
@endsection