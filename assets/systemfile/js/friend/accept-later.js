$(document).ready(function() {
	
	$(document).on('click', '.btn-accept-later', function(event) {

		var mURL = $(this).attr('data-href');
		var $liHide = $(this).closest('li');//.attr('class'));
		$.ajax({
			url: mURL,
			type: 'POST'
		})
		.done(function() {
			// console.log("success");
			// alert($(this).closest('div').attr('class'));
			$liHide.next('li').hide('fast');
			$liHide.hide('slow');
	          var numWaitAccept = $("#numWaitAccept");
	          var num = parseInt(numWaitAccept.text(), 10);
	          num--;
	          numWaitAccept.text(num);		
		})
		.fail(function() {
			// console.log("error");
			alert("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
});