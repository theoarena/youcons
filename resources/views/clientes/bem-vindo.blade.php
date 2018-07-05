@extends('index-painel-cliente-simulacao')

@section('content') 
  
   <div id="app-bemvindo">
    <app-bemvindo id="{{ Auth::user()->id }}"></app-bemvindo>     
   </div> 

<script type="text/javascript">
    
    const bemvindo_app = new Vue({
     el: '#app-bemvindo'
    });   

</script>

@endsection