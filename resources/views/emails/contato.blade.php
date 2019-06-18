<div style="margin: 30px 0;font-family: Verdana; ">
	<img src="{{ $message->embed(public_path() . '/images/logo.jpg') }}" style="display: block;margin: 30px auto 10px">
	<div style="border-radius: 3px;display: block;margin: 0 auto; background: #52b3d7;max-width:500px;width: 100%;padding: 20px;border-bottom: 2px solid #489ebd;">
		<h2 style="color:#f7f7f7">Contato através do site</h2>
		
		<p style="color: #f7f7f7;">Conteúdo da mensagem:</p>
		<ul style="color:#f7f7f7;line-height: 25px;">
			<li><strong>Nome:</strong> <span style="color: #31536E;text-decoration: none;">{{ $nome }}</span></li>
			<li><strong>Email:</strong> <span style="color: #31536E;text-decoration: none;"><a href="mailto: {{ $email }}">{{ $email }}</a></span></li>
			<li><strong>Telefone:</strong> <span style="color: #31536E;text-decoration: none;">{{ $telefone }}</span></li>
			<li><strong>Mensagem:</strong> <p style="color: #31536E;text-decoration: none;">{{ $mensagem }}</p></li>
		</ul>
		
	</div>
	<div style="display: block;margin: 2px auto 0; font-family: Verdana;max-width:500px;width: 100%; padding:0 20px;">	
		<p style="text-align: center; color: #747474">Youcons.com.br</p>
	</div>
</div>