<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Authentification | MSANPsLTE</title>

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('css/css_template/all_templ.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/css_template/OverlayScrollbars_templ.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/css_template/adminlte_templ.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/css_template/icheck-bootstrap_templ.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/css_template/auth-style_templ.css') }}">
  <!---------------------------------Fichier javascript----------------------------------------------->
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    
    <script type="text/javascript" src="{{ asset('js/js_template/jquery_templ.min.js') }}" defer></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="{{ asset('js/js_template/bootstrap_templ.bundle.min.js') }}" defer></script>
    <!-- overlayScrollbars -->
    <script type="text/javascript" src="{{ asset('js/js_template/jquery_templ.overlayScrollbars.min.js') }}" defer></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{ asset('js/js_template/adminlte_templ.js') }}" defer></script>
    <script>
        function showpassword(){
            //alert('ici');
            var x = document.getElementById("password");
            var lclass = $("#lshowpwd").attr('class');
            if(x.type == "password"){
                x.type = "text";

            }else{
                x.type = "password";
            }
            $("#lshowpwd").removeClass("fa fa-eye-slash");
            $("#lshowpwd").addClass("fa fa-eye");
            
            if (lclass == "fa fa-eye-slash"){
                $("#lshowpwd").removeClass("fa fa-eye-slash");
                $("#lshowpwd").addClass("fa fa-eye");
            }else{
                $("#lshowpwd").removeClass("fa fa-eye");
                $("#lshowpwd").addClass("fa fa-eye-slash");
            }

            //document.getElementById("").attr(class="fa fa-eye-slash")
        }

        var $f = function($) { return $*$; };
        
        
        
        //var jQueryss = 2;
        var testvar = 3;
        console.log( $f(testvar));
        //==================================//
        // An inline version (immediately invoked)
        console.log( (function($) { return $*$; })(testvar) );
    </script>
<!--------------------------------fin fichier javascript------------------------------------------>
</head>
<body class="hold-transition page-login">
<h1>Bonjour</h1>



</body>
</html>