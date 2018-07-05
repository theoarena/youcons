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

	 	 $('#parcela').inputmask('currency',{
	 	 	prefix: "R$",
	 	 	radixPoint: ",",
	 	 	removeMaskOnSubmit:true
	 	 }); 
	
	});


</script>

<div id="carouselHome" class="carousel slide carousel-fade" data-ride="carousel">

	<ol class="carousel-indicators">
		<li data-target="#carouselHome" data-slide-to="0" class="active"></li>
		<li data-target="#carouselHome" data-slide-to="1"></li>
		<li data-target="#carouselHome" data-slide-to="2"></li>		
	</ol>


	<div class="carousel-inner">

		<div class="carousel-item clearfix active" id="banner1">

		  <div class="carousel-caption d-md-block">
		  	<div class="banner-title">
		  		<img src="{{ asset('images/casa-banner.png') }}" />
		    	<h2>Consórcio <span>Imobiliário</span></h2>
		  	</div>
		  		
		    <p class="banner-middle">Quem compra imóvel com financiamento <span>
			paga muito mais que um imóvel.</span> </p>

			<p class="banner-subtext">Compre, construa ou reforme via <br>consórcio com orientação dos <strong>Youcons!</strong></p>	

			<button class="btn btn-assista" data-toggle="modal" data-target="#videobanner1"><span></span>Assista o vídeo explicativo!</button>	  
		  </div>		
			

		  <img class="d-block" src="{{ asset('images/banner-imob.jpg') }}" alt="Imobiliário">
		</div>		

		<div class="carousel-item clearfix" id="banner2">

		  <div class="carousel-caption d-md-block">
		  	<div class="banner-title">
		  		<img src="{{ asset('images/carro-banner.png') }}" />
		    	<h2>Consórcio de <span>Veículos</span></h2>
		  	</div>
		  		
		    <p class="banner-middle">Adquira sua moto ou carro com poupança <br>programada e taxas acessíveis.
		    <span>Nossos Youcons ajudam você!</span> </p>

			<p class="banner-subtext">Compre, construa ou reforme via <br>consórcio com orientação dos <strong>Youcons!</strong></p>	

			<button class="btn btn-assista" data-toggle="modal" data-target="#videobanner2"><span></span>Assista o vídeo explicativo!</button>	 

		  </div>		
			

		  <img class="d-block" src="{{ asset('images/banner-veiculos.jpg') }}" alt="Imobiliário">
		</div>	

		<div class="carousel-item clearfix" id="banner3">

		  <div class="carousel-caption d-md-block">
		  	<div class="banner-title">		  	
		  		<img src="{{ asset('images/servicos-banner.png') }}" />	
		    	<h2>Consórcio de <span>serviços</span></h2>
		  	</div>
		  		
		    <p class="banner-middle">Pensando em fazer cirurgia plástica, <br>pequena reforma no apê,
		    <span>ou a viagem dos sonhos?</span></p>

			<p class="banner-subtext">Os Youcons te ajudam a realizar tudo isso<br> com planejamento e <strong>ótimas taxas!</strong></p>	

			<button class="btn btn-assista" data-toggle="modal" data-target="#videobanner3"><span></span>Assista o vídeo explicativo!</button>	 	  
		  </div>		
			

		  <img class="d-block" src="{{ asset('images/banner-servicos.jpg') }}" alt="Imobiliário">
		</div>	
	</div>	

	<div id="wrapper-banner-form" class="container">  
    	<div id="form_banner">
			<p id="obs_form">Solicite uma simulação <b>gratuita</b>:</p>     
			@include('structure.home-messages')     
    		{!! form_start($form) !!} 

    		{!! form_row($form->nome) !!} 
    		{!! form_row($form->email) !!} 
    		{!! form_row($form->telefone) !!} 
    		{!! form_row($form->modalidade) !!} 

			<div id="valores">
        		{!! form_row($form->credito) !!} 
        		{!! form_row($form->parcela) !!} 
        		{!! form_row($form->lance) !!} 
    		</div>
    		{!! form_row($form->obs) !!} 

    		{!! form_end($form) !!} 
    		<figure id="youcon-form"><img src="{{ asset('images/youcon-form.png') }}"></figure>
    	</div>
    </div>  

		

</div>