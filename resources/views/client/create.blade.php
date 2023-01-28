@extends('layouts.app')
@section('content')
<h1>Créer un nouveau Client</h1>
<form method="POST" action="/client" enctype="multipart/form-data">
    @method('PUT')
    @include('includes.form')
<br>
<button type="submit" class="btn btn-primary">AJouter Client</button>
    
</form>
@endsection