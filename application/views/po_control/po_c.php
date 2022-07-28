<?php

$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('u_p/result_control',$x);				
	echo "<input style='width: 24%;height: 18px; float: left;margin-left:10px'
		type='text' name='po_number'onfocus='if(!this._haschanged){this.value=''};this._haschanged=true;'> 
		<input style='height: 24px;margin-right: 44%;' type='submit' value='Search'>
</form>";
?>

<br/>