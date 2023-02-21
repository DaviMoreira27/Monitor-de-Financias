@extends('layouts.main')
@section('title', 'Faturamento')
@section('css', 'userIndex')


@section('content')
    <main class="content-center">
        <section class="user-container">
            @if ($errors->all())
                <div class="errors-container">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <article class="container-login container-logar">
                <h1>Logar</h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf('POST')

                    <label for="input-cnpj">CNPJ
                        <input type="text" name="cnpj" id="input-cnpj">
                    </label>
                    <label for="input-cnpj">Senha
                        <input type="password" name="password" id="input-senha">
                    </label>
                    <div class="options-container">
                        <a href="{{route('password.request')}}">Esqueceu a Senha?</a>
                        <label for="input-remember" id="label-remember">Lembrar de Mim
                            <input type="checkbox" name="rememberMe" id="input-remember">
                        </label>
                    </div>
                    <input type="submit" value="Entrar" id="submit-login">
                </form>
            </article>
            <hr>

            <article class="container-cadastro container-logar">
                <h1>Cadastrar</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf('POST')

                    <label for="input-cnpj">CNPJ
                        <input type="text" name="cnpj" id="input-cnpj">
                    </label>
                    <label for="input-razaoSocial">Razão Social
                        <input type="text" name="razaoSocial" id="input-razaoSocial">
                    </label>
                    <label for="input-email">Email
                        <input type="email" name="email" id="input-email">
                    </label>
                    <label for="input-senha">Senha
                        <input type="password" name="password" id="input-senha">
                    </label>
                    <label for="input-senhaConfirm">Confirme a Senha
                        <input type="password" name="senhaConfirm" id="input-senhaConfirm">
                    </label>
                    <label for="input-remember" id="label-remember">Lembrar de Mim
                        <input type="checkbox" name="rememberMe" id="input-remember">
                    </label>

                    <input type="submit" value="Cadastrar-se" id="submit-login">
                </form>
            </article>
        </section>
    </main>
@endsection
