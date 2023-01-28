$('#plateforme').change(function(){
  var value = jQuery("#plateforme").val() ;
  //alert(value);
  /*$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });*/
  var iPlateformeId = jQuery("#plateforme").val() ;
  var _token = $('input[type="hidden"]').attr('value');
  $.ajax({
    type:"POST",
    url: "searchService",
    dataType:'json',
    data: {iPlateformeId : iPlateformeId , _token : _token },
    success: function(data){
        //alert(JSON.stringify(data));
        var json2=JSON.parse(JSON.stringify(data));
        //alert("id="+JSON.stringify(json2[0].id));
        //alert("name="+JSON.stringify(json2[0].name));
        $("#results").html("");
        $("#resultsTable").show();
        $.each(json2, function (key, value) {
            //alert("boucle valeur id"+value.id);
            $("#results").append('<tr><td>'+value.name+'<td><tr>');
          });
   
    }
  })

});
/*
[{"id":7,"parent_id":6,"name":"SGIS","created_at":null,"updated_at":null},
{"id":8,"parent_id":6,"name":"SPMT","created_at":null,"updated_at":null},
{"id":9,"parent_id":6,"name":"SLAB","created_at":null,"updated_at":null}
]
*/
/**************ok**************** */
$('#plateformeok').change(function(){
    var zContenuSelectRegion = "" ;
	var tzReponse = new Array() ;
	var tzRegion = new Array() ;
	var iPlateformeId = jQuery("#plateforme").val() ;
    var _token = $('input[type="hidden"]').attr('value');
    alert('plateforme='+iPlateformeId);
	jQuery.ajax({
		//url: "http://127.0.0.1:8000/searchServiceNew",
        url: "searchServiceNew",
		type: "POST",
		//dataType: "html",
        dataType: "json",
		data: {iPlateformeId : iPlateformeId , _token : _token },
		async:false,
		success: function(zReponse){
			alert('reponse='+zReponse) ;
			/*tzReponse = zReponse.split("|") ;
			for (var j=0; j < tzReponse.length; j++){
				tzRegion = tzReponse[j].split("_") ;
				if((tzRegion[0] != "") && (tzRegion[1] != "")){
					zContenuSelectRegion += "<option value='" + tzRegion[0] + "'>" + tzRegion[1] + "</option>" ;
				}
				else{
					zContenuSelectRegion += "<option value='" + "0" + "'>" + "Sans region" + "</option>" ;
				}
			}
			//alert(zContenuSelectRegion) ;
			jQuery("#selectClientRegionId").html(zContenuSelectRegion) ;*/
		}
	
	});
  
  });
    

$('#create_record').click(function(){
        $('#formModal').modal('show');
        //alert('ici');

    });
    $('#sample_form').on('submit',function(event){
        event.preventDefault();
        if($('#action_button').val() == 'Add'){
            alert('test boutton submit');
            $.ajax({
                url:"filesajax",
                method:"POST",
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                //dataType:"json",
                success:function(data){
                    alert(json.stringify(data));
                    alert(data);
                    var html = '';
                    if(data.errors)
                    {
                        html ='<div class="alert alert-danger">';
                        for(var count = 0 ; count < data.errors.lenght; count++)
                        {
                            html += '<p>'+data.errours[count] + '</p>';
                        }
                        html += '</div>';

                    }

                    if(data.success){
                        alert(data);
                        html ='<div class="alert alert-success">' 
                        + data.success + '</div>';
                        $('#sample_form')[0].reset();
                    }
                    $('#form_result').html(html);

                }
            });
        }


    });
