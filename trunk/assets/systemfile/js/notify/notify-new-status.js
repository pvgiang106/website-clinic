    $(document).ready(function() {
      
      function doAjaxRequireFriend() {

      $.ajax({
        url: site_url + 'home/notify/getNewestStatus',
        type: 'GET',
        dataType: 'json'
      })
      .done(function (response, textStatus, jqXHR){

        var newest_statusID = $.cookie('newest_statusID');

        // console.log(response);

        if(response != 0)
        {
          if ((typeof newest_statusID) == "undefined"
            || response['statusID'] != newest_statusID)
          {

var htmlNewStatus = "<div id='" + response['statusID'] + "' class='status-message'>"
              +"<div class='message-header'>"
                +"<div class='user-image'>"
                  +"<a href='#'>"
                    +"<img src='" + base_url + response['avatar'] + "'class='img-circle'>"
                  +"</a>"
                +"</div>"
                +"<div class='user-info'>"
                  +"<span class='user-info-name'>"
                    +"<a href='#'>" + response['username'] + "</a>"
                  +"</span>"
                  +"<span class='user-info-date'>" + response['time'] + "</span>"
                +"</div>"
              +"</div>"
              +"<hr />"
              +"<div class='message-body'>";


              if(response['isImage'] == 0)
              {
                 htmlNewStatus += "<div class='expandable'>"
                                    +"<p class='message-content'>" + response['content'] + "</p>"
                                  +"</div>";
              }
              else
              {
                 htmlNewStatus += "<img class='img-post' src='" + base_url + response['content'] + "'/>";
              }



htmlNewStatus += "<p>"
                  +"<form class='form-like' action='" + site_url + 'home/like/' + response['statusID'] + "' method='post' accept-charset='utf-8'>"
                    +"<button type='submit' class='btn btn-xs btn-danger btn-like'>"
                      +"<span class='glyphicon glyphicon-thumbs-up'>0</span>"
                    +"</button>"
                  +"</form>"
                  +"<form class='form-share' action='" + site_url + 'home/share/' + response['statusID'] + "' method='post' accept-charset='utf-8'>"
                    +"<button type='submit' class='btn btn-xs btn-primary btn-share'>"
                      +"<span class='glyphicon glyphicon-share-alt'>0</span>"
                    +"</button>"
                  +"</form>"
                +"</p>"
                +"<div>"
                  +"<form class='form-comment' role='form' action='" + site_url + 'home/commentForStatus/' + response['statusID'] + "' method='post' accept-charset='utf-8'>"
                    +"<div class='form-group'>"
                      +"<textarea name='txtComment' rows='1' cols='50' class='form-control txt-comment' placeholder='Enter comment...'></textarea>"
                    +"</div>"
                  +"</form>"
                +"</div>"
              +"</div>"
              +"<hr />"
            +"</div>";



            $("#status-list").prepend(htmlNewStatus);

            $.cookie('newest_statusID', response['statusID'], { expires: 7 });
   
            var numComment = $("#numComment");
            var num = parseInt(numComment.text(), 10);
            num++;
            numComment.text(num);

            new Audio(base_url + 'assets/sound_effect/notify_message.mp3').play();

            var htmlNotifyStatus = "<li class='notify-status'>"
                                +"<a href='#" + response['statusID'] + "'>"
                                  +"<button type='button' class='close' aria-hidden='true'>&times;</button>"
                                  +"<p>" + response['username'] + " posted on his wall!</p>"
                                +"</a>" 
                             +"</li>";
            $("#notify-bottom-left").prepend(htmlNotifyStatus);
            $("#notify-bottom-left li").delay(5000).fadeOut('slow', "swing");            
          }
        }   
      })
      .fail(function (response, textStatus, jqXHR){
        // alert('error notify-new-status');
        console.log('error notify-new-status');
      })
      .always(function (response, textStatus, jqXHR){

        setTimeout(doAjaxRequireFriend,1000); //now that the request is complete, do it again in 1 second
      });

    }
   
    doAjaxRequireFriend(); // initial call will start rigth away, every subsequent call will happen 1 second after we get a response
    });