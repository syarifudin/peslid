 <link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css">
  <script src="<?=base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?=base_url();?>js/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css" />
   <script src="<?=base_url();?>js/bootstrap3-typeahead.min.js"></script>  
<?php echo form_open('prpo/save_dn','class="form-horizontal"'); ?>
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
    width: 12%;
    text-align-last:center;
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

</script>
 <div class='npa_head'>
	<p>Purchase Order Receive</p>
	<hr>
 </div>
 <?php 
					foreach ($query->result() as $hdr);
	?>
<table class="tablesorter"  cellspacing="0">
  <tr>
		<td>Invoice / Packing Slip</td><td>  <input type='text'  name="pc" style=" height: 27px;  width: 65%;" value='<?php  echo isset($hdr->rcv_inv_packing)?trim($hdr->rcv_inv_packing):"";?>' > </td>
    <td>GRN Number</td><td> <input type='text' name="grn" style=" height: 27px;  width: 35%;" value='<?php  echo isset($hdr->rcv_grn_number)?trim($hdr->rcv_grn_number):"";?>'disabled >   </td>
  </tr>
  <tr>
    <td>Received Date </td><td>   <input type='text' name="rcv_date" class='input'  id='datepicker' style="  height: 27px;  width: 65%;" value='<?php echo isset($hdr->rcv_received_date)?$hdr->rcv_received_date:""; ?>' > </td>
<td>PO Number</td><td><input type='text' name="po_number" value='<?php echo isset($hdr->po_number)?trim($hdr->po_number):""; ?>' style=" height: 27px;" readonly="readonly" > /
     Buyer <input type='text' value='<?php echo isset($hdr->pr_buyer)?trim($hdr->pr_buyer):$hdr->po_buyer; ?>'  name="buyer" style="height: 27px;"  > </td>
  </tr>
</table>
<div class='wrapper'>
<table class="table " id="tab_logic">
				<thead>
					<tr >
          <th>RCV</th>
            <th class="text-left">QTY	</th>
						<th class="text-left">Item Number	</th>
						<th class="text-left" style="width: 24%;">
							Desc
						</th>
						<th class="text-left" style=" width: 10%;">
							Qty PO
						</th>
            <th class="text-left" style=" width: 10%;">
							Price
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
        <?php 
        $no=0;
					foreach ($query_det->result() as $dt){
						$no=$no+1;
					
	      ?>
					<tr id='addr0'>
          <td>
            <input type="checkbox" name='save[]' checked value='<?=$dt->count_id;?>'  onclick="return false;" onkeydown="return false;" > </td>
            <td>
            <input type='text' name='rcv_qty[]' value='<?php echo isset($dt->remaining)?0: $dt->rcv_qty; ?>' class='item' placeholder =''  /></td>
						<td>
						<input type='text' name='item[]' value='<?php echo isset($dt->pr_det_item)?trim($dt->pr_det_item) : ""; ?>' class='item' readonly="readonly"  />
						</td>
						<td>
						<input type='text' name='desc[]' value='<?php echo isset($dt->pr_det_desc)?trim($dt->pr_det_desc) : ""; ?>' class='item' readonly="readonly"  />
						</td>
						<td>
						<input type='text' name="qty[]" value='<?php echo isset($dt->remaining)?trim($dt->remaining) :$dt->pr_det_qty_po; ?>'  class='mid' readonly="readonly" >
						</td>
            <td>
						<input type='text' name="price[]" value='<?php echo isset($dt->rcv_price)?trim($dt->rcv_price) :$dt->pr_det_price_po; ?>' class='mid' readonly="readonly" >
						</td>
						<td>
            <input type='text' name="uom[]" value='<?php echo isset($dt->pr_det_uom)?trim($dt->pr_det_uom) : ""; ?>'  class='mid' readonly="readonly" >
						</td>
						<td>
						<input type='text' name='cc[]' class='mid' value='<?php echo isset($dt->pr_det_cost_center)?trim($dt->pr_det_cost_center) : ""; ?>' readonly="readonly"  />
						</td>
						<td>
						<input type='text' name='pa[]' class='mid' value='<?php echo isset($dt->pr_det_purc_account)?trim($dt->pr_det_purc_account) : ""; ?>'   readonly="readonly" />
						</td>
					</tr>
          <?php }?>
				</tbody>
			</table>
		</div>

 <div class='npa_head' style="    padding: 5px;">

<INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> 
<input type="submit" <?php  echo isset($hdr->rcv_grn_number)?"disabled":"";?>  value='save'>
</div >
<div style='color: blue;'><?php if(isset($msg)){
  echo "Success";
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