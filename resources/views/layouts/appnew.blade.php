<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>MSANP WORKFLOW SNIS</title>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="{{asset('assets_template/plugins/jquery/jquery.js')}}" defer></script>
  <script type="text/javascript" src="{{asset('assets_template/plugins/jquery/jquery.min.js')}}" defer></script>
  
  
   
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/ekko-lightbox/ekko-lightbox.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/sweetalert2.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/general.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/viewmail-style.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/email-style.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/data-style.css')}}">
  <!----For email---->
  
  <!-- Autocomplete et type request validation style -->
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/jquery-ui.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets_template/dist/css/style.css')}}">
  <!-------------Summernote------------------------------->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- For file uploader -->
  <link rel="stylesheet" href="{{asset('assets_template/plugins/dropzone/min/dropzone.min.css')}}">
<!-------------------->

<!-- Bootstrap -->
<script type="text/javascript" src="{{asset('assets_template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>
<!-- DataTables  & Plugins -->
<script type="text/javascript" src="{{asset('assets_template/plugins/jquery/jquery.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables/jquery.dataTables.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/jszip/jszip.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/pdfmake/pdfmake.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/pdfmake/vfs_fonts.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-buttons/js/buttons.html5.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-buttons/js/buttons.print.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/datatables-buttons/js/buttons.colVis.min.js')}}" defer></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="{{asset('assets_template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}" defer></script>
<!---------Accordion ----------->
<!-- Ekko Lightbox -->
<script type="text/javascript" src="{{asset('assets_template/plugins/ekko-lightbox/ekko-lightbox.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/plugins/select2/js/select2.full.min.js')}}" defer></script>


<!-- AdminLTE App -->
<script type="text/javascript" src="{{asset('assets_template/dist/js/adminlte.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/dist/js/sweetalert2.js')}}" defer></script>





<!-- AUTOCOMPLETE -->
<script type="text/javascript" src="{{asset('assets_template/dist/js/jquery-ui.min.js')}}" defer></script>
<!-- BLOCKUI -->
<script type="text/javascript" src="{{asset('assets_template/dist/js/blockUI.js')}}" defer></script>
<!-- Summernote -->
<script src="{{asset('assets_template/plugins/summernote/summernote-bs4.min.js')}}" defer></script>
<!-- For file uploader -->
<script src="{{asset('assets_template/plugins/dropzone/min/dropzone.min.js')}}" defer></script>
<!-- Bootstrap -->

<script src="{{asset('assets_template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>

<!-- PAGE PLUGINS -->
<script type="text/javascript" src="{{asset('assets_template/dist/js/my-scripts.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/dist/js/viewmail-scripts.js')}}" defer></script>

<script type="text/javascript" src="{{asset('assets_template/dist/js/jspdf-1.5.3.min.js')}}" defer></script>
<script type="text/javascript" src="{{asset('assets_template/dist/js/jspdf.plugin.autotable-3.5.6.min.js')}}" defer></script>


