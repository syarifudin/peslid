<?php foreach($dosupplier as $row); 

?>
<html>
<head>
<title></title>
</head>
<body>
<table style="margin-left: auto;margin-right: auto;font-weight:bold;">
<tr><td>==================</td><td>DELIVERY INSTRUCTION</td><td>================</td></tr>
</table>
<br><br>
<table>
	<tr><td>PT. Panasonic Lighting Indonesia</td></tr>
	<tr><td>Rembang Industri Raya 47 </td></tr>
	<tr><td> PIER,PASURUAN 67152 </td></tr>
	<tr><td>Pasuruan  67152 </td></tr>
	<tr><td>Phone : +62-343-740230, Fax : +62-343-740239</td></tr>
	<tr><td>============================================</td></tr>
</table>
<br>
<br>
<br>
<table style='width:60%'>
	<tr><td>Date</td><td>:<?=$row['dlvy'];?></td></tr>
	<tr><td>DI No</td><td>:<?=$row['so_number'];?></td></tr>
	</table>
<br>
<br>
<table>	
	<tr><td>SOLD TO :</td><td>SHIP TO :</td></tr>
	<tr><td><?=$row['gc_name'];?></td><td><?=$row['gc_name'];?></td></tr>
	<tr><td><?=$row['gc_short'];?></td><td><?=$row['gc_short'];?></td></tr>
	<tr><td><?=$row['gc_add'];?></td><td><?=$row['gc_add'];?></td></tr>
</table>
<br>
<br>
<table border='0'>
	<tr><td>No</td><td>Item Number</td><td>Description</td><td>UM</td><td>Quantity</td></tr>
<?php
	$this->load->database();
	$ams_so=$row['ams_po'];
	$query = $this->db->query("select * from open_so_detil where ams_so_det='$ams_so'");
							$data=$query->result_array();
	$no=1;						
	foreach ($data as $row){
	$nomor=$no++;
	echo"
		<tr><td>$nomor</td>
		<td>$row[kode_item_so]</td>
		<td>$row[kode_item_so]</td>
		<td>PC</td>
		<td>$row[qty_item_so]</td>
		</tr>
	";
	}						
?>
</table>
<br>
<br>
<br>
</body>
<style type="text/css">
 body{
  font-family: "Courier New", Times, serif;
  font-size:12px;
    }
 table{
        width: 100%;
    }
  </style>
</html> 			