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
		  font-size: 12px;
}
span{
	  font-family: inherit;
	  font-size:12px;
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
						<td colspan="2"><div align="center"><font size="3" face="Calibri"><b>Requisition Report</b></font></div><td>
					</tr>
					</table>
					<?php 
					foreach ($query->result() as $hdr);
					?>
					<table  style="width: 90%;" >
						<tr>
							<td>PR Number  </td><td>:</td> <td> <?=$hdr->pr_number;?>		</td> 
							<td>	</td>
						</tr>
						<tr>
							<td>Supplier  </td><td>:</td> <td> <?=$hdr->pr_supplier;?></td>
							<td> Ship-Top	</td><td>:</td><td><?=$hdr->pr_shipto;?></td>
						</tr>
						<tr>
							<td>Req Date  </td><td>:</td> <td> </td>
							<td>Need By Date	</td><td>:</td><td><?=$hdr->pr_need_by_date;?></td>
						</tr>
						<tr>
							<td>Due Date</td><td>:</td> <td> <?=$hdr->pr_due_date;?></td>
							<td>Buyer</td><td>:</td><td><?=$hdr->pr_buyer;?></td>
						</tr>
						<tr>
							<td>Requester</td><td>:</td> <td> <?=$hdr->pr_rq;?></td>
							<td></td><td></td>
						</tr>
					</table>
					
			<br>
			<table  style="width: 100%;" border='1' >
				<th>No</th>
				<th>Item Number </th>
				<th>Desc</th>
				<th>QTY</th>
				<th>UOM</th>
				<th>Pur Acct</th>
				<th>Cost Center</th>
				<?php 
					$no=0;
					foreach ($query_det->result() as $det){ 
							$no=$no+1;
				?>
				<tr>
				<td><?=$no;?></td>			
				<td><?=$det->pr_det_item;?></td>			
				<td><?=$det->pr_det_desc;?></td>
				<td><?=$det->pr_det_qty;?></td>
				<td><?=$det->pr_det_uom;?></td> 
				<td><?=$det->pr_det_purc_account;?></td> 
				<td><?=$det->pr_det_cost_center;?></td>
				 </tr>
					<?php } ?>
			</table>

			<br/><br/><br/><br/><br/>
			<table  style="width: 90%;" border='1' >
				<th>Prepared By</th>
				<th>Checked By</th>
				<th>Approved By</th>
				<th>Purchasing</th>
				<tr>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				<td style="    height: 80px;"></td>
				</tr>
		
					</table>

					