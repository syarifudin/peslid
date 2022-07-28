<html>
  <head>
	<title>GRN Report</title>    		
  </head>
  <body>
  <?php
	$temp_subinventory='';
	$temp_curr='';
	$temp_vname='';
	$temp_vsite='';
	$temp_rcv='';
	
  foreach ($data_grn as $row){
				$i = 0;
				$line = 1;
				$total_qty_rcv = 0;
				$total_amt = 0;
				
				if (strcmp($temp_subinventory,$row['SUBINVENTORY']) !== 0){
					$i=1;
				}
				if (strcmp($temp_curr,$row['CURRENCY_CODE']) !== 0){
					$i=1;
				}
				if (strcmp($temp_vname,$row['VENDOR_NAME']) !== 0){
					$i=1;
				}
				if (strcmp($temp_vsite,$row['VENDOR_SITE_CODE']) !== 0){
					$i=1;
				}
				if (strcmp($temp_rcv,$row['EMPLOYEE_ID']) !== 0){
					$i=1;
				}
	  if ($i>0){
				
		  ?>
		  
		<font size="1" face="Calibri">  
					<table cellpadding="0" cellspacing="0" style="width: 100%">

					<tr>
						<td colspan="3"><div><font size="6" face="Arial"><b>Panasonic</b></font></div></td>
					</tr>
					<tr>
						<td colspan="3" align="center"><div><font size="4" face="Calibri"><u><b>GOODS RECEIPT NOTE</b></u></font></div></td>
					</tr>
					<tr>
						<td colspan="3" align="center"><div><font size="2" face="Calibri">PT Panasonic Gobel Life Solutions Manufacturing Indonesia</font></div></td>
					</tr>
					</table>
					</br>
					<table style="width: 100%">
					<colgroup>
					   <col span="1" style="width: 20%;">
					   <col span="1" style="width: 20%;">
					   <col span="1" style="width: 20%;">
					   <col span="1" style="width: 40%;">
					</colgroup>
					<tr>
						<td><div><font size="2" face="Calibri">W/H</td>
						<td><div><font size="2" face="Calibri">: <?=$row['SUBINVENTORY'];?></font></div></td>
						<td><div><font size="2" face="Calibri">Received from</td>
						<td><div><font size="2" face="Calibri">: <?=$row['VENDOR_NAME'];?></font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Calibri">Currency</td>
						<td><div><font size="2" face="Calibri">: <?=$row['CURRENCY_CODE'];?></font></div></td>
						<td><div><font size="2" face="Calibri"></td>
						<td><div><font size="2" face="Calibri"> &nbsp; <?=$row['VENDOR_SITE_CODE'];?></font></div></td>
					</tr>
					</table>
					
					<table border="1" class="table-cont" style="width: 100%">
					<colgroup>
					   <col span="1" style="width: 5%;">
					   <col span="1" style="width: 8%;">
					   <col span="1" style="width: 5%;">
					   <col span="1" style="width: 8%;">
					   <col span="1" style="width: 8%;">
					   <col span="1" style="width: 9%;">
					   <col span="1" style="width: 13%;">
					   <col span="1" style="width: 8%;">
					   <col span="1" style="width: 8%;">
					   <col span="1" style="width: 8%;">
					   <col span="1" style="width: 10%;">
					   <col span="1" style="width: 10%;">
					</colgroup>
					<thead>
					<tr>
						<th>No.</th>
						<th>Packing Slip</th>
						<th>GRN</th>
						<th>GRN Date</th>
						<th>PO Number</th>
						<th>Item Code</th>
						<th>Description</th>
						<th>Qty PO</th>
						<th>Qty Received</th>
						<th>UOM</th>
						<th>Unit Price</th>
						<th>Amount</th>
					</tr>
					</thead>
					<?php foreach ($data_grn_detail as $detail) {
						if ((strcmp($detail['SUBINVENTORY'],$row['SUBINVENTORY']) == 0) 
							&& (strcmp($detail['CURRENCY_CODE'],$row['CURRENCY_CODE'])==0)
							&& (strcmp($detail['VENDOR_NAME'],$row['VENDOR_NAME'])==0)
							&& (strcmp($detail['VENDOR_SITE_CODE'],$row['VENDOR_SITE_CODE'])==0)
							&& (strcmp($detail['EMPLOYEE_ID'],$row['EMPLOYEE_ID'])==0))
							{
								$qty_po = number_format($detail['QTY_PO'],2,'.',',');
								$qty_rcv = number_format($detail['QTY_RCV'],2,'.',',');
								$price = number_format($detail['PRICE'],5,'.',',');
								$amount = number_format($detail['AMOUNT'],2,'.',',');
								$total_qty_rcv = $total_qty_rcv + $detail['QTY_RCV'];
								$total_amt = $total_amt + $detail['AMOUNT'];
								echo "<tr>
								<td align='center'>$line</td>
								<td>$detail[PACKING_SLIP]</td>
								<td align='center'>$detail[RCV_NUM]</td>
								<td>$detail[TRANSACTION_DATE]</td>
								<td>$detail[PO]</td>
								<td>$detail[ITEM]</td>
								<td>$detail[DESCRIPTION]</td>
								<td align='right'>$qty_po</td>
								<td align='right'>$qty_rcv</td>
								<td>$detail[RCV_UOM]</td>
								<td align='right'>$price</td>
								<td align='right'>$amount</td>
								</tr>";
								
								$line++;
							}
					}
					foreach ($data_grn_sum_qty as $sum_qty) { 
						if($row['SUBINVENTORY']==$sum_qty['SUBINVENTORY'] and $row['EMPLOYEE_ID']==$sum_qty['EMPLOYEE_ID']){?>
					<tr>
						<td colspan="8"></td>
						<td align="right"><?=number_format($sum_qty['QTY_RCV'],2,'.',',');?></td>
						<td><?=$sum_qty['RCV_UOM'];?></td>
					<?php } }
					?>

						<td colspan="2" align="right"><?=number_format($total_amt,2,'.',',');?></td>
					</tr>
					</table>
  <?php 
		$rcv = $row['EMPLOYEE_ID'];
		if ($rcv==425 or $rcv==456)
		{ $receiver = 'Nanik Haidaroh';}
		elseif ($rcv==430)
		{ $receiver = 'David Butar Butar';}
		elseif ($rcv==443)
		{ $receiver = 'Rudy Iswahyudi';}
		elseif ($rcv==444)
		{ $receiver = 'Yanwar Handoko';}
		elseif ($rcv==447 or $rcv==453)
		{ $receiver = 'Nur Fitriyani Dewi';}
		elseif ($rcv==449 or $rcv==454)
		{ $receiver = 'M.Syarifuddin';}
		elseif ($rcv==451)
		{ $receiver = 'Bagus Yuwono';}
		elseif ($rcv==452)
		{ $receiver = 'Ida Chuto Ifa';}
		else {$receiver = '';} ?>
		
		</br>
		  <table border="1" class="table-cont">
			<tr><td>Received By : <?=$receiver;?></td><td rowspan="3">M/S.PT.Panasonic Gobel Life Solutions Manufacturing Indonesia
			</br></br></br>(AUTHORISED SIGNATURE)</td></tr>
			<tr><td>Checked By :</td></tr>
			<tr><td>Inspected By :</td></tr>
		  </table>
	<?php }
			$temp_subinventory = $row['SUBINVENTORY'];
			$temp_curr = $row['CURRENCY_CODE'];	
			$temp_vname = $row['VENDOR_NAME'];	
			$temp_vsite = $row['VENDOR_SITE_CODE'];
			$temp_rcv = $row['EMPLOYEE_ID'];
  }
		?>
	  
	  
  </body>
  
   <style>

   @media print {
		.page-break	{ display: block; page-break-after: always; }
		
	}
	
    body {
        height: 850px;
        width: 750px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
		font-size: 11px;
    }
	.table-cont{   
		font-family: "Calibri", Courier, monospace;
		font-size: 11px;
		width: 100%;
		border-collapse: collapse;
	}

	td {
		width: 10%;
		padding: 2.5px;
	}
	.footer .page-number:after { content: counter(page); }
    </style>

</html>