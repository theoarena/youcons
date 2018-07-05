@extends('index-site')

@section('banner')
	<section id="banner" class="container-fluid">
            @include('banner')   
    </section>
@endsection

@section('content')
  
<section class="container" id="nosso_proposito">	

	<div class="row">
		<div class="col-lg">
			
			<span class="youcons">Youcons</span>
			<h2>Nosso <span>propósito</span></h2>

			<p id="proposito_big" >Nossos Youcons nasceram com o propósito de transformar
informações técnicas sobre <strong>consórcio</strong> em algo de fácil
entendimento para todos os consumidores. </p>

	<p id="proposito_small" >Nosso propósito é <strong>ajudar, orientar a transmitir informações claras ao consumidor</strong> para que possa escolher da melhor maneira as linhas de crédito via consórcio adequadas ao seu perfil.</p>

		</div>
		<div class="col-lg">
			<img class="mx-auto img-fluid" src="{{ asset('images/proposito_img.jpg') }}" title="Nosso Propósito">
		</div>	
	</div>
	
</section>

<section class="container-fluid no-gutter" id="principios">

	<div class="container">
		<div class="row">
			<div class="col-md">

				<h3 id="tit_principios"><span></span>Nossos princípios</h3>
				<p class="text-center">nossos Youcons tem por princípio:</p>

				<div class="list-group-item">		
					<img src="{{ asset('images/tick.jpg') }}">
				    <div class="conteudo">
				      <strong>Ajudar</strong>			      
				      <p class="text-left">tanto quanto puderem</p>	
				    </div>			    		 
				</div>

				<div class="list-group-item">		
					<img src="{{ asset('images/tick.jpg') }}">
				    <div class="conteudo">
				      <strong>Orientar</strong>			      
				      <p class="text-left">tanto quanto souberem</p>	
				    </div>			    		 
				</div>

				<div class="list-group-item">		
					<img src="{{ asset('images/tick.jpg') }}">
				    <div class="conteudo">
				      <strong>Compartilhar</strong>			      
				      <p class="text-left">informações sempre que as tiverem</p>	
				    </div>			    		 
				</div>

				<div class="list-group-item">		
					<img src="{{ asset('images/tick.jpg') }}">
				    <div class="conteudo">
				      <strong>Evoluir</strong>			      
				      <p class="text-left">sempre que errarem</p>	
				    </div>			    		 
				</div>

			</div>

			<div class="col-md right">

				<h3 id="tit_criadores"><span></span>Nossos criadores</h3>

				<em class="text-justify">A plataforma dos Youcons nasceu da parceria entre duas profissionais com foco em inovação.</em>

				<p class="text-justify"><strong>Bettine Castro</strong> é formada e Administração e atua em corretora de sucesso em Campinas e Região, a <strong>Lenanzo Seguros</strong>, com ampla expertise em grandes riscos. <strong>Jessica Dalcol</strong> é formada em Economia e encabeça o Maior Tira-Dúvidas Gratuito sobre Seguros da Internet, a <strong>Muquirana Seguros Online</strong>. Juntas viram a oportunidade de tornar o mercado de consórcios mais acessível ao consumidor.</p>

				<p id="refer_links">
					<a href="http://lenanzoseguros.com.br/" target="blank">lenanzo seguros</a>&nbsp;|
					<a href="http://blog.muquiranaseguros.com.br/" target="blank">Muquirana seguros</a>
					<span class="arrow-right"></span>
				</p>

			</div>
		</div>
	</div>	

</section>

<section class="container-fluid no-gutter" id="ajuda">

	<div class="container">

		<div class="row">
			<div class="col-8 text-center">

				<div id="ajuda_box">			
					<p>Quero ajuda de um <strong>Youcon</strong>!</p>
					<button id="btn-whatsapp"  data-placement="top" type="button" class="btn btn-lg" data-toggle="popover" title="Entre em contato por Whatsapp!" data-content="Utilize o número: (19) 9 9876-5432"><span></span>Whatsapp</button>

					<button id="btn-mail" type="button" class="btn btn-lg" data-placement="top" type="button" class="btn btn-lg" data-toggle="popover" title="Entre em contato por Email!" data-content="Utilize o endereço: vendas@youcons.com.br"><span></span>Email</button>

					<button id="btn-tel" type="button" class="btn btn-lg" data-placement="top" data-toggle="popover" title="Entre em contato por Telefone!" data-content="Utilize o número: (19) 9 9876-5432"><span></span>Telefone</button>
				</div>

			</div>
			<div class="col-4 text-center">
				<img id="youcon-2" src="{{ asset('images/youcon-2.png') }}">				
			</div>
		</div>

	</div>

</section>


<section class="container-fluid no-gutter" id="produtos">

	<div class="container">

		<h2>Nossos <span>produtos</span></h2>

		<div class="row">

			<div class="col-md text-center">
				<div class="card">
				  <div class="card-header"><img src="{{ asset('images/carro.png') }}" /><h3 class="card-title">Consórcio de veículos</h3></div>
				  <div class="card-body">				    
				    <p class="card-text">Adquira sua moto ou carro com poupança programada e taxas acessíveis. Nossos Youcons ajudam você!</p>
				    <a href="#" class="link_produtos">Saiba mais<span class="arrow-right"></span></a>
				  </div>
				</div>
			</div>

			<div class="col-md text-center">
				<div class="card">
				  <div class="card-header"><img src="{{ asset('images/casa2.png') }}" /><h3 class="card-title">Consórcio imobiliário</h3></div>
				  <div class="card-body">				    
				    <p class="card-text">Quem compra imóvel com financiamento paga muito mais que um imóvel. Compre, construa ou reforme via consórcio com orientação dos Youcons!
</p>
				    <a href="#" class="link_produtos">Saiba mais<span class="arrow-right"></span></a>
				  </div>
				</div>
			</div>

			<div class="col-md text-center">
				<div class="card">
				  <div class="card-header"><img src="{{ asset('images/servicos.png') }}" /><h3 class="card-title">Consórcio de serviços</h3></div>
				  <div class="card-body">				    
				    <p class="card-text">Pensando em fazer cirurgia plástica, pequena reforma no apê, uma viagem dos sonhos? Os Youcons te ajudam a realizar tudo isso com planejamento e ótimas taxas!</p>
				    <a href="#" class="link_produtos">Saiba mais<span class="arrow-right"></span></a>
				  </div>
				</div>
			</div>

		</div>

</section>
       
@endsection
