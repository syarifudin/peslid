<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('bom/check',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td>Menu Selection</td><td><select name='bm'>
  <option value="std">BOM STD</option>
  <option value="cur">BOM Current</option>
  <option value="sim">BOM Simulation</option>
</select></td><td><input type='submit' name='Go'></td></tr>
  </table>
  <script>
</script>
