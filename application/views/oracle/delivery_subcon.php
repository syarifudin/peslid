<?php $this->load->database();?>
<style>
#serviceBox
{
	 font-family: Calibri;
	margin-top:2%;
}
.serviceBox1 {
   display: inline-block; 

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
	  font-size:12px;
}
</style>
<p class="page-break">

					<font size="1" face="Calibri">  
					<table cellpadding="0" cellspacing="0">
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
						<td colspan="2"><div><font size="1" face="Calibri">Kawasan Pasuruan Industrial  Estate Rembang  Jl. Rembang Industri Raya 47 Pasuruan 67152  Jawa Timur - INDONESIA, Tel (0343) 740230  Fax (0343) 740239</font></div><td>
					</tr>
					<tr>
						<td colspan="2"><div align="center"><font size="3" face="Calibri"><b><u>Picklist Subcon</u></b></font></div><td>
					</tr>
					</table>
					<?php 
					foreach($header as $hdr);
					?>
			 <div id="serviceBox"> 
					<div class="serviceBox1">
					<table border='1'>
					<th>Purchase Order No
					</th>
					<th> <?=$hdr['PO_NUMBER'];?>
					</th>
					<tr>
					<td>Supply TO
					</td>
					<td>2ANG00<br><?=$hdr['SUPPLIER'];?>
					</td>
					</tr>
					<tr>
					<td>Address					</td>
					<td><?=$hdr['ADDRESS1']."<br>".$hdr['ADDRESS2'];?></td>
					</tr>
					<tr>
					<td>Completion Inventory					</td>
					<td>2I0000</td>
					</tr>
					</table>
					</div>
					<div class="serviceBox2">
					<table border='1'>
						<th>Sender</th>
						<th>Transporter</th>
						<tr>
						<td> &ensp;&ensp;&ensp;<br><br><br>
						</td>
						<td><br><br><br>
						</td>
						</tr>
						<tr>
						<td style="width: 15%;"> Date :&ensp;<br> Name
						</td>
						<td>Date :<br> Name
						</td>
						</tr>				
					</table>
					</div>
			</div>
			<br>
			<span> <b>Material Utilization Detail</b></span>
			<table border='1'>
				<th>No</th>
				<th>Item Code </th>
				<th>Desc</th>
				<th>UOM</th>
				<th>Qty Per</th>
				<th>Finished Goods</th>
				<th>Desc</th>
				<th>Discreate Job</th>
				<th>Planed Qty</th>
				<th>Net Qty</th>
				<th>Scrap Allw</th>
				<th>Total Qty</th>
				<?php
					$no=0;
					foreach ($header as $det){ 
					$item=$det['ITEM'];
					$query = $this->db->query("select a.c_item,a.op_unit, a.c_item_desc,a.c_uom,qty_com,a.supply_subinventory,a.source_subinventory,a.yield,b.item_number,b.on_hand_qty,b.SUBINVENTORY_CODE from 
								orc_bom_list  a full outer join orc_inv_on_hand_view  b ON a.c_item=b.item_number where (effective_date_to >=CAST(GETDATE() AS DATE) or effective_date_to ='1900-01-01') and effective_date_from <=CAST(GETDATE() AS DATE) 
								and p_item='$item'");
							$data=$query->result_array();
					foreach($data as $itm){	
					$no=$no+1;					
				?>
				<tr>
				<td><?=$no;?></td>			
				<td><?=$itm['c_item'];?></td>			
				<td><?=$itm['c_item_desc'];?></td>
				<td><?=$itm['c_uom'];?></td>
				<td><?=round($itm['qty_com'], 5);?></td> 
				<td><?=$det['ITEM'];?></td>
				<td><?=$det['ITEM_DESCRIPTION'];?></td>
				<td><?=$det['DJ'];?></td>
				<td><?=$det['QUANTITY_ORDERED'];?></td>
				<td><?=round(($itm['qty_com']*$det['QUANTITY_ORDERED']),2);?></td>
				
				<td><?php echo ((1-$itm['yield'])*(round(($itm['qty_com']*$det['QUANTITY_ORDERED']),2)));?></td>
				<td><?=round(($itm['qty_com']*$det['QUANTITY_ORDERED']),2)+((1-$itm['yield'])*(round(($itm['qty_com']*$det['QUANTITY_ORDERED']),2)));?></td>
				</tr>
					<?php }}?>
			</table>
					