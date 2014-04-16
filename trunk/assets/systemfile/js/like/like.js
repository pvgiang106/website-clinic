$(document).ready(function() {
  $(document).on('submit', '.form-like', function() {

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
        });/*end done*/

      request.fail(function (jqXHR, textStatus, errorThrown){
          alert('fail');
      });/*end fail*/

      request.always(function () {
        $inputs.prop("disabled", true);
      });/*end always*/
      event.preventDefault();
    });/* end on .form-share SUBMIT*/
});/*end document ready*/