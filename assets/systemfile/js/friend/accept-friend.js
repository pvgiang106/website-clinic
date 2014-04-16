$(document).ready(function() {

	$(document).on('click', '.btn-accept', function(event) {
		
		event.preventDefault();


		// var htmlString =   "<li>"
		// 			          +"<a href='javascript:void(0)' onclick='javascript:chatWith('" + username + "')'>"
		// 			            +"<img src='" + avatar + "' class='img-rounded recommend-friend-image' />"
		// 			            +"&nbsp;&nbsp;" + username
		// 			          +"</a>"
		// 			        +"</li>";

		var mURL = $(this).attr('data-href');
		var $liHide = $(this).closest('li');
		$.ajax({
			url: mURL,
			type: 'POST'
		})
		.done(function() {

			$liHide.next('li').hide('fast');
			$liHide.hide('slow');
	          var numWaitAccept = $("#numWaitAccept");
	          var num = parseInt(numWaitAccept.text(), 10);
	          num--;
	          numWaitAccept.text(num);		
		})
		.fail(function() {
			// alert("error");
			console.log("error accept-friend");
		})
		.always(function() {
			// console.log("complete");
		});
		
	});
});