<template>
    <div id='simulacao-app-bg' class="simulacao-app">

        <modal-contratar v-show="showModal" v-bind:data="opcao_selecionada"></modal-contratar>
        <div class="overlay-contratar" v-show="showModal"></div>

        <transition name="titfade" appear>
            <div class="row simulacao-app__title">
                <div class="col" id="tit-simulacao-wrapper">
                    <h2 id="tit-nova-simulacao">Simulação</h2>

                </div>
            </div>
        </transition>

        <!--  <transition name="titfade" appear>
           <button id="btn-ajuda">ajuda</button>
         </transition> -->

        <transition name="progress_fade" appear>
        <div class="row simulacao-app__progress" id="steps-timeline" v-if="showProgress">
            <div class="col" v-bind:class="checkCompleted(1)"> <small> 1. Modalidade </small>  <div class="bullet"></div></div>
            <div class="col" v-bind:class="checkCompleted(2)"> <small> 2. Crédito </small>  <div class="bullet"></div></div>
            <div class="col" v-bind:class="checkCompleted(3)"> <small> 3. Parcela </small>  <div class="bullet"></div></div>
            <div class="col" v-bind:class="checkCompleted(4)"> <small> 4. Lance e pressa </small>  <div class="bullet"></div></div>
        </div>
        </transition>

        <div class="row position-relative simulacao-app__content" >

            <transition name="titfade" appear>

            <div class="col-lg-5 text-center" id="col-youcon">

                <youcon-component v-bind:hold="hold_youcon" :tipo_youcon="tipo_youcon" v-bind:estado_prop="estado_youcon" :message="'simulacao-app-imobiliario'" :simulacao="true"></youcon-component>

                <div class="step-button" v-if="show_step1">
                    <button class="btn btn-changestep btn disabled">< Anterior</button>
                     <button class="btn btn-changestep btn" v-on:click="changeStep(2)">Próximo ></button>
                </div>
                <div class="step-button" v-if="show_step2">
                    <button class="btn btn-changestep btn" v-on:click="changeStep(1)">< Anterior</button>
                     <button class="btn btn-changestep btn" v-on:click="changeStep(3)">Próximo ></button>
                </div>
                <div class="step-button" v-if="show_step3">
                    <button class="btn btn-changestep btn" v-on:click="changeStep(2)">< Anterior</button>
                     <button class="btn btn-changestep btn" v-on:click="changeStep(4)">Próximo ></button>
                </div>
                <div class="step-button" v-if="show_step4">
                    <button class="btn btn-changestep btn" v-on:click="changeStep(3)">< Anterior</button>
                     <button class="btn btn-finalstep btn" v-on:click="changeStep(5)">Finalizar ></button>
                </div>

                <div id="buttons" v-if="show_step5">

                </div>

            </div>

            </transition>



            <div class="col-lg-7 position-relative" id="col-form">

                <transition name="step-fade" mode="out-in" appear>
                <div id='step1' key="step1" class="simulacao_step" v-if="show_step1">

                    <p class="text-center">Primeiro, selecione o <br>tipo de consórcio que deseja:</p>

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

                <div id='step2' key="step2" class="simulacao_step" v-if="show_step2">
                    <p class="text-center">Agora, selecione o valor de crédito desejado:</p>
                    <div class="simulacao_step__content">
                        <label class="control-label">Crédito</label>
                        <input class="form-control" type="text" name="credito" id="credito" v-model="credito" v-input-mask-currency v-focus>
                        <button class="btn btn-proximo" v-on:click="changeStep(3)"><span class="arrow-right white"></span></button>
                    </div>
                </div>

                <div id='step3' key="step3" class="simulacao_step" v-if="show_step3">
                    <p class="text-center">Selecione o valor desejado da parcela:</p>
                    <div class="simulacao_step__content">
                        <label class="control-label">Parcela</label>
                        <input class="form-control" type="text" name="parcela" id="parcela" v-model="parcela" v-input-mask-currency v-focus>
                        <button class="btn btn-proximo" v-on:click="changeStep(4)"><span class="arrow-right white"></span></button>
                    </div>
                </div>

                <div id='step4' key="step4" class="simulacao_step" v-if="show_step4">
                    <p class="text-center">Selecione o valor do lance desejado:</p>

                    <div class="simulacao_step__content">
                        <label class="control-label">Lance</label>
                        <input class="form-control" type="text" name="lance" id="lance" v-model="lance" v-input-mask-currency v-focus>
                        <button class="btn btn-finalstep" v-on:click="changeStep(5)">finalizar<span class="arrow-right white"></span></button>
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

                <div id='step5' key="step5" class="simulacao_step" v-if="show_step5">
                    <h3 class="text-center">Buscando...</h3>
                </div>

                 <div id='step7' key="step7" class="simulacao_step" v-if="show_step7">
                    <p class="text-center">Sua simulação foi finalizada!</p>
                    <div class="simulacao_step__content">
                        <button class="btn btn-contratar btn-contratar--big " v-on:click="endSimulacao()">Ver minhas simulações</button>
                        <a href="javascript:void(0)" class="simulacao_step__outra-simulacao" v-on:click="changeStep(1)">Fazer outra simulação</a>
                    </div>
                </div>
                </transition>

            </div>



        </div>

        <div class="row">

            <div class="col">

                <transition name="step_fade">
                    <div id="termometros" v-if="showResults" class="simulacao-resultados row">

                         <simulacao-opcao v-for="(opcao, index) in opcoes" v-bind:data="opcao" v-bind:key="index" v-bind:size="simulacao_opcao_qtd"></simulacao-opcao>

                    </div>
                </transition>

            </div>

        </div>

    </div>

