<?php
foreach ($src_item as $row);

 ?>
<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('ex/update_main_item',$x);				
?>
<table class='form_login' >
		<tr>
		<td>Kode item</td><td>: <input type="text" name="mstr_item_number" value='<?php echo isset($row['mstr_item_number'])?$row['mstr_item_number']:""?>'></td>
		</tr>
		<tr>
		<td>Desc</td><td>: <input type="text" name="descr" value='<?php echo isset($row['descr'])?$row['descr']:""?>'></td>
		</tr>
		<tr>
		<td>Periode</td><td>: <input type="date" name="date_reply_" value='<?php echo isset($row['date_reply_'])?$row['date_reply_']:""?>'></td>
		</tr>
		<tr>
		<td>Qty</td><td>: <input type="text" name="qty_item" value='<?php echo isset($row['qty_item'])?$row['qty_item']:""?>'></td>
		</tr>
		<tr>
		<td>Price</td><td>: <input type="text" name="price" value='<?php echo isset($row['price'])?$row['price']:""?>'></td>
		</tr>
		<tr>
		<td>Kode supplier</td><td>: <input type="text" name="kode_supplier" value='<?php echo isset($row['kode_supplier'])?$row['kode_supplier']:""?>'></td>
		</tr>
		</table>
		<button type="reset" value="Reset" style="margin-left: 14%;width: 8%; margin-bottom: 5px;font-family: Courier New, Times, serif;">reset</button>
		<input type="submit" value="save" style="width: 8%; margin-bottom: 5px;font-family: Courier New, Times, serif;">
</form>
<style type="text/css">
 input
 {
   font-family: "Courier New", Times, serif;
   font-size:13px;
 }
 table
 {
   width: 50%;
 }
  </style>