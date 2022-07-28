<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
   <style>
    body {
        height: 185mm;
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
	padding: 2px;
	}

    </style>
      <title>Payment Journal Voucher Report</title>
   </head>
   <body>
   <font size="3" face="Courier New" >  
			<table><tr>Payment Journal Voucher</tr></br>
			<tr>PT Panasonic Gobel Life Solutions Manufacturing Indonesia</tr></br></table>
	<?php 
	$temp_jv = '';
	$temp_vnum = '';
	$temp_vname = '';
	$temp_vsite = '';
	$temp_curr = '';
	$temp_gldate = '';
	
	foreach ($data_pay_journal as $row){
			$i = 0;
			$sum_entered_dr = 0 ;
			$sum_entered_cr = 0 ;
			$sum_accounted_dr = 0 ;
			$sum_accounted_cr = 0 ;
			$account_desc = '';
			

		if (strcmp($temp_jv,$row['VOUCHER']) !== 0){
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
		if (strcmp($temp_curr,$row['CURRENCY_CODE']) !== 0){
			$i=1;
		}
		if (strcmp($temp_gldate,$row['DEFAULT_EFFECTIVE_DATE']) !== 0){
			$i=1;
		}

	if ($i>0){

	?>
	
		</br>	
		<table cellpadding="1" cellspacing="0" style='font-family:"Courier New", Courier, monospace; font-size:11px; width:70%'>
		<tr>
			<td width="15%">Status</td><td width="20%">: POSTED</td><td width="15%">Vendor No.</td><td>: <?=$row['VENDOR_NUMBER'];?></td>
		</tr>
		<tr>
			<td>JV No.</td><td>: <?=$row['VOUCHER'];?></td><td>Vendor Name</td><td>: <?=$row['VENDOR_NAME'];?></td>
		</tr>
		<tr>
			<td>GL Date</td><td>: <?=$row['DEFAULT_EFFECTIVE_DATE'];?></td><td>Vendor Site</td><td>: <?=$row['VENDOR_SITE_CODE'];?></td>
		</tr>
		<tr>
			<td></td><td></td><td>Currency</td><td>: <?=$row['CURRENCY_CODE'];?></td>
		</tr>
		</table>
				
			<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
				<tr>
					<th width="5%">Account Code</th>
					<th width="5%">AUX</th>
					<th width="30%">Account Desc.</th>
					<th width="20%">Description</th>
					<th width="10%">Entered DR</th>
					<th width="10%">Entered CR</th>
					<th width="10%">Accounted DR</th>
					<th width="10%">Accounted CR</th>
					
				</tr>
			<?php 
				foreach ($data_pay_detail as $detail){
					
				if ((strcmp($detail['VOUCHER'],$row['VOUCHER']) == 0) 
				 && (strcmp ($detail['VENDOR_NUMBER'],$row['VENDOR_NUMBER'] == 0))
				 && (strcmp ($detail['VENDOR_NAME'],$row['VENDOR_NAME'] == 0))
				 && (strcmp ($detail['VENDOR_SITE_CODE'],$row['VENDOR_SITE_CODE'] == 0))
				 && (strcmp ($detail['CURRENCY_CODE'],$row['CURRENCY_CODE'] == 0))
				 && (strcmp ($detail['DEFAULT_EFFECTIVE_DATE'],$row['DEFAULT_EFFECTIVE_DATE'] == 0))			 
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
					<td>$detail[ACCOUNT_CODE]</td>
					<td>$detail[AUX]</td>
					<td>$account_desc</td>
					<td>$detail[DESCRIPTION]</td>
					<td align='right'>$entered_dr</td>
					<td align='right'>$entered_cr</td>
					<td align='right'>$accounted_dr</td>
					<td align='right'>$accounted_cr</td>
					
					</tr>";
					}
				}
			?>
				<tr>
					<th colspan = "4"></th>
					<th align="right"><?=number_format($sum_entered_dr,2,'.',',');?></th>
					<th align="right"><?=number_format($sum_entered_cr,2,'.',',');?></th>
					<th align="right"><?=number_format($sum_accounted_dr,2,'.',',');?></th>
					<th align="right"><?=number_format($sum_accounted_cr,2,'.',',');?></th>
					
				</tr>
			</table>
		<?php
			}

			$temp_jv = $row['VOUCHER'];
			$temp_vnum = $row['VENDOR_NUMBER'];
			$temp_vname = $row['VENDOR_NAME'];
			$temp_vsite = $row['VENDOR_SITE_CODE'];
			$temp_curr = $row['CURRENCY_CODE'];
			$temp_gldate = $row['DEFAULT_EFFECTIVE_DATE'];
			}  ?>
</br>
<table border = "1" cellpadding="3" cellspacing="0" width="50%">
         <tr>
            <th width="10%">Prepared by</th>
            <th width="10%">Checked by</th>
            <th colspan="3" width="30%">Approved by</th>
         </tr>
         <tr>
            <td></br></br></br></td>
            <td></br></br></br></td>
            <td></br></br></br></td>
			<td></br></br></br></td>
			<td></br></br></br></td>
         </tr>
      </table>
	  </font>
   </body>
</html>