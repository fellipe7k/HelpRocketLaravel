@extends('admin.layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
<h1> Usuários</h1>



<a href="{{ route ('users.create') }}">Adicionar novo</a>

<x-alert/>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{$user -> name}}</td>
                <td>{{$user -> email}}</td>
                <td>
                    <a href="{{ route ('users.edit', $user->id) }}">Editar</a>
                    <a href="{{ route ('users.show', $user->id) }}">Detalhes</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="100"> Nenhum usuario no banco</td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $users->links() }}
@endsection