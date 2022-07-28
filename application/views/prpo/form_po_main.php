 <link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css">
  <script src="<?=base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?=base_url();?>js/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css" />
   <script src="<?=base_url();?>js/bootstrap3-typeahead.min.js"></script>  
<?php echo form_open('prpo/save_po_creation','class="form-horizontal"'); ?>
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
	<p>Purchase Order Maintenance</p>
	<hr>
 </div>
 <?php 
					foreach ($h->result() as $hdr);
	?>
<table class="tablesorter" cellspacing="0">
  <tr>
		<td>PO Number</td><td>    <input type='text' name="po_number" style=" height: 27px;" value='<?php echo isset($po)?$po:""; ?>' > /
     Buyer <input type='text' value='<?php echo isset($hdr->pr_buyer)?trim($hdr->pr_buyer):$hdr->po_buyer; ?>'  name="buyer" style="height: 27px;"  > </td>
    <td>Ship-To</td><td>    <input type='text' name="shipto" value='<?php echo isset($hdr->pr_shipto)?trim($hdr->pr_shipto):$hdr->po_shipto; ?>'  class='input'   style="  height: 27px;  width: 85%;">   </td>
  </tr>
  <tr>
    <td>Supplier </td><td>    <input type='text' name="supplier" class='typeahead' value='<?php echo isset($hdr->pr_supplier)?trim($hdr->pr_supplier):$hdr->po_supplier; ?>'  style="  height: 27px;  width: 85%;"></td>
<td>PPN </td><td><input type="checkbox" name="vat" value="10" <?php if(isset($hdr->po_vat)){
  if (($hdr->po_vat)!=0){
  echo 'checked';
}  } ?>> VAT 10% </td>
		<td></td><td></td>
  </tr>
  <tr> <td>Currency</td><td>
  <select name="curr"  >
            <?php if(($hdr->po_currency)!=""){ ?>
              <option value='<?=$hdr->po_currency?>'><?=$hdr->po_currency?></option>
              <option value='IDR' >IDR</option>
						  <option value='USD'>USD</option>
						  <option value='JPY'>JPY</option>
            <?php }else { ?>
						  <option value='' ></option>
              <option value='IDR' >IDR</option>
						  <option value='USD'>USD</option>
						  <option value='JPY'>JPY</option>
            <?php } ?>
						</select>
  </td>
  <td>Need By Date</td><td> <input type='text' name="need_by_date" class='input' value='<?php echo isset($hdr->po_need_by_date)?trim($hdr->po_need_by_date):$hdr->pr_need_by_date; ?>' id='datepicker3' style="  height: 27px;  width: 85%;"></td>
	</tr>
  <tr>
  <td>    Remarks    </td>
  <td>  <input type='text' name="remarks"  class='input' value='<?php echo isset($hdr->po_remarks)?trim($hdr->po_remarks):""; ?>'  style="  height: 27px;  width: 55%;"> </td>
  <td>Due Date</td>
  <td>  <input type='text' name="due_date" class='input'  id='datepicker4' style="  height: 27px;  width: 85%;" value='<?php echo isset($hdr->po_due_date)?trim($hdr->po_due_date):$hdr->pr_due_date; ?>'></td>
  </tr>
</table>
<div class='wrapper'>
<table class="table " id="tab_logic">
				<thead>
					<tr >
            <th class="text-left">Line	</th>
						<th class="text-left">Item Number	</th>
						<th class="text-left" style="width: 24%;">
							Desc
						</th>
						<th class="text-left" style=" width: 10%;">
							Qty
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
					foreach ($dt->result() as $dt){
            $no=$no+1;
	      ?>
					<tr id='addr0'>
            <td>
            <input type="checkbox" <?php if(($dt->pr_det_po_number)!=""){ echo 'checked'; } ?> name="save[]" value='<?php echo isset($dt->count_id)?trim($dt->count_id) : ""; ?>'>  	<?="Line - ".$no?> </td>
						<td>
						<input type='text' name='item[]' value='<?php echo isset($dt->pr_det_item)?trim($dt->pr_det_item) : ""; ?>' class='item' placeholder =''  />
						</td>
						<td>
						<input type='text' name='desc[]' value='<?php echo isset($dt->pr_det_desc)?trim($dt->pr_det_desc) : ""; ?>' class='item' placeholder =''  />
						</td>
						<td>
						<input type='text' name="qty[]" value='<?php echo isset($dt->pr_det_qty_po)?trim($dt->pr_det_qty_po) : $dt->pr_det_qty; ?>'  class='mid' placeholder =''  >
						</td>
            <td>
						<input type='text' name="price[]" value='<?php echo isset($dt->pr_det_price_po)?trim($dt->pr_det_price_po) : ""; ?>' class='mid' placeholder =''  >
						</td>
						<td>
            <input type='text' name="uom[]" value='<?php echo isset($dt->pr_det_uom)?trim($dt->pr_det_uom) : ""; ?>'  class='mid' placeholder =''  >
						</td>
						<td>
						<input type='text' name='cc[]' class='mid' value='<?php echo isset($dt->pr_det_cost_center)?trim($dt->pr_det_cost_center) : ""; ?>'  placeholder =''  />
						</td>
						<td>
						<input type='text' name='pa[]' class='mid' value='<?php echo isset($dt->pr_det_purc_account)?trim($dt->pr_det_purc_account) : ""; ?>'   placeholder ='' />
						</td>
					</tr>
          <?php }?>
				</tbody>
			</table>
		</div>

 <div class='npa_head' style="    padding: 5px;">

<INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='save'>
</div >
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