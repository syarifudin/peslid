<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/f_print_po',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">PO Print</option>
			  <option value="sub">PO Print (Subcon)</option>
		  </select>
</td></tr>
    <tr><td>PO Number</td>  <td>  : <input type="text" name="date" placeholder=' ' > to <input type="text" name="date1" placeholder=' ' >
	PO Subcon : <input type="text" name="po_sub" placeholder='split po with coma '  style="width:30%">
	</td></tr>
	<tr>
		<td>Tax/PPh</td>
		<td>: <select name="stat_select" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="n">No</option>
			  <option value="y">Yes</option>
		</select>
        <select name="pph" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="n">No</option>
			  <option value="y">Yes</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>Delivery To</td>
		<td>: <select name="deliv_select" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
		<?php foreach($dat_dell as $row){ ?>
			  <option value="<?=$row['delivery_code']?>"><?=$row['delivery_code']?></option>
				<?php  
		} ?>
		</select></td>
	</tr>
	<tr>
		<td>Terms</td>
		<td>: <select name="term_select" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="no"> </option>
			  <option value="lcl">SEA by LCL</option>
			  <option value="fcl">SEA by FCL</option>
		</select></td>
	</tr>
		<tr>
		<td>Side</td>
		<td>: <select name="cname" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="b">PGLSMFID</option>
		</select></td>
	</tr>
	<tr><td></td><td>   <input type="submit" value='submit' style="  margin-left: 4%;width: 13%;"></td></tr>
</table>