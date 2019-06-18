@extends('index-landing')

@section('banner')
@endsection

@section('content1')

<script src="{{ asset('js/inputmask') }}/dist/jquery.inputmask.bundle.js"></script>
<script src="{{ asset('js/inputmask') }}/dist/inputmask/inputmask.numeric.extensions.js"></script>
<script src="{{ asset('js/inputmask') }}/dist/inputmask/phone-codes/phone.js"></script>

<script type="text/javascript">


	$(document).ready(function(){

	 	 $('#credito').inputmask('currency',{
	 	 	prefix: "R$",
	 	 	radixPoint: ",",
	 	 	removeMaskOnSubmit:true
	 	 });

	 	 $('#lance').inputmask('currency',{
	 	 	prefix: "R$",
	 	 	radixPoint: ",",
	 	 	removeMaskOnSubmit:true
	 	 });
	});


</script>
	<section class="container landing">

		<div class="row justify-content-md-center" id="first-row">
			<div class="col-12 col-md-5">
				<h2>Simule em várias<span>administradoras</span></h2>

				<div id="box-video" class="container">
					<div class="row">
						<div class="col-4">
							<img src="{{ asset('images/A3.png') }}">
						</div>
						<div class="col pt-4">
							<div id="ballon">
							<span></span>
								<p>Preencha o formulário para <strong>simular seu consórcio de imóvel, veículo ou serviços</strong> em várias Administradoras de consórcio! </p>
							</div>
						</div>
					</div>
				</div>

				<p id="p-landing">
					<span>Nossos especialistas trabalharão para formular o melhor orçamento para você. Também lhe ajudarão com dúvidas e solicitações que você tiver.</span>
					 Conte com nossos Youcons, eles estão aqui <br>para ajudar do começo ao fim!
				</p>


				<button class="btn btn-assista" data-toggle="modal" data-target="#videolanding">
					<span></span>Assistir vídeo explicativo
				</button>

			</div>
			<div class="col-12 col-md-6 col-lg-4 ">
				<div id="form-landing">

				<span id="icone"></span>

					{!! form_start($form) !!}

					<div class="row padding">
						<div class="col">
							{!! form_row($form->nome) !!}
							<i class="fa fa-user"></i>
						</div>
					</div>

					<div class="row padding">
						<div class="col">
							{!! form_row($form->email) !!}
							<i class="fa fa-envelope"></i>
						</div>
					</div>

					<div class="row padding">
						<div class="col">
							{!! form_row($form->telefone) !!}
							<i class="fa fa-phone"></i>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col">
							{!! form_row($form->modalidade) !!}
						</div>
					</div>

					<div class="row">
						<div class="col">
							{!! form_row($form->credito) !!}
						</div>
						<div class="col">
							{!! form_row($form->lance) !!}
						</div>
					</div>

					{!! form_end($form) !!}
				</div>
			</div>
		</div>


	</section>

@endsection

@section('content2')
<section class="container landing">
	<div class="row justify-content-md-center md-6 no-gutters" id="second-row">
		<div class="col-8 col-md-7">

			<h3 class="mb-4">Tem dúvidas?</h3>
			<p>
				Não tem problema! Chame nossos Youcons especialistas no <b>whatsapp</b> ou <b>e-mail</b>. Eles lhe orientarão com suas questões! Aproveite também para conhecer e se inscrever em nosso canal no Youtube.
			</p>
		</div>
		<div class="col-4 col-md-2">
			<img src="{{ asset('images/B6.png') }}" class="float-right">
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<img src="{{ asset('images/arrow-down.png') }}" id="arrow-down">
		</div>
	</div>
</section>

@endsection