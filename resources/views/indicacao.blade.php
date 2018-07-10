@extends('index-painel-cliente-simulacao')

@section('simulacao-menu')
@endsection

@section('content') 
  
	<div class="container" id="form-indicacao">	

		@if($msg == "success")
			<div class="row justify-content-md-center mt-5">
				<div class="col-4">
					<p id="p-indicacao">Para prosseguir para a área de clientes, basta preencher os campos abaixo.</p>
				</div>
			</div>
			<div class="row justify-content-md-center">
				<div class="col-3 text-center pt-5">
					<img src="{{ asset('images/A7.png') }}">
				</div>
				<div class="col-3">
					{!! form($form) !!}
				</div>
			</div>
		@else
			<div class="row justify-content-md-center mt-5">
				<div class="col-4">
					<p id="p-indicacao">Não foi possível validar o convite. Ele pode já ter sido usado ou estar corrompido. Tente novamente.</p>
				</div>
			</div>
		@endif
	</div>

@endsection