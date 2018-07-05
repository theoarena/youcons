<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
         <a href="{{ route('home') }}" id="logo" class="navbar-brand"><img src="{{ asset('images/logo.jpg') }}" title="Youcons!"></a>     

         {{--  
        <div id="submenu_header" class="cliente">
          <span id="fone_header">Olá, {{ Auth::user()->name }}</span>             
          <a href="{{ route('logout') }}" id="login_header">Sair</a>
        </div>
          --}}

        <div class="collapse navbar-collapse" id="hamburg_menu">
            <ul class="nav justify-content-end collapse navbar-collapse"> 
              @include('structure.cliente-simulacao-menu')
            </ul>  
        </div>  

    </nav>
</div>