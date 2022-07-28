<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/get_consumption',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 25%;font-family: Lucida Sans Unicode;font-size: 12px;"">
			  <option value="data_so">Consumption By Items</option>
		</select>
</td></tr>
  <tr><td> Period</td>  <td>  : <input type="text" name="period" placeholder='mm-yy' ></td></tr>
  <tr><td> BU</td>  <td>: <select name="bu_select" style="width: 13%;font-family: Calibri;font-size: 12px;">
			  <option value="182">B01</option>
			  <option value="222">C11</option>
		</select></td></tr>
    <tr> <td> </td><td>   <input type="submit" value='submit' style="  margin-left: 4%;   width: 13%;"></td></tr>
  </table>