</template>

<script type="text/javascript">

    module.exports = {
        props:['youcon_path','simulacoes_save', 'user','tipo_youcon'],
        data: function (){
            return{
                actualstep:1,
                estado_youcon:3,
                hold_youcon: false,

                modalidade: 0,
                credito: 0,
                parcela: 0,
                lance: 0,
                pressa: 1,

                showSair: true,
                showResults: false,
                showProgress: true,

                show_step1: true,
                show_step2: false,
                show_step3: false,
                show_step4: false,
                show_step5: false,
                show_step6: false,
                show_step7: false,

                message: 'nada',
                showModal: false,
                opcao_selecionada: null,
                simulacaoId: null,

                opcoes: [
                    {
                        title: "Opção 1",
                        subTitle : "menor parcela",
                        opcao__itens: [
                            {
                                id: 1,
                                administradora: "Mapfre",
                                prazo: "30",
                                credito:"85.000",
                                parcela:"5.000",
                            },
                            {
                                id: 2,
                                administradora: "Mapfre",
                                prazo: "40",
                                credito:"85.000",
                                parcela:"5.000",
                            },
                            {
                                id: 3,
                                administradora: "Mapfre",
                                prazo: "50",
                                credito:"100.000",
                                parcela:"8.500",
                            },

                        ]
                    },
                    {
                        title: "Opção 2",
                        subTitle: "maior prazo",
                        opcao__itens: [
                            {
                                id: 4,
                                administradora: "Mapfre",
                                prazo: "30 meses",
                                credito:"85.000",
                                parcela:"5.000",
                            },
                            {
                                id: 5,
                                administradora: "Construtora javali",
                                prazo: "40 meses",
                                credito:"85.000",
                                parcela:"5.000",
                            },
                            {
                                id: 6,
                                administradora: "Templum consultoria",
                                prazo: "50 meses",
                                credito:"100.000",
                                parcela:"8.500",
                            },

                        ]
                    },
                     {
                        title: "Opção 3",
                        subTitle: "maior prazo",
                        opcao__itens: [
                            {
                                id: 4,
                                administradora: "Mapfre",
                                prazo: "30 meses",
                                credito:"85.000",
                                parcela:"5.000",
                            },
                            {
                                id: 5,
                                administradora: "Construtora javali",
                                prazo: "40 meses",
                                credito:"85.000",
                                parcela:"5.000",
                            },
                            {
                                id: 6,
                                administradora: "Templum consultoria",
                                prazo: "50 meses",
                                credito:"100.000",
                                parcela:"8.500",
                            },

                        ]
                    }
                ]
            }
        },
        created () {

           EventBus.$on('openModalContratar', this.openModalContratar);
           EventBus.$on('closeModalContratar', this.closeModalContratar);
           EventBus.$on('escolherConsorcio', this.saveConsorcio);

        },
        computed: {

            simulacao_opcao_qtd: function () {
                return this.opcoes.length;
            }
        },
        methods:{

            openModalContratar: function(data){
                this.showModal = true;
                this.opcao_selecionada = data
            },

            closeModalContratar: function(data){
                this.showModal = false;
                this.opcao_selecionada = null;
            },

            setMessage:function(e){
                this.message = e;
                EventBus.$emit('new-message',e);
            },
            setModalidade:function(e){
                this.modalidade = e;
                this.changeStep(2);
            },
            setPressa:function(e){
                this.pressa = e;
            },
            changeStep:function(n){

                this['show_step'+this.actualstep] = false;
                this['show_step'+n] = true;
                this.actualstep = n;

                switch(n)
                {
                    case 1:
                        this.resetValues();
                         this.message = "simulacao-app-step1";
                    break;
                    case 2: this.setMessage("simulacao-app-step2") ;break;
                    case 3: this.setMessage("simulacao-app-step3");break;
                    case 4: this.setMessage("simulacao-app-step4");break;
                    case 5:
                        this.setMessage("simulacao-app-step5");
                        this.saveSimulacao();
                        this.getOpcoes();
                        this.showProgress = false;
                        break;
                    case 6:
                        this.setMessage("simulacao-app-step6");
                        this.hold_youcon = true;
                        this.showResults = true;
                        break;
                    case 7:
                        this.setMessage("simulacao-app-step7");
                        this.hold_youcon = true;
                        this.estado_youcon = 2;
                        this.showModal = false;
                        this.showResults = false;
                    break;
                }

            },

            getOpcoes:function(){

               /* axios.post('/api/simulacoes/save',{data, contrato_escolhido}).then(
                    function(response) {
                        this.opcoes = response;
                    }
                );*/

               setInterval( this.changeStep(6), 2000);

            },

            saveConsorcio:function(consorcio){

                let that = this;

                var data = {
                    administradora : consorcio.administradora,
                    credito : consorcio.credito.replace(',','.'),
                    parcela : consorcio.parcela.replace(',','.'),
                    prazo : consorcio.prazo.replace(',','.'),
                    simulacao : this.simulacaoId
                };


                axios.post('/api/consorcios/new',{data}).then(
                    function(response) {

                       // if(response.data.status == "ok")
                            that.changeStep(7);

                    }
                );

            },

            saveSimulacao:function()
            {
                //this.changeStep(5);

                let that = this;

                console.log(this.parcela);

                var data = {
                    modalidade : this.modalidade,
                    credito : ( this.credito > 0) ? this.credito.replace(',','.') : 0,
                    parcela : ( this.parcela > 0) ? this.parcela.replace(',','.') : 0,
                    lance : ( this.lance > 0) ? this.lance.replace(',','.') : 0,
                    pressa : this.pressa,
                    user : this.user,
                };

                axios.post('/api/simulacoes/save',{data}).then(
                    function(response) {

                        that.simulacaoId = response.data.data.simulacao;

                    }
                );


            },
            endSimulacao:function(){
                window.location.href = "/clientes";
            },

            checkCompleted:function(step){
                return {'completed' : this.actualstep >= step};
            },

            resetValues:function () {

                this.modalidade = 0;
                this.credito = 0;
                this.parcela = 0;
                this.lance = 0;
                this.pressa = 1;

                this.showResults = false;
                this.showProgress = true;

                this.estado_youcon = 3;
                this.hold_youcon = false;

                this.showModal = false;
                this.opcao_selecionada = null;
                this.simulacaoId = null;

            }

        }
    };



</script>

