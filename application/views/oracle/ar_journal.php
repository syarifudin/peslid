<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/f_ar_journal',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">AR Journal</option>
		  </select>
</td></tr>
    <tr><td> GL Date</td>  <td>  : <input type="text" name="date" placeholder='dd-mm-yyyy' > to <input type="text" name="date1" placeholder='dd-mm-yyyy' ></td></tr>
    <tr><td> AR No.</td>  <td>  : <input type="text" name="ar1" id="ar1" placeholder='' > to <input type="text" name="ar2" id="ar2" placeholder='' ></td></tr>
	<tr>
		<td>Status</td>
		<td>: <select name="stat_select" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="p">Posted</option>
			  <option value="u">Unposted</option>
			  <option value="a">All</option>
		  </select></td>
	</tr>
	<tr><td>Invoice No.</td> <td>: <input type="text" name="inv_no" id="inv_no" placeholder='' >*to view all data type '%'</tr>
		<tr>
		<td></td>
		<td>   <input type="submit" value='submit' style="  margin-left: 4%;width: 13%;"></td>
	</tr>
</table>