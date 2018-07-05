<template>	
	<div>    
    <p id="encontrei-ovo">Encontrei um ovo de ouro!</p>
    
    <div id="tesouros-head" class="row no-gutters">      
      <div class="col">
        <input type="text" name="codigo_voucher" v-model="codigo" class="form-control" placeholder="Insira aqui o código do tesouro!" required>
      </div>
      <div class="col-3">        
      <button class="btn" id="btn-voucher" v-on:click="getVoucher()">Resgatar</button>
      </div>     
    </div>
      
    <h5 class="text-center mb-0 mt-4">Meus tesouros</h5>              

    <ul id="lista-tesouros">
      <li v-for="tesouro in tesouros">
        <span>{{ tesouro.nome }}</span>
        <strong>{{ tesouro.experiencia }} xp</strong>
      </li>
      <p v-if="!tesouros">Sem tesouros.</p>
    </ul>

  </div>
</template>

<script type="text/javascript">	
  export default 
  {
    props: ['user_id'],
    data:function (){
			return{				
				codigo: "",
        retMsg: "",
        showMsg: false,
        tesouros:[]
			}
    },
    methods:{

      //por todos numa lista e verificar a existencia atraves da listagem

      getVoucher:function(){

        var status = 'voucher-preencha';

        if(this.codigo != "")
        {
          axios.post('/api/vouchers/validate',{codigo:this.codigo, user_id:this.user_id}).then(
            response => {            

              status = response.data.status;
              this.retMsg = status;
              
              if(status == "voucher-inserido")
              {             
                this.codigo = "";
                this.getTesouros();
              }                                      

          });

        }

        EventBus.$emit('new-message',status);  

      },
      getTesouros:function(){

        axios.get('/api/tesouros',{ params:{ user_id:this.user_id} }).then(
          response => {
            console.log(response.data);
            this.tesouros = response.data[0];
          }
        );

      }

    },
    mounted:function(){
      this.getTesouros();
    }
    
  };

</script>

