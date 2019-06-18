<template>
    <div v-bind:class="colSize">

        <div class="simulacao-opcao">

                <h3 class="simulacao-opcao__title">
                    {{data.title}}
                    <span>{{data.subTitle}}</span>
                </h3>

            <div class="simulacao-opcao__body bg-metal">

                <table class="simulacao-opcao__list">
                    <thead>
                        <tr>
                            <th>Administradora</th>
                            <th>Prazo</th>
                            <th>Crédito</th>
                            <th>Parcela</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                         <simulacao-item v-for="(item, index) in data.opcao__itens" v-bind:data="item" v-bind:key="index"></simulacao-item>
                    </tbody>
                </table>

            </div>

        </div>

    </div>
</template>

<script type="text/javascript">	
  module.exports =
  {
    props: ['data','size'],
    data:function (){
        return{

        }
    },

    computed:{

        colSize: function () {

            return "col col-lg-6";

            let cSize = ( this.size > 2 ) ? this.size : 2
            return "col col-lg-"+(12/cSize);
        }

    }

    
  };

</script>

