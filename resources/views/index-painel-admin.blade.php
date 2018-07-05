<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Youcons - Painel de administração</title>
        <link rel='shortcut icon' type='image/x-icon' href='{{ asset('images/favicon.ico') }}' />
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="{{ mix('css/admin.css') }}" rel="stylesheet">
        <script src="{{ mix('js/app.js') }}"></script>
    </head>
    <body data-spy="scroll" data-target="#top-menu" id="admin">

        <header class="container-fluid sticky-top">             
            @include('structure/admin-header')                           
        </header>

        <main class="container-fluid no-gutter" id="admin-main">
            <div class="container">
                <div class="row">

                    <div class="col-md-6">
                        <h3 id="page-title">{{ $pageTitle }}</h3>
                    </div>

                    <div class="col-md-6 btn-group" role="group" aria-label="Alt menu" id="alt-menu">
                        <ul>                            
                            @section('alt_menu')
                            @show
                        </ul>
                    </div>

                </div>
                @yield('content')                
            </div>
        </main>

        <footer class="container-fluid no-gutter" id="contato"> @include('structure.footer') </footer>

        @include('structure/footer-script')
       
    </body>
</html>
