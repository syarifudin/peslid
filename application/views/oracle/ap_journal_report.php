<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
   <style>
    body {
        height: 190mm;
        width: 276mm;
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
      <title>A/P Journal Voucher Report</title>
   </head>
   <body>
		<font size="3" face="Courier New" >  
			<table><tr>A/P Journal Voucher</tr></br>
			<tr>PT Panasonic Gobel Life Solutions Manufacturing Indonesia</tr></br></table>
	<?php 
	
	$temp_post = '';
	$temp_jv = '';
	$temp_inv = '';
	$temp_vnum = '';
	$temp_vname = '';
	$temp_vsite = '';
	$temp_curr = '';
	$temp_invdate = '';
	$temp_duedate = '';
	
	foreach ($data_ap_journal as $row){
			$i = 0;
			$sum_entered_dr = 0 ;
			$sum_entered_cr = 0 ;
			$sum_accounted_dr = 0 ;
			$sum_accounted_cr = 0 ;
			$account_desc = '';
			
		if (strcmp($temp_post,$row['POST']) !== 0){
			$i=1;
		}
		if (strcmp($temp_jv,$row['JV_NO']) !== 0){
			$i=1;
		}
		if (strcmp($temp_inv,$row['INVOICE_NUM']) !== 0){
			$i=1;
		}
		if (strcmp($temp_vnum,$row['VENDOR_NUMBER']) !== 0){
			$i=1;
		}
		if (strcmp($temp_vname,$row['VENDOR_NAME']) !== 0){
			$i=1;
		}
		if (strcmp($temp_vsite,$row['VENDOR_SITE_CODE']) !== 0){
			$i=1;
		}
		if (strcmp($temp_curr,$row['CURR']) !== 0){
			$i=1;
		}
		if (strcmp($temp_invdate,$row['GL_DATE']) !== 0){
			$i=1;
		}
		if (strcmp($temp_duedate,$row['DUE_DATE']) !== 0){
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
	<td>Status</td><td>: <?=$post;?></td><td>Vendor No.</td><td>: <?=$row['VENDOR_NUMBER'];?></td>
</tr>
<tr>
	<td>JV No.</td><td>: <?=$row['JV_NO'];?></td><td>Vendor Name</td><td>: <?=$row['VENDOR_NAME'];?></td>
</tr>
<tr>
	<td>Invoice No.</td><td>: <?=$row['INVOICE_NUM'];?></td><td>Vendor Site</td><td>: <?=$row['VENDOR_SITE_CODE'];?></td>
</tr>
<tr>
	<td>GL Date</td><td>: <?=$row['GL_DATE'];?></td><td>Currency</td><td>: <?=$row['CURR'];?></td>
</tr>
<tr>
	<td>Due Date</td><td>: <?=$row['DUE_DATE'];?></td><td></td>
</tr>
</table>
		
	<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
		<tr>
			<th>Cost Center</th>
			<th>Account Code</th>
			<th>AUX</th>
			<th width="20%">Account Desc.</th>
			<th width="20%">Description</th>
			<th>Entered DR</th>
			<th>Entered CR</th>
		</tr>
	<?php 
		foreach ($data_ap_journal as $detail){
			
		if ((strcmp($detail['POST'],$row['POST']) == 0)
		 && (strcmp($detail['JV_NO'],$row['JV_NO'])==0)
		 && (strcmp ($detail['INVOICE_NUM'],$row['INVOICE_NUM'] == 0))
		 && (strcmp ($detail['VENDOR_NUMBER'],$row['VENDOR_NUMBER'] == 0))
		 && (strcmp ($detail['VENDOR_NAME'],$row['VENDOR_NAME'] == 0))
		 && (strcmp ($detail['VENDOR_SITE_CODE'],$row['VENDOR_SITE_CODE'] == 0))
		 && (strcmp ($detail['CURR'],$row['CURR'] == 0))
		 && (strcmp ($detail['GL_DATE'],$row['GL_DATE'] == 0))			 
		)	{
			$entered_dr = number_format($detail['ENTERED_DR'],2,'.',',');
			$entered_cr = number_format($detail['ENTERED_CR'],2,'.',',');
			$accounted_dr = number_format($detail['ACCOUNTED_DR'],2,'.',',');
			$accounted_cr = number_format($detail['ACCOUNTED_CR'],2,'.',',');
			
			$sum_entered_dr = $sum_entered_dr + $detail['ENTERED_DR'];
			$sum_entered_cr = $sum_entered_cr + $detail['ENTERED_CR'];
			$sum_accounted_dr = $sum_accounted_dr + $detail['ACCOUNTED_DR'];
			$sum_accounted_cr = $sum_accounted_cr + $detail['ACCOUNTED_CR'];
			
			foreach ($data_acc_aux as $acc){
				if ($detail['ACCOUNT_CODE'] == $acc['account'] && $detail['AUX'] == $acc['aux']){$account_desc = $acc['acc_desc'].' . '.$acc['aux_desc'];}
			}
			
			echo "<tr>
			<td>$detail[COST_CENTER]</td>
			<td>$detail[ACCOUNT_CODE]</td>
			<td>$detail[AUX]</td>
			<td>$account_desc</td>
			<td>$detail[DESCRIPTION]</td>
			<td align='right'>$entered_dr</td>
			<td align='right'>$entered_cr</td>			
			</tr>";
			}
		}
	?>
		<tr>
			<th colspan = "5"></th>
			<th align="right"><?=number_format($sum_entered_dr,2,'.',',');?></th>
			<th align="right"><?=number_format($sum_entered_cr,2,'.',',');?></th>
			
		</tr>
	</table>
<?php
	}
	$temp_post = $row['POST'];
	$temp_jv = $row['JV_NO'];
	$temp_inv = $row['INVOICE_NUM'];
	$temp_vnum = $row['VENDOR_NUMBER'];
	$temp_vname = $row['VENDOR_NAME'];
	$temp_vsite = $row['VENDOR_SITE_CODE'];
	$temp_curr = $row['CURR'];
	$temp_invdate = $row['GL_DATE'];
	$temp_duedate = $row['DUE_DATE'];

	} ?>
</br>
<table border = "1" cellpadding="3" cellspacing="0" width="50%">
         <tr>
            <th>Prepared by</th>
            <th>Checked by</th>
            <th>Approved by</th>
			<th>Authorized by</th>
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