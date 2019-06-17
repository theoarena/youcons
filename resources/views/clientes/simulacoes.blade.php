@extends('index-painel-cliente')

@section('content')

    <p class="col-10 p-message">Utilize a tabela abaixo para navegar por suas simulações já realizadas. Caso queira visualizar informações adicionais, pressione o botão "+" do lado esquerdo de cada simulação. </p>

    <div id="list-vue">
        <v-server-table url="{{ $apiUrl }}" :columns="columns" :options="options" ref="listTable" >

            <div slot="child_row" slot-scope="props" v-bind:props="props" >
                <div class="cliente_child_row" >
                    {{--<p><strong>Código:</strong> @{{props.row.id}} </p>--}}
                    <p><strong>Modalidade:</strong> @{{props.row.modalidade_id}} </p>
                    <p><strong>Pressa:</strong> @{{props.row.pressa}} </p>

                    <template v-if="props.row.consorcio">

                        <p>A opção de consórcio escolhida foi:</p>

                        <div class="container">
                            <div class="row">

                                <div class="col col-lg-5 col_cliente-termometro">
                                    <h3>@{{props.row.consorcio.administradora}}</h3>
                                    <p> <b>Prazo:</b> @{{props.row.consorcio.prazo}} </p>
                                    <p> <b>Crédito:</b> @{{props.row.consorcio.credito}} </p>
                                    <p> <b>Parcela:</b> @{{props.row.consorcio.parcela}} </p>
                                    <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

                                    {{-- <button class="btn btn-sm btn-contratar">Contratar</button>
                                     <button class="btn btn-sm btn-detalhes float-right" v-on:click="solicitarDetalhes(1)">Solicitar detalhes</button>--}}
                                </div>

                            </div>
                        </div>

                    </template>

                </div>
            </div>

            <div slot="favorite" slot-scope="props" class="favorite-group">
                <btn-favorite v-bind:favorite="props.row.favorite" v-bind:id="props.row.id" v-bind:key="props.row.id" v-on:favorite-change="changeFavorite"></btn-favorite>
            </div>

            {{--  <div class="actions-group text-center" slot="actions" slot-scope="props">
               <a :href="itemLink(props.row.id)" class="btn btn-ver" role="button" aria-pressed="false">Ver</a>
             </div> --}}

        </v-server-table>
    </div>
    <div id="pagination"> </div>

@endsection

@section('footer-script')

    @parent

    <script type="text/javascript">



        var headings = {
            favorite: 'Favorita',
            vendedor_id: 'Vendedor',
            credito: 'Crédito',
            lance: 'Lance',
            parcela: 'Parcela',
            created_at : 'Criada em',
            //   actions : 'Ações'
        };

        var qtd_pag = {{ Config::get('constants.list_qtdpage') }};

        var list = new Vue({
            el: "#list-vue",
            //props:['editurl'],
            methods: {
                formatDate(date) {return moment(date).format('DD/MM/YYYY'); },
                changeFavorite(e){ },
                solicitarDetalhes(id){
                    console.log(id);
                }
            },
            data: {
                columns: ['favorite', 'vendedor_id','credito','lance','parcela','created_at'] ,
                options:
                    {
                        perPage:qtd_pag,
                        perPageValues:[qtd_pag],
                        headings: headings,
                        sortable: ['id','credito','lance', 'parcela'],
                        orderBy:{'column' : 'id'},
                        customFilters: [],
                        filterable:false,
                        requestAdapter(data)
                        {
                            return {
                                sort: data.orderBy ? data.orderBy : 'name',
                                direction: data.ascending ? 'asc' : 'desc',
                                page: data.page ? data.page : 1,
                                active: this.ativo,
                                query: data.query,
                            }
                        },
                        responseAdapter(resp)
                        {
                            var data = this.getResponseData(resp);
                            var count = data.items.total;
                            pagination.setTotal(count);
                            return { data: data.items.data, count: count}
                        },
                        templates: {
                            vendedor_id:function(h,row){
                                return (row.vendedor != null)?(row.vendedor.conta.name):("");
                            },
                            credito:function(h,row){ return currencyFormatter.format(row.credito, { code: 'BRL' }); },
                            lance:function(h,row){ return currencyFormatter.format(row.lance, { code: 'BRL' }); },
                            parcela:function(h,row){ return currencyFormatter.format(row.parcela, { code: 'BRL' }); }
                        },
                        texts: {
                            count: "Mostrando de {from} até {to}. Total: {count} itens|{count} itens|Um item",
                            noResults: "Sem simulações.",
                        },

                    }
            }
        });

        var pagination = new Vue({
            el: "#pagination",
            data: {
                page: 1,
                records: 0,
            },
            methods: {
                setPage: function(page) {
                    this.page = page;
                    list.$refs['listTable'].setPage(this.page);
                },
                setTotal: function(value){
                    this.records = value;
                }
            }
        });


    </script>

@endsection
