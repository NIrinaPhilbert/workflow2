(function($){
  notificationActionCount()
  $(document).on('click', '.item-notification', function(e) {
    e.preventDefault()
    if ($(this).hasClass('unread')) {
	    $(this).removeClass('unread').addClass('read')
	    notificationActionCount()
	}
	window.location.href = $(this).attr('href')
  })
  $(document).on('click', 'table.table-readable tr.unread', function(e) {
    // e.preventDefault()
    $(this).removeClass('unread').addClass('read')
  })
  $(document).on('click', '.item-tr .btn-delete', function(e) {
    e.preventDefault()
    let _this = $(this)
    Swal.fire({
		html: '<span class="text-lg">Delete this row ?</span>',
		icon: 'question',
		showCancelButton: true,
		confirmButtonText: 'Yes',
		cancelButtonText: 'No'
	}).then((result) => {
		if (result.isConfirmed) {
			showMsg('success', '', '<div class="text-lg pb-2">Row is successfully deleted.</div>', 3000)
			_this.closest('.item-tr').remove()
		}
	})
  })
})(jQuery);

function notificationActionCount() {
	let nbUnread = $('.notification').find('.item-notification.unread').length
  	if (nbUnread > 0) $('.nb-notification').html(nbUnread).show()
  	else $('.nb-notification').html('').hide()
}

function showMsg(icon, title, text, timer) {
	Swal.fire({
		icon: icon,
		title: title,
		html: text,
		showConfirmButton: false,
		showCancelButton: false,
		timer: timer
	})
}