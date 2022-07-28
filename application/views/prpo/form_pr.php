 <link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css">
  <script src="<?=base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?=base_url();?>js/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="<?=base_url();?>js/bootstrap3-typeahead.min.js"></script>  
<?php echo form_open('prpo/save_pr','class="form-horizontal"'); ?>
 <style>
.npa_head {
    text-align: center;
	font-family: Lucida Sans Unicode;
    font-size: 14.5px;
	font-weight: bold;
}
.item{
width:100%;
height: 25px;
}
.mid{
width:80%;
height: 25px;

}
.input{
	    padding: 1px;
        width: 85%;
        height:27%;
		font-family: Lucida Sans Unicode;
    
}
.typeahead{
	    padding: 3px;
		font-family: Lucida Sans Unicode;
}
.input1{
	    padding: 1px;
		font-family: Lucida Sans Unicode;
        width: 85%;
}
.wrapper {
  margin-top: 3%;
  -webkit-overflow-scrolling:touch;
  width:100%;
  white-space:nowrap;
}

input{
	    padding: 2px;
      font-size: 11px;
}
select{
	    padding: 2px;
}



 </style>
  <script>
   $( function() {
    $( "#datepicker3" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
   $( function() {
    $( "#datepicker4" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );

  $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $("#addr"+i).html("<td>"+ (i+1) +"</td><td><input type='text' name='item[]' class='item' placeholder =''></td><td><input type='text' name='desc[]' class='item' placeholder =''  ></td><td><input type='text' name='qty[]' class='mid' placeholder =''  ></td><td><input type='text' name='uom[]'  class='mid' placeholder =''  ></td><td><input type='text' name='cc[]' class='mid cc'  placeholder =''  ></td><td><input type='text' name='pa[]' class='mid pa'  placeholder =''></td>");
      $(document).on('focus', '.cc:not(.ui-autocomplete-input)', function (e) {
        $(this).autocomplete({
           source: "<?php echo site_url('blog/get_autocomplete')?>",
           onSelect: function (event, ui) {
          // Set selection
          jq('[name="cc[]"]').val(ui.item.label); // display the selected text
          jq('[name="cc[]"]').val(ui.item.labela); // display the selected text
          jq('[name="cc[]"]').val(ui.item.value); // save selected id to input
          
        }
});
});
      $(document).on('focus', '.pa:not(.ui-autocomplete-input)', function (e) {
        $(this).autocomplete({
           source: "<?php echo site_url('blog/get_autocompletee')?>",
           onSelect: function (event, ui) {
          // Set selection
          jq('[name="pa[]"]').val(ui.item.label); // display the selected text
          jq('[name="pa[]"]').val(ui.item.labelb); // display the selected text
          jq('[name="pa[]"]').val(ui.item.value); // save selected id to input
          
        }
});
});
      $("#tab_logic").append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });
});
</script>
 <div class='npa_head'>
	<p> New Requisition</p>
	<hr>
 </div>
<table class="tablesorter" cellspacing="0">
  <tr>
		<td>PR Number</td><td>    <input type='text' name="pr" style=" height: 27px;"  > / Buyer <input type='text' name="buyer" style="height: 27px;"  > </td>
		
    <td>Due Date</td><td>    <input type='text' name="due_date" class='input'  id='datepicker4' style="  height: 27px;  width: 85%;"></td>
  </tr>
  <tr>
    <td>Supplier </td><td>    <input ' type='text' name="supplier" class='supplier'  onclick="disableTxt()" style="  height: 27px;  width: 85%;"></td>
   <td>Requester </td><td>    <input type='text' name="rq" class='input'  style="  height: 27px;  width: 85%;"></td>
		<td></td><td>   </td>
  </tr>
  <tr> <td>Need By Date</td><td>    <input type='text' name="need_by_date" class='input'  id='datepicker3' style="  height: 27px;  width: 52%;"></td>
  <td>Ship-To</td><td>    <input type='text' name="shipto"  class='input'   style="  height: 27px;  width: 85%;"></td>
	<td>    
  
  </td>
		
  </tr>
</table>
<div class='wrapper'>
<table class="table " id="tab_logic">
				<thead>
					<tr >
						<th class="text-left" >
							No
						</th>
						<th class="text-left">
							Item Number
						</th>
						<th class="text-left" style="width: 24%;">
							Desc
						</th>
						<th class="text-left" style=" width: 10%;">
							Qty
						</th>
						<th class="text-left" style=" width: 10%;">
							UOM
						</th>
						<th class="text-left">
							Cost Center
						</th>
						<th class="text-left">
							Pur  Acc
						</th>
						</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td>
						<input type='text' name='item[]' class='item' placeholder =''  >
						</td>
						<td>
						<input type='text' name='desc[]' class='item' placeholder =''  >
						</td>
						<td>
						<input type='text' name="qty[]"  class='mid' placeholder =''  >
						</td>
						<td>
            <input type='text' name="uom[]"  class='mid' placeholder =''  >
						</td>
						<td>
						<input type='text' name='cc[]' class='mid cc'  placeholder =''  >

						</td>
						<td>
						<input type='text' name='pa[]' class='mid pa'  placeholder ="" >
						</td>
					</tr>
                    <tr id='addr1'>
					</tr>
				</tbody>
			</table>
		</div>
	<a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
	<a id="add_row" class="pull-right btn btn-default">Add Row</a>
 <div class='npa_head' style="    padding: 5px;">
<INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='save'>
</div>

<script type="text/javascript">
    $('input.supplier').typeahead({
          autoSelect: true,
        minLength: 2,
		source:  function (query, process) {
        return $.get('get_supplier', { query: query }, function (data) {
                console.log(data);
                data = $.parseJSON(data);
                return process(data);
            });
        }
    });
</script>


<script src="<?php echo base_url().'assets/js/jquery-3.3.1.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$( '.cc' ).autocomplete({
source: "<?php echo site_url('blog/get_autocomplete')?>",
onSelect: function (event, ui) {
          // Set selection
          jq('[name="cc[]"]').val(ui.item.label); // display the selected text
          jq('[name="cc[]"]').val(ui.item.labela); // display the selected text
          jq('[name="cc[]"]').val(ui.item.value); // save selected id to input
          
        }
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
$( '.pa' ).autocomplete({
source: "<?php echo site_url('blog/get_autocompletee')?>",
onSelect: function (event, ui) {
          // Set selection
          jq('[name="pa[]"]').val(ui.item.label); // display the selected text
          jq('[name="pa[]"]').val(ui.item.labelb); // display the selected text
          jq('[name="pa[]"]').val(ui.item.value); // save selected id to input
          return false;
        }
});
});
</script>


