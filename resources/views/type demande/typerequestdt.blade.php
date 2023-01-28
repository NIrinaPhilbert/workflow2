@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col">
           
           
          </div>
          <div class="col">
          
          </div>
          <div class="col">
         
          </div>
          <div class="col">
          
          </div>
          <div class="col">
          
          </div>
          <div class="col">
          <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("create_type_request_by_tool");?>" class="btn btn-primary">Créer type demande</a>
          </div>
          
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pb-4">
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
                      <th>ID</th>
                      <th>Type demande</th>
                      <th>Description</th>
                      <th>Outil concerné</th> 
                      
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $zTypeRequestNameInit = ""; 
                        foreach($typerequests as $typerequest){
                
                          //$dataid = $dataid.'data-id=\"'.$typerequest->ID.'\"';
                          //$zTyperequestsDatatable .= '["'.$typerequest->ID.'","'.$typerequest->tool_name.'","'.$typerequest->type_requestname.'","'.$typerequest->description.'","<button type=\"button\" class=\"btn btn-edit btn-info\"'.$dataid.'>Edit</button>  <button type=\"button\" class=\"btn btn-delete btn-danger\"'.$dataid.'>Delete</button>"],';
                        
                        
                      ?> 
                          
                      
                     
                      <tr class="item-tr">
                        <td>{{$typerequest->id}}</td>
                        <td>{{$typerequest->name}}</td>
                        <td>{{$typerequest->description}}</td>
                        <td>
                            <?php
                            $zTypeRequest = $typerequest->name;
                            foreach($ListTypeRequest as $typerequest2){
                              if(strcmp($typerequest2->type_requestname,$zTypeRequest) === 0) {
                                $idToolNameTypeRequest = $typerequest2->tool_id."_".$typerequest2->type_request_id;
                                echo "- ".$typerequest2->tool_name.' <a href="#" class="btn-deleteToolTypeReq" data-id="'. $idToolNameTypeRequest.'">[Supprimer]</a><br/>';
                              }
                            }
                            
                        
                            ?> 
                        </td>
                        
                        <td>
                          <a href="typerequest/view/{{ $typerequest->id }}"><i class="fas fa-eye text-primary"></i></a>
                          <a href="<?php echo url("edit_type_request/{$typerequest->id}"); ?>"><i class="fas fa-edit ml-1 text-secondary"></i></a>
                          <a href="#" class="btn-deleteTypeReq" data-id="{{ $typerequest->id }}"><i class="fas fa-trash ml-1 text-danger"></i></a>
                        </td>
                      </tr>
                      <?php 
                      
                         
                        } //end foreach
                      ?>
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
<!-- /.content-wrapper -->
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
  
    $('body').on('click', '.btn-deleteTypeReq', function(e) {
        //alert('ici');
        var param_request = $(this).attr("data-id");
        var urlnextpage = "<?php echo url("typerequestdatatable");?>";
        //var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sûr de supprimer ce type de demande ?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        type: "get",                        
                        url:"<?php echo url("type_request/delete");?>"+'/'+param_request,
                        context:document.body,
                        async:false,
                        success: function (data) {
                           //alert(data);
                            window.location = urlnextpage;
                            
                            },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    /*if(success){
                        window.open(urlnextpage)
                    }*/
            }
        })
    })

    $('body').on('click', '.btn-deleteToolTypeReq', function(e) {
        //alert('ici');
        var param_request = $(this).attr("data-id");
        var urlnextpage = "<?php echo url("typerequestdatatable");?>";
        //var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sûr de supprimer cet outil dans ce type de demande ?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        type: "get",                        
                        url:"<?php echo url("tool_type_request/delete");?>"+'/'+param_request,
                        context:document.body,
                        async:false,
                        success: function (data) {
                           //alert(data);
                            window.location = urlnextpage;
                            
                            },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    /*if(success){
                        window.open(urlnextpage)
                    }*/
            }
        })
    })
  </script>
@endsection

