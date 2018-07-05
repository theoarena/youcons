@extends('index-painel-admin')

@section('content')	

	<div class="row content-box justify-content-md-center">
	    <div class="col-4">       
	 		{!! form($form) !!}
			<a href="{{ route('admin_vouchers') }}" class="btn btn-voltar" role="button" aria-pressed="true">Voltar</a> 
	    </div>
	   
	</div>   


@endsection

