<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Workflow SNIS MSANP</title>

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
    </head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                            <?php if(isset($_GET['error'])){?>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <p class="alert alert-class alert-danger">{{ $zMessageError }}</p>
                                    </div>
                                </div>
                            <?php } ?>
                            
            <div class="card">
                <div class="card-header">Reinitialisation password</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customlogin') }}">
                    @csrf
                        
                        <input type="hidden" name="token" value="{{ csrf_token() }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="<?php if(isset($_GET['mail'])) echo $_GET['mail'];?>" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password provisoire</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="passwordtemp">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Nouveau password</label>

                            <div class="col-md-6">
                                <input id="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" required autocomplete="newpassword">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password-confirm" required autocomplete="new-password-confirm">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    }); 
</script>
</body>
</html>
