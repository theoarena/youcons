@extends('index-painel-cliente')

@section('content')

    <div class="container" id="simulacao_view">
        <div class="row color">
            <div class="col">
                <p><strong>Código</strong>: {{ $obj->id }}</p>
                <p><strong>Criada em</strong>: {{ $obj->created_at }}</p>                
                <p><strong>Modalidade </strong>: <span> {{ $obj->modalidade_id }} </span>
                <p><strong>Pressa</strong>: {{ $obj->pressa }}</p>
                </p>
               
            </div>
            <div class="col color">
                <p><strong>Crédito</strong>: {{ $obj->credito }}</p>
                <p><strong>Lance</strong>: {{ $obj->lance }}</p>
                <p><strong>Parcela</strong>: {{ $obj->parcela }}</p>
                
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('clientes') }}" class="btn btn-voltar" role="button" aria-pressed="true">Voltar</a> 
            </div>
        </div>
    </div>

@endsection
