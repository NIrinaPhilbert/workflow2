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
                       
                        <?php foreach($RequestProcessingbyid as $req)  { 
                            //$dataidconcat = $req->idrequest;
                            $idprocess = $req->idprocessings;
                            $idrequest = $req->idrequest;
                           
                        ?>

                        <form method="POST" action="" enctype="multipart/form-data">
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
                                                        <td><input type="hidden" id="txtEntityID" value="<?php echo Session::get('s_entityid_user');?>"></input><label>Entite source</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td><span><?php $userId = $req->usersourceid ;  $zEntite = App\User::getEntityNameByUserId($userId); echo $zEntite; ?></span></td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><input type="hidden" id="txtUrl" value="<?php echo url("processingrequest"); ?>"></input><label>Utilisateur source</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td><?php $zUserName = App\User::getNameUserbyId($userId); echo $zUserName; ?></td>
                                                    </tr>  
                    
                                                    <tr class="item-tr">
                                                        <td><label>Objet de la demande</label></td>
                                                    </tr>  
                                                    <tr class="item-tr">
                                                        <td><span>{{$req->Objetwf}}</span></td>
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
                                                        <td><span>
                                                          <?php  
                                                                $zLibEtatTraitement = Helper::getLibelleSituationTraitement($req->etat);
                                                                echo $zLibEtatTraitement;
                                                          ?></span></td>
                                                        
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Lettre de demande ou pièce jointe</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                 $target_request = public_path().'/docrequest/'.$idrequest.'/dossier_demande/';
                                                                  $files = scandir("$target_request");

                                                                 ?>
                                                                
                                                                <?php 
                                                                  foreach($files as $file) { 
                                                                  if (in_array($file, array(".",".."))) continue;
                                                                ?>
                                                                <p>
                                                                <?php echo $file; ?>
                                                                
                                                                <a href="{{asset('/docrequest/'.$idrequest.'/dossier_demande/'.$file)}}" target="_blank" alt="cliquer pour télécharger"> [Télécharger]</a>
                                                                </p>
                                                                <?php } ?>
                                                        </td>
                                                    </tr>     
                                                    <tr class="item-tr">
                                                        <td><label>Date création</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span>{{$req->created_at}}</span></td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Liste traitement</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                          <?php if($sizeRequestProcessAchevements > 0) {?>
                                                          <table class="table">
                                                              <thead>
                                                                  <tr>
                                                                  <th scope="col">id</th>
                                                                  <th scope="col">Date traitement</th>
                                                                  <th scope="col">Déscription</th>
                                                                  <th scope="col">Pièce jointes</th>
                                                                  
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                                  <?php foreach($RequestProcessAchievements as $rpa) { 
                                                                    $idprocessach = $rpa->idprocessachievements;
                                                                  ?>
                                                                  <tr>
                                                                      <td>{{$rpa->idprocessachievements}}</td>
                                                                      <td>{{$rpa->achievementdate}}</td>
                                                                      <td>{{$rpa->achievementcomment}}</td>
                                                                      <td>
                                                                        <!---------debut affichage fichier------------->
                                                                        <?php 
                                                                          $target_process = public_path().'/docrequest/'.$idrequest.'/dossier_traitement/'.$idprocessach.'/';
                                                                          if (!file_exists($target_process)){
                                                                              echo "Pas encore de traitement";
                                                                          }else
                                                                          {
                                                                          
                                                                          
                                                                              
                                                                              $files = scandir("$target_process");

                                                                              foreach($files as $file) { 
                                                                              if (in_array($file, array(".",".."))) continue;
                                                                          ?>
                                                                              <p>
                                                                                  <?php echo $file; ?>
                                                                
                                                                            <a href="{{asset('/docrequest/'.$idrequest.'/dossier_traitement/'.$idprocessach.'/'.$file)}}" target="_blank" alt="cliquer pour télécharger"> [Télécharger]</a>
                                                                            </p>
                                                                          <?php 
                                                                            } 

                                                                          }
                                                                          
                                                                          ?>
                                                                        <!---------fin affichage fichier--------------->
                                                                      </td>
                                                                      
                                                                  </tr>
                                                                  <?php } ?>
                                                                  
                                                              </tbody>
                                                              </table>
                                                              <?php } else { 
                                                                echo "pas encore de traitement";
                                                              }  ?>
                                                              
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
                                        <button type="button" class="btn btn-info btn-final-process" data-id="<?php echo $idprocess."_".$idrequest; ?>">MARQUER COMME TRAITE</button>
                                        <button type="button" class="btn btn-info btn-process" data-id="<?php echo $idprocess; ?>">AJOUTER TRAITEMENT</button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                        <?php// } ?>
                        <!-- /.card -->
                    </div>
                </div>
                    <!-- /.row -->
            </section>
        </div><!--/. container-fluid -->
        <!---------------------start enreg evolution traitement------- --------------> 
        <div class="modal fade" id="modal-process" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="entityCrudModal">Enregistrement processus traitement</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="reason_rejectionForm" name="reason_rejectionForm" class="form-horizontal" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="id" value="<?php echo $idprocess;?>">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Date traitement:</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" id="process_date" name="process_date" value="<?php 
                                            
                                            $mytime = Carbon\Carbon::now();
                                            echo $mytime->toDateTimeString();
                                            
                                            ?>" required="" size="10">
                                            @error('comment_process')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Situation traitement:</label>
                                        <div class="col-sm-12">
                                            <select class="custom-select @error('entity_id') is-invalid @enderror" name="process_status" id="process_status" required="">
                                                <option value="1" selected>traitement terminé</option>
                                                <option value="0">traitement en cours</option>
                                                
                                                
                                            </select>
                                            @error('entity_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                        
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Observation:</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" id="comment_process" name="comment_process" value="" required="">
                                            @error('comment_process')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!---------------------------------------------------->
                                    <!-- DropzoneJS -->
                                    <div class="input-group mb-3">
                                                            <label class="w-100">Lettre de demande ou autre pièce jointe</label>
                                                            <div id="actions" class="row w-100">
                                                                  <div class="col-lg-6">
                                                                    <div class="btn-group w-100">
                                                                      <span class="btn btn-sm btn-success col fileinput-button">
                                                                        <i class="fas fa-plus"></i>
                                                                        <span>Add</span>
                                                                      </span>
                                                                      <button type="button" class="btn btn-sm btn-primary col start">
                                                                        <i class="fas fa-upload"></i>
                                                                        <span>Start</span>
                                                                      </button>
                                                                      <button type="button" class="btn btn-sm btn-warning col cancel">
                                                                        <i class="fas fa-times-circle"></i>
                                                                        <span>Cancel</span>
                                                                      </button>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-lg-6 d-flex align-items-center mt-1">
                                                                    <div class="fileupload-process w-100">
                                                                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                            </div>
                                                                <div class="table table-striped files mt-2" id="previews">
                                                                  <div id="template" class="row mt-2" style="background: #f6f6f6; border: 1px solid #eee; border-radius: .2em;">
                                                                    <div class="col-12 d-flex" style="justify-content: right;">
                                                                      <div class="btn-group">
                                                                        <button data-dz-remove class="btn btn-md btn-link text-danger delete pt-1 pr-0 pb-0 pl-0" title="Remove">
                                                                          <i class="fas fa-times-circle"></i>
                                                                        </button>
                                                                      </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                                                    </div>
                                                                    <div class="col d-flex align-items-center">
                                                                        <p class="mb-2">
                                                                          <span class="lead" data-dz-name></span>
                                                                          (<span data-dz-size></span>)
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-12 d-flex align-items-center mt-1">
                                                                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto d-flex align-items-center mt-1 mb-1">
                                                                    <strong class="error text-danger text-sm" data-dz-errormessage></strong>
                                                                        <strong class="error text-success text-sm" data-dz-successmessage></strong>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                          </div>
                                                          <!-- DropzoneJS -->
                                    <!---------------------------------------------------->
                                    
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-save-process" id="btn-save-process" value="create" data-id="<?php echo $idprocess."_".$idrequest; ?>">Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                </div>
            </div>
        <!-----------------end enreg evolution traitement----------- -------------->  
        <?php } ?>   
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
  
    $('body').on('click', '.btn-save-process', function(e) {
        //alert('ici');
        //var param_request = $(this).attr("data-id");//idrequest
        var param_process = $(this).attr("data-id");//idprocess+idrequest
        var process_status = $("#process_status").val();
        var process_date = $("#process_date").val();
        var comment_process = $("#comment_process").val();
        var urlnextpage =$("#txtUrl").val();
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sur de valider ce demande?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
               
                    $.ajax({
                        data: {param_process:param_process,process_status:process_status,process_date:process_date,comment_process:comment_process},
                        type: "post",                        
                        url:"{{route('requestwf.process')}}",
                        context:document.body,
                        async:false,
                        success: function (data) {
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

    $('body').on('click','.btn-process', function () {
            $('#modal-process').modal('show');
    })
    $('body').on('click', '.btn-final-process', function(e) {
        //alert('ici');
        var param_process = $(this).attr("data-id");//idprocess+idrequest
        
        var process_status = 1;
        var process_date = $("#process_date").val();
        var comment_process = "Demande traité";
        var urlnextpage =$("#txtUrl").val();
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sur de marquer ce demande comme traité?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
               
                    $.ajax({
                        data: {param_process:param_process,process_status:process_status,process_date:process_date,comment_process:comment_process},
                        type: "post",                        
                        url:"{{route('requestwf.finalizerequest')}}",
                        context:document.body,
                        async:false,
                        success: function (data) {
                            window.location = urlnextpage;
                            
                            },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    /*if(success){
                        window.open(urlnextpage)
                    }*/
            }//fin if confirmed
        })
      })
    
    


        
  
  </script>
  <!-------------------------------------------------------->
  <!-- DropzoneJS -->
<script type="text/javascript">
  var listFilenames = []
  var url_lte = "/sendfileprocess";
  $(document).ready(function() {
    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: url_lte, // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews", // Define the container to display the previews
      clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response) {
        // console.log(file)
        listFilenames.push(file.name)
        updateState()
        $('.delete').hide()
        $('#section-footer').find('#btn-save').show()
      }
    })

    myDropzone.on("addedfile", function(file) { })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    })

    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1"
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function() {
       
      var added_files = myDropzone.getFilesWithStatus(Dropzone.ADDED)
      
      if (added_files.length > 0) {
        myDropzone.enqueueFiles(added_files)
        
        console.log(added_files) ;
        //return false ;
        
      }
      else
      {
        alert('veuillez mettre au moins un fichier') ;
        console.log('eo mijanona') ;
        //return false ;
      }
      
      //updateState() // Le div ayant id="div-state" n'existe pas
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true) ;
      
      if (listFilenames.length > 0) {
        cancelFiles(listFilenames);
      }
      $('.delete').show()
      $('#section-footer').find('#btn-save').hide()
    }
    // DropzoneJS Demo Code End
  })
  function updateState() {
    if (listFilenames.length == 0) {
      $('#div-state').removeClass('alert-success').addClass('alert-danger').find('.txt-state').html('<i class="fas fa-exclamation-triangle mr-2"></i>Please! Upload at least one file.')
    } else {
      $('#div-state').removeClass('alert-danger').addClass('alert-success').find('.txt-state').html('<i class="fas fa-check mr-2"></i>Files are uploaded and form can be submitted.')
    }
    $('#div-state').fadeIn(300)
  }
  function resetForm() {
    $("#actions .cancel").click()
    $('form#form-files')[0].reset()
  }
  function saveForm(_form, filenames, entityid) {
    console.log(filenames);
    var form = $(_form);
    urlnextpage = "<?php echo url('request')?>"+"/"+entityid;
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'ajax',
      method: 'put',
      url: "/request/save",
      data: form.serialize()+"&filenames="+filenames,
      //dataType: 'json',
      dataType: 'text',
      async: true,
      success: function(data){
        //alert(data);
        window.location.href = urlnextpage;
      }
    });

  }
  function cancelFiles(filenames) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'ajax',
      method: 'post',
      url: url_lte,
      data: { ext_action: "delete_files", filenames: filenames },
      dataType: 'json',
      async: true,
      success: function(data){
        listFilenames = []
        updateState()
      }
    });
  }
  function resetMessage() {
    $('#div-state').hide()
    $('#div-state').removeClass('alert-success').removeClass('alert-danger').find('.txt-state').html('')
  }
  $(document).on('submit', 'form#form-files', function(e) {
    e.preventDefault()
  })
  $(document).on('click', '#btn-save', function(e) {
    e.preventDefault()
    if (listFilenames.length > 0) saveForm($('form#form-files'), listFilenames, <?php $entite_user = Session::get('s_entityid_user'); echo $entite_user; ?>)
  })
  $(document).on('click', '#btn-reset', function(e) {
    e.preventDefault()
    resetForm()
    resetMessage()
  })
</script>
<!-- DropzoneJS -->

  <!-------------------------------------------------------->
@endsection
