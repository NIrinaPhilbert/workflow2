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
@if(Session::has('success'))
  <script type="text/javascript">

  /*function massge() {
  Swal.fire(
            'Good job!',
            'Successfully Saved!',
            'success'
        );
  }

  window.onload = massge;*/
 </script>
@endif
    <div id="app">
            <main class="py-4 container">
            
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @if(Session::has('message'))
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
                                                    Session::get('message') }}<br/>{{Session::get('message1')}}</p>
                                    </div>
                                </div>
                            @endif
                            @if(Session::has('messagealert'))
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ 
                                                    Session::get('messagealert') }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="card">
                            
                                
                                <div class="card-header">Inscription système workflow</div>

                                <div class="card-body">
                                    <div class="alert alert-danger" id="divError" style="display:none;"></div>
                                    <form method="POST" class="needs-validation" novalidate id="verifyDocForm" action="{{ route('saveuserext') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Select profile image</label>

                                            <div class="col-md-6">
                                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" required ="image" autofocus>

                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="entity" class="col-md-4 col-form-label text-md-right">Entité tutelle</label>
                                            <div class="col-md-6">
                                                <select class="custom-select @error('entity_tut_id') is-invalid @enderror" name="entity_tut_id" id="entity_tut_id">
                                                    <option value="">--Sélectionner votre entité parent--</option>
                                                    @foreach($listentitetutelle as $enttut)
                                                    <option value="{{ $enttut->id }}">{{ $enttut->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('$enttut_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                
                                                </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="entity" class="col-md-4 col-form-label text-md-right">Type d'Entité</label>
                                            <div class="col-md-6">
                                                <select class="custom-select @error('entity_type_id') is-invalid @enderror" name="entity_type_id" id="entity_type_id">
                                                    <option value="">--Sélectionner votre type d'entité--</option>
                                                    @foreach($typeentity as $typeent)
                                                    <option value="{{ $typeent->id }}">{{ $typeent->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('entity_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                
                                                </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="entity" class="col-md-4 col-form-label text-md-right">Entité</label>
                                            <div class="col-md-6" id="divEntity">
                                                <select class="custom-select @error('entity_id') is-invalid @enderror" name="entity_id" id="entity_id">
                                                    <option value="">--Sélectionner votre entité--</option>
                                                   
                                                </select>
                                                @error('entity_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                
                                                </span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Fonction</label>

                                            <div class="col-md-6">
                                                <input id="function" type="text" class="form-control @error('function') is-invalid @enderror" name="function" value="{{ old('function') }}" required autocomplete="function" autofocus>

                                                @error('function')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div> 

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Telephone" class="col-md-4 col-form-label text-md-right">Téléphone</label>

                                            <div class="col-md-6">
                                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required ="tel">

                                                @error('tel')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary btnsavenewuser">
                                                    {{ __('Register') }}
                                                </button>
                                                <a href="<?php echo url("authenticateuser");?>" class="btn btn-success">Retour</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
    </div>
<script>
        jQuery(document).on('submit', 'form.needs-validation ', function (event) {
                                var form = jQuery("#verifyDocForm");
                                event.preventDefault();
                                Swal.fire({
                                    html: '<span class="text-lg">Etes vous sur d inscrire dans le système workflow ?</span>',
                                    icon: 'question',
                                    showCancelButton: true,
                                    confirmButtonText: 'Yes',
                                    cancelButtonText: 'No'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                })

        })


        $("#app").delegate("#entity_type_id", 'change', function() {
            event.preventDefault();
          
            var iTypeEntId = jQuery("#entity_type_id").val() ;
            var iEntityParentId = jQuery("#entity_tut_id").val();
            var _token = $('input#_token').val();
            $.ajax({
                type:"POST",
                url: "showentitybytypeentityandentityparent",
                dataType:'html',
                data: {iTypeEntId : iTypeEntId, iEntityParentId : iEntityParentId  , _token : _token },
                success: function(data){ 
                    
                    $("#entity_id").html("");
                    $("#entity_id").html(data);
            
                }
            })
        });
        $("#verifyDocForm").on('submit',function(){
            if(!testFormulaire()){
                $('#divError').slideDown() ;
                return false ;
            }
        });
        function testFormulaire()
        {
            //var bRetour         = true ;
            var zMessageErreur  = '' ;
            if($('#name').val() == '')
            {
                zMessageErreur += 'Le champ Nom est obligatoire' ;
            }
            if($('#entity_id').val() == '')
            {
                zMessageErreur += '<br/>Le champ Entité est obligatoire' ;
            }
            if($('#email').val() == '')
            {
                zMessageErreur += '<br/>Le champ Email est obligatoire' ;
            }
            if($('#email').val() != '' && !validateEmail($('#email').val()))
            {
                zMessageErreur += '<br/>L\'Email est invalide' ;
            }
            $('#divError').html(zMessageErreur) ;
            var bRetour = (zMessageErreur == '') ? true : false ; 
            return bRetour ;
        }
        function validateEmail(email_id) {
            const regex_pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            if (regex_pattern.test(email_id)) {
                console.log('The email address is valid');
                return true ;
            }
            else {
                console.log('The email address is not valid');
                return false ;
            }
        }

            //============================================================//
</script>   
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


