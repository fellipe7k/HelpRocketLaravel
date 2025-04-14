@extends('admin.layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')
    <h1>Detalhes do Usuário</h1>
    
    <ul>
        <li> Nome: {{ $user->name }}</li>
        <li> E-mail: {{ $user->email }}</li>
       
    </ul>
    <form action="{{ route('users.destroy', $user->id ) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar</button>
    </form>
@endsection