<!-------------------->
<style type="text/css">
  .os-scrollbar-vertical{background:#c1c1c1!important;}
</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<?php $user_name = Auth::user()->name;?>
<?php $entite_user = Session::get('s_entityid_user');?>
<?php $entite_user = Session::get('s_entityname_user');?>
<?php $photo_user = Session::get('s_photo_user') ?? 'user-default.png';?>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('assets_template/dist/img/loader.gif') }}" alt="MSANP wf" height="60" width="60">
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
        <a class="nav-link dropdown-toggle" data-toggle="dropdown"  href="javascript:void(0);" onclick="$('#demande_submenu').slideToggle() ;$('#parametre_submenu').slideUp() ;">Demande</a>
		<div class="dropdown-menu" id="demande_submenu">
			<a class="dropdown-item" href="request/{{ Session::get('s_entityid_user') }}">Demande envoyé</a>
			<a class="dropdown-item" href="#">Demande en attente validation</a>
			<a class="dropdown-item" href="#">Demande en attente traitement</a>
      <a class="dropdown-item" href="#">Recherche demande</a>
			
		</div>
		
      </li>
    @can('create', App\Entity::class)
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" onclick="$('#parametre_submenu').slideToggle() ;$('#demande_submenu').slideUp() ;">Paramètres</a>
        <div class="dropdown-menu" id="parametre_submenu">
          <a class="dropdown-item" href="#">Libellé situation demande</a>
          <a class="dropdown-item" href="#">Libellé Etat validation demande</a>
          <a class="dropdown-item" href="#">Utilisateur</a>
          <a class="dropdown-item" href="#">Validation type demande</a>
          <a class="dropdown-item" href="#">Type demande</a>
          <a class="dropdown-item" href="#">Outil</a>
          <a class="dropdown-item" href="#">Entité</a>
        </div>
		
    </li>
    @endcan  
	  <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Déconnexion
                                    </a>
	  </li>
     
      
      <li class="nav-item">
		<a class="nav-link btn btn" href="#"></a>
	  </li>
    </ul>
   
    <button type="button" class="btn btn-outline-info"> Bienvenue <?php echo $user_name.' ['.$entite_user.']';?></button>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    	<!-- Notifications Dropdown Menu -->
      <!-- Menu notification --------------->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:void(0);" onclick="$('#profil_submmenu').slideToggle() ;">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="profil_submmenu">
          <div class="dropdown-item dropdown-header disabled">
            <div class="image mt-2">
              <img src="<?php echo asset('images').'/'.$photo_user; ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info mt-3">
              <label class="d-block">{{ Auth::user()->name }}</label>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <?php $user_id = Auth::id();?>
          <a href="/showprofil/{{ $user_id }}" class="dropdown-item">
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
      <img src="{{asset('assets_template/dist/img/AdminLTELogo.png')}}" alt="MSANP Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
          <!----
          <li class="nav-item">
            <a href="<?php //$vSessionEntityUser=Session::get('s_entityid_user'); echo url("searchrequest");?>" class="nav-link active">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Recherche demande
              </p>
            </a>
          </li>-->
          @can('create', App\User::class)
          <li class="nav-item">
            <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("searchstatusrequestbyentity");?>" class="nav-link active">
            
            <i class="nav-icon fas fa-list"></i>
              <p>
                Suivi validation demande par entite
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\User::class)
          <li class="nav-item">
            <a href="<?php $vSessionEntityUser=Session::get('s_entityid_user'); echo url("showprocessrequestbyentityoremp");?>" class="nav-link active">
             
            <i class="nav-icon fas fa-list"></i>
              <p>
                Suivi traitement demande par entite/personnel
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\User::class)
          <li class="nav-item">
            <a href="<?php echo url("userdatatable");?>" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Utilisateur
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\User::class)
		      <li class="nav-item">
            <a href="<?php echo url("statusrequestlist");?>" class="nav-link active">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
                Libellé Situation demande .................
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\User::class)
		      <li class="nav-item">
            <a href="<?php echo url("validationstatuslist");?>" class="nav-link active">
              <i class="nav-icon fas fa-info"></i>
              <p>
                Libellé Etat validation demande
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\validation_request::class)
		      <li class="nav-item">
            <a href="<?php echo url("approbation_type_demande");?>" class="nav-link active">
              <i class="nav-icon fa fa-gears"></i>
              <p>
                Validation type demande
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\type_request::class)
          <li class="nav-item">
            <a href="<?php echo url("typerequestdatatable");?>" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding"></i>
              <p>
                Type demande
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\Tool::class)
          <li class="nav-item">
            <a href="<?php echo url("tooldatatable");?>" class="nav-link active">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>
                Outil
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\Entity::class)
          <li class="nav-item">
            <a href="<?php echo url("entitydatatable");?>" class="nav-link active">
              <i class="nav-icon fa fa-institution"></i>
              <p>
                Entité
              </p>
            </a>
          </li>
          @endcan
          @can('create', App\User::class)
          <li class="nav-item">
            <a href="<?php echo url("showcomment");?>" class="nav-link active">
              <i class="nav-icon fa fa-institution"></i>
              <p>
                Voir commentaire
              </p>
            </a>
          </li>
          @endcan
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




</body>
</html>