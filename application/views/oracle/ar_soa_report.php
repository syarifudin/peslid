
<?php
	$temp_cust = '';
	$temp_bill = '';
	$temp_address1 = '';
	$temp_address2 = '';
	$temp_address3 = '';
	$temp_address4 = '';
	$temp_curr = '';
	
	
	foreach ($data_ar_soa as $row){
		$i = 0;
		$sum_aging0 = 0;
		$sum_aging31 = 0;
		$sum_aging61 = 0;
		$sum_aging91 = 0;
		$total = 0;
		$no = 0;
								
		if (strcmp($temp_cust,$row['ACCOUNT_NUMBER']) !== 0){
					$i=1;
				}
				if (strcmp($temp_bill,$row['BILL_TO']) !== 0){
					$i=1;
				}
				if (strcmp($temp_address1,$row['ADDRESS1']) !== 0){
					$i=1;
				}
				if (strcmp($temp_address2,$row['ADDRESS2']) !== 0){
					$i=1;
				}
				if (strcmp($temp_address3,$row['ADDRESS3']) !== 0){
					$i=1;
				}
				if (strcmp($temp_address4,$row['ADDRESS4']) !== 0){
					$i=1;
				}
				if (strcmp($temp_curr,$row['CURRENCY']) !== 0){
					$i=1;
				}
				if ($i>0){
					?>
					<p class="page-break">

					<font size="1" face="Calibri">  
					<table cellpadding="0" cellspacing="0">
					<tr>
						<td><div><font size="6" face="Arial"><b>Panasonic</b></font></div></td>
					</tr>
					<tr>
						<td><div><font size="1" face="Calibri">(Lighting - Lamp - Wiring Device)</font></div></td>
					</tr>
					<tr>
						<td><div><font size="3" face="Arial">PT Panasonic Gobel Life Solutions Manufacturing Indonesia</font></div></td>
					</tr>
					<tr>
						<td><div><font size="1" face="Calibri"><b>Bogor Head Office</b>
						</br>Kawasan Industri Menara Permai Jl. Raya Narogong KM 23.8 Cileungsi Bogor 16820 Jawa Barat - INDONESIA,  Tel (021) 8230054 Fax (021) 8230339-40
						</br><b>Pasuruan Factory</b>
						</br>Kawasan Pasuruan Industrial  Estate Rembang  Jl. Rembang Industri Raya 47 Pasuruan 67152  Jawa Timur - INDONESIA, Tel (0343) 740230  Fax (0343) 740239
						</font></div></td>
					</tr>
					<tr>
						<td><div align="center"><font size="3" face="Calibri"><b><u>STATEMENT OF ACCOUNT</u></b></font></div></td>
					</tr>
					</table>
					
					</br>
					<table cellpadding="1" cellspacing="0" style='font-family:"Calibri", Courier, monospace; font-size:12px;'>
					<tr>
						<td>Customer Code</td><td>: <?=$row['ACCOUNT_NUMBER'];?> | <?=$row['BILL_TO'];?></td><td>Division Code</td><td>: 00038274</td>
					</tr>
					<tr>
						<td>Account of Messrs</td><td>: <?=$row['ADDRESS1'];?></td><td>As at</td><td>: <?php echo $data_soa_period?></td>
					</tr>
					<tr>
						<td></td><td>: <?=$row['ADDRESS2'];?></td><td>Pay Date</td><td>: CMS Date</td>
					</tr>
					<tr>
						<td></td><td>: <?=$row['ADDRESS3'];?></td><td>Currency</td><td>: <?=$row['CURRENCY'];?></td>
					</tr>
					<tr>
						<td></td><td>: <?=$row['ADDRESS4'];?></td><td></td><td></td>
					</tr>
					<tr>
						<td>Attention</td><td>: Finance & Accounting Department</td><td></td><td></td>
					</tr>
					</table>
					<?php if ($row['BILL_TO'] == '26-PESGSID') {
						?>
					<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
					<thead>
					<tr>
						<th>No.</th>
						<th>Invoice Number</th>
						<th width="25%">Ship to</th>
						<th>Invoice Date</th>
						
						<th>Aging 0-30</th>
						<th>Aging 31-60</th>
						<th>Aging 61-90</th>
						<th>Aging Over 91</th>
					</tr>
					</thead>
					<?php
						foreach ($data_soa_detail as $detail){
							
							if ((strcmp($detail['ACCOUNT_NUMBER'],$row['ACCOUNT_NUMBER']) == 0) 
							 && (strcmp ($detail['ADDRESS1'],$row['ADDRESS1']) == 0)
							 && (strcmp ($detail['ADDRESS2'],$row['ADDRESS2']) == 0)
							 && (strcmp ($detail['ADDRESS3'],$row['ADDRESS3']) == 0)
							 && (strcmp ($detail['ADDRESS4'],$row['ADDRESS4']) == 0)
							 && (strcmp ($detail['BILL_TO'],$row['BILL_TO']) == 0)
							 && (strcmp ($detail['CURRENCY'],$row['CURRENCY']) == 0)
							)
							{
								$aging0 = number_format($detail['AMOUNT_REMAINING'],2,'.',',');
								$aging31 = number_format($detail['OVERDUE_30'],2,'.',',');
								$aging61 = number_format($detail['OVERDUE_60'],2,'.',',');
								$aging91 = number_format($detail['OVERDUE_90'],2,'.',',');
								
								$sum_aging0 = $sum_aging0 + $detail['AMOUNT_REMAINING'];
								$sum_aging31 = $sum_aging31 + $detail['OVERDUE_30'];
								$sum_aging61 = $sum_aging61 + $detail['OVERDUE_60'];
								$sum_aging91 = $sum_aging91 + $detail['OVERDUE_90'];
								
								$no++;
								
								echo "<tr height=20px>
								<td align='right'>$no</td>
								<td align='center'>$detail[INVOICE_NO]</td>
								<td align='center'>$detail[SHIP_TO]</td>
								<td align='center'>$detail[INVOICE_DATE]</td>
								
								<td align='right'>$aging0</td>
								<td align='right'>$aging31</td>
								<td align='right'>$aging61</td>
								<td align='right'>$aging91</td>
								</tr>";
							}
						}
						$total = $sum_aging0 + $sum_aging31 + $sum_aging61 + $sum_aging91;
					?>
					<tr>
						<td colspan="4" align="center"><b>AGING AMOUNT</b></td>
						<td align="right"><b><?=number_format($sum_aging0,2,'.',',');?></b></td>
						<td align="right"><b><?=number_format($sum_aging31,2,'.',',');?></b></td>
						<td align="right"><b><?=number_format($sum_aging61,2,'.',',');?></b></td>
						<td align="right"><b><?=number_format($sum_aging91,2,'.',',');?></b></td>
					</tr>
					<tr>
						<td colspan="4" align="center"><b>TOTAL AMOUNT</td>
						<td colspan="4" align="center"><b><?=number_format($total,2,'.',',');?></b></td>
					</tr>
					</table>
					<?php } 
					else { ?>
					<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
					<thead>
					<tr>
						<th>No.</th>
						<th width="15%">Invoice Number</th>
						<th>Invoice Date</th>
						
						<th>Aging 0-30</th>
						<th>Aging 31-60</th>
						<th>Aging 61-90</th>
						<th>Aging Over 91</th>
					</tr>
					</thead>
					<?php
						foreach ($data_soa_detail as $detail){
							
							if ((strcmp($detail['ACCOUNT_NUMBER'],$row['ACCOUNT_NUMBER']) == 0) 
							 && (strcmp ($detail['ADDRESS1'],$row['ADDRESS1']) == 0)
							 && (strcmp ($detail['ADDRESS2'],$row['ADDRESS2']) == 0)
							 && (strcmp ($detail['ADDRESS3'],$row['ADDRESS3']) == 0)
							 && (strcmp ($detail['ADDRESS4'],$row['ADDRESS4']) == 0)
							 && (strcmp ($detail['BILL_TO'],$row['BILL_TO']) == 0)
							 && (strcmp ($detail['CURRENCY'],$row['CURRENCY']) == 0)
							)
							{
								$aging0 = number_format($detail['AMOUNT_REMAINING'],2,'.',',');
								$aging31 = number_format($detail['OVERDUE_30'],2,'.',',');
								$aging61 = number_format($detail['OVERDUE_60'],2,'.',',');
								$aging91 = number_format($detail['OVERDUE_90'],2,'.',',');
								
								$sum_aging0 = $sum_aging0 + $detail['AMOUNT_REMAINING'];
								$sum_aging31 = $sum_aging31 + $detail['OVERDUE_30'];
								$sum_aging61 = $sum_aging61 + $detail['OVERDUE_60'];
								$sum_aging91 = $sum_aging91 + $detail['OVERDUE_90'];
								
								$no++;
								
								echo "<tr height=20px>
								<td align='right'>$no</td>
								<td align='center'>$detail[INVOICE_NO]</td>
								<td align='center'>$detail[INVOICE_DATE]</td>
								
								<td align='right'>$aging0</td>
								<td align='right'>$aging31</td>
								<td align='right'>$aging61</td>
								<td align='right'>$aging91</td>
								</tr>";
							}
						}
						$total = $sum_aging0 + $sum_aging31 + $sum_aging61 + $sum_aging91;
					?>
					<tr>
						<td colspan="3" align="center"><b>AGING AMOUNT</b></td>
						<td align="right"><b><?=number_format($sum_aging0,2,'.',',');?></b></td>
						<td align="right"><b><?=number_format($sum_aging31,2,'.',',');?></b></td>
						<td align="right"><b><?=number_format($sum_aging61,2,'.',',');?></b></td>
						<td align="right"><b><?=number_format($sum_aging91,2,'.',',');?></b></td>
					</tr>
					<tr>
						<td colspan="3" align="center"><b>TOTAL AMOUNT</td>
						<td colspan="4" align="center"><b><?=number_format($total,2,'.',',');?></b></td>
					</tr>
					</table>
					<?php } ?>
					</br>
					<table cellpadding="1" cellspacing="0" style='font-family:"Calibri", Courier, monospace; font-size:12px;'>
					<tr><td>Authorized by,</td><td></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td></td><td></td></tr>
					<tr><td><u>MATSUMOTO SHIN</u></td><td></td></tr>
					<tr><td>DIRECTOR FIN & ACC DEPT</td><td></td></tr>
					<tr><td colspan="2"><?php if ($this->session->userdata('user_site')=='222'){ ?>
					<img src="<?=base_url();?>images/soa.jpg" style="width:548px;height:139px;">
					<?php }else{?>
					<img src="<?=base_url();?>images/soa_b01.png" style="width:548px;height:139px;">
					<?php }?>
					</td></tr>
					<tr><td colspan="2">Please confirm this amount and explain if found any discrepancy by fax or e-mail ASAP (one day) :</td></tr>
					<tr><td>[ ] Correct</td><td></td></tr>
					<tr><td>[ ] Incorrect</td><td></td></tr>
					<tr><td>....................................................................</td><td>Confirmed by,</td></tr>
					<tr><td>....................................................................</td><td>Name	:</td></tr>
					<tr><td>....................................................................</td><td>Position	:</td></tr>
					<tr><td></td><td>Date	:</td></tr>
					<tr><td></td><td>Signature	:</td></tr>
					</table>
					</p>
					<?php
					
				}
	$temp_cust = $row['ACCOUNT_NUMBER'];
	$temp_bill = $row['BILL_TO'];
	$temp_address1 = $row['ADDRESS1'];
	$temp_address2 = $row['ADDRESS2'];
	$temp_address3 = $row['ADDRESS3'];
	$temp_address4 = $row['ADDRESS4'];
	$temp_curr = $row['CURRENCY'];
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
	th {
		background-color: #f1f1c1;
	}
	.footer .page-number:after { content: counter(page); }
    </style>
</html>