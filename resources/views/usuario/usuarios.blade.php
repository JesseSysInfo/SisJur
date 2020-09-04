@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Usuários</li>
@endsection

@section('content')
<div class="container">
<h2>Usuários</h2>
    <div class="card">
        <div class="card-body">
            <div class="text-right mb-1">
                <a class="btn btn-sm btn-success" href="{{ route('usuarios.novo') }}">Novo usuário</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th>Ativo</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role_id != null ? $user->role->nome : 'Sem perfil' }}</td>
                        <td>{{ $user->ativo == true ? 'Ativo' : 'Inativo' }}</td>
                        <td align='center'><a href="{{ route('usuarios.edicao', $user) }}">Editar</a></td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                {{ $users->links() }}
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection