<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open_multipart('maintenance/po_rev_',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
  <tr><td>PC Order Number</td> <td> Status </td> <td>Action </td></tr>
  <tr><td>
  <input type="text"  name="pc_order_number" >
  </td> <td>Open  
  </td><td>
  <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='Kirim'>
 </td>
 </tr>
</table> 
  
  