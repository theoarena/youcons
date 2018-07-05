@extends('index-painel-admin')

@section('alt_menu')

@endsection

@section('content') 

    <p>Clientes que estão aguardando aprovação.</p>
     @include('components.list-table')  

@endsection

@section('footer-script')

    @parent

    <script type="text/javascript">   

    window.addEventListener('load', function () {

        var editurl = "{{ route('admin_clientes.edit') }}";
        var deleteurl = "{{ route('admin_users.delete') }}";
        var columns = ['id','name','email','created_at','actions']; 
        var headings = { 
            id: 'ID',
            name: 'Nome',
            email: 'Email',
            created_at : 'Criado em',
            actions : 'Ações'
        };
        var sortable = ['id','name','created_at'];
        var sort_column = "id";
        var custom_template = {};
        var custom_filters = [];    
       // var filterable = ['id','name'];
       /* var customFilters = [{
           name: 'name',
           callback: function(row,query){
            alert(query);
            this.setFilter(query);
           }
        }];*/

        @include('components.list-script');     

    }); 

    </script>

@endsection