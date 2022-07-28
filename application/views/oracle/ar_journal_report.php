<html>

   <head>
   <style>
    body {
        height: 842px;
        width: 750px;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
		font-size: 11px;
    }
	.table-cont{   
	font-family: "Courier New", Courier, monospace;
    font-size: 11px;
    width: 100%;
	border-collapse: collapse;
	}
	td {
    width: 10%;
	padding: 2.5px;
	}

    </style>
      <title>A/R Journal Voucher Report</title>
   </head>
<body>
<font size="3" face="Courier New" >  
<table><tr>A/R Journal Voucher</tr></br>
		<tr>PT Panasonic Gobel Life Solutions Manufacturing Indonesia</tr></br></table>
<?php
$temp_post = '';
$temp_ar_no = '';
$temp_invoice_no = '';
$temp_customer = '';
$temp_gl_date = '';
$temp_currency = '';
foreach($data_ar_journal as $row){
	/*echo "$row[POST]<br>
	$row[AR_NO]<br>
	$row[INVOICE_NO]<br>
	$row[CUSTOMER]<br>
	$row[CURRENCY]<br>
	$row[AUX]<br>
	$row[ENTERED_DR]<br>
	$row[ENTERED_CR]<br>
	$row[ACCOUNTED_DR]<br>
	$row[ACCOUNTED_CR]<br><br>";
	
	echo $temp_post;
	echo $temp_ar_no;
	echo $temp_invoice_no;
	echo $temp_customer;
	echo $temp_gl_date;
	echo $temp_currency;*/
	
	$i = 0;
	$sum_entered_dr = 0 ;
	$sum_entered_cr = 0 ;
	$sum_accounted_dr = 0 ;
	$sum_accounted_cr = 0 ;
	
	if (strcmp($temp_post,$row['POST']) !== 0){
		$i=1;
	}
	if (strcmp($temp_ar_no,$row['AR_NO']) !== 0){
		$i=1;
	}
	if (strcmp($temp_invoice_no,$row['INVOICE_NO']) !== 0){
		$i=1;
	}
	if (strcmp($temp_customer,$row['CUSTOMER']) !== 0){
		$i=1;
	}
	if (strcmp($temp_currency,$row['CURRENCY']) !== 0){
		$i=1;
	}
	
	if ($i>0){
		$post = $row['POST'];
		if ($row['POST'] == 'P'){ $post = 'POSTED';}
		else {$post='UNPOSTED';}
?>
</br>

<table cellpadding="1" cellspacing="0" style='font-family:"Courier New", Courier, monospace; font-size:11px;'>
<tr>
	<td>Status</td><td>: <?=$post;?></td><td>Invoice No</td><td>: <?=$row['INVOICE_NO'];?></td>
</tr>
<tr>
	<td>AR Number</td><td>: <?=$row['AR_NO'];?></td><td>Customer</td><td>: <?=$row['CUSTOMER'];?></td>
</tr>
<tr>
	<td>Currency</td><td>: <?=$row['CURRENCY'];?></td><td></td><td></td>
</tr>
</table>
<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
<tr>
	<th>GL Date</th>
	<th>Code</th>
	<th>BU</th>
	<th>Cost Center</th>
	<th>Account Code</th>
	<th>AUX</th>
	<th>Entered DR</th>
	<th>Entered CR</th>
	<th>Accounted DR</th>
	<th>Accounted CR</th>
</tr>

<?php

foreach($data_ar_detail as $detail){
	if ((strcmp($detail['POST'],$row['POST']) == 0) && (strcmp($detail['AR_NO'],$row['AR_NO'])==0)
		 && (strcmp ($detail['INVOICE_NO'],$row['INVOICE_NO'] == 0))
		 && (strcmp ($detail['CUSTOMER'],$row['CUSTOMER'] == 0))
		 && (strcmp ($detail['GL_DATE'],$row['GL_DATE'] == 0))
		 && (strcmp ($detail['CURRENCY'],$row['CURRENCY'] == 0))			 
		){
	$entered_dr = number_format($detail['ENTERED_DR'],2,'.',',');
	$entered_cr = number_format($detail['ENTERED_CR'],2,'.',',');
	$accounted_dr = number_format($detail['ACCOUNTED_DR'],2,'.',',');
	$accounted_cr = number_format($detail['ACCOUNTED_CR'],2,'.',',');
	
	$sum_entered_dr = $sum_entered_dr + $detail['ENTERED_DR'];
	$sum_entered_cr = $sum_entered_cr + $detail['ENTERED_CR'];
	$sum_accounted_dr = $sum_accounted_dr + $detail['ACCOUNTED_DR'];
	$sum_accounted_cr = $sum_accounted_cr + $detail['ACCOUNTED_CR'];
			
	echo "<tr><td>$detail[GL_DATE]
	</td><td>$detail[CODE]
	</td><td>$detail[BU]
	</td><td>$detail[COST_CENTER]
	</td><td>$detail[ACCOUNT_CODE]
	</td><td>$detail[AUX]
	</td><td align='right'>$entered_dr
	</td><td align='right'>$entered_cr
	</td><td align='right'>$accounted_dr
	</td><td align='right'>$accounted_cr</td></tr>";
	}
}
?>
		<tr>
			<th colspan="6"></th>
			<th align="right"><?=number_format($sum_entered_dr,2,'.',',');?></th>
			<th align="right"><?=number_format($sum_entered_cr,2,'.',',');?></th>
			<th align="right"><?=number_format($sum_accounted_dr,2,'.',',');?></th>
			<th align="right"><?=number_format($sum_accounted_cr,2,'.',',');?></th>
		</tr>
</table>
<?php
	}
	$temp_post = $row['POST'];
	$temp_ar_no = $row['AR_NO'];
	$temp_invoice_no = $row['INVOICE_NO'];
	$temp_customer = $row['CUSTOMER'];
	$temp_gl_date = $row['GL_DATE'];
	$temp_currency = $row['CURRENCY'];
} ?>
</br>

      <table border = "1" cellpadding="4" cellspacing="0" width="60%">
         <tr>
            <th>Prepared by</th>
            <th>Checked by</th>
            <th>Approved by</th>
			<th>Approved by</th>
         </tr>
         <tr>
            <td></br></br></br></td>
            <td></br></br></br></td>
            <td></br></br></br></td>
            <td></br></br></br></td>
         </tr>
      </table>
	</font>
   </body>
	
</html>