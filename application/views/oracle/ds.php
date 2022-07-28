<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/get_data',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 25%;font-family: Lucida Sans Unicode;font-size: 12px;"">
			  <option value="data_so">Data Sales Order</option>
		</select>
</td></tr>
  <tr><td> Actual Shipdate</td>  <td>  : <input type="text" name="date" placeholder='mm-yyyy' ></td></tr>
    <tr> <td> </td><td>   <input type="submit" value='submit' style="  margin-left: 4%;   width: 13%;"></td></tr>
  </table>
