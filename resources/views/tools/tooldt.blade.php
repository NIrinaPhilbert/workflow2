@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col">
           
            <a href="/client/create" class="btn btn-info">Liste outil</a>
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
            @can('create', App\Tool::class)
            <a href="<?php echo url("tool/create");?>" class="btn btn-primary">Créer Outil</a>
            @endcan
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
                      <th>Name</>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($Tools as $tool) {?>
                      <tr class="item-tr">
                        <td><a href="tool/view/{{ $tool->id }}">{{ $tool->id }}</a></td>
                        <td>{{ $tool->name }}</td>
                        <td>
                          <a href="tool/view/{{ $tool->id }}"><i class="fas fa-eye text-primary"></i></a>
                          <a href="tool/edit/{{ $tool->id }}"><i class="fas fa-edit ml-1 text-secondary"></i></a>
                          <a href="#" class="btn-deleteTool" data-id="{{ $tool->id }}"><i class="fas fa-trash ml-1 text-danger"></i></a>

                          
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
  
    $('body').on('click', '.btn-deleteTool', function(e) {
        //alert('ici');
        var param_request = $(this).attr("data-id");
        var urlnextpage = "<?php echo url("tooldatatable");?>";
        //var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
        //alert('urlnextpage='+urlnextpage);
        e.preventDefault()
        let _this = $(this)
        Swal.fire({
            html: '<span class="text-lg">Etes vous sûr de supprimer cet outil?</span>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                
                    $.ajax({
                        type: "get",                        
                        url:"<?php echo url("tool/delete");?>"+'/'+param_request,
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
  </script>

@endsection

