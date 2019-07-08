jQuery(document).ready(function($)
{
	if($('#product').length)
	{
	    $('#product').on('click', '.delete', function(){
	        var confirm = window.confirm('Delete product: ' + $(this).data('name') + ' ?');

	        if (confirm){
	            $('.mask-submitted-container').show();
	            $.ajax({
	                method: 'POST',
	                dataType: 'json',
	                url: base_url + 'backend/product/delete/' + $(this).data('id'),
	                success: function( res ) {
	                    if(res.status == 1){
	                        if($('#product').DataTable().ajax.reload()){
	                            $('.mask-submitted-container').hide();
	                        }
	                    }else{
	                        alert(res.message);
	                        $('.mask-submitted-container').hide();
	                    }
	                },
	                error: function ( msg ) {
	                    alert("An error occured. Please contact your system administrator");
	                    console.log(msg);
	                    $('.mask-submitted-container').hide();
	                }
	            });
	        }
	    });
	}

	$(".price").number( true, 0 );

	if($('#tr_add').length) {
		var $tr_id = 3;
		$('#tr_add_btn').on('click', function(e) {
			$tr_id = $tr_id+1;
			e.preventDefault();
			var $cloned_tr = $('#tr_clone').clone(true),
				random_id = Math.random().toString(36).substr(2, 9);
			$($cloned_tr).find('input').each(function(e)
			{
				clone_input_tr_name = $(this).attr('name').replace('metaadd','meta');
				$(this).attr('name',clone_input_tr_name);
			});

			$cloned_tr.removeAttr('style');
			$cloned_tr.insertBefore($('#tr_add'));
		})
	}
	if($('#tr_add_detail').length) {
		var $tr_id = 3;
		$('#tr_add_btn_detail').on('click', function(e) {
			$tr_id = $tr_id+1;
			e.preventDefault();
			var $cloned_tr = $('#tr_clone_detail').clone(true),
				random_id = Math.random().toString(36).substr(2, 9);
			$($cloned_tr).find('input').each(function(e)
			{
				clone_input_tr_name = $(this).attr('name').replace('metaadd','meta');
				$(this).attr('name',clone_input_tr_name);
			});
				
			$cloned_tr.removeAttr('style');
			$cloned_tr.insertBefore($('#tr_add_detail'));
		})
	}
	if($('.tr_remove').length) {
		$('.tr_remove').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').remove();
		})
	}
});