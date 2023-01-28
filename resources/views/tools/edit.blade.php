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
                        <!-- TABLE: DATA --route('requestww.store')-->
                        <form method="POST" action="<?php echo url("tool/update") ?>">
                            @csrf   
                            {{ csrf_field() }}
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <p></p>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edition outil</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0 mt-3 mb-3">
                                    <div class="table-responsive">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-7 col-md-10 col-sm-12 col-xs-12 mx-auto pt-2">
                                                    <!-- ERROR MESSAGES -->
                                                        
                                                        <!-- ERROR MESSAGES -->
                                                        <div class="input-group mb-3">
                                                        <input type="hidden" id="id_tool" name="id_tool" value="{{ $oTool->id }}">
                                                            <label class="w-100">Nom outil</label>
                                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom outil" value="{{ $oTool->name }}">
                                                            @error('name')
                                                                <div class="invalid-feedback">
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                                  
                                                        <div class="input-group mb-3">
                                                            <label class="w-100">Description outil</label>
                                                            <textarea id="description" class="form-control" name="description">{{ $oTool->description }}</textarea>
                                                        </div>
                                                         
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer bg-transparent border" id="section-footer">
                                    <div class="mt-2 mb-2 text-center">
                                        
                                        <!--<button class="btn btn-primary" type="submit">ENVOYER DEMANDE</button>
                                        <button class="ml-1 btn btn-secondary" type="reset">CANCEL</button>-->
                                        <a href="<?php echo url("tooldatatable");?>" class="btn btn-primary">RETOUR</a>
                                        <button type="submit" class="btn btn-primary">Enregistrer modification</button>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                        <!-- /.card -->
                    </div>
                </div>
                    <!-- /.row -->
            </section>
        </div><!--/. container-fluid -->       
</div>

<script type="text/javascript">
  $(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  


</script>
@endsection