
$(".wbb_ajx_delete_entry").click(function(){
	//$("#result").html(ajax_load);
	$(this).fastConfirm({
		position:     "right",
		questionText: "Are you sure?",
		unique:       true,
		onProceed:    function(trigger) {
			$.ajax({
				type:     'GET',
				url:      $(trigger).attr('href') + '.json',
				dataType: 'json',
				success:  function(json) {
					if(!json.code) {
						alert( json[0].message ? json[0].message : 'Something went terribly wrong, server side.');
					}
					else {
				    	$(trigger).closest('tr').fadeOut('slow');
					}
				    //$("#result").html(result);
				 }
			});
			$(trigger).fastConfirm('close');
		}
	});
		
	return false;
});



/*

$('button.fos_comment_comment_reply_show_form').live('click', function() {
    var $button = $(this);
    var $container = $button.parent().addClass('replying');
    var $reply = $('div.fos_comment_reply_prototype').clone()
        .removeClass('fos_comment_reply_prototype')
        .find('.fos_comment_reply_name_placeholder').text($button.attr('data-name')).end()
        .find('input[name=reply_to]').val($button.attr('data-id')).end()
        .find('.fos_comment_reply_cancel').click(function() {
            $reply.remove();
            $container.removeClass('replying');
        }).end()
        .appendTo($container)
        .find('textarea').focus().end();
});
*/