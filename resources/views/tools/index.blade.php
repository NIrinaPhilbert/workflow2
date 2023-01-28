
@section('scripts')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <!------script pour type demande -------------------->
<script type="text/javascript" src="{{ asset('js/assets_js/js/jquery.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/assets_js/js/jquery-ui.min.js') }}" defer></script>

@endsection
@extends('layouts.app')
@section('content')
@yield('scripts')
<h1>Liste des plateformes</h1>
<a href="" class="btn btn-primary my-3">Plateformes</a>
<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
<div class="row d-flex justify-content-center">
<table id="table_id" class="display table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom plateforme</th>
      <th scope="col">Description</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($tools as $tool)
    <tr>
      <th scope="row">{{$tool->id}}</th>
      <td>{{$tool->name}}</td>
      <td>{{$tool->description}}</td>
      <td><a href="">Modifier</a></td>
      <td><a href="">Supprimer</a></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
</div>
<div class="row d-flex justify-content-center">
    {{ $tools->links() }}
</div>
<script>
  $(document).ready(function () {
    $.noConflict();
    $('#table_id').DataTable();
  });
</script>

@endsection

