<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open_multipart('ex/uplooad_reply_po',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Upload File</td><td>   : <input type="file" name="ex_po" id='myText' onclick="disableTxt()" ></td></tr>
  <tr><td> Item Model </td>  <td>  : <input type="text" name="item" id='myTex' onclick="disableTx()"></td></tr>
  <tr><td> Periode</td>  <td>  : <input type="date" placeholder=' dd/mm/yy' name="periode" style=" width: 25%;" id='myT'></td></tr>
    <tr> <td> </td><td>   <INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='Kirim'></td></tr>
  </table>
  <script>
function disableTxt() {
    document.getElementById("myTex").disabled = true;
    document.getElementById("myT").disabled = true;
}
function disableTx() {
    document.getElementById("myText").disabled = true;
    
}
function undisableTxt() {
    document.getElementById("myText").disabled = false;
  }

</script>
