@extends('index-painel-admin')

@push('tools-button')
    <a href="{{ route('admin_vendedores.new') }}" class="btn btn-add" role="button" aria-pressed="true">+ Vendedor</a>
@endpush

@section('content')
  
  	<p>Todos os vendedores cadastrados no sistema.</p>
     @include('components.list-table')  

@endsection

@section('footer-script')

    @parent

    <script type="text/javascript">   

    window.addEventListener('load', function () {

        var editurl = "{{ route('admin_vendedores.edit') }}";
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
        
        var custom_filters = [];    

        @include('components.list-script');      

    }); 

    </script>

@endsection
