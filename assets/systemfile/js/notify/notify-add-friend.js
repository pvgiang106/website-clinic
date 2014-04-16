    $(document).ready(function() {
      
      function doAjaxRequireFriend() {

      $.ajax({
        url: site_url + 'home/notify/getNewRequireFriend',
        type: 'GET',
        dataType: 'json'
      })
      .done(function (response, textStatus, jqXHR){

        var userID_newest_required = $.cookie('userID_newest_required');

        // console.log(response);

        if(response != 0)
        {
          if ((typeof userID_newest_required) == "undefined"
            || response['userID'] != userID_newest_required)
          {

            $.cookie('userID_newest_required', response['userID'], { expires: 7 });
   
            var numWaitAccept = $("#numWaitAccept");
            var num = parseInt(numWaitAccept.text(), 10);
            num++;
            numWaitAccept.text(num);

            new Audio(base_url + 'assets/sound_effect/notify_friend.FLV').play();

            var htmlFriend = "<li class='notify-require-friend'>"
                                +"<a>"
                                  +"<button type='button' class='close' aria-hidden='true'>&times;</button>"
                                  +"<p>" + response['username'] + " sent required add friend!</p>"
                                +"</a>" 
                             +"</li>";
            $("#notify-bottom-left").prepend(htmlFriend);
            $("#notify-bottom-left li").delay(5000).fadeOut('slow', "swing");            
          }
        }   
      })
      .fail(function (response, textStatus, jqXHR){
        // alert('error notify-add-friend');
        console.log('error notify-add-friend');
      })
      .always(function (response, textStatus, jqXHR){

        setTimeout(doAjaxRequireFriend,200); //now that the request is complete, do it again in 1 second
      });

    }
   
    doAjaxRequireFriend(); // initial call will start rigth away, every subsequent call will happen 1 second after we get a response
    });