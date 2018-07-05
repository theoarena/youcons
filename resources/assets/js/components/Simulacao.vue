<template>		  
    <div id='simulacao-app-bg'>

      <transition name="titfade" appear>
        <div class="row">   
          <div class="col" id="tit-simulacao-wrapper"> 
            <h2 id="tit-nova-simulacao">Simulação</h2>       

          </div>
        </div>
      </transition>

     <!--  <transition name="titfade" appear>
        <button id="btn-ajuda">ajuda</button>
      </transition> -->
      
      <transition name="titfade" appear>
        <div class="row" id="steps-timeline" v-if="!showtermometros">
          <div class="col" v-bind:class="checkCompleted(1)"> <small> 1. Modalidade </small>  <div class="bullet"></div></div>
          <div class="col" v-bind:class="checkCompleted(2)"> <small> 2. Crédito </small>  <div class="bullet"></div></div>
          <div class="col" v-bind:class="checkCompleted(3)"> <small> 3. Parcela </small>  <div class="bullet"></div></div>
          <div class="col" v-bind:class="checkCompleted(4)"> <small> 4. Lance e pressa </small>  <div class="bullet"></div></div>
        </div>
      </transition>

      <div class="row position-relative">               
        
        <transition name="titfade" appear>

          <div class="col-lg-5 text-center">

            <youcon-component :tipo_youcon="tipo_youcon" :estado_prop="3" v-bind:message="message" v-bind:simulacao="true"></youcon-component>

            <div id="buttons" v-if="okstep1">
              <button class="btn btn-changestep btn disabled">< Anterior</button>
              <button class="btn btn-changestep btn" v-on:click="changeStep(2)">Próximo ></button>
            </div>
            <div id="buttons" v-if="okstep2">
              <button class="btn btn-changestep btn" v-on:click="changeStep(1)">< Anterior</button>
              <button class="btn btn-changestep btn" v-on:click="changeStep(3)">Próximo ></button>
            </div>
            <div id="buttons" v-if="okstep3">
              <button class="btn btn-changestep btn" v-on:click="changeStep(2)">< Anterior</button>
              <button class="btn btn-changestep btn" v-on:click="changeStep(4)">Próximo ></button>
            </div>
            <div id="buttons" v-if="okstep4">
              <button class="btn btn-changestep btn" v-on:click="changeStep(3)">< Anterior</button>
              <button class="btn btn-finalstep btn" v-on:click="endSimulacao(5)">Finalizar ></button>
            </div>
           
            <div id="buttons" v-if="okstep5">
              
            </div>          
            
          </div>

        </transition>



        <div class="col-lg-7 position-relative">
          
          <transition name="step-fade" mode="out-in" appear>

            <div id='step1' key="step1" class="step" v-if="okstep1">
              <p class="text-center">Primeiro, selecione o tipo de consórcio que deseja:</p>


              <div class="row">                
                <div class="col-sm radio-group block-modalidade">                  
                    <button class="btn btn-modalidade" id="btn-imobiliario" v-bind:class="{ selected: modalidade == 1}" v-on:click="setModalidade(1)" v-on:mouseover="setMessage('simulacao-app-imobiliario')">Imobiliário</button>
                  
                </div>

                <div class="col-sm radio-group block-modalidade">                  
                    <button class="btn btn-modalidade" id="btn-veicular" v-bind:class="{ selected: modalidade == 2}" v-on:click="setModalidade(2)" v-on:mouseover="setMessage('simulacao-app-automovel')">Veicular</button>
                  
                </div>

                <div class="col-sm radio-group block-modalidade">                  
                    <button class="btn btn-modalidade" id="btn-servicos" v-bind:class="{ selected: modalidade == 3}" v-on:click="setModalidade(3)" v-on:mouseover="setMessage('simulacao-app-servicos')">Serviços</button>
                  
                </div>
              </div>
                       
            </div>
         
            <div id='step2' key="step2" class="step valores" v-if="okstep2">
              <p class="text-center">Agora, selecione o valor de crédito desejado:</p>
              <div class="block-valores">
                <label class="control-label">Crédito</label>
                <input class="form-control" type="text" name="credito" id="credito" v-model="credito" v-input-mask-currency v-focus>               
              </div>
            </div>        

            <div id='step3' key="step3" class="step valores" v-if="okstep3">
              <p class="text-center">Selecione o valor desejado da parcela:</p>
              <div class="block-valores">
                <label class="control-label">Parcela</label>
                <input class="form-control" type="text" name="parcela" id="parcela" v-model="parcela" v-input-mask-currency v-focus>
              </div>  
            </div>
          
            <div id='step4' key="step4" class="step valores" v-if="okstep4">
              <p class="text-center">Selecione o valor do lance desejado:</p>
              <div class="block-valores">
                <label class="control-label">Lance</label>
                <input class="form-control" type="text" name="lance" id="lance" v-model="lance" v-input-mask-currency v-focus>
              </div>

              <p class="text-center">Qual a sua pressa?</p>
              <div class="row">

                <div class="col-sm radio-group block-pressa">                  
                  <button class="btn btn-pressa" id="btn-pouca" v-bind:class="{ selected: pressa == 1}" v-on:click="setPressa(1)">Pouca</button>                 
                </div>

                <div class="col-sm radio-group block-pressa"> 
                  <button class="btn btn-pressa" id="btn-media" v-bind:class="{ selected: pressa == 2}" v-on:click="setPressa(2)">Média</button>    
                </div>

                <div class="col-sm radio-group block-pressa"> 
                  <button class="btn btn-pressa" id="btn-alta" v-bind:class="{ selected: pressa == 3}" v-on:click="setPressa(3)">Alta</button>   
                </div>

              </div>

            </div>
         
            <div id='step5' key="step5" class="step" v-if="okstep5">
              <h3 class="text-center">Buscando...</h3>                     
            </div>                
          </transition>

        </div>

       

      </div>     

      <div class="row">       

        <div class="col">
          
          <transition name="step_fade">
            <div id="termometros" v-if="showtermometros">            

              <div class="card-deck">

                <div class="card">
                  <img class="card-img-top" src="#" alt="Card image cap">

                  <div class="card-body">

                    <h5 class="card-title">Opção 1</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <a href="#" class="btn btn-contratar">Contratar</a>

                  </div>
                </div>

                <div class="card">
                  <img class="card-img-top" src="#" alt="Card image cap">

                  <div class="card-body">

                    <h5 class="card-title">Opção 2</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-contratar">Contratar</a>

                  </div>
                </div>

                <div class="card">
                  <img class="card-img-top" src="#" alt="Card image cap">

                  <div class="card-body">

                    <h5 class="card-title">Opção 3</h5>                  
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <a href="#" class="btn btn-contratar">Contratar</a>

                  </div>
                </div>

              </div>

            </div>
          </transition>

        </div>

      </div>

    </div>     
  
