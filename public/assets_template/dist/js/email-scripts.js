(function($){
	$("#user_autoemail").select2({
    	width: '100%',
    	minimumInputLength: 1,
    	templateResult: formatState,
    	tags: [],
    	ajax: {
			url: 'rest/modules/lte.php?got=list',
			dataType: 'json',
			// type: "GET",
			type: 'post',
			// data: { users: $("#user_autoemail").val() }
			data: function (params) {
	            return {
	                searchTerm: params.term
	            };
	        },
	        processResults: function (response) {
				return {
					results: response
				};
			},
			cache: true
		}
    })
    $('#user_autoemail').on('select2:select', function(e) {
		e.preventDefault()
		var data = e.params.data
		if (data.id == 0) addNewUser(data.text, data.label)
		// console.log('select : '+data.id)
	})
	$('#user_autoemail').on('select2:unselect', function(e) {
		e.preventDefault()
		var data = e.params.data
		// console.log('unselect : '+data.id)
	})
	$('#btn-output').on('click', function(e) {
		e.preventDefault()
		$('#output-data').text(JSON.stringify($('#user_autoemail').val(), null, "\t"))
	})
})(jQuery);

function formatState (state) {
	var baseUrl = "assets/dist/img"
	if (!state.icon && validateEmail(state.text)) {
		var formattedText = state.text.split('@')
		state.label = state.text
		state.text = formattedText[0]
		state.id = 0
		var formattedData = '<div class="form-inline ml-2">'
								+'<img src="' + baseUrl + '/user-default.png" class="img-circle" width="40" height="40" />'
								+'<div class="text-left ml-2">'
									+'<span class="text-md w-100 text-left">' + formattedText[0] + '</span><br/>'
									+'<span class="text-sm w-100 text-left">' + state.label + '</span>'
								+'</div>'
								+'<div class="text-lg float-right position-absolute" style="right:1rem;"><i class="fas fa-plus"></i></div>'
							+'</div>'
	} else if (state.icon) {
		var formattedData = '<div class="form-inline ml-2">'
								+'<img src="' + baseUrl + '/' + state.icon + '" class="img-circle" width="40" height="40" />'
								+'<div class="text-left ml-2">'
									+'<span class="text-md w-100 text-left">' + state.text + '</span><br/>'
									+'<span class="text-sm w-100 text-left">' + state.label + '</span>'
								+'</div>'
							+'</div>'
	} else {
		return false;
	}
	var $state = $(formattedData)
	return $state
};

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function addNewUser(name, email) {
	$.ajax({
        type: 'ajax',
        method: 'post',
        url: "rest/modules/lte.php?got=add",
        data: { name: name, email: email },
        dataType: 'json',
        async: true,
        success: function(data){
        	if (!data.success) alert("Error!!! Unable to add this item.")
        	else {
        		$('#user_autoemail option[value="0"]').attr({'value': data.addedID, 'selected': true})
        		// $('#user_autoemail').val(data.addedID)
        		$("#user_autoemail").select2({
			    	width: '100%',
			    	minimumInputLength: 1,
			    	templateResult: formatState,
			    	tags: [],
			    	ajax: {
						url: 'rest/modules/lte.php?got=list',
						dataType: 'json',
						// type: "GET",
						type: 'post',
						// data: { users: $("#user_autoemail").val() }
						data: function (params) {
				            return {
				                searchTerm: params.term
				            };
				        },
				        processResults: function (response) {
							return {
								results: response
							};
						},
						cache: true
					}
			    }).trigger('change')
        	}
        },
        error: function(data) {
            alert("Error!!! Something wrong.")
        }
    });
}