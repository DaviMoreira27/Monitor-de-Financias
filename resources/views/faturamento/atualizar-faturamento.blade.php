@extends('layouts.main')
@section('title', 'Novo Faturamento')
@section('css', 'faturamento')
@section('js', 'faturamento')
    

@section('content')
    <main class="container-center">
        @foreach ($financias as $financia)
        <form action="/update/faturamento/{{$financia->idFinancias}}" method="POST">
                <h1>Balanço Mensal - Mês {{$financia->month}} de {{$financia->year}}</h1>
            @endforeach

            @if ($errors->all())
                <div class="errors-container">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach 
                </div>
            @endif
            
            @csrf
            @method('GET')

            @foreach ($financias as $financia)
                
                <label for="select-month">Mês
                    <input type="month" value="{{$financia->year . '-' . $financia->month}}" id="select-month" name="month-year" placeholder="Nome do Gasto">
                </label>


            <div class="row-gasto rows">
                <label for="select-tipoGasto">Tipo de Gasto
                        
                    <select id="select-tipoGasto">
                        @foreach ($getTiposGastos as $item)
                            <option value="{{$item['idTipoGasto']}}">{{$item['nomeGasto']}}</option>
                        @endforeach
                    </select>
                </label>


                <label for="input-valorGasto">Valor do Gasto
                    <input type="text" data-js="money" id="input-valorGasto" placeholder="Valor do Gasto">
                </label>
            </div>
            <div class="rowObj-gastos rows" id="rowObj-gastos"></div>
            <input type="hidden" name="collectionGastos" id="inputCollectGastos">
            <button type="button" id="add-gasto">Adicionar Gasto</button>


                <label for="faturaTotal">Faturamento Total
                    <input type="text" readonly="readonly" value="{{$financia->faturamentoMes}}" name="oldFatura" id="faturaTotal" 
                    placeholder="Faturamento Total">
                </label>

                <label for="input-faturamentoD">Faturamento Dinheiro
                    <input type="text" data-js="money" value="{{$financia->faturaDinheiro}}" id="input-faturamentoD" name="FaturaD" 
                    placeholder="Faturamento em Dinheiro">
                </label>

                <label for="input-faturamentoC">Faturamento Cartão
                    <input type="text" data-js="money" value="{{$financia->faturaCartao}}" id="input-faturamentoC" name="FaturaC" 
                    placeholder="Faturamento Cartão">
                </label>
            @endforeach

            <button type="submit" id="final-gasto">Adicionar Gasto</button>
        </form>
    </main>
    <script src="/js/regex.js"></script>
@endsection