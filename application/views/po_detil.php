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
<table  style="width:100%;" class="tablesorter_">
<thead> 
	<th>Item Number</th>
	<th>Line Customer</th>
	<th>Line Peslid</th>
	<th>Due Date</th>
	<th>Qty</th>
	<th>Price Item</th>
	<th>No Pu.Order</th>
	<th>Kode Suplier</th>
</thead>	
<?php
 foreach($detil as $row){
 $price=substr($row['price_item'],0,-1);
 echo"<tr>
     <td>$row[item_number]</td>
     <td>$row[line_cus]</td>
	 <td>$row[line_peslid]</td>
     <td>$row[due_date_]</td>
	 <td>$row[qty_item]</td>
     <td>$price</td>
     <td>$row[po_number_peslid]</td>
	 <td>$row[kode_suplier]</td>
	  </tr>";
 }
?>
</table>
<?php } else {echo"<span style='margin-left: 41%;margin-right: auto;font-weight:bold;'>Detil Po tidak ditemukan</span>";}?>