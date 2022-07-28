<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/gl_j',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">GL Journal Report</option>
		  </select>
</td></tr>
   <tr><td> BU</td>  <td>: <select name="bu_select" style="width: 13%;font-family: Calibri;font-size: 12px;">
			  <option value="182">B01</option>
			  <option value="222">C11</option>
		</select></td></tr>
   <tr><td> Period ( Max 3 Months)</td>  <td>  : <input type="text" name="date" placeholder='dd-mm-yyyy' > - <input type="text" name="date1" placeholder='dd-mm-yyyy' > </td></tr>
   <tr><td> Account Code</td>  <td>  : <input type="text" name="account" placeholder='' > - <input type="text" name="account1" placeholder='' > </td></tr>
   <tr><td> GL No.</td>  <td>  : <input type="text" name="no" placeholder='' > - <input type="text" name="no1" placeholder='' > </td></tr>
   <tr> <td> </td><td>   <input type="submit" value='submit' style="  margin-left: 4%;   width: 13%;"></td></tr>
</table>