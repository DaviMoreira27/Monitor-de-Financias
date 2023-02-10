<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/@yield('css').css">
    <link rel="stylesheet" href="/css/main-layout.css">
    <script src="https://kit.fontawesome.com/9a93fc2a85.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300&display=swap');

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container-center{
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 4rem 0 4rem 0;
            padding: 1rem;
            gap: 4rem
        }

        h1, h2, button, label{
            font-family: 'Poppins', sans-serif;
        }

        h3, a, p, ul, li, tr, td, th, h4, input::placeholder{
            font-family: 'Open Sans', sans-serif;
        }

        input, select{
            font-family: 'Open Sans', sans-serif;
            font-weight: 600
        }

        ul, li, a{
            text-decoration: none;
            list-style: none;
            color: #000
        }
    </style>
</head>
<body>
    <header>
        <h1>Balança de Gastos</h1>
        <nav>
            <li>
                <a href="/">Dashboard</a>
            </li>

            <li>
                <a href="/novo-faturamento">Adicionar Faturamento Mensal</a>
            </li>
        </nav>
    </header>
    @yield('content')
    <script src="/js/@yield('js').js"></script>
</body>
</html>