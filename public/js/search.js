$(function(){
    $(document).on('click','.confirm-search',function($event){
        event.preventDefault();
        //alert('ici');
        //var plateform = $('#plateforme').val();
        var plateform = $('#plateforme').val();
        var _token = $('input[type="hidden"]').attr('value');
        alert(plateform);
        alert(_token);
        //return false;
        $.ajax({
            url:'searchService',
           // url:'/searchService',
            data:{
                plateform,
                _token
            },
            //dataType:'json',
            type:"POST",
            success:function(data1){
                alert(data1);
                //console.log(json.stringify(data1));
                alert(json.stringify(data1));
                //return false;
                $("#results").html();
                $("#resultsTable").show();
                for(let index=0;index < data.length;index++){
                    $("#results").append('<tr><td>'+data[index].service+'<td><tr>');
                }
            }
        })
    });
   
});