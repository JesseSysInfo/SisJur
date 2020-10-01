@extends('app')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Clientes</li>
@endsection

@section('content')
<div class="container">
    <h2>Clientes</h2>
    <div class="card">
        <div class="card-body">
            <div class="text-right mb-1">
                <a class="btn btn-sm btn-success" href="{{ route('clientes.novo') }}">Novo cliente</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nome }}</td>
                        <td>{{ $cliente->cpf }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td align="center">
                            <a href="{{ route('clientes.edicao', [$cliente, 1]) }}">Visualizar</a> |
                            <a href="{{ route('clientes.edicao', [$cliente, 2]) }}">Editar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    {{ $clientes->links() }}
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection