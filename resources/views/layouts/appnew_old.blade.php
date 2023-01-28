<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MSANP WORKFLOW SNIS</title>

  <!-- Google Font: Source Sans Pro -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <!------script pour type demande -------------------->
    <script type="text/javascript" src="{{ asset('js/assets_js/js/jquery.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/jquery-ui.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/all.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/popper.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/bootstrap.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/assets_js/js/sweetalert2.js') }}" defer></script>
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('css/css_template/all_templ.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/css_template/OverlayScrollbars_templ.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/css_template/adminlte_templ.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/css_template/icheck-bootstrap_templ.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/css_template/auth-style_templ.css') }}">
  <!-----------style css pour type demande ------------------>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/assets_js/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-----------fin style css pour type demande--------------->
   
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('css/img_template/loader.gif') }}" alt="MSANP wf" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light bg-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" class="nav-link">Accueil</a>
      </li>
	  <li class="nav-item dropdown">
        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">Demande</a>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="request/{{ Session::get('s_entityid_user') }}">Demande envoyé</a>
			<a class="dropdown-item" href="#">Demande en attente validation</a>
			<a class="dropdown-item" href="#">Demande en attente traitement</a>
			
		</div>
		
      </li>
	  <li class="nav-item dropdown">
        <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">Paramètres</a>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="#">Libellé situation demande</a>
			<a class="dropdown-item" href="#">Libellé Etat validation demande</a>
			<a class="dropdown-item" href="#">Utilisateur</a>
			<a class="dropdown-item" href="#">Validation type demande</a>
			<a class="dropdown-item" href="#">Type demande</a>
			<a class="dropdown-item" href="#">Outil</a>
			<a class="dropdown-item" href="#">Entité</a>
		</div>
		
      </li>
      
	  <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>
	  </li>
      <?php $user_name = Auth::user()->name;?>
      <?php $entite_user = Session::get('s_entityid_user');?>
      <?php $entite_user = Session::get('s_entityname_user');?>
      
      <li class="nav-item">
		<a class="nav-link btn btn" href="#"></a>
	  </li>
    </ul>
   
    <button type="button" class="btn btn-outline-info"> Bienvenue <?php echo $user_name.' ['.$entite_user.']';?></button>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
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
	              <img src="assets/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
	              <img src="assets/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
	              <img src="assets/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
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
              <img src="assets/dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info mt-3">
              <label class="d-block">{{ Auth::user()->name }}</label>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-eye"></i><span class="ml-2">Voir profil</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" class="dropdown-item"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="fas fa-power-off"></i><span class="ml-2">Déconnexion</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('css/img_template/AdminLTELogo.png') }}" alt="MSANP Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">WORKFLOW SNIS</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class=" btn btn-success mb-2">MENU</li>
		  <li class="nav-item">
            <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("request/{$vSessionEntityUser}");?>" class="nav-link active">
              <i class="nav-icon fa fa-paper-plane"></i>
              <p>
                Liste demande envoyé
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("pendingrequest/{$vSessionEntityUser}");?>" class="nav-link active">
              <i class="nav-icon fa fa-check-square"></i>
              <p>
                Liste demande en attente validation
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("processingrequest");?>" class="nav-link active">
              <i class="nav-icon fa fa-play-circle"></i>
              <p>
                Liste demande en attente traitement
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url("userdatatable");?>" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Utilisateur
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="template_table.html" class="nav-link active">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Libellé Situation demande
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="template_table.html" class="nav-link active">
              <i class="nav-icon fas fa-info"></i>
              <p>
                Libellé Etat validation demande
              </p>
            </a>
          </li>
		   <li class="nav-item">
            <a href="<?php echo url("approbation_type_demande");?>" class="nav-link active">
              <i class="nav-icon fa fa-gears"></i>
              <p>
                Validation type demande
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url("typerequestdatatable");?>" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding"></i>
              <p>
                Type demande
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url("tooldatatable");?>" class="nav-link active">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>
                Outil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo url("entitydatatable");?>" class="nav-link active">
              <i class="nav-icon fa fa-institution"></i>
              <p>
                Entité
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
  <div>
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2022 <a href="https://www.sante.gov.mg">MSANP.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script type="text/javascript" src="{{ asset('js/js_template/jquery_templ.min.js') }}" defer></script>
<!-- Bootstrap -->
<script type="text/javascript" src="{{ asset('js/js_template/bootstrap_templ.bundle.min.js') }}" defer></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{ asset('js/js_template/jquery_templ.overlayScrollbars.min.js') }}" defer></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{ asset('js/js_template/adminlte_templ.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/js_template/sweetalert2_templ.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/js_template/my-scripts_templ.js') }}" defer></script>

</body>
</html>