<html>
  <head>
	<title>Debit/Credit Note Print</title>    		
  </head>
  <body>
  <?php 
  				$temp_dnno ='';
				$temp_billto ='';
				$temp_account ='';
				$temp_address1 = '';
				$temp_address2 = '';
				$temp_address3 = '';
				$temp_address4 = '';
				$temp_address5 = '';
				$temp_create = '';
				$temp_due = '';
				$dnorcn='';
				/*$temp_curr = '';
				$temp_desc = '';
				$temp_lnno = '';
				$temp_amt = '';
				$temp_qty = '';
				$temp_price = '';*/
				
		foreach ($data_dncn as $row) {
			
				$i = 0;
				$sum_amt = 0;
				$line = 1;
				
				if (strcmp($temp_dnno,$row['TRX_NUMBER']) !== 0){
					$i=1;
				}
				if (strcmp($temp_billto,$row['BILL_TO']) !== 0){
					$i=1;
				}
				if (strcmp($temp_account,$row['ACCOUNT_NUMBER']) !== 0){
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
				if (strcmp($temp_address5,$row['ADDRESS5']) !== 0){
					$i=1;
				}
				if (strcmp($temp_create,$row['CREATION_DATE']) !== 0){
					$i=1;
				}
				if (strcmp($temp_due,$row['DUE_DATE']) !== 0){
					$i=1;
				}
				if (substr($row['TRX_NUMBER'],0,2) == "CN"){
					$dnorcn='CREDIT NOTE';
				}
				else {
					$dnorcn='DEBIT NOTE';
				}
				
				
	if ($i>0){

			?>
	<font size="1" face="Book Antiqua">  
					<table cellpadding="0" cellspacing="0" style="width: 100%">
					<colgroup>
					   <col span="1" style="width: 70%;">
					   <col span="1" style="width: 15%;">
					   <col span="1" style="width: 15%;">
					</colgroup>
					<tr>
						<td colspan="3"><div><font size="6" face="Arial"><b>Panasonic</b></font></div></td>
					</tr>
					<tr>
						<td colspan="3"><div><font size="3" face="Book Antiqua">PT Panasonic Gobel Life Solutions Manufacturing Indonesia</font></div></td>
					</tr>
					<tr>
						<td colspan="3"><div><font size="2" face="Book Antiqua">Jl. Rembang Industri Raya No.47</font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">PIER, Pasuruan - 67152, INDONESIA</font></div></td>
						<td><div><font size="2" face="Book Antiqua">Div. Code</font></div></td>
						<td><div><font size="2" face="Book Antiqua">: 00038274</font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Phone: 0343-740230</div></td>
						<td><div><font size="2" face="Book Antiqua">No.</font></div></td>
						<td><div><font size="2" face="Book Antiqua">: <?=$row['TRX_NUMBER'];?> </font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Fax: 0343-740239</font></div></td>
						<td><div><font size="2" face="Book Antiqua">Date</font></div></td>
						<td><div><font size="2" face="Book Antiqua">: <?=$row['GL_DATE'];?></font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Email : pli.info@id.panasonic.com</td>
						<td><div><font size="2" face="Book Antiqua">Due Date</font></div></td>
						<td><div><font size="2" face="Book Antiqua">:<?=$due_data;?></font></div></td>
					</tr>
					</table>
					<table border="1" class="table-cont">
					<tr class="dnListHeading">
						<td colspan="3" bgcolor="#d3d3d3"><div align="center"><font size="4" face="Book Antiqua"><b><?=$dnorcn;?></b></font></div></td>
					</tr>
					</table>
					<table style="width: 100%">
					<colgroup>
					   <col span="1" style="width: 20%;">
					   <col span="1" style="width: 80%;">
					</colgroup>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Account of Messrs</td>
						<td><div><font size="2" face="Book Antiqua">: <?=$row['ADDRESS1'];?></font></div></td>
					</tr>
					<tr>
						<td></td>
						<td><div><font size="2" face="Book Antiqua"> &nbsp; <?=$row['ADDRESS2'];?></font></div></td>
					</tr>
					<tr>
						<td></td>
						<td><div><font size="2" face="Book Antiqua"> &nbsp; <?=$row['ADDRESS3'];?></font></div></td>
					</tr>
					<tr>
						<td></td>
						<td><div><font size="2" face="Book Antiqua"> &nbsp; <?=$row['ADDRESS4'];?></font></div></td>
					</tr>
					<tr>
						<td></td>
						<td><div><font size="2" face="Book Antiqua"> &nbsp; <?=$row['ADDRESS5'];?></font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Customer Code</font></div></td>
						<td><div><font size="2" face="Book Antiqua">: <?=$row['ACCOUNT_NUMBER'];?></font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Attention</font></div></td>
						<td><div><font size="2" face="Book Antiqua">: <?=$attention_data;?></font></div></td>
					</tr>
					<tr>
						<td><div><font size="2" face="Book Antiqua">Email</font></div></td>
						<td><div><font size="2" face="Book Antiqua">: <?=$email_data;?></font></div></td>
					</tr>
					</table>
					<table class="table-cont" cellpadding="7" cellspacing="0">
					<colgroup>
						<col span="1" style="width: 5%;">
						<col span="1" style="width: 75%;">
						<col span="1" style="width: 5%;">
						<col span="1" style="width: 15%;">
					</colgroup>
					<thead>
					<tr class="dnListHeading" >
						<th bgcolor="#d3d3d3">No.</th>
						<th bgcolor="#d3d3d3" width="50%">Description</th>
						<th bgcolor="#d3d3d3" colspan="2">Amount</th>
					</tr>
					</thead>
					<?php foreach ($data_dncn_detail as $detail) {
						if ((strcmp($detail['TRX_NUMBER'],$row['TRX_NUMBER']) == 0) 
							&& (strcmp($detail['BILL_TO'],$row['BILL_TO'])==0)
							&& (strcmp($detail['ACCOUNT_NUMBER'],$row['ACCOUNT_NUMBER'])==0)
							&& (strcmp($detail['ADDRESS1'],$row['ADDRESS1'])==0)
							&& (strcmp($detail['ADDRESS2'],$row['ADDRESS2'])==0)
							&& (strcmp($detail['ADDRESS3'],$row['ADDRESS3'])==0)
							&& (strcmp($detail['ADDRESS4'],$row['ADDRESS4'])==0)
							&& (strcmp($detail['ADDRESS5'],$row['ADDRESS5'])==0)
							&& (strcmp($detail['CREATION_DATE'],$row['CREATION_DATE'])==0)
							&& (strcmp($detail['DUE_DATE'],$row['DUE_DATE'])==0))
							{
								$amount = $detail['EXTENDED_AMOUNT'];
								if ($dnorcn == 'CREDIT NOTE'){
									if ($amount < 0){
										$amount=$amount*(-1);
									}
									else {
										$amount=$amount;
									}
								}
								$sum_amt = $sum_amt + $amount;
								$amount = number_format($amount,2,'.',',');
								echo "<tr>
								<td align='center' height='40'>$line</td>
								<td height='40'>$detail[DESCRIPTION]</td>
								<td height='40'>$detail[CURRENCY]</td>
								<td align='right' height='40'>$amount</td>
								</tr>";
								
								$line++;
							}
					}
					?>
					<tr>
						<td colspan="4"></br></br>Detail Enclosed</td>
					</tr>
					<tr>
						<td colspan="4">Exchange Rate 1 USD =<?=$conv;?></td>
					</tr>
					
					</table>
					<table class="table-cont" cellpadding="7" cellspacing="0">
					<colgroup>
						<col span="1" style="width: 5%; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;">
						<col span="1" style="width: 75%; border-top: 1px solid #000; border-bottom: 1px solid #000;">
						<col span="1" style="width: 5%; border-top: 1px solid #000; border-bottom: 1px solid #000;">
						<col span="1" style="width: 15%; border-top: 1px solid #000; border-bottom: 1px solid #000; border-right: 1px solid #000;">
					</colgroup>
					<tr>
						<td height="30"></td><td height="30"></td>
						<td height="30"><b><?=$detail['CURRENCY'];?></b></td>
						<td align='right' height="30"><b><?=number_format($sum_amt,2,'.',',');?></b></td>
					</tr>
					</table>
					
		<?php
	}		
			$temp_dnno = $row['TRX_NUMBER'];
			$temp_billto = $row['BILL_TO'];	
			$temp_account = $row['ACCOUNT_NUMBER'];	
			$temp_address1 = $row['ADDRESS1'];	
			$temp_address2 = $row['ADDRESS2'];	
			$temp_address3 = $row['ADDRESS3'];	
			$temp_address4 = $row['ADDRESS4'];	
			$temp_address5 = $row['ADDRESS5'];		
			$temp_create = $row['CREATION_DATE'];	
			$temp_due = $row['DUE_DATE'];	
		} ?>
		<table>
		<tr><div><font size="2" face="Book Antiqua">
		</br>
		</br>
		<u>Please remit the above amount to :</u></br>
		MUFG Bank, Ltd. - Surabaya Sub Branch</br>
		Beneficiary Name : PT. Panasonic Gobel Life Solutions Manufacturing Indonesia</br>
		Beneficiary Number : IDR - 7100007364; USD - 7300213559; JPY - 7200215148</br>
		<u>For Panasonic Group :</u></br>
		Please remit your payment with our division code in Panasonic Treasury System (Patres)</br>
		</br>
		</br>
		</br></div>
		<div><font size="2" face="Book Antiqua">Best Regards,</br>
		PT. Panasonic Gobel Life Solutions Manufacturing Indonesia</br>
		</br>
		</br>
		</br>
		</br>
		</br>
		<u><?=$ttd;?></u>
		</div></tr>
		</table>
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
        font-size: 12px;
    }
	.table-cont{   
		font-family: "Book Antiqua", Courier, monospace;
		font-size: 12px;
		width: 100%;
		border-collapse: collapse;
	}
	td {
		width: 10%;
		padding: 2.5px;
	}
	@media print {
		tr.dnListHeading {
			background-color: #d3d3d3 !important;
			-webkit-print-color-adjust: exact; 
		}}
	.footer .page-number:after { content: counter(page); }
  </style>
</html>