$(document).ready(function() {
  $(document).on('submit', '.form-addfriend', function() {

      event.preventDefault();

      var request;
      if (request) 
      {
        request.abort();
      }

      var $form = $(this);
      var $inputs = $form.find("input, select, button, textarea");
      var serializedData = $form.serialize();

      // $inputs.prop("disabled", true);

      request = $.ajax({
        url: $(this).attr('action'),
        type: "post", 
        data: serializedData,
        dataType: 'json'
      });/*end .ajax*/

      request.done(function (response, textStatus, jqXHR){
          // alert('success');

          // alert(response);
          console.log(response);
          // alert(response['avatar']);
          // alert(response[0]['avatar']);
       var htmlNewFriend = "<div class='row recommend-friend-list-friend'>"
                                  +"<div class='col-lg-3'>"
                                    +"<a href='#''>"
                                      +"<img src='" + base_url + response['avatar'] + "' class='img-rounded recommend-friend-image'>"
                                    + "</a>"
                                    +"<p><a href='#''>" + response['username'] + "</a></p>"
                                  +"</div>"
                                  +"<div class='col-lg-4'>"
                                    +"<a href='#'>You can know</a>"
                                    +"<p>"
                                      +"<form class='form-addfriend' action='" + site_url + "friend_controller/addFriend/" + response['userID'] + "' method='post' accept-charset='utf-8'>"
                                      +"<button type='submit' class='btn btn-xs btn-success btn-addFriend'>"
                                        +"<span class='glyphicon glyphicon-plus'></span> Add"
                                      +"</button>"
                                      +"</form>"
                                    +"</p>"
                                  +"</div>"
                              +"</div>"
                              +"<hr />";



          var eleHide = $form.closest('.recommend-friend-list-friend');
          eleHide.next('hr').hide('fast');
          eleHide.hide('slow');

          $("#recommend-friend-list").append(htmlNewFriend);

        });/*end done*/

      request.fail(function (jqXHR, textStatus, errorThrown){
          alert('error send request add friend');
      });/*end fail*/

      request.always(function () {
        $inputs.prop("disabled", true);
      });/*end always*/
      event.preventDefault();
    });/* end on .form-share SUBMIT*/
});/*end document ready*/