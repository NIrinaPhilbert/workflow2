<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="{{ asset('js/search.js') }}" defer></script>
    <script src="{{ asset('js/function.js') }}" defer></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!------script pour type demande -------------------->
    <script type="text/javascript" src="{{ asset('js/assets_js/js/jquery.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/jquery-ui.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/all.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/popper.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/bootstrap.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/sweetalert2.js') }}" defer></script>
    <!------fin script pour type demande------------------>
    <!--------------------js pour datatable--------------------------->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  
    <!--------------------fin js pour datatable------------------------>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Styles -->
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">-->

    <!-----------style css pour type demande ------------------>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-----------fin style css pour type demande--------------->
    <!--------------css pour datatable------------------------->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!--------------fin css datatable-------------------------->
    <script>
$('#create_record').click(function(){
        $('#formModal').modal('show');
        alert('ici');

    });
    $('#sample_form').on('submit',function(event){
        event.preventDefault();
        if($('#action').val() == 'Add'){
            $.ajax({
                url:"filesajax",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                dataType:"json",
                success:function(data){
                    var html = '';
                    if(data.errors)
                    {
                        html ='<div class="alert alert-danger">';
                        for(var count = 0 ; count < data.errors.lenght; count++)
                        {
                            html += '<p>'+data.errours[count] + '</p>';
                        }
                        html += '</div>';

                    }
                    if(data.success){
                        alert(data);
                        html ='<div class="alert alert-success">' 
                        + data.success + '</div>';
                        $('#sample_form')[0].reset();
                    }
                    $('#form_result').html(html);

                }
            });
        }


    });
</script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link"   href="/toolsajax">Tools ajax</a>
                        </li>
                    
                        <li class="nav-item">
                            <a class="nav-link"   href="/user">Utilisateur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/request">Demande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/entity">Entité</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tool">Outil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/client">Client</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/type_demande">Type demande</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/approbation_type_demande">validation type demande</a>
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Se connecter') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @if(session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('message_info') }}
            </div>
            @endif
            @yield('content')
        </main>
    </div>
    
   
</body>
</html>
