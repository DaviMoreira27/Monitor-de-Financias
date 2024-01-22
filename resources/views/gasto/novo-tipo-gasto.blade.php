@extends('layouts.main')
@section('title', 'Novo Tipo de Gasto')
@section('css', 'tipo-gasto')

@section('content')
    <main class="container-center">
        <form action="{{route('new-tipoGasto')}}" method="POST">
            <h1>Tipo de Gasto</h1>

            @if ($errors->all())
                <div class="errors-container">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach 
                </div>
            @endif

            @if (!empty($sucess))
                <div class="sucess-container">
                        <p>{{ $sucess }}</p>
                </div>
            @endif
            
            @csrf
            @method('POST')


            <div class="row-gasto rows">
                <label for="input-nomeGasto">Nome do Gasto
                    <input type="text" name="nomeGasto" id="input-nomeGasto" placeholder="Nome do Gasto">
                </label>
            </div>

            <div class="row-gasto rows">
                <label for="select-tipoGasto">Tipo de Gasto
                    <select id="select-tipoGasto" name="tipoGasto">
                        <option value="Imposto">Imposto</option>
                        <option value="Compra">Compra Loja</option>
                        <option value="Manutencao">Manutenção</option>
                        <option value="Despesas">Despesas Mensais (Internet, luz...)</option>
                    </select>
                </label>
            </div>
            <button type="submit" id="add-gasto">Adicionar Gasto</button>
        </form>
        <div class="listTipos">
            <h1>Tipos de Gastos</h1>
            <ul>
                @if (!empty($getTiposGastos))
                    @foreach ($getTiposGastos as $item)

                    <li class="itens">
                        <p>{{$item['nomeGasto']}}</p>
                    <a href="{{route('delete-tipoGasto', $item['idTipoGasto'])}}">Apagar</a>
                    </li>
                    @endforeach
                    @else

                    <p class="notExistGasto">Nenhum tipo de gasto existente!</p>

                @endif
                

            </ul>
        </div>
    </main>
    <script src="/js/regex.js"></script>
@endsection