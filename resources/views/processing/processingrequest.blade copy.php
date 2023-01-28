<html lang="en">
<head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>DATATABLE2</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-----export button from datatable ---------------->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
</head>
<body>
 
<div class="container">
<h2>Liste demande en attente traitement</h2>
<br>
<a href="<?php echo url("/home");?>" class="btn btn-info ml-3">Retour</a>

<br><br>
 
<table id="entityDatatable" class="display" width="100%"></table>

 
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
</body>
</html>
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
var dataSet = <?php echo $zRequestsDatatable; ?>;

$(document).ready(function() 
{
    
   $('#entityDatatable').DataTable({
        
        data: dataSet,
        "pagingType": "full_numbers",
        columns: [
            { title: "id" },
            { title: "Objet" },
            { title: "Outil" },
            { title: "Type demande" },
            { title: "Situation" },
            { title: "Utilisateur source" },
            { title: "Action" }
          
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        
        "columnDefs": [{
          "targets": 'Objet',
          "orderable": true,
        }],
        "columnDefs": [{
          "targets": 'Action',
          "orderable": false,
        }],
        "order": [[ 0, "desc" ]],
        
    });
   
});
 
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
    
$('body').on('click', '.btn-active', function () {
  var param_request = $(this).attr("data-id");
  alert(param_request);
  confirm("Etes vous sûr de valider cette demande!");
  $.ajax({
      type: "get",
      //url: "entities/destroy/"+entity_id,
      //url:"request/valid/"+request_id,
      url:"<?php echo url("request/process/");?>"+'/'+param_request,
      success: function (data) {
      alert(data)
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
          datatype: 'text',
          //dataType: 'json',
          success: function (data) {
              //alert(data);
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