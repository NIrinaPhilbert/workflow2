@extends('layouts.app')
@section('content')

<h1>Liste des entités</h1>
<a href="" class="btn btn-primary my-3">Entité</a>
<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
<div class="row d-flex justify-content-center">
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom entité</th>
      <th scope="col">Entité tutelle</th>
      <th scope="col">Description</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($entities as $entite)
    <tr>
      <th scope="row">{{$entite->id}}</th>
      <td>{{$entite->name}}</td>
      <td><?php if($entite->entity_id == 0 ) echo ""; else echo $entite->entity->name; ?></td>
      <td>{{$entite->description}}</td>
      <td><a href="">Modifier</a></td>
      <td><a href="">Supprimer</a></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
<div class="row d-flex justify-content-center">
    {{ $entities->links() }}
</div>

@endsection