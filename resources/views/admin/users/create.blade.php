@extends('admin.layouts.app')

@section('title', 'Criar novo Usuário')

@section('content')
    <h1>Novo Usuário</h1>
    
    <x-alert/>

<form action="{{ route ('users.store') }}"  method="POST">
    @csrf()
    <input type="text" name="name" placeholder="Nome" value="{{ old('name') }}">    
    <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}">    
    <input type="password" name="password" placeholder="Senha">    
    <button type="submit">Enviar</button>
</form>

@endsection
