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
          <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("aprobation_type_demande/add");?>" class="btn btn-primary">Créer validation type demande</a>
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
                      <th>Plateforme</th>
                      <th>Processus validation</th>
                      <th>Actions</th>

                    
                    </tr>
                    </thead>
                    <tbody>
                      @php $zTypeDemandePlateformeInit = ""; @endphp
                      @foreach($toApprobation as $approbation) 
                      @php $zTypeDemandePlateforme = $approbation->type_request_id."_".$approbation->tool_id ;@endphp
                      
                      <?php if(strcmp($zTypeDemandePlateforme,$zTypeDemandePlateformeInit) <> 0) {?>
                      <tr class="item-tr">
                        <td>{{$approbation->type_request_id.'.'.$approbation->tool_id}}</td>
                        <td>{{$approbation->type_request_name}}</td>
                        <td>{{$approbation->tool_name}}</td>
                        <td><div  class="btn-group" role="group" aria-label="Basic example"></div> 
                            @foreach($toApprobation as $approbationRang)
                            <?php $zTypeDemandePlateformeRang = $approbationRang->type_request_id."_".$approbationRang->tool_id; ?>
                            @if(strcmp($zTypeDemandePlateforme,$zTypeDemandePlateformeRang) === 0)
                              <button type="button" class="btn btn-primary"><span class="badge badge-light">{{ $approbationRang->rank}} </span>{{ $approbationRang->entity_name}}</button>
                            @endif
                            <?php ?>
                            @endforeach
                          </div>   </td>
                        <td>
                          <a href="typerequest/viewapprobation/{{$zTypeDemandePlateforme}}"><i class="fas fa-eye text-primary"></i></a>
                          <a href="/approbation_type_demande/edit/{{ $zTypeDemandePlateforme}}"><i class="fas fa-edit ml-1 text-secondary"></i></a>
                          <a href="#" class="btn-deleteApprobation" data-id="{{ $zTypeDemandePlateforme }}"><i class="fas fa-trash ml-1 text-danger"></i></a>
                        </td>
                      </tr>
                      @php $zTypeDemandePlateformeInit = $zTypeDemandePlateforme; @endphp
                      <?php } ?>
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
  <script type="text/javascript">
  $(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  
  $('body').on('click', '.btn-deleteApprobation', function(e) {
      //alert('ici');
      var param_request = $(this).attr("data-id");
      var urlnextpage = "<?php echo url("approbation_type_demande");?>";
      //var urlnextpage =$("#txtUrl").val()+'/'+$("#txtEntityID").val();
      //alert('urlnextpage='+urlnextpage);
      e.preventDefault()
      let _this = $(this)
      Swal.fire({
          html: '<span class="text-lg">Etes vous sûr de supprimer ce processus de validation ?</span>',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Yes',
          cancelButtonText: 'No'
      }).then((result) => {
          if (result.isConfirmed) {
              
                  $.ajax({
                      type: "get",                        
                      url:"<?php echo url("type_request/deletevalidationprocess");?>"+'/'+param_request,
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

