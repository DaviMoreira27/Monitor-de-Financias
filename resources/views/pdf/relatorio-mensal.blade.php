@extends('layouts.main')
@section('title', 'Relatório Mensal')
@section('css', 'pdfMensal')


@section('content')
    <style>
        .tg {
            border-collapse: collapse;
            border-color: #aaa;
            border-spacing: 0;
            width: 100%;
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
            padding: 1rem;
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
            word-break: normal;
        }

        .tg .tg-baqh {
            text-align: center;
            vertical-align: top;
            padding: 1rem
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

        .tg .tg-cnpj{
            background-color: #aaaaaa;
            font-size: 1rem;
            padding-top: 1rem;
        }
    </style>
    <center>
        <main class="container-center">
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-baqh" colspan="24">Relátorio Mês {{ $financias['month'] }}</th>
                    </tr>

                    <tr>
                        <th class="tg-cnpj" colspan="24">
                            {{Session::get('user')[2]['cnpj']}}
                            -
                            {{Session::get('user')[2]['razaoSocial']}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-9h37" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Faturamento em cartão (Débito + Crédito)</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($financias['faturaCartao'], 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-siks" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Faturamento em dinheiro</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($financias['faturaDinheiro'], 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-298w" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Despesas do Mês (Boletos + Impostos + Manutenção)</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($financias['gastosMes'], 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="tg-298w" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Faturamento líquido</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($financias['bFinal'], 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="tg-298w" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-baqh" colspan="24">São Paulo, {{ date('d/M/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="24"></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </center>
@endsection
