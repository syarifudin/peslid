<?php 
$this->load->database();
foreach ( $data_rj as $row);

?>
<p style="text-align:center; font-size:16px;font-weight:bold;">PT. Panasonic Gobel Eco Solutions mfg ind</p> 
<p style="text-align:center; font-size:14px;font-weight:bold;">Rejection Note(Nota Pengembalian Barang)</p> 
<p style="margin-left: 5%; font-size:12px;font-weight:bold;">Supplier Name : <?php echo $row->VENDOR_NAME." "; ?> </p> 

<table  border='1' align="center" cellspacing="0">
 <thead>
			<tr> 
				<th colspan="10">Data</th>	
					
			</tr>	
			</thead>
			<thead> 
				<tr> 
					<th>No</th>
					<th>PO Number</th>
					<th>RJ Number</th>
    				<th>Item Number</th> 
    				<th>Desc</th>
					<th>QTY </th>					
    				<th>UM</th> 
    				<th>Price</th> 
					<th>Currency</th> 
    				<th>Amount</th>  

				</tr> 
			</thead> 
<tbody> 			
<?php 
$no=1;
$total=0;
$total_am=0;
foreach($data_rj as $rw){
	$total+=$rw->QTY_RCV;
	$total_am+=$rw->UNIT_PRICE * $rw->QTY_RCV;
	?>
		      
	   				<tr> 
					<td><?php   echo $no++ ?></td> 
						<td><?php   echo $rw->SEGMENT1;?></td> 
						<td><?php   echo $rw->TRANSACTION_ID;?></td> 
						<td><?php   echo $rw->ITEM_CODE;?></td> 
						<td><?php   echo $rw->ITEM_DESCRIPTION  ?></td> 
						<td><?php   echo $rw->QTY_RCV ?></td></td>
						<td><?php   echo $rw->PRIMARY_UNIT_OF_MEASURE  ?></td> 
						<td><?php   echo $rw->UNIT_PRICE ?></td>
						<td><?php echo $rw->CURRENCY_CODE  ?></td> 
						<td><?php echo number_format(abs($rw->UNIT_PRICE * $rw->QTY_RCV),2)  ?>
						</td>														
				    </tr> 
<?php  }
?>
</tbody> 
			<tr> 
				<th colspan="5">total</th>
				
				<th  colspan="1"><?php echo $total;?></th>
				<th>				</th>
				<th>				</th>
				<th>				</th>
				<th><?php echo number_format(abs($total_am),2);?></th>
				</tr>	
				
				
				
				
				<tr> 
				<th colspan="2">Remark</th>
				
				<th  colspan="8"></th>
				</tr>	
			
			</table>
			
		
<table class='ttd'  align="right" border='1' >
<tr>
<th>SENDER'S SIGNATURE
</th>
<th>RECEIVER SIGNATURE
</th>
</tr>
<tr>
<th class='l'>
</th>
<th class='l' >
</th>
</tr>
<tr>
<th>...../...../......
</th>
<th>...../...../......
</th>
</tr>
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
   font-size:10px;
   font-weight:bold;
  
 }
 table
 {
   width: 90%;
   border-collapse: collapse;
   font-size:10px;
   font-weight:bold;
   margin-top: 1%
   margin: 10px auto;
 }
 .ttd{
	 margin-top: 1%;
	  width:35%;
	  margin-right:5%;
 }
 .tbl
 {
   width: 30%;
   border-collapse: collapse;
   font-size:12px;
   font-weight:bold;
   margin-top: 1%;
   margin-left:5%;
 }
 .l {
    height: 80px;
    }
.tebal{
font-weight:bold;
}
td {
    height: 34px;
}
th {
    height: 34px;
}
p.page { page-break-after: always; }
 .footer { position: fixed; bottom: 0px; }
      .pagenum:before { content: counter(page); }
</style>
<p class="page"></p>
</page>