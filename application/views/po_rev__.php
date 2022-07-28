<?php 
foreach($dlv_tt as $rows);
foreach($supplier as $row);
 ?>
<html>
<head>
<title></title>
</head>
<body>
<table >
<tr><td style="margin-left: auto; font-size:18;margin-right: auto;font-weight:bold;">PT. Panasonic Lighting Indonesia</td><td></td><td></td></tr>
</table>
<hr>
<table>
<tr><td>Jl. Rembang Industri Raya 47, Rembang PIER 67152 Pasuruan  67152 INDONESIA </td><td></td><td></td></tr>
</table>
<br>
<br>
<table>
<tr><td class='tebal'> Report Date : <?php echo date("d-M-Y");?></td></tr>
</table>
<?php if(($rows['rev'])==1){ 
echo "<span style=' font-weight: bold;  margin-left: 41%;'>PRODUCTION ORDER (REV) </span>";

 }elseif(($rows['rev'])==0){
echo "<span style='  font-weight: bold;    margin-left: 41%;'>PRODUCTION ORDER (REV)</span>";
 }?>
<br><br>
<?php $dlvy=date('d-M-Y',strtotime($rows['dlvy'])); ?>
<?php $eta=date('d-M-Y',strtotime($rows['eta'])); ?>
<br>
<br>
<?php  
foreach($cnee as $dest);
?>
 <table>
 <tr>
 <td>FACTORY</td><td> <?php if(isset($row['ad_name'])){ echo $row['ad_name']; } ?></td><td>TRADE TYPE</td><td> TRIPARTITE TRANSACTION (RE-EXPORT)</td></tr>
 <tr><td>ATTD</td><td> </td><td>PRODUCTION TYPE</td><td> FINISH GOODS </td> </tr>
 <tr><td class='tebal'>PO NUMBER</td><td> <?=$rows['po_number'];?> </td><td>PROIRITY</td><td>  </td> </tr>
 <tr><td>ORG. GROUP</td><td> </td><td>FINAL DESTINATION</td><td><?=$rows['city_name'];?>   </td> </tr>
 <tr><td></td><td> </td><td>COUNTRY OF FINAL DEST </td><td><?=$rows['country_name'];?>   </td> </tr>
 <tr><td>OORDERER</td><td> (00029576) PT. PANASONIC LIGHTING INDONESIA</td><td></td><td> </td> </tr>
 <tr><td>ACCOUNTEE</td><td> (00029576) PT. PANASONIC LIGHTING INDONESIA</td><td>DELIVERY DATE</td><td> <?=$dlvy;?>  </td> </tr>
 <tr><td>CONSIGNEE</td><td> <?=$dest['global_code']?>  </td><td>TRANSPORTATION MODE</td><td> <?=$rows['dlv'];?></td> </tr>
 <tr><td></td><td>   <?=$dest['gc_name'];?><?=$dest['gc_short'];?> <?=$dest['gc_add'];?></td><td>WHS DATE</td><td></td> </tr>
 <tr><td>FINAL BUYER</td><td></td><td>SWHS / ETA</td><td> </td> </tr>
 <tr><td>ORGINAL BUYER</td><td></td><td>PWHS ETA</td><td> <?=$eta;?></td> </tr>
 <tr><td>CUSTOMER PO</td><td> <?=$rows['cus_po'];?></td> <td>TRADE TERM / PLACE  </td><td> FOB </td> </tr>
 <tr><td>PC ORDER NO</td><td> <?=$rows['ams_po'];?></td> <td>PAYMENT TERM / PLACE  </td><td> EMITTANCE ON THE 25TH OF THE NEXT MONTH</td> </tr>
<tr><td> </td><td> </td><td>CURIENCY</td><td> USD</td></tr>
 </table>
<br>
<br>
<?php 
$ams=$ams_po;
$this->load->database();
			echo "<table border='1'>";
							echo"<tr>
								<td class='tebal'>S/No</td>
								<td class='tebal'>PART NO /DESCRIPTION</td>
								<td class='tebal'>CUSTOMER PART NO</td>
								<td class='tebal'>INDIACTIVE MODEL</td>
								<td class='tebal'>SPECIFICATION</td>
								<td class='tebal'>QTY/PKG</td>
								<td class='tebal'>QTY ORDERED</td>
								<td class='tebal'>UNIT PRICE</td>
								
								<td>AMOUNT</td>
								 </tr>";
						$query = $this->db->query("select * from open_po,open_po_detil 
											where open_po.ams_po=open_po_detil.ams_po_det and open_po.date_po=open_po_detil.date_po_
											and open_po_detil.ams_po_det='$ams' 
											and open_po_detil.kode_suplier='$vendor' and open_po.stat_po='close' and  open_po_detil.stat_po_='close'");
							$data=$query->result_array();
					$line=0;
					$total=0;
					$t=0;					
					foreach($data as $row){	
					$qty=number_format($row['qty_item'], 0);
					$line=$line+1;
					$pric=$row['price_item_peslid'];
					$ext=$pric*$row['qty_item'];
					$j=number_format($ext,2);
					$total+=$ext;
					 	echo"<tr><td>$line</td>
						  <td>$row[item_number]</td>
						  <td></td>
						  <td></td>
						  <td></td>
						  <td>12/pc</td>
						  <td style='text-align: right;'>$qty</td>
						  <td style='text-align: right;'>$pric</td>
						   
						  <td style='text-align: right;'>$j</td>
						</tr>";
						$t+=$row['qty_item'];  
					  }
				echo"</table>";		
 ?>	
<br>
<br>
<span style="  font-weight: bold;    margin-left: 45%;">Total :</span> <span style=" margin-left: 15%;"> <?php echo  number_format($t, 0); ?></span>  <span style="    margin-left: 10%;"><?php echo  number_format($total, 2); ?></span>
<br>
<br><br><br><br><br><br><br><br>
<br>
<span class='tebal'>REVISION REMARSK :</span><br>
 TRADE TERM CHANGED TO FOB
<br>
<br>
<span class='tebal'>FIRST COMMENT	: </span>
<br>
<br>
<?php foreach($case as $mark); ?>
<table>
<tr><td class='tebal'> CASE MARK : </td></tr>
<tr><td > </td></tr>
<tr><td> <?=$mark['case0']; ?>  <?=$mark['case1']; ?> </td></tr>
<tr><td> <?=$mark['case2']; ?>  <?=$mark['case3']; ?>  </td></tr>
<tr><td> <?=$mark['case4']; ?>  <?=$mark['case5']; ?>  </td></tr>
</table>
<br>
<br>
<span class='tebal'>LAST COMMENT</span>
<br><br><span class='tebal'>FROM:</span><br>
<?=$rows['fm'];?>
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
   border-collapse: collapse;
 }
span{
font-size:12px;
}
.tebal{
font-weight:bold;
}
  </style>
</html>			