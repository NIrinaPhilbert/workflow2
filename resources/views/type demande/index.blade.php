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
      <th scope="col">Désignation type demande</th>
      <th scope="col">Description</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($type_requests as $type_request)
    <tr>
      <th scope="row">{{$type_request->id}}</th>
      <td><a href="/type_demande/edit/{{ $type_request->id }}">{{$type_request->name}}</a></td>
      <td>{{$type_request->description}}</td>
      <td><a href="">Modifier</a></td>
      <td><a href="">Supprimer</a></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
<div class="row d-flex justify-content-center">
    {{ $type_requests->links() }}
</div>

@endsection