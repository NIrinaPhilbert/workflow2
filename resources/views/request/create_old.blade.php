@extends('layouts.appnew')

@section('content')
<div id="mymaincontent">
    <h1>Envoie demande</h1>
    <form method="POST" action="/request">
        @method('PUT')
        @csrf   
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" id="_token" value="{{ csrf_token() }}">
    
        <div class="form-group">
            <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" 
            placeholder="Objet de la demande" value="{{ old('subject') }}">
            @error('subject')
                <div class="invalid-feedback">
                    {{ $errors->first('subject') }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <select class="custom-select @error('tool_id') is-invalid @enderror" id="tool_id" name="tool_id">
                <option value="" disabled selected>Selectionner l'outil concerné...</option>
                @foreach($tools as $tool)
                <option value="{{ $tool->id }}">{{ $tool->name }}</option>
                @endforeach
            </select>
            @error('tool_id')
            <div class="invalid-feedback">
                {{-- $errors->first('tool_id') --}}
                Veuillez remplir ce champ !
            </div>
            @enderror
        </div>
        <div class="form-group">
            <select class="custom-select @error('type_request_id') is-invalid @enderror" id="type_request_id" name="type_request_id">
                
                
            </select>
            @error('type_request_id')
            <div class="invalid-feedback">
                {{-- $errors->first('type_request_id') --}}
                Veuillez remplir ce champ !
            </div>
            @enderror

        </div> 
        <div class="form-group">
            <input type="text" class="form-control" id="entity_id" name="entity_id" placeholder="Entite destinataire" value="">
            <input type="text" class="form-control" id="entity_name" name="entity_name" placeholder="Entite destinataire" value="" readonly="true">
        </div>
        
        <div class="form-group">
            <textarea name="content" cols="70" rows="2" placeholder="Contenu de la demande"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer demande</button>
    </form>
</div>
<script>
    //$('#tool_id').change(function(){
$("#mymaincontent").delegate("#tool_id", 'change', function() {
    event.preventDefault();
  //alert(value);
  /*$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });*/
  var iToolId = jQuery("#tool_id").val() ;
  //alert('iToolId'+iToolId);
  //var _token = $('input[type="hidden"]').attr('value');
  var _token = $('input#_token').val();
  $.ajax({
    type:"POST",
    url: "showtyperequest",
    dataType:'json',
    data: {iToolId : iToolId , _token : _token },
    success: function(data){ 
        // format de data
        /*data = '[{"id":"1","ville":"paris"},{"id":"2","ville":"marseille"},
            {"id":"3","ville":"lille"},{"id":"4","ville":"metz"},
            {"id":"5","ville":"renne"}]';  */
        //var json2=JSON.parse(JSON.stringify(data));
        //alert(json2);
       
        var length = Object.keys(data).length;
        
        $("#type_request_id").html("");
        if(length > 0){
            $("#type_request_id").append('<option value="" disabled selected>Selectionner le type de la demande...</option>');
            $.each(data, function (key, value) {           
                $("#type_request_id").append('<option value="'+value.type_request_id+'">'+value.type_request_name+'</option>');
            });
        }else{
            $("#type_request_id").append('<option value="'+""+'">'+"Sans type de demande"+'</option>');
        }
   
    }
  })

});
//============================================================//

$("#mymaincontent").delegate("#type_request_id", 'change', function() {
  
  
  var iToolId = jQuery("#tool_id").val() ;
  var iTypeRequestId = $(this).val() ;
  
  
  var _token = $('input#_token').val();
  //alert('ici1');
  $.ajax({
    type:"POST",
    url: "getfirstentityvalidator",
    dataType:'html',
    data: {iToolId : iToolId , iTypeRequestId : iTypeRequestId , _token : _token },
    success: function(data){
        var tzEntity = data.split('_');

        $('#entity_id').val(tzEntity[0]);
        $('#entity_name').val(tzEntity[1]);

        /*$("#type_request_id").html("");
        if(length > 0){
            $.each(data, function (key, value) {           
                $("#type_request_id").append('<option value="'+value.type_request_id+'">'+value.type_request_name+'</option>');
            });
        }else{
            $("#type_request_id").append('<option value="'+""+'">'+"Sans type de demande"+'</option>');
        }*/
   
    }
  })

});
//===============================================================================//

</script>
@endsection
