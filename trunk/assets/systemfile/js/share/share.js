$(document).ready(function() {
  $(document).on('submit', '.form-share', function() {

      event.preventDefault();

      var request;
      if (request) 
      {
        request.abort();
      }

      var $form = $(this);
      var $inputs = $form.find("input, select, button, textarea");
      var serializedData = $form.serialize();

      $inputs.prop("disabled", true);

      request = $.ajax({
        url: $(this).attr('action'),
        type: "post", 
        data: serializedData
      });/*end .ajax*/

      request.done(function (response, textStatus, jqXHR){
          console.log('success');

          var mySpan = $form.find('span');
          var numShared = parseInt(mySpan.text(), 10);
          numShared++;
          mySpan.text(numShared);

            // $('.btn-share').hover(function () {
                // $form.find('.btn-share').tooltip('show').delay(1000).fadeOut('slow', "swing");
            // }, function () {
                // $(this).tooltip('hide');
            // });

        });/*end done*/

      request.fail(function (jqXHR, textStatus, errorThrown){
          alert('fail');
      });/*end fail*/

      request.always(function () {
        $form.find('.btn-share').tooltip('hide');
        $inputs.prop("disabled", true);
      });/*end always*/
      event.preventDefault();
    });/* end on .form-share SUBMIT*/
});/*end document ready*/