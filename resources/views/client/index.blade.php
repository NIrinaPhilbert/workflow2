@extends('layouts.app')
@section('content')
<h1>Client</h1>
<a href="/client/create" class="btn btn-primary my-3">Nouveau client</a>

<hr>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Status</th>
      <th scope="col">Entreprise</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($clients as $client)
    <tr>
      <th scope="row">{{$client->id}}</th>
      <td><a href="/client/{{ $client->id }}">{{$client->name}}</a></td>
      <td>{{$client->status }}</td>
      <td>{{$client->entreprise->name}}</td>
      <td></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
<div class="row d-flex justify-content-center">
    {{ $clients->links() }}
</div>


@endsection