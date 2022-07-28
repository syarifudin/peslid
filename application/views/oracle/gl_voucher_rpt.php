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
      <title>GL Journal Voucher Report</title>
   </head>
   <body>
   <font size="3" face="Courier New" >  
			<table><tr>GL Journal Voucher</tr></br>
			<tr>PT Panasonic Gobel Life Solutions Manufacturing Indonesia</tr></br></table>
			
	<?php
	$temp_post ='';
	$temp_doc ='';
	$temp_batch ='';
	$temp_name ='';
	$temp_desc ='';
	$temp_category ='';
	$temp_gldate ='';
	$temp_entry ='';
	$temp_curr ='';
	
		foreach ($data_gl_voucher as $row){
			$i = 0;
			$sum_entered_dr = 0 ;
			$sum_entered_cr = 0 ;
			
			if (strcmp($temp_post,$row['STATUS']) !== 0){
			$i=1;
			}
			if (strcmp($temp_doc,$row['GL_NO']) !== 0){
			$i=1;
			}
			if (strcmp($temp_batch,$row['BATCH']) !== 0){
			$i=1;
			}
			if (strcmp($temp_name,$row['NAME']) !== 0){
			$i=1;
			}
			if (strcmp($temp_desc,$row['HEADER']) !== 0){
			$i=1;
			}
			if (strcmp($temp_category,$row['JE_CATEGORY']) !== 0){
			$i=1;
			}
			if (strcmp($temp_gldate,$row['GL_DATE']) !== 0){
			$i=1;
			}
			if (strcmp($temp_entry,$row['DATE_CREATED']) !== 0){
			$i=1;
			}
			if (strcmp($temp_curr,$row['CURRENCY_CODE']) !== 0){
			$i=1;
			}
			if ($i>0){
				
			$post = $row['STATUS'];
			if ($row['STATUS'] == 'P'){ $post = 'POSTED';}
			else {$post='UNPOSTED';}
	?>
	</br>	
	<table cellpadding="1" cellspacing="0" style='font-family:"Courier New", Courier, monospace; font-size:11px;'>
	<tr>
		<td>Status</td><td>: <?=$post;?></td><td>Category</td><td>: <?=$row['JE_CATEGORY'];?></td>
	</tr>
	<tr>
		<td>Document No.</td><td>: <?=$row['GL_NO'];?></td><td>GL Date</td><td>: <?=$row['GL_DATE'];?></td>
	</tr>
	<tr>
		<td>Batch Name</td><td>: <?=$row['BATCH'];?></td><td>Entry Date</td><td>: <?=$row['DATE_CREATED'];?></td>
	</tr>
	<tr>
		<td>JE Name</td><td>: <?=$row['NAME'];?></td><td>Currency</td><td>: <?=$row['CURRENCY_CODE'];?></td>
	</tr>
	<tr>
		<td>Description</td><td colspan="3">: <?=$row['HEADER'];?></td>
	</tr>
	</table>
		
	<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
		<tr>
			<th>AFF</th>
			<th width="20%">Account Desc.</th>
			<th width="20%">Description</th>
			<th>Entered DR</th>
			<th>Entered CR</th>
			
		</tr>
		<?php
			foreach ($data_gl_detail as $detail){
				if ((strcmp($detail['STATUS'],$row['STATUS']) == 0)
				 && (strcmp($detail['GL_NO'],$row['GL_NO'])==0)
				 && (strcmp ($detail['BATCH'],$row['BATCH'] == 0))
				 && (strcmp ($detail['NAME'],$row['NAME'] == 0))
				 && (strcmp ($detail['HEADER'],$row['HEADER'] == 0))
				 && (strcmp ($detail['JE_CATEGORY'],$row['JE_CATEGORY'] == 0))
				 && (strcmp ($detail['GL_DATE'],$row['GL_DATE'] == 0))
				 && (strcmp ($detail['DATE_CREATED'],$row['DATE_CREATED'] == 0))
				 && (strcmp ($detail['CURRENCY_CODE'],$row['CURRENCY_CODE'] == 0))			 
				){
					foreach ($data_acc_aux as $acc){
						if ($detail['ACCOUNT_CODE'] == $acc['account'] && $detail['AUX'] == $acc['aux']){$account_desc = $acc['acc_desc'].' . '.$acc['aux_desc'];}
					}
					$entered_dr = number_format($detail['ENTERED_DR'],2,'.',',');
					$entered_cr = number_format($detail['ENTERED_CR'],2,'.',',');
					
					$sum_entered_dr = $sum_entered_dr + $detail['ENTERED_DR'];
					$sum_entered_cr = $sum_entered_cr + $detail['ENTERED_CR'];
					
					echo "<tr>
						<td>$detail[COST_CENTER].$detail[ACCOUNT_CODE].$detail[AUX].$detail[PARTY_CODE]</td>
						<td>$account_desc</td>
						<td>$detail[DESCRIPTION]</td>
						<td align='right'>$entered_dr</td>
						<td align='right'>$entered_cr</td>
						
						</tr>";
				}
			}
		?>
		<tr>
			<th colspan = "3"></th>
			<th align="right"><?=number_format($sum_entered_dr,2,'.',',');?></th>
			<th align="right"><?=number_format($sum_entered_cr,2,'.',',');?></th>
			
		</tr>
	</table>
	<?php } 
		$temp_post =$row['STATUS'];
		$temp_doc =$row['GL_NO'];
		$temp_batch =$row['BATCH'];
		$temp_name =$row['NAME'];
		$temp_desc =$row['HEADER'];
		$temp_category =$row['JE_CATEGORY'];
		$temp_gldate =$row['GL_DATE'];
		$temp_entry =$row['DATE_CREATED'];
		$temp_curr =$row['CURRENCY_CODE'];
	} ?>
	</br>
	<table border = "1" cellpadding="4" cellspacing="0" width="50%">
         <tr>
            <th>Prepared by</th>
            <th>Checked by</th>
            <th>Approved by</th>
			 <th>Approved by</th>
			<th>Authorized by</th>
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