<template>	
	<button class="btn btn-favorite" v-bind:class="favorite_class" v-on:click="changeFavorite()">   
	</button>
</template>

<script type="text/javascript">	
  export default {
    	props: ['favorite','id'],
    	data:function (){
  			return{				
          isFavorite: ( (this.favorite=="Sim")?true:false ),  			
  			}
    	},
      	methods: {
        	changeFavorite(){

        	  this.isFavorite = !this.isFavorite;
            var status = (this.isFavorite)?1:0;
        		axios.post( '/api/simulacoes/favorite/'+this.id+'/'+ status );
        	}
    	},    
      computed:{                  
        favorite_class:function(){
          return{ 'favorito': this.isFavorite }
        }
      }
  };

</script>

