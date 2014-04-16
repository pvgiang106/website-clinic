$(document).ready(function() {

	$("#btn-list-friend-required").click(function() {

		// alert("clicked");

	    var numWaitAccept = $("#numWaitAccept");
	    var num = parseInt(numWaitAccept.text(), 10);
	    if(num > 0)
	    {
			var $liHide = $(this).closest('li');
			$.ajax({
				url: site_url + 'home/friend_controller/getListWaitAccept',
				type: 'GET',
				dataType: 'json'
			})
			.done(function (response, textStatus, jqXHR){
				var oneWaitHtml = "";
				for (var i = 0; i < response.length; i++) {
					// $("#listWaitAccept")
					   oneWaitHtml +=  "<li>"
							            +"<div class='row'>"
							              +"<div class='col-md-4 require-friend-left'>"
							                +"<img class='img-rounded image-require-friend' src='" + site_url + response[i]['avatar'] + "'>"
							              +"</div>"
							              +"<div class='col-md-2'><a href='#'>" + response[i]['username'] + "</a></div>"
							              +"<div class='col-md-6'>"
							                  +"<button data-href='" + site_url + 'home/friend_controller/acceptFriend/' + response[i]['userID'] + "' class='btn btn-success btn-sm btn-accept'>Accept</button>"
							                  +"&nbsp;&nbsp;"
							                  +"<button data-href='" + site_url + 'home/friend_controller/acceptLater/' + response[i]['userID'] + "' class='btn btn-danger btn-sm btn-accept-later'>Later</button>"
							              +"</div>"
							            +"</div>"
							          +"</li>"
							          +"<li class='divider'></li>";
				};
				$("#listWaitAccept").empty();
				$("#listWaitAccept").append(oneWaitHtml);
				// alert(response.length);
				console.log(response);
			})
			.fail(function() {
				alert("error");
			})
			.always(function() {
				console.log("complete");
			});	    	
	    }


		
	});
});