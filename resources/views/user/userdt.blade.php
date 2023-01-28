@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col">
           
            <a href="/client/create" class="btn btn-info">Liste utilisateur</a>
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
          <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("/createcompte");?>" class="btn btn-primary">Créer utilisateur</a>
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
            @if(Session::has('message'))
              <div class="form-group row">
                    <div class="col-md-12">
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ 
                                    Session::get('message') }}</p>
                    </div>
              </div>
            @endif
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
                  @if($message = Session::get('success'))
                  <div class="alert alert-success">
                    <p>{{$message}}</p>
                  </div>
                  @endif

                  <table id="tblrequestsend" class="table table-bordered table-striped m-0">
                    <thead>
                    <tr>

                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Entite</th>
                      <th>Fonction</th>
                      <th>Activé</th>
                      <th>Administrateur</th>
                      <th>Repondeur</th>
                      <th>Valideur</th>
                      <th>Date de création</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        foreach($dataUser as $user) {
                          $zValActivation = Helper::setOuiNon($user->activated);
                          $zValAdministration = Helper::setOuiNon($user->administrator);
                          $zValRepondeur = Helper::setOuiNon($user->answering);
                          $zValValideur = Helper::setOuiNon($user->validator);
                          //$dataid = $dataid.'data-id=\"'.$user->id.'\"';
                          //$zUsersDatatable .= '["'.$user->id.'","'.$user->name.'","'.$user->email.'","'.$user->entity->name.'","'.$zValActivation.'","'.$zValAdministration.'","'.$zValRepondeur.'","'.$zValValideur.'","'.$user->created_at.'","<button type=\"button\" class=\"btn btn-edit btn-info\"'.$dataid.'>Edit</button>  <button type=\"button\" class=\"btn btn-delete btn-danger\"'.$dataid.'>Delete</button>"],';
                         
                      
                      
                      ?>
                      <tr class="item-tr">
                        <td><a href="">{{$user->id}}</a></td>                      
                        <td><div class="image mt-2">
                              <img src="<?php echo asset('images').'/'.$user->image; ?>" class="img-thumbnail" alt="User Image">
                          </div></td>
                        <td><?php echo $user->name; ?></td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->email}}</td>
                        <td><?php $zEntity = App\Entity::getNameEntityById($user->entity_id); echo $zEntity?></td>
                        <td>{{$user->function}}</td>
                        <td>{{$zValActivation}}</td>
                        <td>{{$zValAdministration}}</td>
                        <td>{{$zValRepondeur}}</td>
                        <td>{{$zValValideur}}</td>
                        <td>{{$user->created_at}}</td>

                        <td>
                          <a href=""><i class="fas fa-eye text-primary"></i></a>
                          <a href="/user/edit/{{ $user->id }}"><i class="fas fa-edit ml-1 text-secondary"></i></a>
                          <?php if($user->activated == 0 ) {?>
                          <a href="/enableuser/{{$user->id}}" class="btn btn-default btn-sm">
                                Enable user <span class="glyphicon glyphicon-sort"></span>
                          </a>
                          <?php } ?>
                          <?php if($user->activated == 1 ) {?>
                          <a href="/enableuser/{{$user->id}}" class="btn btn-default btn-sm">
                                Disable user <span class="glyphicon glyphicon-sort"></span>
                          </a>
                          <?php } ?>
                          <a href="#" class="btn-delete"><i class="fas fa-trash ml-1 text-danger"></i></a>
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

