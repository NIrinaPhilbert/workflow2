
@extends('layouts.appnew')
@section('content')
<div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pb-4">
                    <!-- Main row -->
                    <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- TABLE: DATA -->
                        <form method="POST" action="{{ route('saveuser') }}" enctype="multipart/form-data">
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <p></p>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Création utilisateur</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 mt-3 mb-3">
                                    <div class="table-responsive">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12 mx-auto pt-2">
                                                    <!-- ERROR MESSAGES -->
                                                        <!-- new format -->
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Select Profile Image</label>
                                                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="">
                                                            @error('image')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Nom</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Entité</label>
                                                            <select class="form-control select2 @error('entity_id') is-invalid @enderror" name="entity_id">
                                                                <option value=""></option>
                                                                 @foreach($entities as $entity)
                                                                <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                                                        

                                                                @endforeach
                                                            </select>
                                                            @error('entity_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                            
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Email</label>
                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required autocomplete="email">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-envelope"></span>
                                                                </div>
                                                            </div>
                                                            @error('email')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Activé</label>
                                                            <div class="icheck-primary">
                                                                <input type="radio" id="activeNo" value="0" name="useractivation" checked>
                                                                <label for="activeNo">Non</label>
                                                            </div>
                                                            <div class="icheck-primary ml-3">
                                                                <input type="radio" id="activeYes" value="1" name="useractivation">
                                                                <label for="activeYes">Oui</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Administrateur</label>
                                                            <div class="icheck-primary">
                                                                <input type="radio" id="administratorNo" value="0" name="useradministrator" checked>
                                                                <label for="administratorNo">Non</label>
                                                            </div>
                                                            <div class="icheck-primary ml-3">
                                                                <input type="radio" id="administratorYes" value="1" name="useradministrator">
                                                                <label for="administratorYes">Oui</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Valideur</label>
                                                            <div class="icheck-primary">
                                                                <input type="radio" id="validatorNo" value="0" name="uservalidator" checked>
                                                                <label for="validatorNo">Non</label>
                                                            </div>
                                                            <div class="icheck-primary ml-3">
                                                                <input type="radio" id="validatorYes" value="1" name="uservalidator">
                                                                <label for="validatorYes">Oui</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Répondeur</label>
                                                            <div class="icheck-primary">
                                                                <input type="radio" id="answerNo" value="0" name="useranswering" checked="">
                                                                <label for="answerNo">Non</label>
                                                            </div>
                                                            <div class="icheck-primary ml-3">
                                                                <input type="radio" id="answerYes" value="1" name="useranswering">
                                                                <label for="answerYes">Oui</label>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Mot de passe</label>
                                                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <span class="fas fa-lock"></span>
                                                                </div>
                                                            </div>
                                                            @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Confirmer password</label>
                                                            <input  type="password" class="form-control" type="password" class="form-control" name="password_confirmation" value="">
                                                        </div>
                                                        <!-- new format -->
                                    
                                                        <!-- ERROR MESSAGES -->
                                                        
                                        
                                    
                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer bg-transparent border">
                                    <div class="mt-2 mb-2 text-center">
                                        <button type="submit" class="btn btn-primary">ENREGISTRER</button>
                                        <button class="ml-1 btn btn-secondary" type="reset">CANCEL</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>
                    <!-- /.row -->
            </section>
</div><!--/. container-fluid -->       

<script type="text/javascript">
  $(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  


</script>


@endsection