
@extends('layouts.appnew')
@section('content')
<!------------------------------------------>
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
                  <!------------------------------------>
                  <table id="entityDatatable" class="display table m-0" width="100%"></table>
                  <!------------------------------------>

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
<!------------------------------------------>
<div class="container">


 
    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="entityCrudModal"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="entityForm" name="entityForm" class="form-horizontal">
            <input type="hidden" name="id" id="id">
                <div class="form-group">
                    <label for="name" class="col-sm-6 control-label">Entité parent</label>
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
                    <label class="col-sm-6 control-label">Désignation entité</label>
                    <div class="col-sm-12">
                        <input class="form-control" id="name" name="name" value="" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-6 control-label">Description</label>
                    <div class="col-sm-12">
                        <input class="form-control" id="description" name="description" value="">
                    </div>
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enregistrer
                    </button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            
        </div>
    </div>
    </div>
</div>
<script>
$(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
}); 

$('body').on('click','.btn-add', function () {
    //alert('ici');
    $('#btn-save').val("create-post");
    $('#post_id').val('');
    $('#entityForm').trigger("reset");
    $('#entityCrudModal').html("Ajout Entité");
    $('#ajax-crud-modal').modal('show');
});
var dataSet = <?php echo $zEntitiesDatatable; ?>;

$(document).ready(function() 
{
    
   $('#entityDatatable').DataTable({
        
        data: dataSet,
        "pagingType": "full_numbers",
        columns: [
            { title: "id" },
            { title: "Designation Entite" },
            { title: "Tutelle" },
            { title: "Description" },
            { title: "Action" }
          
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        "columnDefs": [{
          "targets": 'Designation Entite',
          "orderable": true,
        }],
        "columnDefs": [{
          "targets": 'Action',
          "orderable": false,
        }],
        "order": [[ 0, "desc" ]],
        
    });
   
});
 
 
/*$('#add-new-entite').click(function () {
    alert('ici');
    $('#btn-save').val("create-post");
    $('#post_id').val('');
    $('#postForm').trigger("reset");
    $('#postCrudModal').html("Add New Entity");
    $('#ajax-crud-modal').modal('show');
});*/


 
   
$('body').on('click', '.btn-edit', function () {
 //alert('ici');
  var entity_id = $(this).attr("data-id");
  //alert(entity_id);
  $.get('entities/edit/'+entity_id, function (data) {
      //alert(data);
      //alert(JSON.stringify(data));
     $('#name-error').hide();
     $('#email-error').hide();
     $('#entityCrudModal').html("Edition Entité");
      $('#btn-save').val("edit-post");
      $('#ajax-crud-modal').modal('show');
      $('#id').val(data.id);
      $('#entity_id').val(data.entity_id).change();
      $('#name').val(data.name);
      $('#description').val(data.description);
     
  });
});
    
$('body').on('click', '.btn-delete', function () {
  var entity_id = $(this).attr("data-id");
  confirm("Are You sure want to delete !");
  $.ajax({
      type: "get",
      url: "entities/destroy/"+entity_id,
      success: function (data) {
      var oTable = $('#entityDatatable').dataTable(); 
      location.reload();
      oTable.fnDraw(false);
      },
      error: function (data) {
          console.log('Error:', data);
      }
  });
});   


if ($("#entityForm").length > 0) {
  $("#entityForm").validate({
      submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
    
      $.ajax({
          data: $('#entityForm').serialize(),
          url: "{{ route('entities.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
               $('#entityForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              location.reload();
              var oTable = $('#entityDatatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script>
@endsection
