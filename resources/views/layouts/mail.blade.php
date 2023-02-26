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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 4rem 0 4rem 0;
            padding: 1rem;
            gap: 4rem
        }

        h1,
        h2,
        button,
        small,
        label {
            font-family: 'Poppins', sans-serif;
        }

        h3,
        a,
        p,
        ul,
        li,
        tr,
        td,
        th,
        h4,
        input::placeholder {
            font-family: 'Open Sans', sans-serif;
        }

        input,
        select {
            font-family: 'Open Sans', sans-serif;
            font-weight: 600
        }

        ul,
        li,
        a {
            text-decoration: none;
            list-style: none;
            color: #000
        }

        .tg {
            border-collapse: collapse;
            border-color: #aaa;
            border-spacing: 0;
            width: 800px;
            height: 800px;
            text-align: center;
        }

        .tg td {
            background-color: #fff;
            border-color: #aaa;
            border-style: solid;
            border-width: 1px;
            color: #333;
            font-family: Arial, sans-serif;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            background-color: #f38630;
            border-color: #aaa;
            border-style: solid;
            border-width: 1px;
            color: #fff;
            font-family: Arial, sans-serif;
            font-size: 1.5rem;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-baqh {
            text-align: center;
            vertical-align: top
        }

        .tg .tg-9h37 {
            background-color: #aaaaaa;
            font-style: italic;
            text-align: left;
            vertical-align: middle
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top
        }

        .tg .tg-siks {
            background-color: #aaaaaa;
            text-align: left;
            vertical-align: top
        }

        .tg .tg-298w {
            background-color: #aaaaaa;
            color: #aaaaaa;
            text-align: left;
            vertical-align: top
        }
    </style>
</head>

<body>
    @yield('content')
    <script src="/js/@yield('js').js"></script>
</body>

</html>
