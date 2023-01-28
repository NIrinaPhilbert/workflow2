@extends('layouts.appnew')

@section('content')
<style>
    /*
    .overlaytest{
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(200,200,200,0.8) center no-repeat;
    }*/
</style>
<div id="mymaincontent">
        <!--using autre loading--->
        <!----<div class="content-wrapper overlaytest">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div id="imgSpinner1" class="d-flex align-items-center">
                            <strong>Loading...</strong>
                            <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>-->
        <!---end using loading----->
        <p></p>
        
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!--<div id="cover"> <span class="glyphicon glyphicon-refresh w3-spin preloader-Icon"></span>Please Wait, Loading…</div>
            <h1>Dom Loaded</h1>-->
            <!-- Main content -->
            <section class="content">
                <div class="modal"><!-- Place at bottom of page --></div>

                <div class="container-fluid pb-4">
                    <!-- Main row -->
                    <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- TABLE: DATA -->
                       
                        <?php foreach($RequestPendingbyid as $req)  { 
                        $dataidconcat = $req->idrequesthistories.'_'.$req->idrequest.'_'.$req->idtool.'_'.$req->idtyperequest;
                           
                        ?>

                        <form method="POST" action="">
                            @method('POST')
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="txtdataid" value="<?php echo $dataidconcat; ?>">
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
                                                        <td><span><?php $userId = $req->owner_user_id;  $zEntite = App\User::getEntityNameByUserId($userId); echo $zEntite; ?></span></td>
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><input type="hidden" id="txtUrl" value="<?php echo url("pendingrequest/"); ?>"></input><label>Utilisateur source</label></td>
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
                                                        <td><span><?php  $zProcessValidation = Helper::getLibelleSituationProcessusValidation($req->etat); echo $zProcessValidation;?></span></td>
                                                        
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><label>Lettre de demande ou pièce jointe</label></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <?php 
                                                                if(file_exists(public_path().'/docrequest/'.$req->idrequest.'/dossier_demande/')){
                                                                    $target_request = public_path().'/docrequest/'.$req->idrequest.'/dossier_demande/';
                                                                    $files = scandir($target_request);

                                                                    ?>
                                                                    
                                                                    <?php 
                                                                    foreach($files as $file) { 
                                                                    if (in_array($file, array(".",".."))) continue;
                                                                    ?>
                                                                    <p>
                                                                    <?php echo $file; ?>
                                                                    
                                                                    <a href="{{asset('/docrequest/'.$req->idrequest.'/dossier_demande/'.$file)}}" target="_blank" alt="cliquer pour télécharger"> [Télécharger]</a>
                                                                    </p>
                                                                    <?php } ?>
                                                                    <?php } else { echo "Pas de pièce jointe";}?>
                                                        </td>
                                                    </tr>       
                                                    <tr class="item-tr">
                                                        <td><label>Date création</label></td>
                                                    
                                                    </tr>
                                                    <tr class="item-tr">
                                                        <td><span>{{ Helper::convertDateTimeToCurrentDate($req->created_at)}}</span></td>
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
                                        <button type="button" class="btn btn-danger btn-refused" data-id="<?php echo $dataidconcat; ?>">REFUSER</button>
                
                                        <button type="button" class="btn btn-edit btn-info btn-active2" data-id="<?php echo $dataidconcat; ?>">VALIDER</button>
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
        <!---------------------start enreg motif rejet------- --------------> 
        <div class="modal fade" id="modal-motif-refusal" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="entityCrudModal">Enregistrement motif rejet</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="reason_rejectionForm" name="reason_rejectionForm" class="form-horizontal">
                                <input type="hidden" name="id" id="id">
                        
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Motif rejet demande:</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" id="rejection_reason" name="rejection_reason" value="" required="">
                                            @error('rejection_reason')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-save-rejection" id="btn-save-rejection" value="create" data-id="<?php echo $dataidconcat; ?>">Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                </div>
            </div>
        <!-----------------end motif rejet----------- -------------->
        
        <!---------------------start enreg motif validation pour traitement------- --------------> 
        <div class="modal fade" id="modal-valid-final" aria-hidden="true">
                <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="entityCrudModal">Validation final pour processus traitement</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="reason_rejectionForm" name="reason_rejectionForm" class="form-horizontal">
                                    <input type="hidden" name="id" id="id">
                                   
                                    
                                        <div class="form-group">
                                                <label class="col-sm-6 control-label">Entité concerné:</label>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-2">
                                                    <select class="form-control form-control-sm select2" name="entity_list[]" multiple="multiple" data-placeholder="Select entite" id="id_entity_list"></select>
                                            
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-6 control-label">Employees:</label>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="input-group mb-3" id="employees"></div>
                                            </div>
                                        </div>
                        
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Observation:</label>
                                        <div class="col-sm-12">
                                            <input class="form-control" id="comment_approv" name="comment_approv" value="" required="">
                                            @error('rejection_reason')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-body p-4" style="background-color: #f6f6f6; white-space: pre; display:none" id="output-data"></div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-primary btn-save-final-approuv" id="btn-save-final-approuv" value="create" data-id="<?php echo $dataidconcat; ?>">Enregistrer
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                
                            </div>
                        </div>
                </div>
            </div>
        <!-----------------end motif rejet----------- -------------->
</div>

<script type="text/javascript">

  $(document).ready( function () {
        /*$(window).on('load', function () {
            $("#cover").fadeOut(1000);
        });*/

      $('#content').summernote({
          height: "300"
        })
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  /*
    $(document).on({
        ajaxStart: function(){
            $('.overlaytest').show() ;
        },
        ajaxStop: function(){ 
            $('.overlaytest').hide() ;
        }    
    });
    */
    $('body').on('click', '.btn-active2', function(e) {

        /*$.blockUI({message: 'Please wait',
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff',
                        }});*/
       
        var param_request = $(this).attr("data-id");
        var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        
                
        $.ajax({
            type: "get",                        
            url:"<?php echo url("request/checkmaxrank/");?>"+'/'+param_request,
            context:document.body,
            async:false,
            
            success: function (data) {
                //alert(data);
                if(data=="0")
                {
                    Swal.fire({
                        html: '<span class="text-lg">Etes vous sur de valider ce demande?</span>',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            
                                $.ajax({
                                    type: "get",                        
                                    
                                    url:"<?php echo url("request/valid/");?>"+'/'+param_request,
                                    context:document.body,
                                    async:false,
                                    success: function (data) {
                                        window.location = urlnextpage;
                                        
                                        },
                                    error: function (data) {
                                        console.log('Error:', data);
                                    },
                                    beforeSend: function() {
                                        //setTimeout($.unblockUI, 1500);
                                        
                                        
                                        
                                    },
                                    complete: function() {
                                        //alert('complete');
                                        //$("#imgSpinner1").hide();
                                        //$('.overlaytest').hide() ;
                                    }

                                });
                                
                        }
                    })

                }
                if(data=="1")
                {
                    $('#modal-valid-final').modal('show');
                }
                //window.location = urlnextpage;
                
                },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        /*if(success){
            window.open(urlnextpage)
        }*/
            
    })
    $('body').on('click', '.btn-save-rejection', function(e) {
        //alert('ici');
        var param_request = $(this).attr("data-id");
        var reason_reject = $('#rejection_reason').val();
        var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sur de refuser ce demande?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        data: {param_request:param_request,reason_reject:reason_reject},
                        type: "post",                        
                        url:"{{route('requestwf.reject')}}",
                        context:document.body,
                        async:false,
                        success: function (data) {
                            //alert(data);
                            console.log(data);
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
    $('body').on('click', '.btn-save-final-approuv', function(e) {

         //===========================================================//
        
		var data_entity_list = $('[name="entity_list[]"]').val()
		var data_outpout = []
		for (var i = 0; i < data_entity_list.length; i++) {
		
			$('[name="employees['+data_entity_list[i]+']"]:checked').each(function() {
				data_outpout.push({ent: data_entity_list[i], emp: $(this).val()})
			})
		}
		$('#output-data').text(JSON.stringify(data_outpout, null, "\t"))

        //===========================================================//
       
        var param_request = $(this).attr("data-id");
        var approv_comment = $('#comment_approv').val();
        var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        var entityidwithuserid = $('#output-data').text();
        //alert('entityidwithuserid='+entityidwithuserid);
        
        
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sur de valider ce demande pour le traitement?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        data: {param_request:param_request,approv_comment:approv_comment, entityidwithuserid:entityidwithuserid},
                        type: "post",                        
                        url:"{{route('requestwf.validforprocessing')}}",
                        context:document.body,
                        async:false,
                        success: function (data) {
                            //alert(data);
                            console.log(data);
                            window.location = urlnextpage;
                            
                            },
                        error: function (data) {
                            console.log('Error:', data);
                        },
                        beforeSend: function() {
                            //$('.swal2-question').html('<img src="https://cssauthor.com/wp-content/uploads/2018/06/Bouncy-Preloader.gif"/>') ;
                            //setTimeout($.unblockUI, 500);
                            //alert('ici');
                            //$(".swal2-loader").show();
                        },
                        complete: function() {
                            //alert('ok');
                            //$("#imgSpinner1").hide();
                        }
                    });
                    /*if(success){
                        window.open(urlnextpage)
                    }*/
            }
        })
    })
    $('body').on('click','.btn-refused', function () {
        $('#modal-motif-refusal').modal('show');
    });

    //===========Lier tâche aux utilisateurs====================//
    $(document).ready( function () {
       // $('.swal2-popup').append('<img src="http://127.0.0.1:8000/assets_template/dist/img/loader.gif"/>') ;

        var entity_list = <?php echo $json_EntityChild; ?>;
        var employees = <?php echo json_decode($json_User3,false); ?> ;
        var de = <?php echo $json_de; ?>;

	
        $('#id_entity_list').select2({
            width:'100%',
            data: entity_list
        })
        $('#id_entity_list').on('select2:select', function(e) {
            e.preventDefault()
            var data = e.params.data
            var data1 = JSON.stringify(data)
            console.log('data='+data1)
            var checks = ''
            for (var i = 0; i < employees[data.id].length; i++) {
                checks += '<div class="icheck-primary w-100 emp-item-'+data.id+'">'
                                +'<input type="checkbox" name="employees['+data.id+']" class="employees-data" id="emp_'+data.id+'_'+employees[data.id][i].id+'" value="'+employees[data.id][i].id+'">'
                                +'<label for="emp_'+data.id+'_'+employees[data.id][i].id+'">'+employees[data.id][i].text+'</label>'
                        +'</div>'
            }
            $('#employees').append(checks);
        })
        $('#id_entity_list').on('select2:unselect', function(e) {
            e.preventDefault()
            var data = e.params.data
            $('#employees').find('.emp-item-'+data.id).remove()
        })
        $('#btn-save').on('click', function(e) {
            e.preventDefault()
            var data_entity_list = $('[name="entity_list[]"]').val()
            var data_outpout = []
            for (var i = 0; i < data_entity_list.length; i++) {
                // data_outpout[data_users[i]] = $('[name="subusers['+data_users[i]+']"]:checked').serializeArray()
                $('[name="employees['+data_entity_list[i]+']"]:checked').each(function() {
                    data_outpout.push({ent: data_entity_list[i], emp: $(this).val()})
                })
            }
            $('#output-data').text(JSON.stringify(data_outpout, null, "\t"))
            $('[data-dismiss="modal"]')[0].click()
        })
    })


</script>
@endsection
