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
						<td colspan="2"><div align="center"><font size="3" face="Calibri"><b>GRN Report</b></font></div><td>
					</tr>
					</table>
          </br>
          </br>
					<?php 
					foreach ($query_h->result() as $hdr);
					?>
					<table  style="width: 90%;" >
						<tr>
							 
							<td>GRN Number	</td><td>:</td> <td><?=$hdr->rcv_grn_number;?></td>
              <td  >PO Number  </td><td class='right'>:</td> <td class='right'> <?=$hdr->rcv_po_number;?>		</td>
						</tr>
						<tr>
							<td>Supplier  </td><td>:</td> <td> <?=$hdr->po_supplier;?>		</td>
							<td > Ship-To	</td><td class='right'>:</td><td class='right' ><?=$hdr->po_shipto;?></td>
						</tr>
						<tr>
							<td>Invoice   </td><td>:</td> <td><?=$hdr->rcv_inv_packing;?> </td>
							<td >Rcv Date	</td><td class='right'>:</td><td class='right'><?=date('d.M.y',strtotime($hdr->rcv_received_date));?>	</td>
						</tr>
            <tr>
							<td>Currency</td><td>:</td> <td><?=$hdr->po_currency;?> </td>
							<td>	</td><td></td><td>	</td>
						</tr>
					</table>
					
			<br>
			<table  style="width: 100%;" border='1' >
				<th>No</th>
				<th>Item Number </th>
				<th>Desc</th>
				<th>Pur Acct</th>
				<th>Cost Center</th>
        <th>QTY</th>
				<th>UOM</th>
        <th>Price</th>
        <th>Amount</th>
				<?php 
          $no=0;
          $amt=0;
          foreach ($query->result() as $dt){
							$no=$no+1;
				?>
				<tr>
				<td><?=$no;?></td>			
				<td><?=$dt->pr_det_item;?></td>			
				<td><?=$dt->pr_det_desc;?></td>
				<td><?=$dt->pr_det_purc_account;?></td> 
				<td><?=$dt->pr_det_cost_center;?></td>
        <td class='right'><?=$dt->rcv_qty;?></td>
				<td><?=$dt->pr_det_uom;?></td> 
        <td class='right'> <?=number_format($dt->rcv_price, 2);?></td> 
        <td class='right'> <?=number_format($dt->rcv_price*$dt->rcv_qty, 2);?></td> 
				 </tr>
          <?php 

					 $amt+=$dt->rcv_price*$dt->rcv_qty; 
				}  
					$tax= $amt*($hdr->po_vat/100);
					 $amount=$amt+$tax;
			?>
      </table>
      </br> </br>
      <table style="width: 100%;" >
				<tr>
				<td>PPN  <?=trim($hdr->po_vat)."%";?></td>	<td></td> <td class='right'>Line Total </td><td class='right'>:</td><td class='right'> <?=number_format($amt,2)?></td></tr>
				<tr><td></td>	<td></td> <td class='right'>PPN </td> <td class='right'>:</td><td class='right'> <?=number_format($tax,2)?></td></tr>
				<tr><td></td><td>	</td> <td class='right'>Total Amount </td> <td class='right'>:</td><td class='right'> <?=number_format($amount,2)?></td></tr>
        <tr><td></td><td>	</td> <td class='right'>Value On / Transfer To</td> <td class='right'>:</td><td class='right'> </td></tr>
			</table>
			<br/><br/><br/><br/><br/>
			<table  style="width: 90%;" border='1' >
				<th>Created By</th>
				<th>Checked By</th>
				<th>Approved </th>
        <th>User </th>
				<tr>
				<td style=" width:20%;   height: 80px;"></td>
				<td style=" width:20%;     height: 80px;"></td>
				<td style=" width:20%;     height: 80px;"></td>
        <td style=" width:20%;     height: 80px;"></td>
				</tr>
		</table>

					