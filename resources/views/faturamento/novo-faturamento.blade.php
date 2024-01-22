@extends('layouts.main')
@section('title', 'Novo Faturamento')
@section('css', 'faturamento')
@section('js', 'faturamento')

@section('content')
    <main class="container-center">
        <form action="{{route('new/faturamento')}}" method="POST">
            <h1>Balanço Mensal</h1>

            @if ($errors->all())
                <div class="errors-container">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach 
                </div>
            @endif
            
            @csrf
            @method('POST')

            <label for="select-month">Mês
                <input type="month" id="select-month" name="month-year" placeholder="Nome do Gasto">
            </label>

            @if (!empty($getTiposGastos))

            <div class="row-gasto rows">
                <label for="select-tipoGasto">Tipo de Gasto
                        
                    <select id="select-tipoGasto">
                        @foreach ($getTiposGastos as $item)
                            <option value="{{$item['idTipoGasto']}}">{{$item['nomeGasto']}}</option>
                        @endforeach
                    </select>
                </label>

                @else
                    <p class="errorTipoGasto">Adicione um tipo de gasto primeiro!</p>

            @endif

                <label for="input-valorGasto">Valor do Gasto
                    <input type="text" data-js="money" id="input-valorGasto" placeholder="Valor do Gasto">
                </label>
            </div>
            <div class="rowObj-gastos rows" id="rowObj-gastos"></div>
            <input type="hidden" name="collectionGastos" id="inputCollectGastos">
            @if (!empty($getTiposGastos))
                <button type="button" id="add-gasto">Adicionar Gasto</button>
            @else
                <button disabled type="button" id="add-gasto">Adicionar Gasto</button>
            @endif

            <label for="input-faturamentoD">Faturamento Dinheiro
                <input type="text" data-js="money" id="input-faturamentoD" name="FaturaD" placeholder="Faturamento em Dinheiro">
            </label>

            <label for="input-faturamentoC">Faturamento Cartão
                <input type="text" data-js="money" id="input-faturamentoC" name="FaturaC" placeholder="Faturamento Cartão">
            </label>
            @if (!empty($getTiposGastos))
                <button type="submit" id="final-gasto">Adicionar Gasto</button>
            @else
                <button disabled type="submit" id="final-gasto">Adicionar Fatura</button>
            @endif
        </form>
    </main>
    <script src="/js/regex.js"></script>
@endsection