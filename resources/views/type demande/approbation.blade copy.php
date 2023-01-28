<html lang="en">
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
  <!-----------Datatable------------>
  
  
  
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('css/css_template/all_templ.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('css/css_template/OverlayScrollbars_templ.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/css_template/adminlte_templ.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/css_template/icheck-bootstrap_templ.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/css_template/auth-style_templ.css') }}">
  <!-----export button from datatable ---------------->
   
</head>
<body>
 
<div class="container">
<h2>Liste Type demande</h2>
<p></p>
<a href="<?php echo url("/home");?>" class="btn btn-info ml-3">Retour</a>
<a href="javascript:void(0)" class="btn btn-success btn-add ml-3" id="add-new-entite">Ajout processus validation</a>
<br><br>
<hr>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Type demande</th>
      <th scope="col">Plateforme</th>
      <th scope="col">Processus validation</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php $zTypeDemandePlateformeInit = ""; @endphp
    @foreach($toApprobation as $approbation) 
    @php $zTypeDemandePlateforme = $approbation->type_request_id."_".$approbation->tool_id ;@endphp
    
    <?php if(strcmp($zTypeDemandePlateforme,$zTypeDemandePlateformeInit) <> 0) {?>
    <tr>
      <th scope="row">{{$approbation->id}}</th>
      <td>{{$approbation->type_request_name}}</td>
      <td>{{$approbation->tool_name}}</td>
      <td>
      <div  class="btn-group" role="group" aria-label="Basic example"></div> 
        @foreach($toApprobation as $approbationRang)
        <?php $zTypeDemandePlateformeRang = $approbationRang->type_request_id."_".$approbationRang->tool_id; ?>
        @if(strcmp($zTypeDemandePlateforme,$zTypeDemandePlateformeRang) === 0)
          <button type="button" class="btn btn-primary"><span class="badge badge-light">{{ $approbationRang->rank}} </span>{{ $approbationRang->entity_name}}</button>
        @endif
        <?php ?>
        @endforeach
      </div>   
      </td>
      <td>
      <a href="/approbation_type_demande/edit/{{ $zTypeDemandePlateforme}}" class="btn btn-edit btn-info">Modifier</a>
      </td>
    </tr>
    @php $zTypeDemandePlateformeInit = $zTypeDemandePlateforme; @endphp
    <?php } ?>
    @endforeach
    
  </tbody>
</table>
<div class="row d-flex justify-content-center">
    
</div>

</body>
</html>