 <link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css">
  <script src="<?=base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?=base_url();?>js/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css" />
   <script src="<?=base_url();?>js/bootstrap3-typeahead.min.js"></script>  
<?php echo form_open('prpo/update_pr','class="form-horizontal"'); ?>
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
	$( "#datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
  $( function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
   $( function() {
    $( "#datepicker3" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
   $( function() {
    $( "#datepicker4" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );

  $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td><input type='checkbox'  name='save[]' value=0></td><td><input type='text' name='item[]' class='item' placeholder =''/></td><td><input type='text' name='desc[]' class='item' placeholder =''  /></td><td><input type='text' name='qty[]' class='mid' placeholder =''  ></td><td><input type='text' name='uom[]'  class='mid' placeholder =''  ></td><td><input type='text' name='cc[]'class='mid' placeholder =''  /></td><td><input type='text' name='pa[]' class='mid' placeholder ='' /></td>");
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
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
 <?php foreach ($query->result() as $rw); ?>
<table class="tablesorter" cellspacing="0">
  <tr>
		<td>PR Number</td><td>    <input type='text' name="pr" style=" height: 27px;" value='<?php echo isset($rw->pr_number)?trim($rw->pr_number):""; ?>' > / Buyer
     <input type='text' name="buyer" style="height: 27px;" value='<?php echo isset($rw->pr_buyer)?$rw->pr_buyer:""; ?>' > </td>
		
    <td>Due Date</td><td>    <input type='text' name="due_date" class='input'  id='datepicker4' style="  height: 27px;  width: 85%;" value='<?php echo isset($rw->pr_due_date)?$rw->pr_due_date:""; ?>'></td>
  </tr>
  <tr>
    <td>Supplier </td><td>    <input type='text' name="supplier" class='typeahead'  onclick="disableTxt()" style="  height: 27px;  width: 85%;" value='<?php echo isset($rw->pr_supplier)?$rw->pr_supplier:""; ?>' ></td>
   <td>Requester </td><td>    <input type='text' name="rq" class='input'  style="  height: 27px;  width: 85%;" value='<?php echo isset($rw->pr_rq)?$rw->pr_rq:""; ?>'></td>
		<td></td><td>   </td>
  </tr>
  <tr> <td>Need By Date</td><td>    <input type='text' name="need_by_date" class='input'  id='datepicker3' style="  height: 27px;  width: 52%;" value='<?php echo isset($rw->pr_need_by_date)?$rw->pr_need_by_date:""; ?>'></td>
  <td>Ship-To</td><td>    <input type='text' name="shipto"  class='input'   style="  height: 27px;  width: 85%;" value='<?php echo isset($rw->pr_shipto)?$rw->pr_shipto:""; ?>'></td>
	<td>    
  
  </td>
		
  </tr>
</table>
<div class='wrapper'>
<table class="table " id="tab_logic">
				<thead>
					<tr >
          <th class="text-left">
							Line
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
        <?php $no=0;	foreach ($query_det->result() as $det){ $no=$no+1; ?>
					<tr id='addr0'>
          <td>
            <input type="checkbox"  <?php if(($det->pr_det_number)!=""){ echo 'checked'; } ?> name="save[]" value='<?php echo isset($det->count_id)?trim($det->count_id) : ""; ?>'>  	<?="Line - ".$no?> </td>
						<td>
						<input type='text' name='item[]' class='item' value='<?=$det->pr_det_item;?>' />
						</td>
						<td>
						<input type='text' name='desc[]' class='item' value='<?=$det->pr_det_desc;?>' />
						</td>
						<td>
						<input type='text' name="qty[]"  class='mid' value='<?=trim($det->pr_det_qty);?>' >
						</td>
						<td>
            <input type='text' name="uom[]"  class='mid'value='<?=trim($det->pr_det_uom);?>'  >
						</td>
						<td>
						<input type='text' name='cc[]' class='mid' value='<?=trim($det->pr_det_cost_center);?>'  />
						</td>
						<td>
						<input type='text' name='pa[]' class='mid'  value='<?=trim($det->pr_det_purc_account);?>'/>
						</td>
					</tr>
          <?php }?>
           <tr id='addr1'>
					</tr>
        
				</tbody>
			</table>
		</div>
	<a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
	<a id="add_row" class="pull-right btn btn-default">Add Row</a>
 <div class='npa_head' style="    padding: 5px;">
<INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='update'>
</div>
<div style='color: blue;'><?php if(isset($msg)){
  Echo "Success";
} ?>
</div>
<script type="text/javascript">
    $('input.typeahead').typeahead({
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