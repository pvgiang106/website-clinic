$(".btn-ajax-addFriend").click(function() {
	$.ajax({
		url: $(this).attr("data-url"),
		type: 'POST'
	})
	.done(function() {
		$(".btn-ajax-addFriend").hide('slow');
		console.log("success");
	})
	.fail(function() {
		alert("error .btn-ajax-addFriend");
	});	
});// end click