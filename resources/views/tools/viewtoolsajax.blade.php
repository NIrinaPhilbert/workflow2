<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PHP Ajax Insert Data in MySQL By Using Bootstrap Modal - XpertPhp</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
     <!--------------------js pour datatable--------------------------->
     <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>  
    <!--------------------fin js pour datatable------------------------>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
</head>
<body>
    <div class="container">
            <h3 align="center">PHP Ajax Insert Data in MySQL By Using Bootstrap Modal</h3>
            <br />
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <div align="right">
                        <button type="button" class="btn btn-primary text-right m-5" data-toggle="modal" data-target="#addDataModal2">Add methode2</button>
                    </div>
                    <div align="right">
                        <button type="button" class="btn btn-primary text-right m-5" data-toggle="modal" data-target="#addDataModal">Add</button>
                    </div>
                    <br />
                    <div id="employee_table">
                        <table class="table table-bordered table-striped" id="tooltable">
                            <tr>
                                <th width="70%">Id</th>
                                <th width="70%">Nom</th>
                                <th width="70%">Description</th>
                                <th width="30%">Action</th>
                            </tr>
                            <?php foreach($tools as $tool) { ?>
                                <tr>
                                    <td><?php echo $tool->id; ?></td>
                                    <td><?php echo $tool->name; ?></td>
                                    <td><?php echo $tool->description; ?></td>
                                    <td>
                                        <input type="button" name="view" value="view" id="<?php echo $tool->id; ?>" class="btn btn-info btn-xs view_data" />
                                        <input type="button" name="edit" value="edit" id="<?php echo $tool->id; ?>" class="btn btn-info btn-xs view_data" />
                                        <input type="button" name="delete" value="delete......." id="<?php echo $tool->id; ?>" class="btn btn-danger delete" />
                                        <input type="button" class="btn btn-danger delete-btn" data-id="<?php echo $tool->id; ?>" value="Delete2"/>
                                        <a href="#" class="btn btn-success editbtn">EditBtn</a>
                                        <a href="#" class="btn btn-success deletebtn">DeleteBtn</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Data Modal -->
        <div>
            <form method="POST" action="" class="btn-submit" id="addform">
                <div class="modal fade" id="addDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    
                    {{ csrf_field() }}
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Notes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="txtNom">Nom outil</label>
                                    <input type="text" class="form-control" id="txtNom" name="txtNom">
                                </div>
                                <div class="form-group">
                                    <label for="txtDescription"> Description outil</label>
                                    <textarea class="form-control" id="txtDescription" name="txtDescription" rows="3"></textarea>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="add_data" class="btn btn-primary" value="Add">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--------------------------------Edit tools DAta -------------------------->
        
        <div>
            <form method="" class="btn-edit" id="editform">
                <div class="modal fade" id="editDataModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                   
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit Data Tools</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="txtId">id</label>
                                    <input type="text" class="form-control" id="txtId" name="txtId">
                                </div>
                                <div class="form-group">
                                    <label for="txtNom">Nom outil</label>
                                    <input type="text" class="form-control" id="etxtNom" name="etxtNom" value="">
                                </div>
                                <div class="form-group">
                                    <label for="txtDescription"> Description outil</label>
                                    <textarea class="form-control" id="etxtDescription" name="etxtDescription" rows="3" value=""></textarea>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="add_data" class="btn btn-primary" value="Add">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!------------------------------End Edit DAta----------------------------------->
    </div>
 
    <!-- View Data Modal-->
    <div id="dataModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Note Details</h4>
                </div>
                <div class="modal-body" id="note_detail">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Data Modal-->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body" id="note_detail">
                    <h4 align="center" style="margin:0;" id="confirm">Are you sure you want to remove this data</h4>
                    <h4 align="center" style="margin:0;" id="info"></h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger btn-okdelete">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!---------------end data modal-------------->
</body>
</html>
<script>
    $(document).ready( function (){
        $('#tooltable').DataTable({
            processing: true,
            serverSide:true,
            ajax:{
                url: "{{ route('tool1')}} ",
            },
            columns:[
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable:false
                }
            ]

        });
    });
    $(document).ready(function(){
        $('.editbtn').on('click',function(){
            $('#editDataModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();
            //console.log(data);
            $('#txtId').val(data[0]);
            //alert(data[1]);
            $('#etxtNom').val(data[1]);
            $('#etxtDescription').val(data[2]);

        });
        //$('#editForm').on('submit',function()
        $(document).on("submit", ".btn-edit", function(e) 
        {
         
            e.preventDefault();
            var valid = $('#txtId').val();
            var name = $('#etxtNom').val();
            var description = $('#etxtDescription').val();
            var _token = $('input[type="hidden"]').attr('value');           
            var url = '{{ route("tool.update", ":id") }}';
            url = url.replace(':id',valid);
            var dataObject = {'name':name, 'description':description};
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
                });
            $.ajax({
                url: url,
                //type: "POST",
                method:"PUT",
                data: JSON.stringify(dataObject),
                headers:{
                    "Content-Type":"application/json"
                },
                catch: false,
                success: function(response) {
                    console.log(response);
                    alert(response);
                    $('#editDataModal').modal('hide');
                    alert("Data updated");
                    window.location.reload();
                }//fin success
                
            });

        });
        
    });
