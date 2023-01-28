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
<body>
<p></p>
<div class="container p-3 bg-light vh-100 oy-auto">
<h5>Edition validation demande</h5>
<a href="<?php echo url("approbation_type_demande");?>" class="btn btn-info ml-3">Retour</a>
<a href="<?php echo url("/home");?>" class="btn btn-success btn-add ml-3" id="add-new-entite">Ajout Type Demande</a>
<p></p>
@php $id = $type_request->id."_".$tool->id @endphp

		<form method="POST" action="{{ route('typerequest.updateapprobation',$id) }}">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="text" class="form-control" name="type_request_name" value="{{ $type_request->name}}" disabled>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="tool_name" value="{{ $tool->name }}" disabled>
		
		</div>
		<div class="form-group">
			
				<div class="border-row">
					<label>Choisir les entités qui valident</label>
						<div class="input-group mb-3">
							<select name="entity_demande" id="entity_demande" class="form-control form-control-sm bg-white" aria-describedby="basic-addon2">
							@foreach($entities as $entity)
								<option value="{{ $entity->id }}">{{ $entity->name }}</option>
							@endforeach
							</select>
							<div class="input-group-append cursor-pointer" id="btn-add-order">
								<span class="input-group-text" id="basic-addon2"><i class="fas fa-plus" title="Ajouter"></i></span>
							</div>
						</div>
								<hr class="w-100 mt-3">
								<label>Ordre de validation des entités</label>
								<ul class="ul-entity" id="list-entity">
								@foreach($toApprobation as $approbation)                      
									<li class="ui-state-default ui-sortable-handle bg-secondary text-white" data-value="{{$approbation->entity_id}}"><span class="entity-text">{{$approbation->entity_name}}</span> <i class="fas fa-times float-right cursor-pointer remove-entity" title="Supprimer"></i></li>
								@endforeach
								</ul>
				</div>
			
				
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 mt-4 mb-4 hide-data" id="data">
					<label><b>Output data</b></label>
					<pre class="bg-white p-2 output"></pre>
				</div>
		</div>
		<div class="form-group">
			<input type="hidden" class="form-control" name="listeplateforme" id="listeplateforme" value="">
			
		</div>
		<br>
		<button type="submit" class="btn btn-primary">Sauvegarder les informations</button>
			
		</form>
