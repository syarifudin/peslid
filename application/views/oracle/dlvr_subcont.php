<html lang="en">
<head>
</head>
<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/po_subcon',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">Print Delivery Subcontract</option>
		  </select>
</td></tr>
	<tr><td>PO</td><td>  : <input type="text" name="po" placeholder=' ' ></td></tr>
    <tr><td></td><td>   <input type="submit" value='submit' style="  margin-left: 4%;width: 13%;"></td></tr>
</table>
</html>