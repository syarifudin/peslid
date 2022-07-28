<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/f_print_dncn',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">DN & CN Print</option>
		  </select>
</td></tr>
    <tr><td>DN/CN Number</td><td>  : <input type="text" name="dncn_no" placeholder=' ' ></td></tr>
	<tr><td>Attention</td><td>  : <input type="text" name="attention_input" placeholder=' ' ></td></tr>
	<tr><td>Email</td><td>  : <input type="text" name="email_input" placeholder=' ' ></td></tr>
	<tr><td>Due Date</td><td>  : <input type="text" name="due_input" placeholder=' ' ></td></tr>
	<tr><td>Exchange Rate </td><td>  : <input type="text" name="conv" placeholder='' ></td></tr>
	<tr><td>Authorised By </td><td>  : <input type="text" name="ttd" placeholder='' ></td></tr>
	<tr><td></td><td>   <input type="submit" value='submit' style="  margin-left: 4%;width: 13%;"></td></tr>
	
</table>