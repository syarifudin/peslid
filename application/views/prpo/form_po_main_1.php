<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Dynamic Form with Jquery UI datepicker</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
</head>
<body> 

    <form action="" method="post">

    <fieldset>
        <legend>Inputs</legend>
            <div id="extender"></div>
            <p><a href="#" id="add">Add</a></p>
    </fieldset>

    </form>

<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {

    //fadeout selected item and remove
    $('.remove').live('click', function() {
        $(this).parent().fadeOut(300, function(){ 
            $(this).empty();
            return false;
        });
    });

    var options = '<p>Title: <input type="text" name="titles[]" value="" size="30" />  Date: <input type="text" class="datepicker" name="dates[]" value="" size="10" />   <a href="#" class="remove">Remove</a></p>';    

    //add input
    $('a#add').click(function() {
        $(options).fadeIn("slow").appendTo('#extender'); 
        i++;    
        return false;
    });

    $('.datepicker').live('click', function() {
        $(this).datepicker('destroy').datepicker({changeMonth: true,changeYear: true,dateFormat: "yy-mm-dd",yearRange: "1900:+10",showOn:'focus'}).focus();
    });
});
</script>
</body>
</html>