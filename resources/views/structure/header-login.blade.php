<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark">

         <a href="{{ route('home') }}" id="logo" class="navbar-brand"><img src="{{ asset('images/logo.jpg') }}" title="Youcons!"></a>

         <div id="submenu_header">
             <span id="fone_header">Fone: (19) 9 1234 5678</span>             
         </div>

          <button id="hamburg_toggler" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#hamburg_menu" aria-controls="hamburg_menu" aria-expanded="false" aria-label="Toggle mobile menu">
              <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="hamburg_menu">
            <ul class="nav justify-content-end collapse navbar-collapse">                        
                <li class="nav-item"> <a class="nav-link active" href="{{ route('home') }}">Home</a> </li>
            </ul>  
        </div>

    </nav>
</div>