@extends('layouts.app')
@section('content')
<h1>Ajout Document</h1>
<form method="POST" action="/files"  enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
        placeholder="Entrer title....." value="{{ old('title') }}">
        @error('title')
        <div class="invalid-feedback">
            {{-- $errors->first('lib_tool') --}}
            Veuillez remplir ce champ ! ou verifier si c'est déjà existant
        </div>
        @enderror

    </div>
    <div class="form-group">
        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
        placeholder="Entrer descriptioon....." value="{{ old('description') }}">
        @error('description')
        <div class="invalid-feedback">
           
            Veuillez remplir ce champ ! ou verifier si c'est déjà existant
        </div>
        @enderror

    </div>
    
    <div class="form-group">    
            <input type="file" name="file">
    </div>
    <br>
    <button type="submit" class="btn btn-primary">AJouter Document</button>
        
</form>
@endsection