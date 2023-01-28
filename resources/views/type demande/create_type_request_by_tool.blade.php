@extends('layouts.appnew')
@section('content')




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col">
           
            
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
              <h3 class="card-title">Création type demande</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                
                  <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 mt-3">
                    <div class="border-row">
                      <label>Type de demande</label>
                      <input type="text" name="search_type_demande" placeholder="Chercher ou créer..." class="form-control form-control-sm bg-white">
                      <div class="w-100 mt-2" id="demande"></div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 mt-3">
                    <div class="border-row">
                      <label>Description</label>
                      <textarea name="description" id="description" class="form-control form-control-sm bg-white"></textarea>
                      
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 mt-3">
                    <div class="border-row">
                      <label>Choisir et ajouter les outils</label>
                      <div class="input-group mb-3">
                      <select name="entity_demande" class="form-control form-control-sm bg-white" aria-describedby="basic-addon2">
                        
                        <option value="">Sélectionner l'outil</option>
                        <?php foreach($tools as $tool) {?>
                        <option value="{{$tool->id}}">{{$tool->name}}</option>
                        <?php } ?>
                      </select>
                  <div class="input-group-append cursor-pointer" id="btn-add-order">
                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-plus" title="Ajouter"></i></span>
                  </div>
                  </div>
                      <hr class="w-100 mt-3">
                      <label>Liste des outils concernés</label>
                      <ul class="ul-entity" id="list-entity"></ul>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 mt-2 mb-2">
                    <hr class="w-100">
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 text-center">
                  
                    <button id="btn-save" class="btn btn-primary">Enregistrer</button>
                    <p></p>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-sm-12 mt-4 mb-4 hide-data" id="data">
                    <label><b>Output data</b></label>
                    <pre class="bg-white p-2 output"></pre>
                  </div>
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
      $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        }); 
      $(document).ready(function() {
        // data source de l'autocomplétion du type de demande
        /*var availableTagsold = [
          { label: "Demande de compte", val: 1 },
          { label: "Demande modification formulaire", val: 2 },
          { label: "Demande mises à jour formation sanitaire", val: 3 },
          { label: "Demande donnée", val: 4 }
        ]*/
        var availableTags = <?php echo $dataTypeRequestAutocomplete; ?>
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
          })

          // mettre l'ordre de validation déplaçable selon l'ordre voulu
      $( "#list-entity" ).sortable({
        placeholder: "ui-state-highlight",
        update: function( event, ui ) {
          // recalculer les rangs quand on déplace un élément
          reOrderEntity()
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
                      title: 'Enregistrer ces donnees?',
                      html: '<span class="text-danger">This action is irreversible.</span>',
                      icon: 'question',
                      showCancelButton: true,
                      confirmButtonText: 'Yes',
                      cancelButtonText: 'No',
                      allowOutsideClick: false
                  }).then((result) => {
                      if (result.isConfirmed) {
                    let data_entity = getDataEntities()
                    /*let data = {
                      demande: {
                        is_choosen: is_demande_choosen,
                        value: type_demande
                      },
                      tool: data_entity
                    }*/
                    let data = is_demande_choosen+"_"+type_demande+"|"+data_entity
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
        //let entity = []
          let entity = ""
          $('#list-entity').find('li.ui-state-default').each(function() {
            let value = $(this).attr('data-value')
            let rank = $(this).attr('data-rank')
            /*tmp_entity = {
              value: value,
              rank: rank,
            }*/
            //tmp_entity = value+'_'+rank
            tmp_entity = value
            //entity.push(tmp_entity)
            if (entity == ""){
                entity = tmp_entity
            }
            else entity = entity+":"+tmp_entity
          })
          return entity
      }

      // fonction pour finaliser l'enregistrement
      function saveParameters(data) {
       //alert('pass test');
       let description = $('textarea#description').val();
       $.ajax({
            //data: $('#entityForm').serialize()+"&other="+,
            //data: testval+"&other="+data4,
            data: {data: data, description:description},
           
            url: "<?php echo url("type_demande/create"); ?>",
            type: "POST",
            async:false,
            dataType:"text",
            //dataType: 'json',
            success: function (data) {
                //alert(data);
                location.href = '<?php echo url("typerequestdatatable");?>';
                //location.reload();
               
            },
            error: function (data) {
                console.log('Error:', data);
                
            }
      });
        

      }
    </script>

@endsection

