@extends('layouts.app')
@section('content')

<h1>Type demande</h1>
<a href="" class="btn btn-primary my-3">Type demande</a>
<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
<div class="row d-flex justify-content-center">
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Nom</th>
      <th scope="col">Email</th>
      <th scope="col">Entité</th>
      <th scope="col">Activé</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td><img src="{{URL::to('/')}}images/{{$user->image}}" class="img-thumbnail" width="75"/></td>
      <td><a href="/user/edit/{{ $user->id }}">{{$user->name}}</a></td>
      <td>{{$user->email}}</td>
      <td>{{$user->entity->name}}</td>
      <td>{{$user->activated}}</td>
      <td><a href="">Modifier</a></td>
      <td><a href="">Supprimer</a></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
<div class="row d-flex justify-content-center">
    {{ $users->links() }}
</div>

@endsection