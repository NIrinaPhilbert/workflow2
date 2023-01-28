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
                       
                        <?php foreach($RequestPendingbyid as $req)  { 
                        $dataidconcat = $req->idrequesthistories.'_'.$req->idrequest.'_'.$req->idtool.'_'.$req->idtyperequest;
                           
                        ?>

                        <form method="POST" action="">
                            @method('POST')
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST">
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <input type="text" id="txtdataid" value="<?php echo $dataidconcat; ?>">
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
                                                            <?php //foreach($listfile as $lf) { ?>
                                                            <p>
                                                                
                                                            <a href="" target="_blank" alt="cliquer pour télécharger"> [Télécharger]</a>
                                                            </p>
                                                            <?php //} ?>
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
                                        <button type="button" class="btn btn-edit btn-info btn-active" data-id="<?php echo $dataidconcat; ?>">VALIDER</button>
                                        <button type="button" class="btn btn-edit btn-info btn-active2" data-id="<?php echo $dataidconcat; ?>">VALIDER2</button>
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
                                    <span aria-hidden="true">Ã—</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="reason_rejectionForm" name="reason_rejectionForm" class="form-horizontal">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label">Service concernÃ©:</label>
                                        <div class="col-sm-12">
                                            <select class="custom-select @error('entity_id') is-invalid @enderror" name="entity_id" id="entity_id" required="">
                                                <option value=""></option>
                                                @foreach($data as $entity)
                                                <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                                                @endforeach
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
                                            <input class="form-control" id="comment_approv" name="comment_approv" value="" required="">
                                            @error('rejection_reason')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-save-final-approuv" id="btn-save-final-approuv" value="create" data-id="<?php echo $dataidconcat; ?>">Enregistrer
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
      $('#content').summernote({
          height: "300"
        })
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  
    $('body').on('click', '.btn-active', function(e) {
        //alert('ici');
        var param_request = $(this).attr("data-id");
        var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
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
                        type: "get",                        
                        url:"<?php echo url("request/valid/");?>"+'/'+param_request,
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
    $('body').on('click', '.btn-active2', function(e) {
        //alert('ici');
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
                        html: '<span class="text-lg">Etes vous sÃ»r de valider ce demande?</span>',
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
        //alert('ici');
        var param_request = $(this).attr("data-id");
        var approv_comment = $('#comment_approv').val();
        //alert('comment approbation='+approv_comment);
        var entity_id_resp = $('#entity_id').val();
        var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sÃ»r de valider ce demande pour le traitement?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        data: {param_request:param_request,approv_comment:approv_comment,entity_id_resp:entity_id_resp},
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

</script>
@endsection
