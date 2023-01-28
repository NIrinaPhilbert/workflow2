@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div id="mymaincontent">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid pb-4">
			<!------------------------------------>
					<div class="row">
						<div class="col-md-4 col-lg-4 col-xs-4">
							<div class="form-group form-group-sm">
								<input type="hidden" id="_token" value="{{ csrf_token() }}">
								<label for="formGroupInputSmall">Type demande:</label>
								<select class="form-control form-perso" id="typeRequestID">
									<option value="0">Choisir</option>
									<?php
									foreach($ListTypeRequest as $oTypeRequest){
									?>
									<option value="{{$oTypeRequest->id}}">{{$oTypeRequest->name}}</option>
									<?php
									}
									?>
								</select>
                        	</div>
						</div>
						<div class="col-md-4 col-lg-4 col-xs-4">
							<div class="form-group form-group-sm">
								<label for="formGroupInputSmall">Outil:</label>
								<select class="form-control form-perso" id="toolID">
									<option value="0">Choisir</option>
								</select>
                        	</div>
						</div>
						<div class="col-md-4 col-lg-4 col-xs-4">
							<div class="form-group form-group-sm">
								<label for="formGroupInputSmall">Entite:</label>
								<select class="form-control form-perso" id="entityID">
									<option value="0">Choisir</option>
								</select>
                        	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-lg-4 col-xs-4">
							<div class="form-group form-group-sm">
								<label for="formGroupInputSmall">Statut Validation</label>
								<select class="form-control form-perso" id="statusID">
									<option value="0">Choisir</option>
									<option value="1">En attente validation</option>
									<option value="2">Validé</option>
									<option value="5">Refusé</option>
								</select>
                        	</div>
						</div>
				
						<div class="col-md-4 col-lg-4 col-xs-4">
							<div class="form-group form-group-sm">
								<label for="formGroupInputSmall">&nbsp;</label>
								<div>
									<a href="#" class="btn btn-primary btn-showrequest">Valider</a>
								</div>
							</div> 
						</div>
						<div class="col-md-4 col-lg-4 col-xs-4">
							<div class="form-group form-group-sm">
								<label for="formGroupInputSmall">&nbsp;</label>
								<div>
								<button type="button" class="btn btn-outline-success">Nombre d'enregistrement trouvées:<span id="spnnbenreg"></span></button>
								</div>
							</div> 
						</div>
					</div>
					
		<!------------------------------------->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- TABLE: DATA -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><strong>Recherche demande niova</strong></h3>
				
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="input-group float-left m-3" style="width: 300px;">
                  <input id="search-accordion" type="text" placeholder="Search request..." class="form-control form-control-sm">
                  <button id="btn-search-accordion" class="input-group-append btn btn-sm btn-primary"><span><i class="fas fa-search fa-fw"></i></span></button>
                </div>
                <ul class="pagination pagination-sm float-right m-3"></ul>
                <table class="table table-bordered table-hover" id="table-accordion">
                  <tbody id="tbody-accordion"></tbody>
                </table>
                <ul class="pagination pagination-sm float-right m-3"></ul>
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
</div>

<script type="text/javascript">

$(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 

  $(document).ready( function () {
    arrangePJ();
    loadRequest(1);

  })
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
	//alert('ici1') ;
  event.preventDefault();
  $(this).ekkoLightbox({
    alwaysShowClose: true
  });
});
//function special ouverture
function test_ouverture(_iLigneId)
{
	if($('[data-widget="expandable-table"][data-load="' + _iLigneId + '"]').attr('aria-expanded') == 'false')
	{
		$('[data-widget="expandable-table"][aria-expanded="true"] + .expandable-body').addClass('d-none')
		$('[data-widget="expandable-table"][aria-expanded="true"]').attr('aria-expanded', 'false')
		loadSubRequest($('[data-widget="expandable-table"][aria-expanded="true"]'), 0)
		//e.preventDefault()
		loadSubRequest($('[data-widget="expandable-table"][data-load="' + _iLigneId + '"]'), _iLigneId);
	}
	
}


$(document).on('click', '#btn-search-accordion', function(e) {
	//alert('ici2') ;
	e.preventDefault()
	loadRequest(1)
});

$(document).on('keyup', '#search-accordion', function(e) {
	//alert('ici3') ;
	e.preventDefault()
	if (e.key === 'Enter' || e.keyCode === 13) loadRequest(1)
});

