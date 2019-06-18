<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120911883-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-120911883-1');
        </script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Youcons</title>
        <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/favicon.ico') }}' />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">          
        <script src="{{ mix('js/app.js') }}"></script>         

    </head>
    <body data-spy="scroll" data-target="#top-menu" id="{{ str_replace('.', '-', Route::currentRouteName())  }}">

        <header class="container-fluid sticky-top">
            @section('header')
                @include('structure/header-landing')
            @show
        </header>

        @section('banner')
        @show
      
        <main class="container-fluid" id="main1">
            @yield('content1')
        </main>

         <main class="container-fluid" id="main2">
            @yield('content2')
        </main>

        <footer class="container-fluid no-gutter" id="contato"> @include('structure.footer') </footer>


	<div class="modal fade" id="videolanding" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">O que é "Consórcio"?</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
        <div class="container">
            <div class="row">
                <div class="col">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/bqyJvMgdT8w" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>

     </div>
   </div>
 </div>
</div>

        @include('structure/footer-script')

    </body>
</html>
