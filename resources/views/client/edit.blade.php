@extends('layouts.app')
@section('content')
<h1>Editer le profil de {{ $client->name }}</h1>
<form method="POST" action="{{ route('client.update',$client->id) }}" enctype="multipart/form-data">
   {{ csrf_field() }}
   {{ method_field('patch') }}
    @include('includes.form')
<br>
<button type="submit" class="btn btn-primary">Sauvegarder les informations</button>
    
</form>
@endsection