$(document).on('click', '.btn-showrequest', function(e) {
	//alert('click bouton valider') ;
	e.preventDefault()
	loadRequestMulticritere(1)
});


$(document).on('click', '.pagination .page-item:not(.disabled) .page-link', function(e) {
	//alert('ici4') ;
	e.preventDefault()
	loadRequest($(this).parent('.page-item').attr('data-page'))
});

function arrangePJ() {
	var attach_name = $('.mailbox-attachment-name');
	var attach_name_height = 25;
	if (attach_name.length) {
		attach_name.each(function() {
			attach_name_height = ($(this).height() > attach_name_height) ? $(this).height() : attach_name_height;
		});
	}
	attach_name.css({'height':(attach_name_height+5)+'px'});
}

function loadRequest(page) {
	//alert($('#search-accordion').val()) ;
	//return false ;
	$.ajax({
        type: 'ajax',
        method: 'post',
        url: "showrequestaccordionformat?got=list&page="+page,
        data: { search: $('#search-accordion').val() },
        dataType: 'json',
		//dataType: 'text',
        async: true,
        success: function(data){
			$('#spnnbenreg').html(data.data.length);
//			console.log(data) ;
			//return false ;
        	var tpl = ''
        	if (data.data.length > 0) {
	        	for (var i = 0; i < data.data.length; i++) {
	        		tpl += '<tr class="to-expand" data-widget="expandable-table" aria-expanded="false" onclick="test_ouverture('+data.data[i].id+') ;" data-load="'+data.data[i].id+'">'
								+'<td class="pl-2">'
									+'<i class="expandable-table-caret fas fa-caret-right fa-fw"></i>'
									+'<span>'+data.data[i].name+'</span>'
									+'<span class="text-sm float-right">'+data.data[i].date+'</span>'
								+'</td>'
							+'</tr>'
							+'<tr class="expandable-body callout callout-info d-none">'
								+'<td>'
									+'<div class="body-collapse"></div>'
								+'</td>'
							+'</tr>'
	        	}
	        	$('#table-accordion #tbody-accordion').html(tpl)
	        	var ctrlPrevious = (page <= 1) ? ' disabled' : ''
	        	var ctrlNext = (page >= data.pagination.nbpage) ? ' disabled' : ''
	        	var pagination = '<li class="page-item'+ctrlPrevious+'" data-page="'+(parseInt(page)-1)+'"><a class="page-link">&laquo;</a></li>'
		        if (data.pagination.nbpage > 1) {
		        	for (var i = 1; i <= data.pagination.nbpage; i++) {
		        		var ctrlActive = (page == i) ? ' active' : ''
		        		pagination += '<li class="page-item'+ctrlActive+'" data-page="'+i+'"><a class="page-link">'+i+'</a></li>'
		        	}
		        } else pagination += '<li class="page-item active" data-page="1"><a class="page-link">1</a></li>'
	        	pagination += '<li class="page-item'+ctrlNext+'" data-page="'+(parseInt(page)+1)+'"><a class="page-link">&raquo;</a></li>'
	        	$('.pagination').html(pagination)
        	} else {
        		tpl += '<tr><td class="text-center">Empty data.</td></tr>'
	        	$('#table-accordion #tbody-accordion').html(tpl)
        		$('.pagination').html('')
        	}
        },
        error: function(data) {
            alert("Error!!! Something wrong.")
        }
    });
}
function loadRequestMulticritere(page){
	
	$.ajax({
        type: 'ajax',
        method: 'post',
        url: "showrequestaccordionformatmulticritere?got=list&page="+page,
        data: { typerequestID:$('#typeRequestID').val() , toolID:$('#entityID').val(), entityID:$('#entityID').val(), statutID:$('#entityID').val() },
        dataType: 'json',
		//dataType: 'text',
        async: true,
        success: function(data){
			console.log(data) ;
			console.log(data.data.length);
			$('#spnnbenreg').html(data.data.length);
			//return false ;
        	var tpl = ''
        	if (data.data.length > 0) {
	        	for (var i = 0; i < data.data.length; i++) {
	        		tpl += '<tr class="to-expand" data-widget="expandable-table" aria-expanded="false" onclick="test_ouverture('+data.data[i].id+') ;" data-load="'+data.data[i].id+'">'
								+'<td class="pl-2">'
									+'<i class="expandable-table-caret fas fa-caret-right fa-fw"></i>'
									+'<span>'+data.data[i].name+'</span>'
									+'<span class="text-sm float-right">'+data.data[i].date+'</span>'
								+'</td>'
							+'</tr>'
							+'<tr class="expandable-body callout callout-info d-none">'
								+'<td>'
									+'<div class="body-collapse"></div>'
								+'</td>'
							+'</tr>'
	        	}
	        	$('#table-accordion #tbody-accordion').html(tpl)
	        	var ctrlPrevious = (page <= 1) ? ' disabled' : ''
	        	var ctrlNext = (page >= data.pagination.nbpage) ? ' disabled' : ''
	        	var pagination = '<li class="page-item'+ctrlPrevious+'" data-page="'+(parseInt(page)-1)+'"><a class="page-link">&laquo;</a></li>'
		        if (data.pagination.nbpage > 1) {
		        	for (var i = 1; i <= data.pagination.nbpage; i++) {
		        		var ctrlActive = (page == i) ? ' active' : ''
		        		pagination += '<li class="page-item'+ctrlActive+'" data-page="'+i+'"><a class="page-link">'+i+'</a></li>'
		        	}
		        } else pagination += '<li class="page-item active" data-page="1"><a class="page-link">1</a></li>'
	        	pagination += '<li class="page-item'+ctrlNext+'" data-page="'+(parseInt(page)+1)+'"><a class="page-link">&raquo;</a></li>'
	        	$('.pagination').html(pagination)
        	} else {
        		tpl += '<tr><td class="text-center">Empty data.</td></tr>'
	        	$('#table-accordion #tbody-accordion').html(tpl)
        		$('.pagination').html('')
        	}
        },
        error: function(data) {
            alert("Error!!! Something wrong.")
        }
    });
}
function loadSubRequest(_this, id) {
	//alert('ajax sub==>' + id) ;
	if (id == 0) {
		$(_this).next('.expandable-body').find('.body-collapse').html('')
	} else {
		//$(_this).next('.expandable-body').find('.body-collapse').html('texte maromaro') ;
		
		$.ajax({
	        type: 'ajax',
	        method: 'post',
	        url: "showrequestaccordionformat?got=sublist",
	        data: { id: id },
	        dataType: 'json',
	        async: true,
	        beforeSend: function() {
				$(_this).next('.expandable-body').find('.body-collapse').html('<div class="w-100 text-center"><i class="fas fa-spinner fa-spin"></i></div>')
	        },
	        success: function(data){
	        	var tpl = (data.tpl != '') ? data.tpl : '<div class="w-100 text-center">Empty data.</div>'
	        	$(_this).next('.expandable-body').find('.body-collapse').html(tpl)
	        	arrangePJ()
	        },
	        error: function(data) {
	            alert("Error!!! Something wrong.")
	        }
	    });
		
	}
}
//=======================================================//
$("#mymaincontent").delegate("#typeRequestID", 'change', function() {
  event.preventDefault();
  var itypeRequestID = jQuery("#typeRequestID").val() ;
  var _token = $('input#_token').val();
  $.ajax({
    type:"POST",
    url: "showtoolbytyperequest",
    dataType:'json',
    data: {itypeRequestID : itypeRequestID , _token : _token },
    success: function(data){ 
		console.log(data);
        var length = Object.keys(data).length;  
        $("#toolID").html("");
        if(length > 0){
            $("#toolID").append('<option value="0" selected>Selectionner l outil...</option>');
            $.each(data, function (key, value) {           
                $("#toolID").append('<option value="'+value.tool_id+'">'+value.tool_name+'</option>');
            });
        }else{
            $("#toolID").append('<option value="'+""+'">'+"Sans type de demande"+'</option>');
        }
   
    }
  })
});
$("#mymaincontent").delegate("#toolID", 'change', function() {

  event.preventDefault();
  var itypeRequestID = jQuery("#typeRequestID").val() ;
  var itoolID = jQuery("#toolID").val() ;
  var _token = $('input#_token').val();
  $.ajax({
    type:"POST",
    url: "showentitybytoolandtyperequest",
    dataType:'html',
    data: {itypeRequestID : itypeRequestID , itoolID : itoolID, _token : _token },
    success: function(data){ 
		//alert(data);
         
        $("#entityID").html("");
        $("#entityID").html(data);
   
    }
  })
});

</script>

@endsection