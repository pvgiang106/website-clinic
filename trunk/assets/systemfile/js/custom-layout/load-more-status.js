$(document).ready(function() 
{
  $(window).scroll(function() 
  {
   if($(window).scrollTop() + $(window).height() == $(document).height()) 
   {
       // alert("bottom!");
       // var imageLoading =  "<div class='row image-load-more-status'>"
       //                        +"<img src='" + base_url + "images/load_more_status.gif" + "' />"
       //                    +"</div>";
       // $("#status").append(imageLoading);
       // $(".row image-load-more-status").delay(5000).fadeOut('slow', "swing");

      $.ajax({
        url: site_url + 'home/loadMoreStatus',
        type: 'GET',
        dataType: 'json'
      })
      .done(function (response, textStatus, jqXHR)
      {
          if(response != 0)
          {
            // alert(response[0]['statusID'] + response[1]['statusID'] + response[2]['statusID']); 
            var htmlMoreStatus = "";

            for (var i = 0; i < response.length; i++) {
            

            htmlMoreStatus += "<div id='" + response[i]['statusID'] + "' class='status-message'>"
                          +"<div class='message-header'>"
                            +"<div class='user-image'>"
                              +"<a href='#'>"
                                +"<img src='" + base_url + response[i]['avatar'] + "'class='img-circle'>"
                              +"</a>"
                            +"</div>"
                            +"<div class='user-info'>"
                              +"<span class='user-info-name'>"
                                +"<a href='#'>" + response[i]['username'] + "</a>"
                              +"</span>"
                              +"<span class='user-info-date'>" + response[i]['time'] + "</span>"
                            +"</div>"
                          +"</div>"
                          +"<hr />"
                          +"<div class='message-body'>";


                          if(response[i]['isImage'] == 0)
                          {
                             htmlMoreStatus += "<div class='expandable'>"
                                                +"<p class='message-content'>" + response[i]['content'] + "</p>"
                                              +"</div>";
                          }
                          else
                          {
                             htmlMoreStatus += "<img class='img-post' src='" + base_url + response[i]['content'] + "'/>";
                          }



            htmlMoreStatus += "<p>"
                              +"<form class='form-like' action='" + site_url + 'home/like/' + response[i]['statusID'] + "' method='post' accept-charset='utf-8'>"
                                +"<button type='submit' class='btn btn-xs btn-danger btn-like'>"
                                  +"<span class='glyphicon glyphicon-thumbs-up'>0</span>"
                                +"</button>"
                              +"</form>"
                              +"<form class='form-share' action='" + site_url + 'home/share/' + response[i]['statusID'] + "' method='post' accept-charset='utf-8'>"
                                +"<button type='submit' class='btn btn-xs btn-primary btn-share'>"
                                  +"<span class='glyphicon glyphicon-share-alt'>0</span>"
                                +"</button>"
                              +"</form>"
                            +"</p>"
                            +"<div>"
                              +"<form class='form-comment' role='form' action='" + site_url + 'home/commentForStatus/' + response[i]['statusID'] + "' method='post' accept-charset='utf-8'>"
                                +"<div class='form-group'>"
                                  +"<textarea name='txtComment' rows='1' cols='50' class='form-control txt-comment' placeholder='Enter comment...'></textarea>"
                                +"</div>"
                              +"</form>"
                            +"</div>"
                          +"</div>"
                          +"<hr />"
                        +"</div>";

            };// end for

            $("#status-list").append(htmlMoreStatus);




          }// end if response[i] != 0
      })// end .done
      .fail(function (response, textStatus, jqXHR){
        alert('error load more :)');
      })// end .fail
      .always(function (response, textStatus, jqXHR){
      });// end .ajax

    } // end if
  });// end scroll
});// end ready