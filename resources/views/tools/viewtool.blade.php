@extends('layouts.appnew')

@section('content')

<div id="mymaincontent">
        <p></p>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pb-4">
                    <!-- Main row -->
                    <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- TABLE: DATA -->
                        <?php foreach($requesttool as $req)  { ?>
                        <form method="POST" action="">
                            @method('POST')
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <p></p>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Détail Outil</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 mt-3 mb-3">
                                    <div class="table-responsive">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12 mx-auto pt-2">
                                                <table class="table table-bordered">
                                                    <tr class="item-tr">
                                                        <td><label>Nom outil</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td>{{$req->name}}</td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Description outil</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td>{{$req->description}}</td>
                                                    </tr>                 
                                                    <tr class="item-tr">
                                                        <td><label>Date création</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td>
                                                            <span>
                                                            <?php 
                                                                $zDateCreation = Helper::convertDateTimeToCurrentDate($req->created_at); 
                                                                echo $zDateCreation;
                                                            ?>    
                                                            </span>
                                                        </td>
                                                    </tr> 
                      
                                                </table>        
                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer bg-transparent border" id="section-footer">
                                    <div class="mt-2 mb-2 text-center">
                                        <a href="<?php echo url("tooldatatable");?>" class="btn btn-primary">RETOUR</a>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                        <?php } ?>
                        <!-- /.card -->
                    </div>
                </div>
                    <!-- /.row -->
            </section>
        </div><!--/. container-fluid -->       
</div>

<script type="text/javascript">
  $(document).ready( function () {
      $('#content').summernote({
          height: "300"
        })
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  

// =================fin sumernote===============================//
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
