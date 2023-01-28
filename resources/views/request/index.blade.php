@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col">
           
            <a href="/client/create" class="btn btn-info">Liste demande</a>
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
          <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("/request");?>" class="btn btn-primary">Créer demande</a>
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
                      
                      <th>#</th>
                      <th>Objet</th>
                      <th>Outils</th>
                      <th>Type demande</th>
                      <th>Status</th>
                      <th>Date et heure</th>
                      <th>Actions</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($lrequests as $requestwf)
                    @php  $zDateCreation = Helper::convertDateTimeToCurrentDate($requestwf->created_at); @endphp
                    <?php $zLibstatus = App\Status::getLibelleStatusById($requestwf->statusid); ?>
                    <tr class="item-tr">
                      <td><a href="<?php echo url("request/view/{$requestwf->ID}");?>">{{$requestwf->ID}}</td>
                        <td>{{$requestwf->Objet}}</td>
                        <td>{{$requestwf->toolname}}</td>
                        <td>{{$requestwf->type_requestname }}</td>
                        <td><?php echo $zLibstatus; ?></td>
                        <td>{{$zDateCreation}}</td>
                        <td><a href="<?php echo url("request/view/{$requestwf->ID}");?>"><i class="fas fa-eye text-primary"></i></a>                      
                        </td>
                      </tr>
                      @endforeach
                      
                      
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

