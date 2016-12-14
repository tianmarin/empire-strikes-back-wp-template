jQuery(document).ready(function($) {
	// bind change event to select
	$('#post_type_home').bind('change', function () {
		var url = $(this).val(); // get selected value
		if (url) { // require a URL
			window.location = url; // redirect
		}
		return false;
	});
});