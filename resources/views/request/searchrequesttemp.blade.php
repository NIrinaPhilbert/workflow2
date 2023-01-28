<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Request Accordion</title>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="{{asset('assets_template/plugins/jquery/jquery.js')}}" defer></script>
  <script type="text/javascript" src="{{asset('assets_template/plugins/jquery/jquery.min.js')}}" defer></script>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/ekko-lightbox/ekko-lightbox.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/general.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/viewmail-style.css')}}">

  <!-- REQUIRED SCRIPTS -->


<!-- Bootstrap -->
<script type="text/javascript" src="{{asset('assets_template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{asset('assets_template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}" defer></script>
<!-- Ekko Lightbox -->
<script type="text/javascript" src="{{asset('assets_template/plugins/ekko-lightbox/ekko-lightbox.min.js')}}" defer></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{asset('assets_template/dist/js/adminlte.js')}}" defer></script>

<!-- PAGE PLUGINS -->

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center" hidden>
    <img class="animation__wobble" src="{{asset('assets_template/dist/img/loader.gif')}}" alt="MSANPLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light bg-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="" class="nav-link">
          <span class="badge badge-primary">Pending</span>
          <span class="badge badge-secondary navbar-badge nb-pending">5</span>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-primary navbar-badge nb-notification"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification">
          <span class="dropdown-item dropdown-header text-bold disabled">Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item item-notification unread">
            <!-- Notification Start -->
            <div class="media">
              <img src="{{asset('assets_template/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                </h3>
                <p class="text-sm text-ellipsis">Reaction for your post.</p>
                <p class="text-xs text-muted"><i class="far fa-clock mr-1"></i>1h</p>
              </div>
            </div>
            <!-- Notification End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item item-notification unread">
            <!-- Notification Start -->
            <div class="media">
              <img src="{{asset('assets_template/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                </h3>
                <p class="text-sm text-ellipsis">Like your comment on his post.</p>
                <p class="text-xs text-muted"><i class="far fa-clock mr-1"></i>3h 21min</p>
              </div>
            </div>
            <!-- Notification End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item item-notification read">
            <!-- Notification Start -->
            <div class="media">
              <img src="{{asset('assets_template/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                </h3>
                <p class="text-sm text-ellipsis">Send you a photo.</p>
                <p class="text-xs text-muted"><i class="far fa-clock mr-1"></i>4h 12min</p>
              </div>
            </div>
            <!-- Notification End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See all notifications</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-item dropdown-header disabled">
            <div class="image mt-2">
              <img src="{{asset('assets_template/dist/img/user8-128x128.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="info mt-3">
              <label class="d-block">MSANP </label>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-eye"></i><span class="ml-2">View profile</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-power-off"></i><span class="ml-2">Log out</span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{asset('assets_template/dist/img/AdminLTELogo.png')}}" alt="MSANPLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
      <span class="brand-text font-weight-bold text-secondary">MSANP</span><span class="brand-text font-weight-bold text-success">LTE</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-header">MENU</li>
          
          <li class="nav-item">
            <a href="template_accordion.html" class="nav-link active">
              <i class="nav-icon fas fa-list"></i>
              <p>
                example accordeon
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0">EXAMPLE ACCORDEON</h1>
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
                <h3 class="card-title"><strong>Requests list</strong></h3>
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

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>&copy; 2022 <a href="https://MSANP-tech.io" target="blank">MSANP.io</a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->



<script>
/*$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});*/
$(document).ready( function () {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      arrangePJ()
      loadRequest(1)
  }); 

$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox({
    alwaysShowClose: true
  });
});

$(document).on('click', '[data-widget="expandable-table"][aria-expanded="false"]', function(e) {
	$('[data-widget="expandable-table"][aria-expanded="true"] + .expandable-body').addClass('d-none')
	$('[data-widget="expandable-table"][aria-expanded="true"]').attr('aria-expanded', 'false')
	loadSubRequest($('[data-widget="expandable-table"][aria-expanded="true"]'), 0)
	e.preventDefault()
	$(this).attr('aria-expanded', 'true')
	$(this).next('.expandable-body').removeClass('d-none');
	loadSubRequest(this, $(this).attr('data-load'))
})

$(document).on('click', '[data-widget="expandable-table"][aria-expanded="true"]', function(e) {
	e.preventDefault()
	$(this).attr('aria-expanded', 'false')
	$(this).next('.expandable-body').addClass('d-none')
	// $(this).next('.expandable-body').find('.body-collapse').html('<div class="w-100 text-center">Empty data.</div>')
	loadSubRequest(this, 0)
})

$(document).on('click', '#btn-search-accordion', function(e) {
	e.preventDefault()
	loadRequest(1)
})

$(document).on('keyup', '#search-accordion', function(e) {
	e.preventDefault()
	if (e.key === 'Enter' || e.keyCode === 13) loadRequest(1)
})

$(document).on('click', '.pagination .page-item:not(.disabled) .page-link', function(e) {
	e.preventDefault()
	loadRequest($(this).parent('.page-item').attr('data-page'))
})

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
	$.ajax({
        type: 'ajax',
        method: 'post',
        url: "showrequestaccordionformat?got=list&page="+page,
        data: { search: $('#search-accordion').val() },
        dataType: 'json',
        async: true,
        success: function(data){
        	var tpl = ''
        	if (data.data.length > 0) {
	        	for (var i = 0; i < data.data.length; i++) {
	        		tpl += '<tr class="to-expand" data-widget="expandable-table" aria-expanded="false" data-load="'+data.data[i].id+'">'
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
	if (id == 0) {
		$(_this).next('.expandable-body').find('.body-collapse').html('')
	} else {
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

</body>
</html>