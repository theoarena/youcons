<div class="modal fade" tabindex="-1" role="dialog" id="modalindicar">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title">Indicar a Youcons para amigos!</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body container">          
	     
	    	<div class="row">
	    		<div class="col">
	    			<h4 class="text-center mb-4">Gostaria de indicar a youcons para amigos?</h4>	    			
	    		</div>	    		
	    	</div>
	    	<div class="row">
	    		<div class="col">
	    			<p>Quando você indica alguém e essa pessoa cria uma conta conosco, você ganha pontos!</p>
	    		</div>
	    		<div class="col">
	    			<p>Se essa pessoa fechar um consórcio, você ganha mais pontos!</p>	    			
	    		</div>
	    	</div>
	    	<form method="POST" action="{{ route('clientes_indicar-amigo') }}">
	    		@csrf
	    		<input type="hidden" name="user" value="{{ Auth::id() }}">
		    	<div class="row">
	    			<label class="col-form-label col-2 text-center">Email</label>
		    		<div class="col-7">
	    				<input type="text" class="form-control" name="email" required>		    				
		    		</div>	    		
		    		<div class="col-3"> 
		    			<input type="submit" name="enviar" value="Indicar" class="btn-entrar btn"> 
		    		</div>
		    	</div>
	    	</form>

	    	
	    	

	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-light-blue" data-dismiss="modal">cancelar</button>      
	    </div>
	  </div>
	</div>
</div>