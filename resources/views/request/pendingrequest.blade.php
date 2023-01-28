@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-lg-4">
           
            <a href="/client/create" class="btn btn-info">Liste demande en attente validation</a>
          </div>
          <div class="col-lg-6">
          
          </div>
        
          <div class="col-lg-2">
          <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("/request");?>" class="btn btn-primary">Retour</a>
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
                      <th>Objet</th>
                      <th>Outil</th>
                      <th>Type demande</th>
                      <th>Situation</th>
                      <th>Utilisateur source</th>
                      <th>Action</th>                     
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $zUserName = '';
                        $zProcessValidation = '';
                        foreach($ListRequestPendingbyentity as $request){
                            $zUserName = App\User::getNameAndEntityUserbyId($request->usersourceid);
                            //$zProcessValidation = Helper::getLibelleSituationProcessusValidation($request->etat);
                            $zLibEtatTraitement = App\Etat::getLibelleEtatTraitementById($request->etat);
                            //$dataidconcat = $dataidconcat.''.$request->idrequesthistories.'_'.$request->idrequest.'_'.$request->idtool.'_'.$request->idtyperequest;
                           // $dataid = $dataid.'data-id=\"'.$dataidconcat.'\"';
                            //$zRequestsDatatable .= '["'.$request->idrequesthistories.'","'.$request->Objetwf.'","'.$request->toolname.'","'.$request->type_requestname.'","'.$zProcessValidation.'","'.$zUserName.'","<button type=\"button\" class=\"btn btn-edit btn-info\"'.$dataid.'>Edit</button>  <button type=\"button\" class=\"btn btn-warning btn-active \"'.$dataid.'>Valider</button>"],';
                      
                      ?>
                      <tr class="item-tr">
                        <td><a href="<?php echo url("request/viewpendingrequest/{$request->idrequesthistories}");?>">{{$request->idrequesthistories}}</a></td>
                        <td>{{$request->Objetwf}}</td>
                        <td>{{$request->toolname}}</td>
                        <td>{{$request->type_requestname}}</td>
                        <td><?php echo $zLibEtatTraitement; ?></td>
                        <td>{{$zUserName}}</td>
                        <td>
                        <a href="<?php echo url("request/viewpendingrequest/{$request->idrequesthistories}");?>"><i class="fas fa-eye text-primary"></i></a>
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

@endsection

