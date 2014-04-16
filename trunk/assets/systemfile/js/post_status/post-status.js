$(document).ready(function() {

     /*auto height textarea*/
      $('textarea').autosize();
      $("input[type='text']").autosize();

var request;
$("#form-status-post").submit(function()
{
    var htmlString;

    if (request) 
    {
      request.abort();
    }

    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();

    // $inputs.prop("disabled", true);

    request = $.ajax({
      url: $form.attr('action'),
      type: "post",
      // dataType: "json", 
      data: serializedData
    });/*end $.ajax post*/

    request.done(function (response, textStatus, jqXHR){

        // alert(response);
        // $inputs.prop("disabled", false);
        var action_from_comment = site_url + "home/commentForStatus/" + response[0]['statusID'];
        var contentPost = $("#status-post-content").val();

        var action_form_like = site_url + "home/like/" + response[0]['statusID'];
        var action_form_share = site_url + "home/share/" + response[0]['statusID'];

        var now = new Date();
        var strDateTime = [[AddZero(now.getDate()), AddZero(now.getMonth() + 1), now.getFullYear()].join("/"), [AddZero(now.getHours()), AddZero(now.getMinutes())].join(":"), now.getHours() >= 12 ? "PM" : "AM"].join(" ");

        //Pad given value to the left with "0"
        function AddZero(num) {
            return (num >= 0 && num < 10) ? "0" + num : num + "";
        }

        htmlString = 
        "<div class='status-message'>"
          +"<div class='message-header'>"
            +"<div class='user-image'>"
              +"<a href='#'><img src='" + base_url + user['avatar'] +  "'' class='img-circle'></a>"
            +"</div>"
            +"<div class='user-info'>"
              +"<span class='user-info-name'>"
                +"<a href='#'>" + user['username'] + "</a>"
              +"</span>"
              +"<span class='user-info-date'>" + strDateTime + "</span>"
            +"</div>"
          +"</div>"

          +"<hr />"

          +"<div class='message-body'>"
            +"<p>"+contentPost+"</p>"
            +"<p>"
                  +"<form class='form-like' action='"+action_form_like+"' method='post' accept-charset='utf-8'>"
                    +"<button type='submit' class='btn btn-xs btn-danger btn-like'>"
                      +"<span class='glyphicon glyphicon-thumbs-up'>0</span>"
                    +"</button>"
                  +"</form>"
                  +"<form class='form-share' action='"+action_form_share+"' method='post' accept-charset='utf-8'>"
                    +"<button type='submit' class='btn btn-xs btn-primary btn-share'>"
                      +"<span class='glyphicon glyphicon-thumbs-up'>0</span>"
                    +"</button>"
                  +"</form>"
            +"</p>"
            +"<div>"
              +"<form class='form-comment' role='form' action='"+action_from_comment+"' method='post' accept-charset='utf-8'>"
                +"<div class='form-group'>"
                  +"<input name='txtComment' rows='1' cols='50' class='form-control txt-comment' placeholder='Enter comment...'></input>"
                +"</div>"
              +"</form>"
            +"</div>"
          +"</div>"
        +"</div>";
        $("#status-list").prepend(htmlString);
        /*clear input status*/
        $("#status-post-content").val('');
      });/*end done $.ajax POST*/

    request.fail(function (jqXHR, textStatus, errorThrown){
        alert('error post status');
    });/*end fail POST*/

    request.always(function () {
      $inputs.prop("disabled", false);
    });/*end always POST*/
    event.preventDefault();
  });/*#form-status-post SUBMIT*/
});/*end document ready*/
