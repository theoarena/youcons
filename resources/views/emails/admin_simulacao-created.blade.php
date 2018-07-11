<div style="margin: 30px 0;font-family: Verdana; ">
	<img src="{{ $message->embed(public_path() . '/images/logo.jpg') }}" style="display: block;margin: 30px auto 10px">
	<div style="border-radius: 3px;display: block;margin: 0 auto; background: #52b3d7;max-width:500px;width: 100%;padding: 20px;background: -webkit-gradient(linear, left top, left bottom, from(#52b3d7), to(#489ebd));
background: linear-gradient(to bottom, #52b3d7 0%, #489ebd 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#52b3d7', endColorstr='#489ebd',GradientType=0 );border-bottom: 2px solid #3A7E97; text-shadow: 0px 0.5px 0px #3A7E97;">
		<h2 style="color:#f7f7f7">Nova simulação gerada!</h2>	
		
		<p style="color:#f7f7f7">Cliente: {{ $simulacao->cliente->name }}</p>
		<p style="color:#f7f7f7">Modalidade: {{ $simulacao->modalidade_id }}</p>		
		<p style="color:#f7f7f7">Pressa: {{ $simulacao->pressa }}</p>		
		
	</div>
	<div style="background: #375D7B;display: block;margin: 2px auto 0; font-family: Verdana;max-width:500px;width: 100%; padding: 20px;border-bottom: 2px solid #264054;border-radius: 3px">	

		<div style="display: inline-block;width: 49%;text-align: center;vertical-align: top;margin-top: 30px">		

			<a href="{{ route('admin_simulacoes.edit',['id' => $simulacao->id]) }}" style="color: #f7f7f7; padding: 7px 15px; display: inline-block; background: #8BA5BA; font-size: 14px; text-decoration: none; border-radius: 3px; border-bottom: 2px solid #647786;">Acessar simulação</a>		

		</div>

		<div style="display: inline-block;width: 49%;text-align: center;">
			
			<img style="width: 130px; height: auto;" src="{{ $message->embed(public_path() . '/images/youcon-2.png') }}" />
		</div>

	</div>
</div>