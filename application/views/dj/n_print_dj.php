<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php 
$this->load->database();
foreach ( $dj as $row) {

?>
<p style="text-align:center; font-size:14px;font-weight:bold;">PT. Panasonic Gobel Life Solutions mfg Ind</p> 

 <div style='margin-left: -0.5%;margin-bottom: -0.6%;' ><?php echo "<img alt='yes' src='../../../../barcode/barcode.php?codetype=code128a&size=20&text=".$row->WIP_ENTITY_NAME."&print=true'/>";?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo "<img alt='yes' src='../../../../barcode/barcode.php?codetype=code128a&size=20&text=".$row->SEGMENT1."&print=true'/>";?> </div>
Completion Inventory :<?=$row->COMPLETION_SUBINVENTORY;?> 
Shift : ____________<br>
Start Date  : <?=$row->SCHEDULED_START_DATE;?> <br>
<?php
$item=$row->SEGMENT1;
$query = $this->db->query("select a.c_item,a.Alternate,a.op_unit, a.c_item_desc,a.c_uom,qty_com,a.supply_subinventory,a.source_subinventory,fix.product_location_alt,b.item_number,b.on_hand_qty,b.SUBINVENTORY_CODE from 
								orc_bom_list  a full outer join orc_onhand_view_1  b ON (a.c_item=b.item_number  and a.source_subinventory=b.SUBINVENTORY_CODE)
								left join orc_fix_location as fix on a.c_item=fix.product_code
								where (effective_date_to >=CAST(GETDATE() AS DATE) or effective_date_to ='1900-01-01')
								and effective_date_from <=CAST(GETDATE() AS DATE)  
								and p_item='325399' order by 1" );
							$data=$query->result_array();
 ?>
 <?php foreach($data as $rw); echo "Supply TO : "." ".$rw['supply_subinventory']; ?> Planned Qty  :<?=$qt=$row->START_QUANTITY;?> | Actual :_______/_______/_________/
 <div style="
 margin-top: -25px;
    float: right;
    font-size: 16px;
    font-weight: bold;
" ><?php echo "<img alt='yes' src='../../../../barcode/barcode.php?codetype=code128a&size=20&text=".$rw['supply_subinventory']."-".$row->GEN_OBJECT_ID."&print=true'/>";?></div>
<table  border='1' style='margin-top:1px;' cellspacing="0">
 <thead>
			<tr> 
				<th colspan="7">Date</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>	
			</thead>
			<thead> 
				<tr> 
				<th>No</th>
    				<th>Item</th> 
    				<th>Desc</th> 
    				<th>UM</th> 
					<th>STD Packing</th> 
    				<th>QTY Per</th> 
    				<th>QTY </th>
    				<th>Planner</th>  
    				<th>Source</th> 
					<th> Fix Loc</th> 
					<th> Issued 1</th> 
					<th> Issued 2</th> 
					<th> Issued 3</th> 


				</tr> 
			</thead> 
<?php 
$no=1;
foreach($data as $row){
	?>
		      <tbody> 
	   				<tr> 
					<td><?php   echo $no++ ?></td> 
						<td><?php   echo $row['c_item']."</br>".$row['op_unit']?></td> 
						<td><?php   echo $row['c_item_desc']  ?><?php 
						if ($row['source_subinventory']=='2AB000' OR $row['source_subinventory']=='2AGB4D' OR $row['source_subinventory']=='2AGB8A' OR $row['source_subinventory']=='2AGB4E' ){
						echo  "<img alt='yes' src='../../../../barcode/barcode.php?codetype=code128a&size=20&text=".$row['c_item']."'/>";}?>
						</td> 
						<td><?php   echo $row['c_uom'] ?></td> 
						<td><?php   echo '100'?></td> 
						<td><?php   echo  number_format($row['qty_com'],10) ?></td>
						<td><?php   echo $row['qty_com']*$qt ?></td></td>																												
						<td><?php   echo $row['Alternate']?></td> 																												
						<td><?php   echo $row['source_subinventory']?></td> 														
						<td><?php   echo $row['product_location_alt']?></td> 														
						<td></td> 														
						<td></td>		
						<td></td>													
																			
				    </tr> 
				</tbody> 
<?php  }
?>
			<tr> 
				<th colspan="7">Sender</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>				
			</tr>
			<tr> 
				<th colspan="7">Receiver (Approve By Manager)</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
		
			</tr>	
			</table>
</table>
<style type="text/css">

page[size="A4"] {
  background: white;
  width: 21cm;
  height: 29cm;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
       }
}
@media print {
  body, page[size="A4"] {
    margin: 0;
    box-shadow: 0;
  }
}
 body
 {
   font-family: "Courier New", Times, serif;
   font-size:11px;
   font-weight:bold;
 }
 table
 {
   width: 100%;
   border-collapse: collapse;
   font-size:12px;
   font-weight:bold;
 }
.tebal{
font-weight:bold;
}
td {
    height: 24px;
}
th {
    height: 24px;
}
p.page { page-break-after: always; }
 .footer { position: fixed; bottom: 0px; }
      .pagenum:before { content: counter(page); }
</style>
<p class="page"></p>

  <?php
  }
  ?>
</page>