</script>
<script>
    $(document).ready(function() {
        // add

       
        /*$(document).on("submit", ".btn-submit", function(e) {
            e.preventDefault();
            alert('ici');
            var name = $('#txtNom').val();
            var description = $('#txtDescription').val();
            var _token = $('input[type="hidden"]').attr('value');
            var url = "{{ route('tool.insert') }}";
            
            $.ajax({
                url: url,
                type: "POST",
                catch: false,
                data: {
                    added: 1,
                    name: name,
                    description: description,
                    _token : _token
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                        $('#addDataModal').modal().hide();
                        swal("Plateforme inseré avec succés", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });*/
        //---------------2é methode-----------------------//
        $("#addform").on("submit", function(e) {
            e.preventDefault();
            
            var name = $('#txtNom').val();
            var description = $('#txtDescription').val();
            var _token = $('input[type="hidden"]').attr('value');
            var url = "{{ route('tool.insert') }}";
            
            $.ajax({
                url: url,
                type: "POST",
                catch: false,
                data: {
                    added: 1,
                    name: name,
                    description: description,
                    _token : _token
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.status == 1) {
                        $('#addDataModal').modal().hide();
                        swal("Plateforme inseré avec succés", {
                            icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });
        });
        //-----------------------------------------------//
        $(document).on('click', '.view_data', function() {
            var _token = $('input[type="hidden"]').attr('value');
            var note_id = $(this).attr("id");
            var url = "{{ route('tool.insert') }}";
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    note_id: note_id,
                    _token : _token
                },
                success: function(data) {
                    $('#note_detail').html(data);
                    $('#dataModal').modal('show');
                }
            });
        });
        
        $(".delete").click(function(){
            var tool_id = $(this).attr("id");
            $('#confirmModal').modal('show');
            
            $(".btn-okdelete").click(function(){
                //alert('pass');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                $.ajax({
                    url: "tool/delete/"+tool_id,
                    type: "DELETE",
                    //dataType: "JSON",
                    dataType: "html",
                    data:{
                        "tool_id":tool_id
                    },
                    /*beforeSend:function(){
                    $('.delete'.text('Deleting ...'));
                    },*/
                    success: function(data) {
                        $('#confirmModal').modal('hide');
                        //var datares = JSON.parse(data);
                        //alert(data);
                        /*setTimeout(function(){
                            $('#confirmModal').modal('show');    
                            window.location.reload();

                            },2000);*/
                        //console.log(data);
                        //$('#note_detail').html(data);
                        alert('Enregistrement id='+data+'supprimé avec suucés');
                        //$('#info').html('Enregistrement id='+data+'supprimé avec suucés');
                        //$('#confirmModal').modal('hide');
                        //alert(JSON.stringify(data).success);
                        //$('#confirm').html('');
                        //alert(data.success);
                    }
                    /*error: function(xhr) {
                        console.log(xhr.responseText); // this line will save you tons of hours while debugging
                        
                    }*/
                });

            });
            

        });
        $(".delete-btn").click(function(){
            // Confirm
            if ( ! confirm('Are you sure want to delete this row?')){
                return false;
            }
            // id need to delete
            var tool_id = $(this).attr("data-id");
            // Current button 
            var obj = this;
            
            
        //alert('pass');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "tool/delete/"+tool_id,
            type: "DELETE",
            
            //dataType: "html",
            dataType : "text",
            data:{
                "tool_id":tool_id
            },         
            success : function(result){
                    result = $.trim(result);
                    if (result == 'OK'){
                        // Remove HTML row
                        $(obj).parent().parent().remove();
                        alert('Enregistrement supprimé avec suucés');
                    }
                    else{
                        alert('request fails');
                    }
                }
            
        });

            
            

        });
        $('#deletebtn').click(function(){
            var _token = $('input[type="hidden"]').attr('value');
            var tool_id = $(this).attr("id");
            var url = "{{ route('tool.insert') }}";
            //url:"/ajax-crud/destroy/"+tool_id;
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    note_id: note_id,
                    _token : _token
                },
                beforeSend:function(){
                    $('#ok_button'.text('Deleting ...'));
                },
                success: function(data) {
                    setTimeout(function(){
                       $('#confirmModal').modal('show');    
                       $('#tooltable').DataTable().ajax.reload(); 
                    },2000);
                    $('#note_detail').html(data);
                    $('#dataModal').modal('show');
                }
            });
            
        });
 
    });
</script>
