<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('prpo/get_prpo',$x);				
 ?>
<table>
<tr>
		<td>PO/GRN/PR Number : 	 <input style="width:24%;height: 21px; "type="text" name="data"">
		</td>
		<td>	Selection Data : <select name="select"  >
						  <option value='' >Select....</option>
							<option value='PR' >Requisition Report</option>
						  <option value='PO'>Purchase Order Report</option>
							<option value='GRN'>Goods Receive Note</option>
				</select>
				</td>
		<td>		
			<input  type="submit" value="Print">
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