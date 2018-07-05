<div class="form-row form-inline" id="inputfilter">
  <div class="col-auto position-relative ">
              
    <input type="text" name="global-search" placeholder="Busca" class="form-control" v-model="query_string"><button v-on:click="clearSearch()" id="btn-clearsearch">x</button>

  </div>

  @stack('filters')   

  <div class="col text-right">
    @stack('tools-button')    
  </div>

</div>

 <div id="list-vue">
  <v-server-table url="{{ $apiUrl }}" :columns="columns" :options="options" @loading ="onLoading" ref="listTable" :active="2" name="listtable">  

   {{--  <template slot="child_row" scope="props" :key="id">
      <div><b>ID:</b> {{props.row.id}}</div>     
    </template> --}}

    <div class="actions-group" slot="actions" slot-scope="props">    

        @if($useModal)
          <button v-on:click="openModal(props.row.id)" type="button" class="btn btn-ver" data-toggle="modal" data-target="#modalWindow">
            Ver
          </button
        @else
          <a :href="itemLink(props.row.id)" class="btn btn-ver btn-area" role="button" aria-pressed="true">Ver</a> 
        @endif
        <div class="btn-group" role="group">
            <button id="btnGroupDelete" type="button" class="btn btn-area btn-remover dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Desativar
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDelete">              
                <form :action="deleteLink(props.row.id)" method="post" v-on:submit.prevent="onSubmitDelete(props.row.id)" >                   
                      @csrf
                    <input type="hidden" name="_method" value="DELETE">            
                    <button class="dropdown-item dropdown-confirm btn-confirm-delete" type="submit">Confirmar</button>
                </form>
              
            </div>
        </div>

    </div>

  </v-server-table>
</div>
<div id="pagination"> </div>