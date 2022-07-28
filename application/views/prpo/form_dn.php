<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('prpo/dn_slection',$x);				
 ?>
<table>
<tr>
		<td>PO Number : 	 <input style="width:24%;height: 21px; "type="text" name="data"">
		</td>
		<td>	Selection Data : <select name="select"  >
						  <option value='' >Select....</option>
							<option value='DN' >Purcahse Order Receive</option>
						  <option value='RETURN'>Purchase Order Return</option>
				</select>
				</td>
		<td>		
			<input  type="submit" value="Continue">
		</td>
  </form>
	
	</tr>
	</table>
<br>
<style>
select {
    height: 27px;
		font-family: monospace;
    font-size: 14px
}
table {
    width: 100%;
		font-family: monospace;
    font-size: 15px;
}
input[type="submit"] {
    font-size: 14px;
    font-family: monospace;
}
</style>