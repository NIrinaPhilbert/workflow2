@extends('layouts.app')
@section('content')
<h1>Document</h1>
<a href="" class="btn btn-primary my-3">Document</a>
<button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
<hr>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">View</th>
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody>
  @foreach($documents as $key =>$data)
    <tr>
      <th scope="row">{{$data->id}}</th>
      <td>{{$data->title}}</td>
      <td>{{$data->description}}</td>
      <td><a href="/files/{{$data->id}}">View</a></td>
      <td><a href="/files/download/{{$data->file}}">Download</a></td>
    </tr>
    @endforeach
    
  </tbody>
</table>
<div class="row d-flex justify-content-center">
    
</div>
<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <h5 class="modal-title" id="Modal-simple-demo-label">Add New Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
 
                    <span aria-hidden="true">&times;</span>
 
                </button>
                
            </div>
            
            <div class="modal-body">
                <span id="form_result"></span>
                <form method="POST"  enctype="multipart/form-data" id="sample_form" class="form-horizontal">
                    @csrf
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                        id="title" placeholder="Entrer title....." value="{{ old('title') }}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{-- $errors->first('lib_tool') --}}
                            Veuillez remplir ce champ ! ou verifier si c'est déjà existant
                        </div>
                        @enderror

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                        id="description" placeholder="Entrer descriptioon....." value="{{ old('description') }}">
                        @error('description')
                        <div class="invalid-feedback">
                        
                            Veuillez remplir ce champ ! ou verifier si c'est déjà existant
                        </div>
                        @enderror

                    </div>
                    
                    <div class="form-group">    
                            <input type="file" name="file" id="file">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="hidden_id" id="hidden_id"/>
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add"/>
                    </div>                                          
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
