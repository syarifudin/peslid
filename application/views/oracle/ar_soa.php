<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/f_ar_soa',$x);
  

 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">SOA</option>
		  </select>
</td></tr>
	<tr><td>As at</td>  <td>  : <input type="text" name="date" placeholder='dd-mm-yyyy' > </td></tr>
    <tr><td>Customer</td>  <td>  : <select name="cust_select" style="width: 13%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <?php foreach($data_cust  as $row){ ?>  
			  <option value="<?=$row->BILL_TO;?>"><?=$row->BILL_TO;?></option>
		<?php }?>
		</select> </td></tr>

	<tr><td></td><td>   <input type="submit" value='submit' style="  margin-left: 4%;width: 13%;"></td></tr>
	
</table>