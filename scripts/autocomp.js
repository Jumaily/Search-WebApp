// autocomplet : this function will be executed every time we change the text
function autocomplet(srch) {
	var min_length = 0; // min caracters to display the autocomplete
	var keyword = $('#search_keyword_id').val();
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax_refresh.php?srch='+srch,
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#search_keyword').show();
				$('#search_keyword').html(data);
			}
		});
	} else {
		$('#search_keyword').hide();
	}
}

// set_item : this function will be executed when we select an item
function set_item(item) {
	// change input value
	$('#search_keyword_id').val(item);
	// hide proposition list
	$('#search_keyword').hide();
}