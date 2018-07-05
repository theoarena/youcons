@extends('index-painel-admin')

@push('tools-button')
    <a href="{{ route('admin_vouchers.new') }}" class="btn btn-add" role="button" aria-pressed="true">+ Voucher</a>
@endpush

@section('content')
  
  	<p>Todos os vouchers cadastrados no sistema.</p>
     @include('components.list-table')  

@endsection

@section('footer-script')

    @parent

    <script type="text/javascript">   

    window.addEventListener('load', function () {

        var editurl = "{{ route('admin_vouchers.edit') }}";
        var deleteurl = "{{ route('admin_vouchers.delete') }}";
        var columns = ['id','codigo','experiencia','created_at','valid_until','actions']; 
        var headings = { 
            id: 'ID',
            codigo: 'Código',
            experiencia: 'XP',               
            created_at : 'Criado em',
            valid_until : 'Válido até',
            actions : 'Ações'
        };
        var sortable = ['id','codigo','created_at'];
        var sort_column = "id";
        var custom_template = {
             active:function(h,row){ return (row.active == '1')?('Sim'):('Não'); },
             created_at:function(h,row){ return moment(row.created_at).format('DD/MM/YYYY'); },
             valid_until:function(h,row){ return moment(row.valid_until).format('DD/MM/YYYY'); },
        };
        
        var custom_filters = [];    

        @include('components.list-script');      

    }); 

    </script>

@endsection
