@extends('layouts.app')
@section('content')
<h1>{{ $client->name }}</h1>
<a href="/client/{{$client ->id}}/edit" class="btn btn-primary my-3">Editer</a>
<form action="/client/{{ $client->id }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Supprimer</button>
</form>
<hr>
<p><strong>Status:</strong>{{$client->status}}</p>
<p><strong>Entreprise:</strong>{{$client->entreprise->name}}</p>
@if($client->image)
    <img src="{{asset('storage/'.$client->image)}}" alt="client-avatar" class="img-thumbmail" width="200">
@endif
@endsection