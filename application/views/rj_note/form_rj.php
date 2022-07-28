<style type="text/css">
    p{
      font-family: serif;
      line-height: 1.75em;
    }
    i { 
      font-family: sans;
      color: orange;
    }
  </style>
<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('oracle/src_rj',$x);				
?>
<table class="tablesorter"  cellspacing="0">
<tr> <td> Purchase Order Number</td>
<td>   : 
   <input type="text" name="po_number" style="width: 40%;padding: 6px 6px;" >
</td>
</tr>
<tr> <td> Reject Note Number</td><td>   : 
   <input type="text" name="rj_number" style="width: 40%;padding: 6px 6px;background-color:rgba(255, 165, 0, 1);" >
</td>
</tr>
  <tr><td>Status</td>  <td>  : 
  <select name="status" style="width: 30%;padding: 6px 6px;" >
  <option value="tidak ada"></option>
  <option value="RETURN TO VENDOR">RETURN TO VENDOR</option>
  </select>
  </td></tr>
  <tr><td> Transaction  Date</td>  <td>  : <input type="date" placeholder=' dd-mm-yy' name="date_create" style=" width: 30%;padding: 6px 6px;" id='myT'>
  </td></tr>
    <tr> <td> </td><td><input type="submit" value='Search' style=" padding: 6px 6px;"></td></tr>
  </table>
  </form>
