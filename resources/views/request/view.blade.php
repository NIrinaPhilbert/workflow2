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
                        <?php foreach($requestwf as $req)  { ?>
                        <form method="POST" action="">
                            @method('POST')
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <p></p>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Détail demande</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 mt-3 mb-3">
                                    <div class="table-responsive">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12 mx-auto pt-2">
                                                <table class="table table-bordered">
                                                    <tr class="item-tr">
                                                        <td><label>Entite source</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td><span><?php $userId = $req->userid;  $zEntite = App\User::getEntityNameByUserId($userId); echo $zEntite; ?></span></td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Utilisateur source</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td>{{$req->username}}</td>
                                                    </tr>  
                    
                                                    <tr class="item-tr">
                                                        <td><label>Objet de la demande</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td><span>{{$req->Objet}}</span></td>
                                                    </tr>    
                                                    <tr class="item-tr">
                                                        <td><label>Outil</label></td>
                                                        
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span>{{$req->toolname}}</span></td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Type demande</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span>{{$req->type_requestname}}</span></td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Description de la  Demande</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span><?php echo $req->content; ?></span></td>
                                                    </tr> 
                                                    <tr class="item-tr">
                                                        <td><label>Status  Demande</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span>{{$req->status}}</span></td>
                                                    </tr> 
                                                    <tr class="item-tr">
                                                        <td><label>Lettre de demande ou pièce jointe</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                                <?php 
                                                                    $target_request = public_path().'/docrequest/'.$req->ID.'/dossier_demande/';
                                                                    $files = scandir("$target_request");
                                                                    foreach($files as $file) { 
                                                                    if (in_array($file, array(".",".."))) continue;
                                                                ?>
                                                                <p>
                                                                <?php echo $file; ?>
                                                                
                                                                <a href="{{asset('/docrequest/'.$req->ID.'/dossier_demande/'.$file)}}" target="_blank" alt="cliquer pour télécharger"> [Télécharger]</a>
                                                                </p>
                                                                <?php } ?>
                                                        </td>
                                                    </tr>   
                                                  
                                                    


                                                    <tr class="item-tr">
                                                        <td><label>Date création</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span>{{ Helper::convertDateTimeToCurrentDate($req->created_at)}}</span></td>
                                                    </tr> 
                                                    <tr class="item-tr">
                                                        <td><label>Liste traitement demande</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <?php 
                                                        
                                                        if($iNombreTraitement > 0)
                                                        {
                                                        
                                                        ?>
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">Déscription</th>
                                                                    <th scope="col">Pièces jointes</th>
                                                                    
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach ($ListProcessAchievementByRequestID as $pa) { 
                                                                    
                                                                        $idprocessachievement = $pa->achievementid;
                                                                        $target_process = public_path().'/docrequest/'.$req->ID.'/dossier_traitement/'.$idprocessachievement.'/';

                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $pa->achievementdate; ?></td>
                                                                            <td><?php echo $pa->achievementcomment; ?></td>
                                                                            <td>
                                                                                <!--------------------------->
                                                                                
                                                                                        <?php
                                                                                   
                                                                                        if(file_exists($target_process)){
                                                                                            $files = scandir("$target_process");
                                                                                            foreach($files as $file) { 
                                                                                            if (in_array($file, array(".",".."))) continue;
                                                                                        
                                                                                    
                                                                                            ?>
                                                                                            <p>
                                                                                            <?php echo $file; ?>
                                                                                        
                                                                                            <a href="{{asset('/docrequest/'.$req->ID.'/dossier_traitement/'.$idprocessachievement.'/'.$file)}}" target="_blank" alt="cliquer pour télécharger"> [Télécharger]</a>
                                                                                            </p>
                                                                                            <?php 
                                                                                        
                                                                                            } 
                                                                                        }
                                                                                        else{
                                                                                            echo "Auccun pièce jointe";
                                                                                        }
                                                                                        ?>
                                                            
                                                                                <!--------------------------->
                                                                            </td>
                                                                        </tr>
                                                                    <?php } // fin existence dossier ?>
                                                                </tbody>
                                                                </table>
                                                        <?php } // fin existence dossier
                                                            else
                                                            {
                                                                echo "Pas encore de traitement";  
                                                            }
                                                        ?>
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
                                        <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("request/{$vSessionEntityUser}");?>" class="btn btn-primary">RETOUR</a>
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