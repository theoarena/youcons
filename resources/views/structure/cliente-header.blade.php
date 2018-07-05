<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">
         <a href="{{ route('home') }}" id="logo" class="navbar-brand"><img src="{{ asset('images/logo.jpg') }}" title="Youcons!"></a>     

         {{--  
        <div id="submenu_header" class="cliente">
          <span id="fone_header">Olá, {{ Auth::user()->name }}</span>             
          <a href="{{ route('logout') }}" id="login_header">Sair</a>
        </div>
          --}}

        <button id="hamburg_toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburg_menu" aria-controls="hamburg_menu" aria-expanded="false" aria-label="Toggle mobile menu">
              <span class="navbar-toggler-icon"></span>
        </button>       

    </nav>
</div>