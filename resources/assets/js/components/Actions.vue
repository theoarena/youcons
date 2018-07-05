<template>	
	<div id="actions-group">			
		<a :href="edit(data.id)" class="btn btn-primary" role="button" aria-pressed="true">Ver</a> 
		<div class="btn-group" role="group">
		    <button id="btnGroupDelete" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		      Remover
		    </button>
		    <div class="dropdown-menu" aria-labelledby="btnGroupDelete">

		    	<form  method="post">					
					<input type="hidden" name="_method" value="DELETE">			   
		      		<button class="dropdown-item" type="submit">Sim</button>
				</form>
		      
		      <a class="dropdown-item" href="#">Cancelar</a>
		    </div>
		</div>
	</div>
</template>

<script type="text/javascript">
	//v-bind:action="delete_url"
  export default {
    	props: ['data', 'index', 'editurl'],
    	//data:{editurl:editurl},
      	methods: {
        	edit(id)
            {                 
               return editurl+''+id;                              
            },
            remove(id)
            { 
                return 'admin/clientes/delete/'+id;                                              
            }
    	}
  };

</script>

