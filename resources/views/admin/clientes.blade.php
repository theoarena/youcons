@extends('index-painel-admin')

@push('filters')

    <div class="col-auto" id="ativo-filter">
      <label for="ativo-select" class="d-inline-block">Ativo:</label>       
      <select v-on:change="toggleFilter('active', $event)" class="form-control d-inline-block" id="ativo-select">
        <option value="2" selected>Todos</option>
        <option value="1">Sim</option>
        <option value="0">Não</option>
      </select>       
    </div>

@endpush

@push('tools-button')
    <a href="{{ route('admin_clientes.new') }}" class="btn btn-add" role="button" aria-pressed="true">+ Cliente</a>
@endpush

@section('content')  
    <p>Todos os clientes cadastrados no sistema.</p>
     @include('components.list-table')  
@endsection

@section('footer-script')

    @parent

    <script type="text/javascript">   

    window.addEventListener('load', function () {

        var editurl = "{{ route('admin_clientes.edit') }}";
        var deleteurl = "{{ route('admin_users.delete') }}";
        var columns = ['id','active','name','email','telefone','created_at','actions']; 
        var headings = { 
            id: 'ID',
            active: 'Ativo?',
            name: 'Nome',
            email: 'Email',
            telefone: 'Telefone',
            created_at : 'Criado em',
            actions : 'Ações'
        };
        var sortable = ['id','active','name','created_at'];
        var sort_column = "id";
        var custom_template = {
             active:function(h,row){ return (row.active == '1')?('Sim'):('Não'); },
        };
        
        var custom_filters = ['active'];

        @include('components.list-script');      

    }); 

    </script>

@endsection
