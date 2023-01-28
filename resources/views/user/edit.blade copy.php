@extends('layouts.appnew')

@section('content')

  <style type="text/css">
    .move-left {
    width: auto;
    box-shadow: none;
      }
      .pers {

        margin-top: 10px;
  margin-left: 2px;
   
      }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edition Utilisateur</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',$user->id) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="entity" class="col-md-4 col-form-label text-md-right">Entité</label>
                            <div class="col-md-6">
                            <select class="custom-select @error('entity_id') is-invalid @enderror" name="entity_id">
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

                        </div> 

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Activé</label>
                            <div class="col-md-6">
                                <input id="status" class="form-check-input pers" type="checkbox" name="activated" value="{{ $user->activated }}" {{ $user->activated == 1 ? 'checked':''}}>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Administrateur</label>
                            <div class="col-md-6">
                                <input id="administrator" class="form-check-input pers" type="checkbox" name="administrator" value="{{ $user->administrator }}" id="gridCheck2" {{ $user->administrator == 1 ? 'checked':''}}>
                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Repondeur</label>
                            <div class="col-md-6">
                                <input id="answering" class="form-check-input pers" type="checkbox" name="answering[]" value="{{ $user->answering }}" id="gridChec3k" {{ $user->answering == 1 ? 'checked':''}}>
                                
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer Modification
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
