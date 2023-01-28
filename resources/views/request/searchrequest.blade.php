@extends('layouts.appnew')
@section('content')
<!-- Content Wrapper. Contains page content -->
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
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- TABLE: DATA -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title"><strong>Recherche demande</strong></h3>
				<button id="exemple_bouton" class="btn btn-sm btn-primary"><span>exemple</span></button>
				<button id="exemple_bouton1" class="btn btn-sm btn-primary"><span>exemple2</span></button>
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

  <script type="text/javascript">

$(document).on('click', '#exemple_bouton', function(e) {
    //alert($(this).attr('data-load'));
	//$(this).attr('aria-expanded', 'true') ;
	
	$('[data-widget="expandable-table"][aria-expanded="true"] + .expandable-body').addClass('d-none')
	$('[data-widget="expandable-table"][aria-expanded="true"]').attr('aria-expanded', 'false')
	loadSubRequest($('[data-widget="expandable-table"][aria-expanded="true"]'), 0)
	e.preventDefault()
	
	
	$('[data-widget="expandable-table"][data-load="1"]').attr('aria-expanded', 'true')
	$('[data-widget="expandable-table"][data-load="1"]').next('.expandable-body').removeClass('d-none');
	loadSubRequest($('[data-widget="expandable-table"][aria-expanded="true"]'), 1);
	//e.preventDefault() ;
	//alert('ici') ;
	//return false ;
});


  jquery(document).ready( function () {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  }); 
  $(document).ready( function () {
    arrangePJ()
    loadRequest(1)

  })
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
	alert('ici1') ;
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
/*Anomalie dans Laravel (commenté mais encore fonctionnel ==> effet visible)
$(document).on('click', '[data-widget="expandable-table"][aria-expanded="false"]', function(e) {
    //alert($(this).attr('data-load'));
	//$(this).attr('aria-expanded', 'true') ;
	
	$('[data-widget="expandable-table"][aria-expanded="true"] + .expandable-body').addClass('d-none')
	$('[data-widget="expandable-table"][aria-expanded="true"]').attr('aria-expanded', 'false')
	loadSubRequest($('[data-widget="expandable-table"][aria-expanded="true"]'), 0)
	e.preventDefault()
	
	
	$(this).attr('aria-expanded', 'true')
	$(this).next('.expandable-body').removeClass('d-none');
	loadSubRequest(this, $(this).attr('data-load'));
	//e.preventDefault() ;
	alert('ici') ;
	return false ;
});

$(document).on('click', '[data-widget="expandable-table"][aria-expanded="true"]', function(e) {
	e.preventDefault()
    alert('ici2');
	alert(this);
	$(this).attr('aria-expanded', 'false')
	$(this).next('.expandable-body').addClass('d-none')
	// $(this).next('.expandable-body').find('.body-collapse').html('<div class="w-100 text-center">Empty data.</div>')
	loadSubRequest(this, 0)
});
*/

$(document).on('click', '#btn-search-accordion', function(e) {
	alert('ici2') ;
	e.preventDefault()
	loadRequest(1)
});

$(document).on('keyup', '#search-accordion', function(e) {
	//alert('ici3') ;
	e.preventDefault()
	if (e.key === 'Enter' || e.keyCode === 13) loadRequest(1)
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
  </script>

@endsection