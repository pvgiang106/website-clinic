$(document).ready(function() {

	
  $("#status-post-content").keypress(function(e) 
    {   
        if (e.keyCode == 13 && !e.shiftKey)
        {        
            e.preventDefault();

            if ($(this).val().length > 0){
                // $("#form-status-post").submit();
                $('#btn-text').trigger('click');
            }
            return;
        }
  });

});