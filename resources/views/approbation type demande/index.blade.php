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
      <th scope="col">Entreprise</th>
    </tr>
  </thead>
  <tbody>
    @foreach($clients as $client)
    <tr>
      <th scope="row">{{$client->id}}</th>
      <td><a href="/client/{{ $client->id }}">Demande mots de passe</a></td>
      <td>{{$client->status}}</td>
      <td>DHIS2 COVAX</td>
      <td>
       <div  class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary"><span class="badge badge-light">1</span> DEPSI </button>
        <button type="button" class="btn btn-info">></button> 
        <button type="button" class="btn btn-primary"><span class="badge badge-light">2 </span> DDDS </button>
        <button type="button" class="btn btn-info">></button> 
        <button type="button" class="btn btn-primary"><span class="badge badge-light">3 </span> DVSSER </button>
        <button type="button" class="btn btn-info">></button> 
      </div>
      <div  class="btn-group" role="group" aria-label="Basic example"></div>
        <div  class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-success"><span class="badge badge-light">4</span> DEPSI </button>
        <button type="button" class="btn btn-secondary">></button> 
        <button type="button" class="btn btn-success"><span class="badge badge-light">5</span> DDDS </button>
        <button type="button" class="btn btn-secondary">></button> 
        <button type="button" class="btn btn-success"><span class="badge badge-light">6</span> DVSSER </button>
        <button type="button" class="btn btn-success"><span class="badge badge-light">7</span> DEPSI </button>
        
       </div>
      </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
<div class="row d-flex justify-content-center">
    {{ $clients->links() }}
</div>


@endsection