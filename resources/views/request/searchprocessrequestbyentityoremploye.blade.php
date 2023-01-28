@extends('layouts.appnew')
@section('content')
<style>
  #status fieldset
{width:100%;display:block;position:relative;zoom:1;border:1px solid#990000;padding:10px;-webkit-border-radius:5px;-moz-border-radius:5px;-ms-border-radius:5px;border-radius:5px;position:relative;min-height:100px;}
#status fieldset legend
{padding:5px 15px;color:#fff;position:absolute;top:-24px;}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="mymaincontent">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pb-4">
        <!-----------------row recherche----------------------->
        <div id="status"><fieldset><legend></legend>
        <div class="row">
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <label for="formGroupInputSmall">Type demand       e:</label>
                            <select class="form-control form-perso" id="typeRequestID">
                                <option value="0">Choisir</option>
                                <?php
                                foreach($ListTypeRequest as $oTypeRequest){
                                ?>
                                <option value="{{$oTypeRequest->id}}">{{$oTypeRequest->name}}</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">Outil:</label>
                            <select class="form-control form-perso" id="toolID">
                                <option value="0">Choisir</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">Entite niova:</label>
                            <select class="form-control form-perso" id="entityID">
                                <option value="0">Choisir</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">Employé</label>
                            <select class="form-control form-perso" id="employeID">
                                <option value="0">Choisir</option>
                            </select>
                            
                        </div>
                    </div>
            
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">Situation Traitement</label>
                            <select class="form-control form-perso" id="statusID">
                                <option value="0">Choisir</option>
                                <option value="1">En attente traitement</option>
                                <option value="1">En cours traitement</option>
                                <option value="3">Traité partiellement</option>
                                <option value="4">Traité</option>
                            </select>
                        </div> 
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">&nbsp;</label>
                            <div>
                            <a href="javascript:void(0)" onClick="return false;" class="btn btn-primary btn-showrequest">Valider</a>
                            </div>
                        </div> 
                    </div>
			    </div>
          </fieldset></div>
                <div class="row">
            
                    <div class="col-md-6 col-lg-6 col-xs-6">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">&nbsp;</label>
                            <div>
                             <button type="button" class="btn btn-outline-success">Nombre d'enregistrement trouvées:<span id="spnnbenreg"><?php echo $NumberRecordInit1; ?></span></button>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-4 col-lg-4 col-xs-4">
                        <div class="form-group form-group-sm">
                            <label for="formGroupInputSmall">&nbsp;</label>
                            <div>
                            
                            </div>
                        </div> 
                    </div>
			    </div>
        <!-----------------end row recherce-------------------->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- TABLE: DATA -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">All data</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table id="tblrequestsend" class="table table-bordered table-striped m-0">
                    <thead>
                    <tr>
                      
                      <th>#</th>
                      <th>Objetniova</th>
                      <th>Outils</th>
                      <th>Type demande</th>
                      <th>Status</th>
                      <th>Date et heure</th>
                      <th>Actions</th>
                      
                    </tr>
                    </thead>
                    <tbody id="idtbody">
                    <?php 
                    
                    foreach($lrequests as $requestwf){
                    ?>
                    <tr class="item-tr">
                        <td><a href="">{{$requestwf->ID}}</td>
                        <td>{{$requestwf->Objet}}</td>
                        <td>{{$requestwf->type_requestname}}</td>
                        <td>{{$requestwf->toolname}}</td>
                        <td>{{$requestwf->status}}</td>
                        <td>{{$requestwf->created_at}}</td>
                        <td><a href="<?php echo url("viewdetailrequest/{$requestwf->ID}");?>"><i class="fas fa-eye text-primary"></i></a>                      
                        </td>
                    </tr>
                    <?php } ?>
                      
                      
                    </tbody>
                  
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    $("#mymaincontent").delegate("#typeRequestID", 'change', function() {
  event.preventDefault();
  var itypeRequestID = jQuery("#typeRequestID").val() ;
  var _token = $('input#_token').val();
  $.ajax({
    type:"POST",
    url: "showtoolbytyperequest",
    dataType:'json',
    data: {itypeRequestID : itypeRequestID , _token : _token },
    success: function(data){ 
		console.log(data);
        var length = Object.keys(data).length;  
        $("#toolID").html("");
        if(length > 0){
            $("#toolID").append('<option value="0" selected>Selectionner l outil...</option>');
            $.each(data, function (key, value) {           
                $("#toolID").append('<option value="'+value.tool_id+'">'+value.tool_name+'</option>');
            });
        }else{
            $("#toolID").append('<option value="'+""+'">'+"Sans type de demande"+'</option>');
        }
   
    }
  })
});
$("#mymaincontent").delegate("#toolID", 'change', function() {

  event.preventDefault();
  var itypeRequestID = jQuery("#typeRequestID").val() ;
  var itoolID = jQuery("#toolID").val() ;
  var _token = $('input#_token').val();
  $.ajax({
    type:"POST",
    url: "showentitybytoolandtyperequestinprocess",
    dataType:'html',
    data: {itypeRequestID : itypeRequestID , itoolID : itoolID, _token : _token },
    success: function(data){ 
		//alert(data);
         
        $("#entityID").html("");
        $("#entityID").html(data);
   
    }
  })
});

$("#mymaincontent").delegate("#entityID", 'change', function() {

event.preventDefault();
var itypeRequestID = jQuery("#typeRequestID").val() ;
var itoolID = jQuery("#toolID").val() ;
var iEntityID = jQuery("#entityID").val();
var _token = $('input#_token').val();
$.ajax({
  type:"POST",
  url: "showuserbytoolandtyperequestinprocess",
  dataType:'html',
  data: {itypeRequestID : itypeRequestID , itoolID : itoolID , iEntityID : iEntityID, _token : _token },
  success: function(data){ 
  //alert(data);
       
      $("#employeID").html("");
      $("#employeID").html(data);
 
  }
})
});

$("#mymaincontent").delegate(".btn-showrequest", 'click', function() {
//alert('ok');

$('#tblrequestsend').dataTable({
            "bDestroy": true
        }).fnDestroy();
event.preventDefault();
var itypeRequestID = jQuery("#typeRequestID").val() ;
var itoolID = jQuery("#toolID").val() ;
var istatusID = jQuery("#statusID").val();
var iEntityID = jQuery("#entityID").val();
var iuserID = jQuery("#employeID").val();
var _token = $('input#_token').val();
$.ajax({
  type:"POST",
  url: "showListRequestByStatusProcess",
  dataType:'html',
  data: { istatusID : istatusID, iuserID : iuserID, iEntityID : iEntityID , _token : _token },
  success: function(data){
  //alert(data);
  //return false; 
  const tzData = data.split("_");
  alert(data);
      $("#spnnbenreg").html(tzData[0]);
      $("#idtbody").html("");
      $("#idtbody").html(tzData[1]);
      //==================================//
      $("#tblrequestsend").DataTable({

        "initComplete": function(settings, json) {
          var api = this.api();
          var numRows = api.rows( ).count();
          alert('ok');
          alert('ici'+numRows);
          // Place the value in your HTML using jQuery, etc
        },
        
      "responsive": true, "lengthChange": false, "autoWidth": false,
      
	  "ordering": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
	  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	  //"buttons": ["pageLength"],
	  //iDisplayLength: -1
	  iDisplayLength: 10
    }).buttons().container().appendTo('#tblrequestsend_wrapper .col-md-6:eq(0)');

    

    //alert(numRows);

 
  }
})
});


 </script>

@endsection

