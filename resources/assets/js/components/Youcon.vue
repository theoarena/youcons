<template>		
  <div id="youcon-animated"> 
    <transition name="message_fade">    
      <div v-show="show" v-bind:class="{ msg_simulacao:simulacao }" class="alert alert-success alert-dismissible fade show" id="youcon-msg">
          <span></span>
          <p v-html="textMessage" id="p-msg" v-bind:class="{ 'txt-sblue' : !simulacao} "></p>
          <button type="button" class="close" aria-label="Close" v-on:click="deleteTimeOut()">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
    </transition>
    <img v-bind:src="youcon_path" class="mx-auto d-block" @mouseover="showNotification" id="youcon-avatar" />
  </div>
</template>

<script type="text/javascript">
	
  module.exports = { 
    props:['message','simulacao','tipo_youcon','estado_prop'],
    data: function (){
      return{
        estado: this.estado_prop,
        show: false,
        hideTimeout: false,
        messageCode: this.message,
        textMessage:""
      }
    },
    methods:{      
     
      showNotification() {
        if(this.messageCode != "nada")
        {
          this.show = true;
          this.hideNotification();
        }
      },
      hideNotification() {
          this.hideTimeout = setTimeout(() => {
            this.show = false;
            this.deleteTimeOut();
          }, 4500);
      },
      deleteTimeOut(){
        
        clearTimeout(this.hideTimeout);
         this.show = false;
      //  this.messageCode = "nada";
      },
      setMessage(e){        

        this.deleteTimeOut();

        this.messageCode = e;

        switch(e)  
        {
          case 'cliente-pontos': this.textMessage = "Aqui você pode ver e administrar seu nível e ovos de ouro!"; break          

          case 'cliente-profile-picture-success': this.textMessage = "Sua foto de perfil foi atualizada!"; break          
          case 'cliente-profile-success': this.textMessage = "Seus dados foram salvos com sucesso!"; break;
          case 'cliente-profile-error': this.textMessage = "Ocorreu algum problema, tente novamente!"; break;         
          case 'simulacao-app-imobiliario': this.textMessage = "O consórcio de imóvel pode ser usado para compra de imóvel e terreno, assim como reforma e construção! "; break;

          case 'simulacao-app-automovel': this.textMessage = "O consórcio de automóvel pode ser usado para carros, motos e caminhões zero km ou usados! * <small>*Ano de fabricação conforme regra da administradora.</small>"; break;         

          case 'simulacao-app-servicos': this.textMessage = "O consórcio de serviços é muito versátil! Pode ser usado para serviços de viagem, serviços médicos como cirurgias plásticas e fertilização in vitro, tratamentos estéticos entre outros!"; break;

          case 'simulacao-app-step1': this.textMessage = ""; break;
          case 'simulacao-app-step2': this.textMessage = "O crédito é o valor do imóvel / veículo / serviço que você deseja comprar / contratar"; break;
          case 'simulacao-app-step3': this.textMessage = "A parcela que você espera pagar nos ajuda a buscar grupos de consórcio que atendem seu perfil!"; break;
          case 'simulacao-app-step4': this.textMessage = "Se você tem um dinheiro guardado, ele pode ajudar a dar lance no seu consórcio! Checaremos se seu lance é baixo ou alto nos grupos em andamento!"; break;
          case 'simulacao-app-step5': this.textMessage = "Ótimo! Agora vou buscar os resultados"; break
          ;

          case 'voucher-inserido': this.textMessage = "Voucher resgatado com sucesso!"; break;            
          case 'voucher-jaexiste': this.textMessage = "Você já possui este tesouro!"; break;            
          case 'voucher-preencha': this.textMessage = "Insira o código do tesouro!"; break;            
          case 'voucher-naoencontrado': this.textMessage = "O código do voucher inserido não foi encontrado. Verifique e tente novamente!"; break;       

          case 'indicacao-error': this.textMessage = "Ocorreu algum erro durante a indicação, tente novamente!"; break;            
          case 'indicacao-success': this.textMessage = "Enviamos um convite para a sua indicação, obrigado!"; break;            
          case 'indicacao-exists': this.textMessage = "O email fornecido já foi indicado!"; break;            
          case 'indicacao-user-exists': this.textMessage = "O email fornecido já possui cadastro em nossos sistemas!"; break;            

        }        

        if(this.messageCode != "nada")
          this.showNotification();

      }
    },    
   
    created () {

      if(this.message != "nada")      
        this.setMessage(this.message);
      //listener pra qualquer msg que chegar
      EventBus.$on('new-message', this.setMessage);      

    },      
    watch:{

      message:function(){
        this.setMessage(this.message);
      },

      estado:{

        handler:function(){

          var ret = "";

          if(this.tipo_youcon == "1")
          {
            switch(this.estado)
            {
              case 1: ret = '../../images/A1.png'; break;
              case 2: ret = '../../images/A3.png'; break; 
              case 3: ret = '../../images/A7.png'; break; 
            }
          } 
          else        
          {
            switch(this.estado)
            {
              case 1: ret = '../../images/B1.png'; break;
              case 2: ret = '../../images/B3.png'; break; 
              case 3: ret = '../../images/B6.png'; break; 
            }
          }               
          this.youcon_path = ret;          
        },
        immediate: true
      },     

    } 
  };

</script>