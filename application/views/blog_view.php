<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Autocomplete</title>
<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css'?>">

</head>
<body>
<div class="container">
<div class="row">
<h2>Autocomplete Codeigniter</h2>
</div>
<div class="row">
<form>
<div class="form-group">
<label>Title</label>
<input type="text" class="cc form-control" name="cc[]"  placeholder="Title" autocomplete="off" required style="width:500px;">
<input type="text" class="cc form-control" name="cc[]" placeholder="Title" autocomplete="off" required style="width:500px;">
</div>
</form>
</div>
</div>
<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$( ".cc" ).autocomplete({
source: "<?php echo site_url('blog/get_autocomplete/?');?>",
onSelect: function (event, ui) {
          // Set selection
          jq('.cc').val(ui.item.label); // display the selected text
          jq('.cc').val(ui.item.value); // save selected id to input
          return false;
        }
});
});
</script>
</body>
</html>



<!-- Script -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <!-- jQuery UI -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
    <!--<script type='text/javascript'>
    $(document).ready(function(){

     // Initialize 
     $( ".cc" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?php //echo site_url('prpo/userList/?');?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        onSelect: function (event, ui) {
          // Set selection
          $(".cc").val(ui.item.label); // display the selected text
          $(".cc").val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
    </script>-->

    <!--<script type='text/javascript'>
    $(document).ready(function(){

     // Initialize 
     $( ".pa" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?php //echo site_url('prpo/userLista/?');?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        onSelect: function (event, ui) {
          // Set selection
          $(".pa").val(ui.item.label); // display the selected text
          $(".pa").val(ui.item.value); // save selected id to input
          return false;
        }
      });

    });
    </script>-->