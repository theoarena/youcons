@extends('index-painel-cliente')

@section('content')

   <script type="text/javascript">
      
      //calculo dos pontos

      var nivel = {{ $user->nivel }};
      var max = 10; //total de niveis
      var progresso = (nivel*100)/max; //progresso do circulo

   </script>

  <div class="container">   	
    <div class="row">
    	<div class="col-md">
        <div id="ovos-ouro">           
           <div class="container">
              <div class="row no-gutters">               

                 <div class="col">                     
                    <div id="progress-circle">
                       <vue-circle 
                       :progress="progresso"
                       :size="150"
                       :reverse="false"
                       line-cap="round"  
                       :fill="{ gradient: ['#489EBD','#52B3D7'] }"
                       
                       empty-fill="rgba(0, 0, 0, .1)"
                       :animation-start-value="0.0"
                       :start-angle="0"
                       insert-mode="append"
                       :thickness="18"
                       :show-percent="false"
                       >
                       <p>Nível
                          <strong>{{ $user->nivel }}</strong>
                       </p>
                       </vue-circle>   
                    </div>   
                 </div>

                 <div class="col">
                    <div id="ovos-nivel">                           
                       <h3 id="nivel" class="align-middle">                    
                        <span>Categoria</span>
                        {{ $user->getCategoria() }}
                       </h3>
                    </div>
                    <div id="total-progresso">
                     {{ $user->getProgresso() }} <span>pontos</span>
                    </div>
                 </div>

              </div>
           </div>

           <div id="info-pontos">
            <p>{{ $user->getPontosRestantes() }}</p>
           </div>

           <div id="info-ovos">                  
              <div class="list-group" id="list-beneficios">

                <?php 

                  $nivel = $user->getProgresso('nivel');
                  $beneficio = 0;

                  for ($i=1; $i <= $nivel ; $i++) { 
                    $beneficio = 50*$i;

                    ?>

                      <div class="list-group-item list-group-item-action flex-column align-items-start">
                      <div class="d-flex">
                      <h5 class="mb-1">Benefício nível <strong><?php echo $i; ?></strong></h5>                        
                      </div>
                      <p class="mb-1"><?php echo "R$".$beneficio.",00"; ?> em desconto.</p>

                      </div>

                    <?php

                  }

                ?>
               
              </div>
           </div>

        </div>
      </div>
      <div class="col-md">
        
        <div>
          <div class="container">

            <div class="row no-gutters">   
              <div class="col"><h3 id="tit-tesouros">Tesouros de ovos de ouro</h3></div>
            </div>

             <div class="row no-gutters">   
              <div class="col">
                <button class="btn" id="btn-tesouros-info" data-toggle="modal" data-target="#modaltesouros">O que são os tesouros?</button>
              </div>
            </div>         

            <div class="row no-gutters">   
              <div class="col" id="tesouros">                  
                <tesouros-app user_id="{{ Auth::user()->id }}"></tesouros-app>
              </div>
            </div>

          </div>    
        </div>
      </div>
    </div>
	</div>

</div>

<script type="text/javascript">
   
    const progress_circle = new Vue({
     el: '#progress-circle',
     data:{
         progresso: progresso
     }
    });   

    const tesouros = new Vue({
     el: '#tesouros',
     data:{        
     }
    });

</script>       
   



@endsection
