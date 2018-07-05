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
                @include('structure/header')                
            @show
        </header>

        @section('banner')
        @show
      
        <main class="container-fluid no-gutter" id="sobre">
            @yield('content')
        </main>

        <footer class="container-fluid no-gutter" id="contato"> @include('structure.footer') </footer>

        @include('structure/footer-script')
        @include('structure/modal-banner')        
       
    </body>
</html>
