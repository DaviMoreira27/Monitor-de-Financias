@extends('layouts.main')
@section('title', 'Dashboard')
@section('css', 'index')
@section('js', 'index')
    

@section('content')
    <main class="container-center">
        <h1>Dashboard</h1>

        <section class="economy-container">
            <div class="select-container">
                <button class="select-button">
                    Selecionar por Mês
                </button>
                <button class="select-button">
                    Selecionar por Ano
                </button>
            </div>

            <div class="value-container">
                @if (empty($datas->items))
                    <h1>Nenhum dado foi encontrado!</h1>
                @endif
                @foreach ($datas as $data)
                    <div class="value-box">
                        <h2>Mês {{$data->month}} de {{$data->year}}</h2>

                        <div class="number-box">
                            <div class="fg-box" id="gastos">
                            <h3>Gastos</h3>
                            <h3>R$ {{$data->gastosMes}}</h3>  
                            </div>
                            
                            <div class="fg-box" id="faturamento">
                            <h3>Faturamento</h3>
                            <h3>R$ {{$data->faturamentoMes}}</h3>  
                            </div>
                            
                            <div class="fg-box" id="saldo">
                            <h3>Balanço Final</h3>
                            <h3>R$ {{$data->bFinal}}</h3>  
                            </div>

                            <a class="more-about" href="faturamento/{{$data->idFinancias}}">
                                <i class="fa-solid fa-magnifying-glass fa-2x"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection


