<link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css">
  <script src="<?=base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?=base_url();?>js/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="<?=base_url();?>js/bootstrap3-typeahead.min.js"></script>  
<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('prpo/create_po',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
  <tr>
    <td>Requisition Number</td>
    <td><input type='text' name='prno' class='mid'  placeholder ='' /></td>
    <td>Purchase Order Number</td>
    <td><input type='text' name='pono' class='mid'  placeholder ='' /></td>
    <td><input type='submit' value='Create Purchase Order' name='CPO'></td>
  </tr>
</table>
<style>
input{
    font-size: 14px;
    font-family: monospace;
    height: 21px;
}
table {
    width: 100%;
		font-family: monospace;
    font-size: 15px;
}
</style>
<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript">
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.prno').autocomplete({
      source: "<?php echo site_url('blog/get_prautocomplete')?>",
      onSelect: function (event, ui){
        jq('[name="prno"]').val(ui.item.label); // display the selected text
          jq('[name="prno"]').val(ui.item.labela); // display the selected text
          jq('[name="prno"]').val(ui.item.value); // save selected id to input
      }
    })
  })
</script>