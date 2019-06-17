@extends('index-painel-admin')


@push('filters')

    <div class="col-auto" id="ativo-filter">
      <label for="ativo-select" class="d-inline-block">Favoritas:</label>       
      <select v-on:change="toggleFilter('favorite', $event)" class="form-control d-inline-block" id="ativo-select">
        <option value="2" selected>Todas</option>
        <option value="1">Sim</option>
        <option value="0">Não</option>
      </select>       
    </div>

    <div class="col-auto" id="modalidade-filter">
      <label for="ativo-select" class="d-inline-block">Modalidade:</label>       
      <select v-on:change="toggleFilter('modalidade_id', $event)" class="form-control d-inline-block" id="ativo-select">
        <option value="0" selected>Todas</option>
        <option value="1">Imobiliário</option>
        <option value="2">Veicular</option>
        <option value="3">Serviços</option>
      </select>       
    </div>  

    <div class="col-auto" id="periodo-filter">
      <label for="periodo-input" class="d-inline-block">Período:</label>       
      <rangedate-picker ref="dateRangePicker" @selected="toggleFilter('periodo', $event)" class="d-inline-block" :months="months" :short-days="shortDays" :captions="captions" :format="format" :righttoleft="'true'"></rangedate-picker>  
      <button v-on:click="resetRange()" class="btn btn-add">Limpar</button>
    </div>

@endpush


@push('tools-button')    
    <a v-on:click.prevent="downloadCsv('{{ route('api_simulacao.csv') }}')" href="#" class="btn-csv btn-area btn ">Download Excel</a>
@endpush

@section('content')  
    <p>Todos as simulações cadastradas no sistema.</p>
    @include('components.list-table')    
@endsection

@section('footer-script')

    @parent

    <script type="text/javascript">   

    window.addEventListener('load', function () {

        var editurl = "{{ route('admin_simulacoes.edit') }}";
        var deleteurl = "{{ route('admin_simulacoes.delete') }}";       
        var columns = ['id','favorite','user_id','vendedor_id','modalidade_id','credito','lance','parcela','created_at', 'actions'];
        var headings = { 
            id: 'ID',
            user_id: 'Cliente',
            favorite: 'Favorita?',
            vendedor_id: 'Vendedor',
            modalidade_id: 'Modalidade',
            credito: 'Crédito',
            lance: 'Lance',
            parcela: 'Parcela',
            created_at : 'Criado em',
            actions : 'Ações'
        };
        var sortable = ['id','user_id', 'created_at'];
        var sort_column = "id";
        var filterable = ['id'];
        var custom_template = {            
            user_id:function(h,row){ return (row.cliente)?(row.cliente.name):"-"; },
            vendedor_id:function(h,row){ return (row.vendedor != null)?(row.vendedor.conta.name):(""); },
            credito:function(h,row){ return currencyFormatter.format(row.credito, { code: 'BRL' }); },
            lance:function(h,row){ return currencyFormatter.format(row.lance, { code: 'BRL' }); },
            parcela:function(h,row){ return currencyFormatter.format(row.parcela, { code: 'BRL' }); }
            //favorite:function(h,row){ return (row.favorite == '1')?('Sim'):('Não'); }
        };  

        var custom_filters = [];    
       
        @include('components.list-script');   

    }); 



    </script>


@endsection
