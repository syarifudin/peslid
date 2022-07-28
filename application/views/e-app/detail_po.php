<div class="main-content">
                <div class="section__content section__content--p30">
                <div class="content">
	<?php
				$temp_supplier ='';
				$temp_po = '';
				$temp_address1 = '';
				$temp_address2 = '';
				$temp_address3 = '';
				$temp_rev = '';
				$temp_curr = '';
				$temp_buyer = '';
				$temp_ship = '';
				$temp_create = '';
				$temp_payterms = '';
				$temp_desc = '';
        $data_po_print=$data_po_detail;
        
			foreach ($data_po_print as $row){
			 
				
				$i = 0;
				$sum_qty = 0;
				$sum_amt = 0;
				$buyer_name = '';
				$terms_pay = '';
				$tax = 0;
				$tax_amount = 0;
				$grand = 0;
				$delivery = '';
				$no = 1;
				$terms = '';
								
				if (strcmp($temp_supplier,$row['SUPPLIER']) !== 0){
					$i=1;
				}
				if (strcmp($temp_po,$row['PO_NUM']) !== 0){
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
				if (strcmp($temp_rev,$row['REVISION_NUM']) !== 0){
					$i=1;
				}
				if (strcmp($temp_curr,$row['CURRENCY_CODE']) !== 0){
					$i=1;
				}
				if (strcmp($temp_buyer,$row['BUYER']) !== 0){
					$i=1;
				}
				if (strcmp($temp_ship,$row['FREIGHT_TERMS_LOOKUP_CODE']) !== 0){
					$i=1;
				}
				if (strcmp($temp_create,$row['CREATION_DATE']) !== 0){
					$i=1;
				}
				if (strcmp($temp_payterms,$row['TERMS_ID']) !== 0){
					$i=1;
				}
				if (strcmp($temp_desc,$row['COMMENTS']) !== 0){
					$i=1;
				}
				if ($i>0){
				?>
					<p class="page-break">
					<font size="1" face="Calibri">  
					<table cellpadding="0" cellspacing="0">
					<tr>
						<th><div><font size="6" face="Arial"><b>Panasonic</b></font></div></th>
						<th align='right'><div><font size="1" face="Calibri">Creation Date: <?=$row['CREATION_DATE'];?></br>
						Print Date: <?=date("d-m-Y");?></div></th>
					</tr>
					<tr>
						<td><div><font size="1" face="Calibri">(Lighting - Lamp - Wiring Device)</font></div></td>
					</tr>
					<tr>
					<td colspan="2"><div><font size="3" face="Arial">PT Panasonic Gobel Life Solutions Manufacturing Indonesia</font></div><td>

					</tr>
					<tr>
						<td colspan="2"><div><font size="1" face="Calibri"><b>Bogor Head Office</b></font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div><font size="1" face="Calibri">Kawasan Industri Menara Permai Jl. Raya Narogong KM 23.8 Cileungsi Bogor 16820 Jawa Barat - INDONESIA,  Tel (021) 8230054 Fax (021) 8230339-40</font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div><font size="1" face="Calibri"><b>Pasuruan Factory</b></font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div><font size="1" face="Calibri">Kawasan Pasuruan Industrial  Estate Rembang  Jl. Rembang Industri Raya 47 Pasuruan 67152  Jawa Timur - INDONESIA, Tel (0343) 740230  Fax (0343) 740239</font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div align="center"><font size="3" face="Calibri"><b><u>PURCHASE ORDER</u></b></font></div><td>
					</tr>
					</table>
				<?php
					if ($row['BUYER'] == 430){$buyer_name = 'David Butar Butar';} 
					if ($row['BUYER'] == 452){$buyer_name = 'Ida Chuto Ifa';} 
					if ($row['BUYER'] == 449){$buyer_name = 'M.Syarifuddin';} 
					if ($row['BUYER'] == 451){$buyer_name = 'Bagus Yuwono';} 
					if ($row['BUYER'] == 447){$buyer_name = 'Nur Fitriyani Dewi';} 
					if ($row['BUYER'] == 456){$buyer_name = 'Sindhu Gumilang';} 
					if ($row['BUYER'] == 455){$buyer_name = 'Willy Wijaya';} 
					if ($row['BUYER'] == 425){$buyer_name = 'Nanik Haidaroh';}
					if ($row['BUYER'] == 443){$buyer_name = 'Rudy Iswahyudi';}
					if ($row['BUYER'] == 951){$buyer_name = 'Hafizul I';}
					
					if ($row['TERMS_ID'] == 10000){$terms_pay = 'C30M10';}
					if ($row['TERMS_ID'] == 10001){$terms_pay = 'C30M30';}
					if ($row['TERMS_ID'] == 10023){$terms_pay = 'Net 30';}
					if ($row['TERMS_ID'] == 10041){$terms_pay = 'Net 60';}
					if ($row['TERMS_ID'] == 10080){$terms_pay = 'Net 14';}
					if ($row['TERMS_ID'] == 10081){$terms_pay = 'Net 105';}
					
			?>
					<table cellpadding="1" cellspacing="0" style='font-family:"Calibri", Courier, monospace; font-size:12px;' >
					<tr>
						<td>Supplier Code</td><td>: <?=$row['SUPPLIER'];?></td><td>Order No.</td><td>: <?=$row['PO_NUM'];?></td>
					</tr>
					<tr>
						<td>To</td><td rowspan="3" valign="top">: <?=$row['ADDRESS1'];?> <?=$row['ADDRESS2'];?> <?=$row['ADDRESS3'];?></td><td>Revision No.</td><td>: <?=$row['REVISION_NUM'];?></td>
					</tr>
					<tr>
						<td></td><td>Trade Terms</td><td>: <?=$row['FREIGHT_TERMS_LOOKUP_CODE'];?></td>
					</tr>
					<tr>
						<td></td><td>Shipment</td><td>: <?=$terms;?></td>
					</tr>
					<tr>
						<td>Attn.</td><td>:</td><td>Payment Terms</td><td>: <?=$terms_pay;?></td>
					</tr>
					<tr>
						<td>Delivery To</td><td rowspan="3" valign="top">:</td><td valign="top">Currency</td><td valign="top">: <?=$row['CURRENCY_CODE'];?></td>
					</tr>
					<tr>
						<td></td><td valign="top">Description</td><td valign="top">: <?=$row['COMMENTS'];?></td>
					</tr>
					<tr>
						<td></td><td valign="top">Buyer</td><td valign="top">: <?=$buyer_name;?></td>
					</tr>
					<tr>
						<td valign="top">Bill To</td><td>: Jl. Rembang Industri Raya 47 PIER, Pasuruan 67152 - Indonesia</td><td></td>
					</tr>
					</table>
					<table border="1" cellpadding="1" cellspacing="0" class="table-cont">
					<thead>
					<tr>
						<th>No.</th>
						<th>Model Number</th>
						<th >Description</th>
						<th>Qty</th>
						<th>UOM</th>
						<th>Unit Price</th>
						<th>ETD</th>
						<th>ETA</th>
						<th>Amount</th>
					</tr>
					</thead>
					<?php
						foreach ($data_po_detail as $detail){
							if($detail['ITEM_COST']<=0)
							{
								echo "<script type='text/javascript'>
										alert('Item Cost Null!');
										document.location = 'f_print_po';
									</script>";		
							}
							else
							{
							
							if ((strcmp($detail['SUPPLIER'],$row['SUPPLIER']) == 0) 
							 && (strcmp($detail['PO_NUM'],$row['PO_NUM'])==0)
							 && (strcmp ($detail['ADDRESS1'],$row['ADDRESS1']) == 0)
							 && (strcmp ($detail['ADDRESS2'],$row['ADDRESS2']) == 0)
							 && (strcmp ($detail['ADDRESS3'],$row['ADDRESS3']) == 0)
							 && (strcmp ($detail['REVISION_NUM'],$row['REVISION_NUM']) == 0)
							 && (strcmp ($detail['CURRENCY_CODE'],$row['CURRENCY_CODE']) == 0)
							 && (strcmp ($detail['BUYER'],$row['BUYER']) == 0) 
							 && (strcmp ($detail['FREIGHT_TERMS_LOOKUP_CODE'],$row['FREIGHT_TERMS_LOOKUP_CODE']) == 0)
							 && (strcmp ($detail['CREATION_DATE'],$row['CREATION_DATE']) == 0)
							 && (strcmp ($detail['TERMS_ID'],$row['TERMS_ID']) == 0)
							 && (strcmp ($detail['COMMENTS'],$row['COMMENTS']) == 0)
							)
							{
								$qty = number_format($detail['QUANTITY'],2,'.',',');
								
							
								$price = number_format($detail['UNIT_PRICE'],5,'.',',');
								
								$amount = number_format($detail['QUANTITY']*$detail['UNIT_PRICE'],2,'.',',');
								
								$sum_qty = $sum_qty + $detail['QUANTITY'];
								$sum_amt = $sum_amt + ($detail['QUANTITY']*$detail['UNIT_PRICE']);

								echo "<tr height=30px>
								<td align='right'>$detail[LINE_NUM]</td>
								<td>$detail[ITEM_NUMBER]</td>
								<td>$detail[ITEM_DESCRIPTION]</td>
								<td align='right'>$qty</td>
								<td>$detail[UOM]</td>
								<td align='right'>$price</td>
								<td>$detail[PROMISED_DATE]</td>
								<td>$detail[NEED_BY_DATE]</td>
								<td align='right'>$amount</td>
								</tr>";
							}
						}
							$tax_amount = $sum_amt * $tax ;
							
							$grand = $sum_amt + $tax_amount;
							$sum_qty_=	$sum_qty;
					}
					?>
					<tr>
						<th></th>
						<th></th>
						<th>Total</th>
						<th align="right"><?php if($row['BUYER']){echo number_format($sum_qty,2);}?></th>
						<th colspan="4"><div align="right">Total Amount:</div></th>
					<th><div align="right"><?=number_format($sum_amt,2,'.',',');?></div></th>
					</tr>
					<tr>
						<td colspan="8"><div align="right"><b>Tax:</b></div></td>
						<td><div align="right"><b><?=number_format($tax_amount,2,'.',',');?></b></div></td>
					</tr>
					<tr>
						<td colspan="8"><div align="right"><b>PPh:</b></div></td>
						<td><div align="right"><b></b></div></td>
					</tr>
					<tr>
						<td colspan="8"><div align="right"><b>Grand Total:</b></div></td>
						<td><div align="right"><b><?=number_format($grand,2,'.',',');?></b></div></td>
					</tr>
					</table>
		</p>
	<?php	
			}
				$temp_supplier = $row['SUPPLIER'];
				$temp_po = $row['PO_NUM'];
				$temp_address1 = $row['ADDRESS1'];
				$temp_address2 = $row['ADDRESS2'];
				$temp_address3 = $row['ADDRESS3'];
				$temp_rev = $row['REVISION_NUM'];
				$temp_curr = $row['CURRENCY_CODE'];
				$temp_buyer = $row['BUYER'];
				$temp_ship = $row['FREIGHT_TERMS_LOOKUP_CODE'];
				$temp_create = $row['CREATION_DATE'];
				$temp_payterms = $row['TERMS_ID'];
				$temp_desc = $row['COMMENTS'];
			} ?>
   </body>
   <style>
 	.table-cont{   
		font-family: "Calibri", Courier, monospace;
		font-size: 12px;
		width: 90%;
		border-collapse: collapse;
	}
	td {
		width: 10%;
		padding: 2.5px;
	}
  .footer .page-number:after { content: counter(page); }
  .content {
    width: 85%;
    background: white;
    padding: 12px 15px;
    margin-left: 8%;
    margin-top: 1%;
}

    </style>
</div>
</div>
</div>
