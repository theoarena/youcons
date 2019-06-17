<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">

         <a href="{{ route('home') }}" id="logo" class="navbar-brand"><img src="{{ asset('images/logo.jpg') }}" title="Youcons!"></a>

         <div id="submenu_header">
             <a href="{{ route('login') }}" id="login_header">área do cliente</a>|
             <span id="fone_header">Fone: (19) 9 9260-0645</span>
         </div>

          <button id="hamburg_toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburg_menu" aria-controls="hamburg_menu" aria-expanded="false" aria-label="Toggle mobile menu">
              <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="hamburg_menu">
            <ul class="nav justify-content-end navbar-collapse">                        
                <li class="nav-item"> <a class="nav-link active" href="#home">Home</a> </li>               
                @include('structure.guest-menu')               
            </ul>  
        </div>

    </nav>
</div>