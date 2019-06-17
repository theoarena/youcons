<template>

    <div v-show="showModal" class="modal-contratar modal-dialog centered modal-custom__dialog" role="document">
        <div class="modal-content modal-custom__content">
            <div class="modal-header modal-custom__header">
                <h3 class="modal-title">Você escolheu:</h3>
                <button type="button" class="close" aria-label="Close" v-on:click="closeModalContratar()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-custom__body">

                <strong class="modal-custom__title">{{data.administradora}}</strong>

                <p class="modal-custom__description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>

                <div class="option-block row">

                    <div class="col col-lg-4">
                        <div class="option-block__item">
                            <h4 class="option-block__label">Prazo</h4>
                            <span class="option-block__value option-block__value--big">{{data.prazo}}</span>
                        </div>
                    </div>

                    <div class="col col-lg-4">
                        <div class="option-block__item">
                            <h4 class="option-block__label">Crédito</h4>
                            <span class="option-block__value">R${{data.credito}}</span>
                        </div>
                    </div>

                    <div class="col col-lg-4">
                        <div class="option-block__item">
                            <h4 class="option-block__label">Parcela</h4>
                            <span class="option-block__value">R${{data.parcela}}</span>
                        </div>
                    </div>

                </div>


                <div class="row option-block-btns">

                    <div class="col col-lg-6 text-center">
                        <button class="btn btn-lg btn-contratar" v-on:click="escolherConsorcio()">Contratar</button>
                    </div>

                    <div class="col col-lg-6 text-center">
                        <button class="btn btn-lg btn-contratar-outro" v-on:click="closeModalContratar()">Escolher outra</button>
                    </div>

                </div>

            </div>

        </div>
    </div>

</template>

<script type="text/javascript">

    module.exports = {
        props: ['data'],

         methods:{

                closeModalContratar:function(){
                    EventBus.$emit('closeModalContratar',null);
                },

                escolherConsorcio:function(){
                    EventBus.$emit('escolherConsorcio',this.data);
                }

            }

    };

</script>

