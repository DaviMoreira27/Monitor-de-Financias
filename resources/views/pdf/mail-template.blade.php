@extends('layouts.mail')
@section('title', 'Relatório Mensal')
@section('css', 'pdfMensal')


@section('content')
    <article class="container-center">
        <div class="container-email" 
        style="background-color: #3475e6; padding: 1rem; border-radius: 10px; display: flex; flex-direction: column; gap: 1rem; color: #FFF;">
            <h1>Relatório Mensal - {{ $month }} de {{ $year }}</h1>

            <p>Mensagem automática, por favor, não responda</p>
            <p>Relatório referente ao mes {{ $month }} de {{ $year }}. Gerado através do APP Balanço de
                Gastos</p>

            <small>Made by Laravel</small>
        </div>

        <center>
        <main class="container-center">
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-baqh" colspan="24">Relátorio Mês {{ $month }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="tg-9h37" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Faturamento em cartão (Débito + Crédito)</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($faturaCartao, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-siks" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Faturamento em dinheiro</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($faturaDinheiro, 2, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-298w" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Despesas do Mês (Boletos + Impostos + Manutenção)</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($gastosMes, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="tg-298w" colspan="24"></td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="14">Faturamento líquido</td>
                        <td class="tg-0lax" colspan="10">R$ {{ number_format($bFinal, 2, ',', '.') }}</td>
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
    </article>
@endsection
