 //código padrão da lista em vue
var qtd_pag = {{ Config::get('constants.list_qtdpage') }};

if(!"openModal" in window)
  var openModal = function(){};

if(!"csvurl" in window)
  var csvurl = null;

var list = new Vue({
    el: "#list-vue",        
    methods: {
        formatDate(date) {return moment(date).format('DD/MM/YYYY'); },
        itemLink(id) {return editurl+'/'+id; },
        deleteLink(id) {return deleteurl+'/'+id; },        
        onSubmitDelete(id){ axios.delete(this.deleteLink(id)).then( function(){ list.$refs['listTable'].refresh() } ) },
        onLoading(v){ EventBus.$emit('csvParamsChange', v);  }
    },   
    data: {
        columns: columns,                                                    
        options:
        {
          perPage:qtd_pag,  
          perPageValues:[10],        
          headings: headings,
          sortable: sortable,        
          orderBy:{"column" : sort_column}, 
          customFilters: custom_filters,              
          filterable:true,           
          dateColumns:['created_at'],
          requestAdapter: function (data) {            
            data.orderBy = data.orderBy ? data.orderBy : 'name';
            data.direction = data.ascending ? 'asc' : 'desc';
            data.page = data.page ? data.page : 1;                
            data.query = data.query;
            data.active = data.active ? data.active : 2;
            return data;
          },                             
          responseAdapter(resp)
          {
              var data = this.getResponseData(resp);  
              var count = data.items.total;  
              pagination.setTotal(count);                               
              return { data: data.items.data, count: count} 
          },
          templates: custom_template,
          texts: {
            count: "Mostrando de {from} até {to}. Total: {count} itens|{count} itens|Um item",
             noResults: "Nada encontrado.",
          }
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

var inputfilter = new Vue({

  el: "#inputfilter",   
  data: {
    query_string: "",
    activeFilter:2,
    csvParams: [],

    //datepicker
    months:['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho',
    'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    shortDays:['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    captions:{'title': 'Selecione o período', 'ok_button': 'OK'},
    format: "DD/MM/YYYY",   

  },
  methods:{
   
    clearSearch:function(){
      this.query_string = "";
    },
    toggleFilter: function(filterName, $event) 
    {
      var searchItem;
      //console.log( filterName);
      //this.loadingData = true;      
      setTimeout(function()
      {
        if(filterName == "periodo") //se for o filtro periodo
        {
          if($event != null)
            searchItem = {
              'start': moment($event.start).format('YYYY-MM-DD'), 
              'end': moment($event.end).format('YYYY-MM-DD') 
            };
        }
        else if (typeof $event === 'string')
        { searchItem = $event; } 
        else 
        { searchItem = $event.target.value; } 

        var table = list.$refs['listTable'];        
        table.customQueries[filterName] = searchItem; 
        table.getData(); 
         // this will send the request 
        // this.loadingData = false; 
       });

    },
    resetRange: function()
    {
      var picker = this.$refs['dateRangePicker'];
      picker.dateRange = {};
      picker.$emit('selected', null);    
    },
    downloadCsv: function(url)
    {
      axios.get(url,{params: this.csvParams, responseType: 'blob', headers:{'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'} }).then(
        function(response){          
          //resp = response.data.toString('utf8'); 
          download( response.data, 'simulacoes.xlsx',"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        }
      );    
    }
  },
  mounted(){
    const self = this; 
    EventBus.$on('csvParamsChange', function(value) {       
      self.csvParams = value; 
    });
  },

  watch:{

    query_string: _.debounce( function(value){
        list.$refs['listTable'].setFilter( value );  
      },450
    ),    
  }

});

