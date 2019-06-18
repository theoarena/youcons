<template>
    <tr class="simulacao-opcao-item">
        <td> <span class="simulacao-opcao-item__text simulacao-opcao-item__text--bold">{{data.administradora}} </span> </td>
        <td class="e"> <span>{{data.prazo}} </span> </td>
        <td> <span>{{data.credito}} </span> </td>
        <td> <span>{{data.parcela}} </span> </td>
        <td class="simulacao-opcao-item__col-btn">
            <button class="btn btn-contratar-list" data-toggle="modal" data-target="#modalContratar" v-on:click="openModalContratar()">contratar</button>
        </td>
    </tr>
</template>

<script type="text/javascript">

    module.exports =
        {
            props: ['data'],

            methods:{

                openModalContratar:function(){
                    EventBus.$emit('openModalContratar',this.data);
                },

            }

        };

</script>

