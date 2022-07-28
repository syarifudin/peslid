<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/tb_base',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">Trial Balance (Base)</option>
		  </select>
</td></tr>
    <tr><td> Period</td>  <td>  : <input type="text" name="period" placeholder='mmm-yy' > ex: Jan-18 </td></tr>
	<tr><td> Currency</td>  <td>: <select name="curr_select" style="width: 13%;font-family: Calibri;font-size: 12px;">
			  <option value="USD">USD</option>
			  <option value="STAT">STAT</option>
		</select></td></tr>
	<tr><td> Business Unit</td>  <td>: <select name="bu_select" style="width: 13%;font-family: Calibri;font-size: 12px;">
			  <option value="C11">C11</option>
			  <option value="B01">B01</option>
		</select></td></tr>
    <tr><td></td><td><input type="submit" value='submit' style="  margin-left: 4%;   width: 20%;"></td></tr>
</table>