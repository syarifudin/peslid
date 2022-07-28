<?php 
foreach($supplier as $row);
 ?>
<html>
<head>
<title></title>
<style type="text/css">
</style>
</head>
<body>
<table style="margin-left: auto;margin-right: auto;font-weight:bold;">
<tr><td>==================</td><td>PRODUCTION ORDER  </td><td>================</td></tr>
</table>
<br><br>
<table>
<tr><td>PPT. PANASONIC GOBEL ECO SOLUTIONS MANUFACTURING INDONESIA</td><td></td> <td> </td></tr>
<tr><td>Jl. Rembang Industri Raya 47 </td><td></td> <td>Order Number : <?php echo isset($no_po)?$no_po:"";?></td><td> Revision :0</td></tr>
<tr><td>Rembang PIER 67152 </td><td></td><td> Order date : <?php echo date("d-m-Y");?></td></tr>
<tr><td>Pasuruan  67152 </td><td></td><td>Print date : <?php echo date("d-m-Y");?> </td></tr>
<tr><td>INDONESIA</td><td>    </td> <td> </td></tr>
</table>
<div class="teacherPage"> </div>
<br>
<br>
<table>
<tr><td>Supplier : <?=$sup; ?> </td><td>Ship to :</td></tr>
<br>
<tr><td><?=$row['ad_name']; ?></td><td></td></tr>
<tr><td><?=$row['ad_line1'] ;?></td><td></td></tr>
<tr><td><?=$row['ad_line2']; ?></td> <td></td></tr>
<tr><td><?php if(isset($row['ad_line3'])){echo $row['ad_line3'];} ?></td><td></td></tr>
<tr><td><?php if(isset($row['ad_city'] )){echo $row['ad_city'];}?></td> <td></td></tr>
<tr><td><?=$row['ad_country'];?></td></tr>
<tr><td>ATTENTION : <?=$row['ad_attn']; ?></td></tr>
</table>
<table>
<tr><td>Confirm</td><td>:</td><td>Supplier Telephone</td><td>: <?=$row['ad_phone']; ?></td>  </tr>
<tr><td>Buyer</td><td>:</td><td>Contact<td>:</td></td></tr>
<tr><td>Credits Term</td><td>: </td><td>Ship Via</td><td>: </td></tr>
</table>
<br>
Remarsk :---------------------
<br>
<br>
<br>
<?php 
$this->load->database();
			echo "<table border='1'>";
							echo"<tr>
								<td>Ln</td>
								<td>Item Number</td>
								<td>T Due Date</td>
								<td>Qty Open</td>
								<td>UM</td>
								<td>Unit Cost</td>
								<td>Extended Cost</td>
								 </tr>";
						 $month=date('m',strtotime($per));
	                     $year=date('Y',strtotime($per));
						$query = $this->db->query("select * from pc_item_master");
	                     $data=$query->result_array(); 
							$line=0;
					$total=0;					
					foreach($data as $row){		
					$line=$line+1;
					//$ext=$row['price_item_peslid']*$row['qty_item'];
					//$total+=$ext;
					 	echo"<tr><td>$line</td>
						  <td>$row[mstr_item_number]</td>
						  <td>--</td>
						  <td>$row[qty_item]</td>
						  <td>pc</td>
						  <td>--</td>
						  <td>--</td>
						</tr>";
					  }
				echo"</table>";		
 ?>	
<br>
<br>
-------------------------------------------------------------------------------------------------
<table style=" margin-top: 31%;">
<tr><td>non-Taxable :</td><td><?=$total.".00"; ?></td><td>Currency  : USD</td><td>Line Total :</td><td>
<?=$total.".00"; ?></td></tr>
<tr><td>Taxable :</td><td>0.000</td><td> </td><td> Total Tax :</td><td>0.000</td></tr>
<tr><td>non-Taxable :</td><td>...</td><td></td><td> Total :</td><td><?=$total.".00"; ?></td></tr>
</table>

</body>
<style type="text/css">
 body
 {
   font-family: "Courier New", Times, serif;
   font-size:12px;
 }
 table
 {
   width: 100%;
 }
  </style>
</html>			