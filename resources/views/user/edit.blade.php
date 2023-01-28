@extends('layouts.appnew')

@section('content')

<div id="mymaincontent">
        <p></p>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pb-4">
                    <!-- Main row -->
                    <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- TABLE: DATA -->
                        <form method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                            @method('POST')
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <p></p>
                            @if(Session::has('message'))
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
                                                    Session::get('message') }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edition utilisateur</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 mt-3 mb-3">
                                    <div class="table-responsive">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3 col-lg-3 col-xs-3"><!----div premier division---->
                                                    <div class="form-group">
                                                        
                                                        <img src="{{URL::to('/')}}/images/{{$user->image}}" class="img-thumbnail" width="100"/>
                                                        <input type="hidden" name="hidden_image" value="{{$user->image}}" />
                                                        <div id="divMenu">
                                                            <label class="text-left">Select Profile Image</label>
                                                            <input type="file" name="image"/>
                                                            
                                                        </div>
                                                    </div>

                                                </div><!-----fin div 1er division----->
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 mx-auto pt-2">
                                                    <!-- ERROR MESSAGES -->
                                                        <!-- new format -->
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Nom</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
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
                                                                <option value="{{ $entity->id }}" {{ $user->entity_id == $entity->id ? 'selected':''}}>{{ $entity->name }}</option>
                                                        

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
                                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
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
                                                            
                                                                
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="activated" id="useractiveyes" value="1" <?php if($user->activated == 1) echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="activated" id="useractiveno" value="0" <?php if($user->activated == 0) echo 'checked'?>>
                                                                    <label class="form-check-label" for="inlineRadio2">Non</label>
                                                                </div>
                                                            
                                                            
                                                        </div>
                                                        
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Administrateur</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="administrator" id="useraadminyes" value="1" <?php if($user->administrator == 1) echo 'checked'?>>
                                                                <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="administrator" id="useradminno" value="0" <?php if($user->administrator == 0) echo 'checked'?>>
                                                                <label class="form-check-label" for="inlineRadio2">Non</label>
                                                            </div>



                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Valideur</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="validator" id="uservalidyes" value="1" <?php if($user->validator == 1) echo 'checked'?>>
                                                                <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="validator" id="uservalidno" value="0" <?php if($user->validator == 0) echo 'checked'?>>
                                                                <label class="form-check-label" for="inlineRadio2">Non</label>
                                                            </div>

                                                        </div>
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Repondeur</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="answering" id="useransweryes" value="1" <?php if($user->answering == 1) echo 'checked'?>>
                                                                <label class="form-check-label" for="inlineRadio1">Oui</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="answering" id="useranswerno" value="0" <?php if($user->answering == 0) echo 'checked'?>>
                                                                <label class="form-check-label" for="inlineRadio2">Non</label>
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
                                        <button class="btn btn-primary" type="submit">ENREGISTRER MODIFICATION</button>
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
</div>
<script>

</script>
@endsection
