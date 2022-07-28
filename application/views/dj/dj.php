<style type="text/css">
    p{
      font-family: serif;
      line-height: 1.75em;
      font-size: 18px;
    }
    i { 
      font-family: sans;
      color: orange;
    }
  </style>
<?php

$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('discrete_job/create_dj',$x);				
?>
<table class="tablesorter"  cellspacing="0">
<tr> <td> Discrete Job Name</td><td>   : 
   <input type="text" name="dj_name" style="width: 40%;padding: 6px 6px;" id='myText' >
</td></tr>
  <tr><td>SubInventory From</td>  <td>  : 
 
  <select name="subinventory_from" style="width: 30%;padding: 6px 6px;" id='myTex' onclick="disableTxt()">
<?php foreach($suninventory as $row) { ?>
  <option value="<?=$row['subinventory']?>"><?=$row['subinventory']."    ".$row['descr']?></option>
<?php }?> 
</select>
  </td></tr>
  <tr><td>SubInventory To</td>  <td>  : <select name="subinventory_to" style="width: 30%;padding: 6px 6px;" id='myex' onclick="disableTxt()">
<?php foreach($suninventory as $row) { ?>
  <option value="<?=$row['subinventory']?>"><?=$row['subinventory']."    ".$row['descr']?></option>
<?php }?> 
</select></td></tr>
  <tr><td> Start Date</td>  <td>  : <input type="date" placeholder=' dd-mm-yy' name="date_create" style=" width: 30%;padding: 6px 6px;" id='myT'></td></tr>
    <tr> <td> </td><td><input type="submit" value='Search' style=" width: 10%;padding: 6px 6px;"></td></tr>
  </table>
  </form>
  <script>
function disableTxt() {
    document.getElementById("myTex").disabled = false;
    document.getElementById("myex").disabled = false;
    document.getElementById("myT").disabled = false;
	document.getElementById("myText").disabled = true;
}
function undisableTxt() {
    document.getElementById("myText").disabled = false;
  }
</script>