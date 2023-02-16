@extends('layouts.main')
@section('title', 'Relatório Mensal')
@section('css', 'pdfMensal')


@section('content')
    <center>
        <main class="container-center">
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-baqh" colspan="24">Relátorio Mês {{ $financias['month'] }}</th>
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
