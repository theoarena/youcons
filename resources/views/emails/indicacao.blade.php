<div style="margin: 30px 0;font-family: Verdana; ">
	<img src="{{ $message->embed(public_path() . '/images/logo.jpg') }}" style="display: block;margin: 30px auto 10px">
	<div style="border-radius: 3px;display: block;margin: 0 auto; background: #52b3d7;max-width:500px;width: 100%;padding: 20px;border-bottom: 2px solid #489ebd;text-shadow: 0px 0.5px 0px #3A7E97;">
		<h2 style="color:#f7f7f7">Olá! :)</h2>
		<p style="color:#f7f7f7">Somos a <strong>Youcons</strong>!</p>
		<p style="color:#f7f7f7">Você foi indicado(a) para utilizar nossa plataforma!</p>		
		<p style="color:#f7f7f7">Para começar é bastante simples: basta clicar no botão abaixo e ir para a sua área de clientes, já preparamos tudo para você!</p>
		<p style="color: #31536E;margin-top: 30px;">Obrigado! Equipe <strong>Youcons</strong>.</p>
	</div>
	<div style="background: #375D7B;display: block;margin: 2px auto 0; font-family: Verdana;max-width:500px;width: 100%; padding: 20px;border-bottom: 2px solid #264054;border-radius: 3px">	

		<div style="display: inline-block;width: 49%;text-align: center;vertical-align: top;margin-top: 30px">		

			<a href="http://youcons.com.br/indicacao?ind={{ $indicacao->id }}&key={{ $indicacao->key }}" style="color: #f7f7f7; padding: 7px 15px; display: inline-block; background: #8BA5BA; font-size: 14px; text-decoration: none; border-radius: 3px; border-bottom: 2px solid #647786;">Ir para a <strong>área do cliente</strong></a>

			<a href="http://youcons.com.br" style="color: #f7f7f7; padding: 7px 15px; display: inline-block; background: #8BA5BA; font-size: 14px; text-decoration: none; border-radius: 3px; border-bottom: 2px solid #647786;margin-top: 20px">Ir para o site</a>

		</div>

		<div style="display: inline-block;width: 49%;text-align: center;">
			
			<img style="width: 130px; height: auto;" src="{{ $message->embed(public_path() . '/images/youcon-2.png') }}" />
		</div>

	</div>
</div>