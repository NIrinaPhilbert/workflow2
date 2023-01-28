<form method="POST" action="/tool">
    @method('PUT')
    @csrf   
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">

    <div class="form-group">
        <input type="text" class="form-control @error('lib_tool') is-invalid @enderror" name="lib_tool">
        @error('lib_tool')
        <div class="invalid-feedback">
            {{-- $errors->first('lib_tool') --}}
            Veuillez remplir ce champ !
        </div>
        @enderror

    </div>
    
    <br>
   
    @can('create', App\Tool::class)
    <button type="submit" class="btn btn-primary">AJouter outil</button>
    @endcan
    
</form>