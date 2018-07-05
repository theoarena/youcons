<template>
   <v-server-table url="{{ apiurl }}" :columns="{{ columns }}" :options="{{ options }}" ref="listTable">   

    <div class="actions-group" slot="actions" slot-scope="props">    

        <a :href="itemLink(props.row.id)" class="btn btn-primary" role="button" aria-pressed="true">Ver</a> 

        <div class="btn-group" role="group">
            <button id="btnGroupDelete" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Remover
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDelete">

                <form :action="deleteLink(props.row.id)" method="post" v-on:submit.prevent="onSubmitDelete(props.row.id)" >
                    <input type="hidden" name="_method" value="DELETE">            
                    <button class="dropdown-item dropdown-confirm" type="submit">Sim</button>
                </form>
              
              <a class="dropdown-item dropdown-cancel" href="#">Cancelar</a>
            </div>
        </div>

    </div>

  </v-server-table>
</template>

<script type="text/javascript">  

   

</script>