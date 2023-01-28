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
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/sweetalert2.css')}}">
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
    <script type="text/javascript" src="{{asset('assets_template/dist/js/sweetalert2.js')}}" defer></script>
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
    </script>
<!--------------------------------fin fichier javascript------------------------------------------>
</head>
<body class="hold-transition page-login">
<div id="login-page">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('css/img_template/loader.gif') }}" alt="MSANPsLTELogo" height="60" width="60">
  </div>
  <div class="login-box">
    <div class="card">
        <div class="card-header">Authentification </div>
            <div class="card-body login-card-body">
            
                <!-- /.login-logo -->
                <p class="login-box-msg mt-4"></p>
                <!-- ERROR MESSAGES -->
                
                    @error('email')
                    <div class="w-100 alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                        Mail ou mots de passe incorrect!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>

                        </button>
                    </div>

                    @enderror
                    @error('password')   
                    <div class="w-100 alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                        Mail ou mots de passe incorrect!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>

                        </button>
                    </div>

                    @enderror
                            
                   
                
                
                <!-- /ERROR MESSAGES -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"  name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Mot de passe" required autocomplete="current-password">
                        <div class="input-group-append">
                        <div class="input-group-text">
                            <a href="javascript:void(0)" class="fa fa-eye-slash" onClick="showpassword()" id="lshowpwd"></a>
                            
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Se souvenir de moi</label>
                        </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center mt-3 mb-3">
                        <button class="btn btn-block btn-primary" type="submit">Se connecter</button>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="social-auth-links text-center mt-3 mb-3">
                        <a class="btn btn-block btn-info" href="{{ route('password.request') }}">Mots de passe oublié ?</a>
                        </div>
                    @endif
                    <div class="social-auth-links text-center mt-3 mb-3">
                        <a class="btn btn-block btn-success" href="{{ route('register') }}">S'enregistrer</a>
                    </div>
                    <div class="social-auth-links text-center mt-3 mb-3">
                        <a class="btn btn-block btn-secondary btn-show-modal-comment">Envoyer commentaire</a>
                    </div>
                </form>
            </div>
        <!-- /.login-card-body -->
        </div>
  </div>
  <!-- /.login-box -->
  <!---------------------start enreg comment user------- --------------> 
  <div class="modal fade" id="modal-send-comment" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="sendCommentModal">Enregistrement de votre commentaire</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="labMail">Email address</label>
                                    <input type="email" class="form-control" id="txtmailvisitor" placeholder="saisir votre mail">
                                </div>
                                <div class="form-group">
                                    <label for="labComment">saisir votre commentaire</label>
                                    <textarea class="form-control" id="txtComment" rows="10"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-send-comment">Envoyer</button>
                            </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                </div>
            </div>
        <!-----------------end send comment user----------- -------------->
</div>
<script>
    $(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
    }); 
    $('body').on('click','.btn-show-modal-comment', function () {
        $('#modal-send-comment').modal('show');
        $('#txtmailvisitor').val('Saisir votre mail');
        $('#txtComment').val('Saisir votre commentaire');

    });
    
    $('body').on('click', '.btn-send-comment', function(e) {
        //alert('ici');
        var mailvisitor = $('#txtmailvisitor').val();
        var comment = $('#txtComment').val();
        //var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sur denvoyer ce commentaire ?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        data: {mailvisitor:mailvisitor,comment:comment},
                        type: "post",                        
                        url:"{{route('comment.save')}}",
                        context:document.body,
                        async:false,
                        success: function (data) {

                            //alert(data);
                            console.log(data);
                            //swal("Done!","It was saved!","success");
                            Swal.fire(
                            'Inserted!',
                            'Your comment has been sent.',
                            'success'
                            );
                            $('#modal-send-comment').modal('hide');
                            //return false;
                            //window.location = urlnextpage;
                            
                            },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    /*if(success){
                        window.open(urlnextpage)
                    }*/
            }
        })
    })
</script>


</body>
</html>