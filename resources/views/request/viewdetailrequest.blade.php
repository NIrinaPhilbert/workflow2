@extends('layouts.appnew')

@section('content')

<div class="wrapper">

  
  
  <!-- Main Sidebar Container -->
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">Détail de la demande<a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-sm btn-primary ml-3"><i class="fas fa-arrow-left fa-fw"></i>Retour</a></h1>
          </div><!-- /.col -->
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
            <div class="card card-primary card-outline">
            <?php foreach ($Detailrequestwf as $oreq){ ?>
              <div class="card-header">
                <h3 class="card-title"><strong>{{$oreq->Objet}}</strong></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-default btn-sm btn-tool" title="Supprimer">
                    <i class="far fa-trash-alt"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm btn-tool" title="Répondre">
                    <i class="fas fa-reply"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm btn-tool" title="Transférer">
                    <i class="fas fa-share"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm btn-tool" title="Imprimer">
                    <i class="fas fa-print"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                
                <div class="mailbox-read-info pl-3 pr-3">
                  <h5 class="info-sender">
                    <span class="info-name">De{{" ".$oreq->username}}</span>
                    <span class="text-muted info-mail">&lt;{{$oreq->useremail}}&gt;</span>
                    <span class="mailbox-read-time info-time">{{$oreq->created_at}}</span>
                  </h5> 
                  
                </div>
                <!-- /.mailbox-read-info -->
                <div class="mailbox-read-message pt-3 pr-4 pb-3 pl-4">
                  <p>
                  	<label class="mt-1">Entité source</label><br/>
                  	<span><?php $zEntityUser = App\User::getEntityNameByUserId($oreq->userid); echo $zEntityUser; ?></span>
                  </p>
                  <p>
                  	<label class="mt-1">Utilisateur source</label><br/>
                  	<span><?php echo $oreq->username ; ?></span>
                  </p>
                  <p>
                  	<label class="mt-1">Outil</label><br/>
                  	<span><?php echo $oreq->toolname; ?></span>
                  </p>
                  <p>
                  	<label class="mt-1">Type de la demande</label><br/>
                  	<span><?php echo $oreq->type_requestname ;?></span>
                  </p>
                  <p>
                  	<label class="mt-1">Corps de la demande</label><br/>
                  	<span>
                  		<?php echo $oreq->content; ?>
                  	</span>
                  </p>
                  <p>
                  	<label class="mt-1">Status de la demande</label><br/>
                  	<span>{{$oreq->status}}</span>
                  </p>
                </div>
                <?php } ?>
                <!-- /.mailbox-read-message -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-white pt-0 pl-4 pr-4">
                <label class="mb-3">Lettre de demande ou pièces jointes</label>
                <ul class="mailbox-attachments align-items-stretch clearfix">
                <?php 
                    $target_request = public_path().'/docrequest/'.$oreq->ID.'/dossier_demande/';
                    $files = scandir("$target_request");
                    foreach($files as $file) { 
                    if (in_array($file, array(".",".."))) continue;
                    $typefile = substr($file, strrpos($file, '.')+1);
                    $znameicon = Helper::getNameIcon($file,$typefile);


                ?>
                  <li>
                    <span class="mailbox-attachment-icon"><img class="icon" src="<?php if($znameicon != $file) {echo asset('assets_template/dist/img/icons/'.$znameicon);} else echo asset('/docrequest/'.$oreq->ID.'/dossier_demande/'.$file);  ?>" alt="PDF"></span>
                    <div class="mailbox-attachment-info">
                      <label class="mailbox-attachment-name"><?php echo $file; ?></label>
                          <span class="mailbox-attachment-size clearfix mt-1">
                            <a href="{{asset('/docrequest/'.$oreq->ID.'/dossier_demande/'.$file)}}" class="btn btn-default btn-sm float-right link-download" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                          </span>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
              </div>
              <!-- /.card-footer -->
              <div class="card-footer bg-white pt-0 pl-4 pr-4">
              	<label class="mb-3">Liste traitement de la demande</label>
              	<table class="table table-bordered">
              		<thead>
              			<tr>
              				<th>Déscription</th>
                      <th>Date</th>
              				<th>Pièces jointes</th>
              			</tr>
              		</thead>
              		<tbody>
                  <?php foreach ($ListProcessAchievementByRequestID as $pa) { 
                                                                    
                    $idprocessachievement = $pa->achievementid;
                    $target_process = public_path().'/docrequest/'.$oreq->ID.'/dossier_traitement/'.$idprocessachievement.'/';

                    ?>
              			<tr>
                      <td><?php echo $pa->achievementdate; ?></td>
                      <td><?php echo $pa->achievementcomment; ?></td>
              				<td>

                      <?php
                                                                                   
                            if(file_exists($target_process)){
                                $files = scandir("$target_process");
                                foreach($files as $file) { 
                                if (in_array($file, array(".",".."))) continue;
                                $typefile = substr($file, strrpos($file, '.')+1);
                                $znameicon = Helper::getNameIcon($file,$typefile);
                        
                                ?>
                                
                                <div class="d-block pj-data text-left">
                                  <label class="pj-content d-inline-block">
                                    <img class="pj-icon" src="<?php if($znameicon != $file) {echo asset('assets_template/dist/img/icons/'.$znameicon);} else echo asset('/docrequest/'.$oreq->ID.'/dossier_traitement/'.$idprocessachievement.'/'.$file);  ?>" alt="PDF">
                                    <span class="pj-name ml-1"><?php echo $file; ?></span>
                                  </label>
                                  <a href="{{asset('/docrequest/'.$oreq->ID.'/dossier_traitement/'.$idprocessachievement.'/'.$file)}}" class="btn btn-default btn-xs link-download d-inline-block" title="Télécharger" target="blank"><i class="fas fa-download"></i></a>
                                </div>
                              
                              
                              
                              
                                
                                <?php 
                            
                                } 
                            }
                            else{
                                echo "Auccun pièce jointe";
                            }
                        ?>

              				</td>
              			</tr>
              			<?php } ?>
              		</tbody>
              	</table>
              </div>
              <!-- /.card-footer -->
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
</div>
<!-- ./wrapper -->
@endsection