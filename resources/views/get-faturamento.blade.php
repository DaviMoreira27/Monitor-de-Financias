@extends('layouts.main')
@section('title', "Faturamento")
@section('css', 'get-faturamento')
@section('js', 'get-faturamento')



@section('content')
    @foreach ($financias as $get)
            <main class="container-center">
                <h1>Mês {{$get->month}} de {{$get->year}}</h1>
                <article class="container-faturamento">
                    <section class="row-faturamento">
                        <h2>Mês {{$get->month}}</h2>
                        <div class="row-buttons">
                            <a id="delete-btn" href="/deletar-faturamento/{{$get->idFinancias}}">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                            <a id="update-btn" href="/atualizar-faturamento/{{$get->idFinancias}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                    </section>

                    <span class="row-info">
                        <p>Gasto total do mês</p>
                        <h4>R$ {{number_format($get->gastosMes, 2, ',', '.')}}</h4>
                    </span>
                    <span class="row-info">
                        <p>Faturamento em Dinheiro</p>
                        <h4>R$ {{number_format($get->faturaDinheiro, 2, ',', '.')}}</h4>
                    </span>
                    <span class="row-info">
                        <p>Faturamento em Cartão</p>
                        <h4>R$ {{number_format($get->faturaCartao, 2, ',', '.')}}</h4>
                    </span>
                    <span class="row-info">
                        <p>Faturamento do Mês</p>
                        <h4>R$ {{number_format($get->faturamentoMes, 2, ',', '.')}}</h4>
                    </span>
                    <span class="row-info">
                        <p>Balanço Final</p>    
                        <h4>R$ {{number_format($get->bFinal, 2, ',', '.')}}</h4>
                    </span>
                    @foreach ($gastos as $gasto)  
                    <div class="box-gastos">
                        <div class="column-gastos nomeData">
                            <h3>{{$gasto->nomeGasto}}</h3>
                            <p>{{date('d/m/Y', strtotime($gasto->dataGasto))}}</p>
                        </div>
                        <div class="column-gastos valorTipo">
                            <p>R$ {{number_format($gasto->valorGasto, 2, ',', '.')}}</p>
                            @foreach ($tipoGasto as $item)
                                @if ($item->idTipoGasto === $gasto->idTipoGasto)
                                    <p>{{$item->campoGasto}}</p>
                                @endif
                            @endforeach
                        </div>
                        <a id="delete-btn" href="/deletar-gastoMes/{{$gasto->idGasto}}/{{$gasto->idFinancias}}">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                    @endforeach
                </article>
                <div class="container-options">
                    <a id="month-pdf">Gerar PDF Mensal</a>
                    <a id="simples-doc">Gerar SIMPLES Nacional</a>
                </div>
            </main>
    @endforeach
@endsection