@extends('layouts.main')
@section('title', 'Novo Faturamento')
@section('css', 'faturamento')
@section('js', 'faturamento')
    

@section('content')
    <main class="container-center">
        <form action="post/faturamento" method="POST">
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

            <div class="row-gasto rows">
                <label for="input-nomeGasto">Nome do Gasto
                    <input type="text" id="input-nomeGasto" placeholder="Nome do Gasto">
                </label>

                <label for="input-dataGasto">Data Gasto
                    <input type="date"id="input-dataGasto">
                </label>
            </div>

            <div class="row-gasto rows">
                <label for="select-tipoGasto">Tipo de Gasto
                    <select id="select-tipoGasto">
                        <option value="01">Imposto</option>
                        <option value="02">Compra Loja</option>
                        <option value="03">Manutenção</option>
                    </select>
                </label>

                <label for="input-valorGasto">Valor do Gasto
                    <input type="number" id="input-valorGasto" placeholder="Valor do Gasto">
                </label>
            </div>
            <div class="rowObj-gastos rows" id="rowObj-gastos"></div>
            <input type="hidden" name="collectionGastos" id="inputCollectGastos">
            <button type="button" id="add-gasto">Adicionar Gasto</button>

            <label for="input-faturamentoD">Faturamento Dinheiro
                <input type="text" id="input-faturamentoD" name="FaturaD" placeholder="Faturamento em Dinheiro">
            </label>

            <label for="input-faturamentoC">Faturamento Cartão
                <input type="text" id="input-faturamentoC" name="FaturaC" placeholder="Faturamento Cartão">
            </label>

            <button type="submit" id="final-gasto">Adicionar Gasto</button>
        </form>
    </main>
@endsection