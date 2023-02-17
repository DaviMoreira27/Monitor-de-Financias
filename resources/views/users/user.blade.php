@extends('layouts.main')
@section('title', 'Faturamento')
@section('css', 'userIndex')


@section('content')
    <main class="content-center">
        <section class="user-container">
            <article class="container-login container-logar">
                <h1>Logar</h1>
                <form action="#" method="POST">
                    @csrf('POST')

                    <label for="input-cnpj">CNPJ
                        <input type="text" name="cnpj" id="input-cnpj">
                    </label>
                    <label for="input-cnpj">Senha
                        <input type="password" name="senha" id="input-senha">
                    </label>

                    <input type="submit" value="Entrar" id="submit-login">
                </form>
            </article>
            <hr>

            <article class="container-cadastro container-logar">
                <h1>Cadastrar</h1>
                <form action="#" method="POST">
                    @csrf('POST')

                    <label for="input-cnpj">CNPJ
                        <input type="text" name="cnpj" id="input-cnpj">
                    </label>
                    <label for="input-cnpj">Razão Social
                        <input type="text" name="razaoSocial" id="input-razaoSocial">
                    </label>
                    <label for="input-cnpj">Senha
                        <input type="password" name="senha" id="input-senha">
                    </label>
                    <label for="input-cnpj">Confirme a Senha
                        <input type="password" name="senhaConfirm" id="input-senhaConfirm">
                    </label>

                    <input type="submit" value="Cadastrar-se" id="submit-login">
                </form>
            </article>
        </section>
    </main>
@endsection
