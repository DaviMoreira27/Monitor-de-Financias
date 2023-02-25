@extends('layouts.main')
@section('title', 'Faturamento')
@section('css', 'userIndex')

@section('content')
    <main class="container-center">
        <h1>Enviar relatório para Email</h1>

        @if ($errors->all())
                <div class="errors-container">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        <form action="{{route('email-send')}}" method="POST">
            @csrf('POST')

            <label for="input-email">Email
                <input type="email" name="email" id="input-email">
            </label>

            <input type="submit" value="Enviar">
        </form>
        <button onclick="window.location.href='/'">Voltar</button>
    </main>
@endsection