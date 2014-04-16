$(document).ready(function() {
	$(".img-transport-type").click(function() {
		
		var selectorTable = $(this).attr('id').split('-')[2];
		$("#main-content").children().hide('slow');
		$("#" + selectorTable).show('slow');
	});
});// end ready