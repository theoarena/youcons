@extends('index-painel-admin')

@section('content')	

	<div class="row content-box">
		 <div class="col-md-7">       
	 		
	    </div>
	    <div class="col-md-5">       
	 		{!! form($form) !!}
			<a href="{{ route('admin_clientes') }}" class="btn btn-voltar" role="button" aria-pressed="true">Voltar</a> 
	    </div>
	   
	</div>   


@endsection

