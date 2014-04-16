$(document).ready(function() {
	
	$(".txt-comment").keypress(function(e) 
    {
		
        if (e.keyCode == 13 && !e.shiftKey)
        {
            e.preventDefault();
          
            if ($(this).val().length > 0)
            {
                // alert( $(this).parents('form').attr('class') );
                $(this).parents('form').submit();
            }
            return;
        }//end if
	});
});