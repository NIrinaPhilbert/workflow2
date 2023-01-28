
@csrf   
{{ csrf_field() }}
<input type="hidden" name="_method" value="PUT">
<div class="form-group">
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
    placeholder="Entrer votre nom....." value="{{ old('name')  ?? $client->name}}">
    @error('name')
    <div class="invalid-feedback">
        {{-- $errors->first('lib_tool') --}}
        Veuillez remplir ce champ ! ou verifier si c'est déjà existant
    </div>
    @enderror

</div>
<div class="form-group">
    <select class="custom-select @error('status') is-invalid @enderror" name="status">
       @foreach($client->getStatusOptions() as $key => $value) 
        <option value="{{ $key }}" {{$client->status == $value ? 'selected' : ''}}>{{$value}}</option>
       @endforeach 
    </select>
    @error('status')
    <div class="invalid-feedback">
        {{-- $errors->first('lib_tool') --}}
        Veuillez remplir ce champ !
    </div>
    @enderror

</div>
<div class="form-group">
    <select class="custom-select @error('entreprise_id') is-invalid @enderror" name="entreprise_id">
        @foreach($entreprises as $entreprise)
        <option value="{{ $entreprise->id }}" {{ $client->entreprise_id == $entreprise->id ? 'selected':''}}>{{ $entreprise->name }}</option>
        @endforeach
    </select>
    @error('entreprise_id')
    <div class="invalid-feedback">
        {{-- $errors->first('lib_tool') --}}
        Veuillez remplir ce champ !
    </div>
    @enderror

</div> 
<div class="form-group">
    <div class="custom-file">
        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="validatedCustomFile" required>
        <label class="custom-file-label" for="validatedCustomFile">Choose une image</label>
        @error('image')
            <div class="invalid-feedback">{{$errors->first('image')}}</div>
        @enderror
    </diV>
</div>