@extends('index-painel-cliente')

@section('content')

<script src="{{ asset('js/inputmask') }}/dist/jquery.inputmask.bundle.js"></script>
<script src="{{ asset('js/inputmask') }}/dist/inputmask/inputmask.numeric.extensions.js"></script>

<script type="text/javascript">


	$(document).ready(function(){

		 $('#telefone').inputmask('(99) 9999[9]-9999');

	 	 $('#credito').inputmask('currency',{
	 	 	prefix: "R$",
	 	 	radixPoint: ",",
	 	 });  

	 	 $('#lance').inputmask('currency',{
	 	 	prefix: "R$",
	 	 	radixPoint: ",",

	 	 }); 

	 	 $('#parcela').inputmask('currency',{
	 	 	prefix: "R$",
	 	 	radixPoint: ",",
	 	 }); 
	
	});


</script>

	<div class="container">
		
		<div class="row justify-content-md-center">	
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<h2>Duis aute irure dolor in reprehenderit </h2>

				<div class="my-5">					
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					<p> Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
				{!! form_start($form) !!} 
        		
        		<div id="box-modalidade">        			
        			{!! form_row($form->modalidade) !!} 
        		</div>

				<div id="box-valores">
	        		{!! form_row($form->credito) !!} 
	        		{!! form_row($form->parcela) !!} 
	        		{!! form_row($form->lance) !!} 
        		</div>
        		<div id="box-pressa" class="clearfix">
        			{!! form_row($form->pressa) !!} 
        		</div>

        		{!! form_end($form) !!} 
			</div>			
			<div class="col-md-2"></div>
		</div>

	</div>

   
 {{--    <a href="{{ route('clientes') }}" class="btn btn-voltar" role="button" aria-pressed="true">Voltar</a> --}}
   
@endsection

