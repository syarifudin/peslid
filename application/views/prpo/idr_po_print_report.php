<style>
#serviceBox
{
	 font-family: Calibri;
	margin-top:2%;
}
.serviceBox1 {
   display: inline-block; 
	 width:50%;

}
.serviceBox2 {
   display: inline-block; 
    margin-left: 4%;
}
table{
	 border-collapse: collapse;
	      font-family: monospace;
		  font-size: 10px;
}
.table_per{
	 border-collapse: collapse;
	      font-family: monospace;
		  font-size: 9px;
}
p{
	font-family: monospace;
		  font-size: 10px;
}
span{
	  font-family: inherit;
	  font-size:10px;
}
.tengah{
	text-align: center;
}
.right{
	text-align: right;
}
</style>
<p class="page-break">

					<font size="1" face="Calibri">  
					<table cellpadding="0" cellspacing="0" style="    width: 100%;">
					<tr>
						<th><div><font size="6" face="Arial"><b>Panasonic</b></font></div></th>
						<th align='right'><div><font size="1" face="Calibri"></br>
						Print Date: <?=date("d-m-Y");?></div></th>
					</tr>
					<tr>
						<td><div><font size="1" face="Calibri">(Lighting - Lamp - Wiring Device)</font></div></td>
					</tr>
					<tr>
						<td colspan="2"><div><font size="3" face="Arial">PT Panasonic Gobel Life Solutions Manufacturing Indonesia</font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div><font size="1" face="Calibri"><b>Pasuruan Factory</b></font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div><font size="1" face="Calibri">Kawasan Pasuruan Industrial  Estate Rembang  Jl. Rembang Industri Raya 47 Pasuruan 67152  <br>Jawa Timur - INDONESIA, Tel (0343) 740230  Fax (0343) 740239</font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div align="center"><font size="3" face="Calibri"><b>Purchase Order Report</b></font></div><td>
					</tr>
					</table>
					<?php 
					foreach ($query->result() as $hdr);
					?>
					<table  style="width: 100%;" >
						<tr>
							<td>PO Number  </td> <td>:</td> <td> <?=$hdr->po_number;?> ||	 <?=$hdr->po_remarks;?>	</td> 
							<td>	</td>
						</tr>
						<tr>
							<td>Supplier  </td><td>:</td> <td> <?=$hdr->po_supplier;?></td>
							<td> Req Date	</td><td>:</td><td></td>
						</tr>
						<tr>
							<td> Ship-Top </td><td>:</td> <td> <?=$hdr->delivery_name."</br>".$hdr->delivery_add;?></td>
							<td>Need By Date	</td><td>:</td><td><?=date('d-M-y',strtotime($hdr->po_need_by_date))?></td>
						</tr>
						<tr>
						<td>Buyer</td><td>:</td><td><?=$hdr->po_buyer;?></td>
							<td>Due Date</td><td>:</td> <td> <?=date('d-M-y',strtotime($hdr->po_due_date))?></td>
						</tr>
						<tr>
							<td>Currency</td><td>:</td> <td> <?=$hdr->po_currency;?></td>
							
						</tr>
					</table>
					
			<br>
			<table  style="width: 100%;" border='1' >
				<th>No</th>
				<th>Item Number </th>
				<th>QTY</th>
				<th>UOM</th>
				<th>Cost Center</th>
				<th>Price</th>
				<th>Tot Price</th>
				<?php 
					$no=0;
					$amt=0;
					foreach ($query_det->result() as $det){ 
							$no=$no+1;
							
				?>
				<tr>
				<td><?=$no;?></td>			
				<td><?=$det->pr_det_item;?><br> <?=$det->pr_det_desc;?></td>			
				<td class='right'><?=$det->pr_det_qty_po;?></td>
				<td class='tengah'><?=$det->pr_det_uom;?></td> 
				<td class='tengah'><?=$det->pr_det_cost_center;?></td> 
				<td class='right'><?=number_format($det->pr_det_price_po, 2);?></td>
				<td class='right'><?=number_format($det->pr_det_price_po*$det->pr_det_qty, 2);?></td>
				 </tr>
					<?php 
					 $amt+=$det->pr_det_price_po*$det->pr_det_qty; 
				}  
					$tax= $amt*($hdr->po_vat/100);
					 $amount=$amt+$tax;
			?>
			</table>
			<table style="width: 100%;" >
				<tr>
				<td>PPN : <?=trim($hdr->po_vat)."%";?></td>	<td></td> <td class='right'>Line Total </td><td class='right'>:</td><td class='right'> <?=number_format($amt,2)?></td></tr>
				<tr><td></td>	<td></td> <td class='right'>PPN </td> <td class='right'>:</td><td class='right'> <?=number_format($tax,2)?></td></tr>
				<tr><td></td><td>	</td> <td class='right'>Total Amount </td> <td class='right'>:</td><td class='right'> <?=number_format($amount,2)?></td></tr>
			</table>

			<br/><br/><br/><br/><br/>
			<table   style="width: 90%;" border='1' >
				<th>Supplier</th>
				<th>Department By</th>
				<th>Issued By</th>
				<th>Procurement <br> Manager </th>
				<th>Fin/Acc <br> Manager </th>
				<tr>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				</tr>
				</table >
				<p>*) Pembayaran akan dilakukan bila Supplier telah melengkapi dokumen berikut ini :</br>
				<table  class='table_per' >
				<tr>
				<td >1. Original Invoice (bukti penagihan)</td> <td ></td>
				<td>4. Original kuitansi bermaterai (bukti pembayaran)</td> <td ></td>
				</tr>
				<tr>
				<td >2. Original Surat Jalan</td> <td ></td>
				<td >5. Original + Copy faktur pajak (bagi supplier yang memberlakukan PPN)</td> <td ></td>
				</tr>
				<tr>
				<td>3. Copy PO</td> <td ></td>
				<td></td> <td ></td>
				</tr>
				</table>
			  *) Bila dalam invoice telah dilengkapi materai, maka kuitansi tidak diperlukan lagi </br>*)
				 Dalam setiap invoice, kuintansi, surat jalan dan faktur pajak harap menuliskan No. PO</p>

					