</div>
<script type="text/javascript">
    	$(document).ready(function() {
    		// data source de l'autocomplétion du type de demande
            //remplissage zone de text concatenation
            reOrderEntity();
            let data_entity = getDataEntities();
            
            $('#listeplateforme').val(data_entity.toString());
            // effacement entité par defaut 
			$( "li" ).each(function( index ) {
				
				//console.log( index + ": " + $( this ).text() );
				let value_entity_default = $(this).text();
				//alert(value_entity_default);
				let id_entity = $(this).attr("data-value");
				//alert(id_entity);
				///
				$('#entity_demande option').each(function(index,element){
					if(element.value == id_entity)
						$(this).remove();
					//console.log(index);
					//console.log(element.value);
					//console.log(element.text);
				});
				
				///
				
				
			})
			
    		var availableTags = [
                { label: "Demande donnée", val: 4 }
    		]
    		// fonction autocomplétion du type de demande avec action
	        $('[name="search_type_demande"]').autocomplete({
	            source: availableTags,
	            focus: function( event, ui ) {
	                return false
	            },
	            select: function( event, ui ) {
	                $('#demande').html('<p class="badge badge-secondary mb-0 px-3 py-2 w-100 type_demande" data-demande="'+ui.item.val+'">'
			        			+'<bal class="txt float-left bal">'+ui.item.label+'</bal>'
			        			+'<bal class="ml-2 float-right bal">'
			        				+'<i class="fas fa-pencil-alt item-bal edit-type_demande" title="Modifier"></i>'
			        			+'</bal>'
			        		+'</p>')
	                $('[name="search_type_demande"]').val('').hide()
	                return false
	            }
	        })

	        // évènement click de changement de demande
	        $(document).on('click', '.edit-type_demande', function(e) {
	        	e.preventDefault()
	        	$(this).closest('.type_demande').remove()
	        	$('[name="search_type_demande"]').val('').fadeIn(100)
	        })

	        // évènement click de suppression d'une entité dans l'ordre de validation
	        $(document).on('click', '.remove-entity', function(e) {
	        	e.preventDefault()
	        	let li = $(this).closest('.ui-state-default')
	        	let value = li.attr('data-value')
	        	let text = li.find('.entity-text').text()
	        	li.remove()
	        	reOrderEntity()
	        	$('[name="entity_demande"]').append('<option value="'+value+'">'+text+'</option>')
                ///////////////
				var options = $("#entity_demande option");                    // Collect options         
				options.detach().sort(function(a,b) {               // Detach from select, then Sort
					var at = $(a).text();
					var bt = $(b).text();         
					return (at > bt)?1:((at < bt)?-1:0);            // Tell the sort function how to order
				});
				options.appendTo("#entity_demande");  
								
				//////////////////
                let data_entity = getDataEntities();
                $('#listeplateforme').val(data_entity.toString());
                
	        })

	        // évènement click de l'ajout d'une entité vers l'ordre de validation
	        $(document).on('click', '#btn-add-order', function(e) {
	        	e.preventDefault()
	        	let itemValue = $('[name="entity_demande"]').val()
	        	let itemText = $('[name="entity_demande"]').find('option:selected').text()
	        	if (itemValue !== null) {
		        	$('[name="entity_demande"]').find('option:selected').remove()
		        	$('#list-entity').append('<li class="ui-state-default ui-sortable-handle bg-secondary text-white" data-value="'+itemValue+'"><span class="entity-text">'+itemText+'</span> <i class="fas fa-times float-right cursor-pointer remove-entity" title="Supprimer"></i></li>')
		        	// recalculer les rangs
		        	reOrderEntity()
		        } else {
		        	Swal.fire({
			            title: '',
			            html: '<span class="text-danger">Aucune entité disponible.</span>',
			            icon: 'error',
			            showCancelButton: false,
						confirmButtonText: 'OK',
			            allowOutsideClick: false
			        })
		        }
                let data_entity = getDataEntities();
                $('#listeplateforme').val(data_entity.toString());
               
	        })

	        // mettre l'ordre de validation déplaçable selon l'ordre voulu
			$( "#list-entity" ).sortable({
				placeholder: "ui-state-highlight",
                //alert("glissement");
				update: function( event, ui ) {
					// recalculer les rangs quand on déplace un élément
					reOrderEntity();
                    let data_entity = getDataEntities();
                    $('#listeplateforme').val(data_entity.toString());
                    //console.log("mikisaka");
				}
			});
			// désactiver la sélection dans les éléments dans l'ordre de validation
			$( "#list-entity" ).disableSelection();

			// évènement click enregistrer
	        $(document).on('click', '#btn-save', function(e) {
	        	e.preventDefault()
	        	let search_type_demande = $('[name="search_type_demande"]').val()
	        	let type_demande = $('#demande').find('.type_demande')
	        	let entite_demande = $('#list-entity').find('li.ui-state-default')
	        	if (type_demande.length > 0 || (type_demande.length == 0 && search_type_demande != '')) {
		        	is_demande_choosen = false
		        	if (type_demande.length > 0) {
		        		is_demande_choosen = true
		        		type_demande = type_demande.attr('data-demande')
		        	} else type_demande = search_type_demande;
		        	if (entite_demande.length > 0) {
		        		Swal.fire({
			                title: 'Enregistrer ces données?',
			                html: '<span class="text-danger">This action is irreversible.</span>',
			                icon: 'question',
			                showCancelButton: true,
			                confirmButtonText: 'Yes',
			                cancelButtonText: 'No',
			                allowOutsideClick: false
			            }).then((result) => {
			                if (result.isConfirmed) {
				        		let data_entity = getDataEntities()
				        		let data = {
				        			demande: {
				        				is_choosen: is_demande_choosen,
				        				value: type_demande
				        			},
				        			entity: data_entity
				        		}
				        		// afficher le data formaté dans la page
				        		$('#data').find('pre').text(JSON.stringify(data, null, 4))
				        		$('#data').fadeIn(100)
				        		// afficher le data dans la console (pour plus de détail)
				        		console.log(data)
				        		// finaliser l'enregistrement
				        		saveParameters(data)
			                }
			            })
		        	} else {
		        		Swal.fire({
				            title: '',
				            html: '<span class="text-danger">Vous n\'avez choisi aucune entité.</span>',
				            icon: 'error',
				            showCancelButton: false,
							confirmButtonText: 'OK',
				            allowOutsideClick: false
				        })
		        	}
	        	} else {
	        		Swal.fire({
			            title: '',
			            html: '<span class="text-danger">Vérifiez le type de demande.</span>',
			            icon: 'error',
			            showCancelButton: false,
						confirmButtonText: 'OK',
			            allowOutsideClick: false
			        })
	        	}
	        })
    	})

    	// fonction pour calculer les rangs
    	function reOrderEntity() {
    		let it = 0
        	$('#list-entity').find('li.ui-state-default').each(function() {
        		it++
        		$(this).attr('data-rank', it)
        	})
    	}

    	// fonction pour recevoir et formater les entités avec leurs rangs respectifs
    	function getDataEntities() {
    		let entity = []
        	$('#list-entity').find('li.ui-state-default').each(function() {
        		let value = $(this).attr('data-value')
        		let rank = $(this).attr('data-rank')
                value_rank = value+'_'+rank
        		/*tmp_entity = {
        			value: value,
        			rank: rank,
        		}*/
        		//entity.push(tmp_entity)
                entity.push(value_rank)
        	})
        	return entity
    	}

    	// fonction pour finaliser l'enregistrement
    	function saveParameters(data) {
    		// mettez ici les scripts d'enregistrement
            alert('ici');
            document.location.href = "/type_demande" ;
    	}
    </script>
</body>
</html>