<!doctype html>
<html lang="{{ app()->getLocale() }}">
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
        <link href="{{ mix('css/cliente.css') }}" rel="stylesheet">
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body data-spy="scroll" data-target="#top-menu" id="admin">

        <header class="container-fluid sticky-top">             
            @include('structure/cliente-header')   
        </header>

        <main class="container-fluid no-gutter" id="admin-main">
            <div class="container">                
                <div class="row">

                    <div class="col-md-3 bg-metal" id="cliente-sidebar">                        
                        @include('structure/cliente-sidebar')                            
                    </div>

                    <div class="col-md-9" >

                        <div class="container" id="cliente-content" >                
                            <div class="row bg-blue" id="content-header">
                                <div class="col">
                                    <h3 id="page-sub">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col" id="alt-menu">
                                    <div class="btn-group" role="group" aria-label="Basic example"> 
                                        @section('alt_menu')
                                        @show                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="content-clientes">
                                <div class="col">@yield('content') </div>
                            </div>
                        </div>  
                    </div>

                </div>
                              
            </div>
        </main>

        <footer class="container-fluid no-gutter" id="contato"> @include('structure.footer') </footer>

        @include('structure/footer-script')
        @include('modal/ovos-de-ouro')
        @include('modal/indicar-amigos')
    
       
    </body>
</html>
