<div id="cliente-picture-container">	

	<h2 id="tit-area">Área de clientes</h2>

	<picture id="profile-picture">
		@if(Auth::user()->avatar)
			<img src="{{ Auth::user()->getAvatar() }}">
		@else
			<img src="{{ asset('images/user-profile.png') }}">
		@endif
	</picture>
	<p id="user-name">Olá, {{ Auth::user()->getFirstName() }}</p>
	<a class="link-sair btn" href="{{ route('logout') }}">Sair</a>
</div>

<ul>
	<li class="nav-item"> <a class="nav-link {{ active(['clientes_simulacoes.new']) }}" href="{{ route('clientes_simulacoes.nova-simulacao') }}">Nova simulação</a> </li>
	<li class="nav-item"> <a class="nav-link {{ active(['clientes','clientes_simulacoes.new','clientes_simulacoes.edit']) }}" href="{{ route('clientes') }}">Minhas simulações</a> </li>
	<li class="nav-item"> <a class="nav-link {{ active('clientes_perfil') }}" href="{{ route('clientes_perfil') }}">Minha conta</a> </li>
	<li class="nav-item"> <a class="nav-link {{ active('clientes_pontos') }}" href="{{ route('clientes_pontos') }}">Meus ovos de ouro</a> </li>
</ul>

<div id="youcon-sidebar-app">	
	<youcon-component :tipo_youcon="{{ Auth::user()->tipo_youcon }}" :estado_prop="1" message="{{ session('message-youcon','nada') }}" ></youcon-component>		
</div>

<script type="text/javascript">

	const sidebar_app = new Vue({
   	 el: '#youcon-sidebar-app',   
	});

</script>