</template>

<script type="text/javascript">
	

  module.exports = { 
    props:['youcon_path','simulacoes_save', 'user','tipo_youcon'],
    methods:{
      setMessage:function(e){
         this.message = e;
      },
      setModalidade:function(e){
         this.modalidade = e;
      },
      setPressa:function(e){
         this.pressa = e;
      },
      changeStep:function(n){ 

        this['okstep'+this.actualstep] = false;
        this['okstep'+n] = true;  
        this.actualstep = n;   
      

        switch(n)
        {
         // case 1: this.message = "simulacao-app-step1";break;
          case 2: this.setMessage("simulacao-app-step2") ;break;
          case 3: this.setMessage("simulacao-app-step3");break;
          case 4: this.setMessage("simulacao-app-step4");break;
          case 5: this.setMessage("simulacao-app-step5");break;         
        }


      },
      endSimulacao:function()
      {
        this.changeStep(5);

        var data = {
          modalidade : this.modalidade,
          credito : this.credito.replace(',','.'),
          parcela : this.parcela.replace(',','.'),
          lance : this.lance.replace(',','.'),
          pressa : this.pressa,
          user : this.user,
        };

        axios.post(this.simulacoes_save,{data}).then(
          function(response) {
          //  console.log(response);
            //if(response.)
          }
        );

        //this.showsair = false;        
        this.showtermometros = true;        
      },
      close:function(){},

      checkCompleted:function(step){
        return {'completed' : this.actualstep >= step};
      }

    },
    data: function (){
      return{
        actualstep:1,
        modalidade: 1,
        credito: 0,
        parcela: 0,
        lance: 0,
        pressa: 1,
        showsair: true,
        showtermometros: false,
        okstep1: true,
        okstep2: false,
        okstep3: false,
        okstep4: false,
        okstep5: false,
        okstep6: false,
        message: 'nada',
      }
    },
    computed:{},       
  };



</script>

