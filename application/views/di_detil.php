<?php if(!empty($detil)){?>
<table class="po_master">
<?php foreach($detil as $row);
echo "<tr>
	   <td>NO PO Customer </td><td>:</td><td>$row[ams_po]</td></tr>
	   <tr><td>Kode Global Code</td><td>:</td><td>$row[cnee]</td>
	   <tr><td>Nama Customer</td><td>:</td><td>$row[gc_name]</td>
	  </tr>";
 ?>
 </table>
 <hr>
<table style="width:100%;" class="tablesorter_">
<thead> 
    <th>Kode Po Customer</th>
	<th>SO Number</th>
	<th>Item Number</th>
	<th>Due Date</th>
	<th>Qty</th>
	<th>Price Item</th>
	<th>Safety Stock</th>
	<th>Destination</th>
</thead>	
<?php
 foreach($detil as $row){
 echo"<tr>
     <td>$row[ams_so_det]</td>
     <td>$row[so_number]</td>
     <td>$row[kode_item_so]</td>
     <td>$row[due_date_so]</td>
	 <td>$row[qty_item_so]</td>
     <td>$row[price_item_so]</td>
     <td>$row[safety_stock]</td>
     <td>$row[so_cnee]</td>
	  </tr>";
   }
?>
</table>
<?php } else {echo"<span style='margin-left: 41%;margin-right: auto;font-weight:bold;'>Detil Po tidak ditemukan</span>";}?>