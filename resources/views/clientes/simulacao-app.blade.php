@extends('index-painel-cliente-simulacao')

@section('content')	
	
   <div id="simulacao-app" class="app-fullscreen">
    <simulacao-app tipo_youcon="{{ Auth::user()->tipo_youcon }}" simulacoes_save="{{ route('api_simulacao.save') }}" user="{{ Auth::user()->id }}"></simulacao-app>     
   </div> 

<script type="text/javascript">
    
    const simulacao_app = new Vue({
     el: '#simulacao-app'
    });   

</script>

@endsection