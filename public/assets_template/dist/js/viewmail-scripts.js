(function($){
	var attach_name = $('.mailbox-attachment-name');
	var attach_name_height = 25;
	if (attach_name.length) {
		attach_name.each(function() {
			attach_name_height = ($(this).height() > attach_name_height) ? $(this).height() : attach_name_height;
		});
	}
	attach_name.css({'height':(attach_name_height+5)+'px'});
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
})(jQuery);