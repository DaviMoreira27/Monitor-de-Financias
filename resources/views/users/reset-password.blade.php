@extends('layouts.main')
@section('title', 'Faturamento')
@section('css', 'userIndex')

@section('content')
    <main class="container-center">
        <h1>Resetar Senha</h1>
        @if ($errors->all())
                <div class="errors-container">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        <form action="{{route('password.update')}}" method="POST">
            @csrf

            <label for="input-email">Email cadastrado
                <input type="email" value="{{request()->input('email')}}" name="email" id="input-email">
            </label>
            <label for="input-email">Senha
                <input type="password" name="password" id="input-password">
            </label>
            <label for="input-email">Confirmar Senha
                <input type="password" name="password_confirmation" id="input-passwordC">
            </label>
            <input type="hidden" name="token" value="{{ $token }}">

            <input type="submit" value="Enviar">
        </form>
        <button onclick="window.location.href='/'">Voltar</button>
    </main>
@endsection