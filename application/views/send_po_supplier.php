<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open_multipart('admin/send_posup',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
  <tr><td>Supplier </td><td>Periode</td> <td> Status </td> <td>Action </td></tr>
  <tr><td> <select name="supplier">
	  <option value="PIZ00002">TOSPO</option>
	  <option value="LAM00001">LAMPTAN</option>
	  <option value="PIL00003">LKS</option>
</select></td><td>
  <input type="date" placeholder='dd/mm/yy' name="periode" >
  </td> <td>Open  
  </td><td>
  <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='Kirim'>
 </td>
 </tr>
</table> 
  
  