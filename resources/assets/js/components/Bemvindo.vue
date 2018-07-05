<template>		
  
    <div id='simulacao-app-bg'>

      <div class="row">
        <div class="col">

          <transition name="titfade" appear>    
            <h3 id="tit-bemvindo">Seja bem-vindo!<span> Clique para escolher o Youcon que irá lhe ajudar com seu consórcio :)</span> </h3>
          </transition>

          <transition name="titfade"> 
            <a id="btn-outro" v-if="btn_outro" v-on:click="selecionaYoucon(0)">Selecionar outro Youcon</a>
          </transition>

        </div>
      </div>

      <div class="row position-relative justify-content-md-center" id="youcon-selector">  

        <div class="col-3 text-center position-relative">

          <transition name="youconfade" appear mode="out-in">
            <img v-bind:src="youcon1" v-on:click="selecionaYoucon(1)" v-if="show1">
          </transition>

          <transition name="msgfade">
            <p class="mensagem-youcon alert right" v-show="msg21">
              <span></span>
              Oba!!! Obrigado por me escolher!
              Tenho uma ideia! Que tal fazermos sua <strong>primeira simulação</strong>?
            </p>
          </transition>         

        </div>
        <div class="col-3 text-center position-relative">

          <transition name="youconfade" appear >               
            <img v-bind:src="youcon2" v-on:click="selecionaYoucon(2)" v-if="show2">
          </transition>

          <transition name="msgfade">
            <p class="mensagem-youcon alert left" v-show="msg11">
              <span></span>
              Oba!!! Obrigado por me escolher!
              Tenho uma ideia! Que tal fazermos sua <strong>primeira simulação</strong>? 
            </p>
          </transition>
               

        </div>

      </div>

      <div class="row">
        <div class="col">
          <transition name="btnsimufade">
            <button class="btn" id="btn-bemvindo-simulacao" v-on:click="fazerSimulacao()" v-if="btn_simulacao">Fazer minha primeira simulação!</button>
          </transition>
        </div>
      </div>
     

    </div>      
  
</template>

<script type="text/javascript">
	

  module.exports = { 
    props:['path','id'],
    methods:{     
      fazerSimulacao:function(){

        axios.post('/api/users/setyoucon',{youcon:this.youcon,user:this.id}).then(
          response => {
          window.location.href = "/clientes/simulacoes/nova-simulacao";
          }
        );

      },
      selecionaYoucon:function(tipo){

          if(tipo == 0)
          {
            this.show1 = true;
            this.show2 = true;
            this.btn_outro = false;
            this.msg11 = false;
            this.msg12 = false;
            this.msg21 = false;
            this.msg22 = false;
            this.btn_simulacao = false;
            this.step--;
          }else
          {
            if(tipo == 1)
              this.show2 = false;
            else
              this.show1 = false;

            this.btn_simulacao = true;
            this.step++;
            this.youcon = tipo;
          }         
      }
    },
    data: function (){
      return{            
       step:1,
       youcon:0,
       btn_outro:false,
       btn_simulacao: false,
       show1:true,
       show2:true,
       msg11:false,
       msg12:false,
       msg21:false,
       msg22:false,
      }
    },
    computed:{

      youcon1: function() { 
          var ret = "";
          switch(this.step)
          {
            case 1: ret = '../../images/A1.png'; this.btn_outro = false; break;
            case 2: ret = '../../images/A3.png'; this.msg11 = true; this.btn_outro = true; break;
            case 3: ret = '../../images/A7.png'; this.msg11 = false; this.msg12 = true;break;
          }
          return ret;
      },
      youcon2: function() { 
          var ret = "";
          switch(this.step)
          {
            case 1: ret = '../../images/B1.png'; this.btn_outro = false; break;
            case 2: ret = '../../images/B3.png'; this.msg21 = true; this.btn_outro = true; break;
            case 3: ret = '../../images/B6.png'; this.msg21 = false; this.msg22 = true; break;
          }
          return ret;
      }

    }  
    
  };



</script>

