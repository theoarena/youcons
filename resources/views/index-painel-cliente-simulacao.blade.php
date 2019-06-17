<!doctype html>
<html lang="{{ app()->getLocale() }}" id="app-fullscreen">
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120911883-3"></script>
         <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-120911883-3');
        </script> 
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Youcons - Área de clientes</title>
        <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/favicon.ico') }}' />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        {{--<link href="{{ mix('css/cliente.css') }}" rel="stylesheet">--}}
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body data-spy="scroll" data-target="#top-menu" id="admin">

        <header class="container-fluid sticky-top">             
            @include('structure/cliente-header-simulacao')   
        </header>

        <main class="container-fluid no-gutter" id="cliente-app">
            @yield('content')            
        </main>      

        @include('structure/footer-script')
       
    </body>
</html>
