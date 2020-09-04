@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item"><a href="{{ route('usuarios') }}">Usuários</a></li>
<li class="breadcrumb-item active" aria-current="page">Editar</li>
@endsection

@section('content')
<div class="container">
<h2>Editar Usuário</h2>
<div class="card">
    <div class="card-body">
        <div class="text-right"><button class="btn btn-sm btn-success" onclick="resetar_senha();">Alterar senha</button></a></div>
        <form action="{{ route('usuarios.editar', $user) }}" method="post">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-form-label col-md-4 text-md-right">Nome</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') == '' ? $user->name : old('name') }}" required autocomplete="name" autofocus>

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
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') == '' ? $user->email : old('email') }}" required autocomplete="email">

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
                    <input type="checkbox" class="form-check-input ml-1" id="ativo" name="ativo" {{ (old('ativo') == null && $user->ativo == 1) || old('ativo') == 'on' ? 'checked' : '' }}>
                </div>               
            </div>
            <div class="form-group row">
                <label for="role_id" class="col-form-label col-md-4 text-md-right">Perfil</label>
                <div class="col-md-6">
                    <select name="role_id" id="role_id" class="custom-select @error('role_id') is-invalid @enderror" required>
                        <option value="">-Selecione-</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ (old('role_id') == null && $user->role_id == $role->id) || old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->nome }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>                
            </div>

            <div class="text-md-right col-md-10">
                <button class="btn btn-primary" type="submit">Editar</button>
                <a href="{{ route('usuarios') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
function resetar_senha()
{
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Deseja realmente alterar a senha!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, alterar!',
        cancelButtonText: 'Não, cancelar'
        }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'GET',
                url: "{{ route('senha.resetar', $user->email) }}",
                success: function(){
                    Swal.fire(
                    'Atenção!',
                    'Verifique a caixa de e-mail para alterar a senha.',
                    'success'
                    );
                }, 
                error: function(){
                    Swal.fire(
                    'Atenção!',
                    'Ocorreu um erro ao tentar alterar a senha.',
                    'error'
                    );
                }
            });
        // For more information about handling dismissals please visit
        // https://sweetalert2.github.io/#handling-dismissals
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire(
            'Cancelado!',
            'A senha não foi alterada.',
            'info'
            )
        }
    });
}
</script>
@endpush