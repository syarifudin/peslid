<html>
<title>Panasonic</title>
<body>
<?php

if(isset($po_customer)) 
{		
		foreach($po_customer as $po);
		 $r=$po['rev'];
		$now=date('d-m-Y');
		$datee=date('d/m/Y',strtotime($po['po_date']));
		$eta=date('d-M-Y',strtotime($po['eta'])); 
		echo " = = = PANASONIC = = ="."<br>"."<br>";
		echo"<table>";
		echo "<tr><td>  PO  / PESLID CHUKAI</td><tr>";
		echo "<tr><td> PO DATE $datee   ***** IMPORT TEXTFILE DATE $now  </td><tr>";
		echo "<tr><td>00038274 PT. PANASONIC GOBEL ECO SOLUTIONS MANUFACTURING INDONESIA</td><tr>";
		echo"</table>";
		
		echo "<br><hr>";
		if(($r)==1){
		echo "<span style='  font-weight: bold;    margin-left: 41%;'>PURCHASE ORDER (REV) </span>
			<br><br><br><br>";}
		elseif(($r)==0){
		echo "<span style='  font-weight: bold;    margin-left: 41%;'>PURCHASE ORDER (NEW) </span>
			<br><br><br><br>";
		}	
		echo"<table>";
		echo "<tr><td> FACTORY</td><td> PT. PANASONIC GOBEL ECO SOLUTIONS MANUFACTURING INDONESIA</td> <td>TRADE TYPE</td> <td> PESGMFID CHUKAI </td><tr>";
		echo "<tr><td> AMS PO</td><td>$po[ams_po]</td><td>PRODUCTION TYPE</td><td> FINISH GOODS</td><tr>";
		echo "<tr><td> ORDR</td><td>$po[ordr] </td><td>F.DEST</td><td> </td><tr>";
		echo "<tr><td> </td><td></td><td>COUNTRY OF FINAL DEST</td><td>  $po[dest] | $po[gc_country] </td><tr>";
		echo "<tr><td> ACTEE</td><td>$po[accte] </td><td>DELIVERY DATE</td><td></td><tr>";
		echo "<tr><td> CNEE</td><td>$po[cnee]</td><td></td><td></td<tr>";
		echo "<tr><td></td><td>$po[gc_name]</td><td></td><td></td><tr>";
		echo "<tr><td></td><td>$po[gc_short]</td><td></td><td></td><tr>";
		echo "<tr><td></td><td>$po[gc_add]</td><td>TRANSPORTATION </td><td>$po[dlv]</td><tr>";
		echo "<tr><td></td><td></td><td>PWHS / ETA</td><td>$eta</td><tr>";
		echo "<tr><td>TRADE TERM </td><td>$po[tt]</td><td></td><td></td><tr>";
		echo "<tr><td> CURIENCY</td><td> USD </td><td>PAYMENT TERM</td><td>$po[pymnt_term]</td><tr>";
		echo "<tr><td>FM </td><td>$po[fm]</td><td></td><td></td><tr>";
		echo "<tr><td>REV</td><td>$po[rev_remark]</td><td></td><td></td><tr>";
		echo"</table>";
		echo "<br>"."<br>"."<br>";
		echo"<table >";
		echo "<tr><td> PRT</td><td> NO/DESCRIPTION</td><td> Due Date</td><td> QTY</td><td>UM</td><td> Price</td><td>UM</td><td> AMT</td></tr>";
		echo "<tr><td>------</td><td-------</td><td> -------</td><td>------</td><td>-----</td><td>-------</td><td>------</td><td>------</td><td>------</td></tr>";
		echo "<tr><td>CUST P/O</td><td> $po[cus_po]</td><td></td><td></td><td></td><td></td><td></td></tr>";
		echo "<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		$l=0;
		$t_price=0;$t_item=0;
		foreach ($po_customer as $det){
		$l=$l+1;
        $dec=substr($det['price_item'], -1);
		 $price=substr($det['price_item'],0,-1);
		 $prc=$price;
		$x=1;
		for($x;$x<=$dec;$x++){
		  $prc=$prc/10;
		}
		if(!isset($det['pr_pc'])){
		$det['pr_pc']=1;
		}
		$qtyitem=number_format($det['qty_item'], 0,'.', ',');
		$price_=$prc/$det['pr_pc'];
		$p=number_format($price_, 0,'.', ',');
		$amt = $det['qty_item'] * $price_;
		$mount=$amt;
		$b=number_format($mount, 0,'.', ',').",00";
		echo"<tr><td>$l</td><td>$det[item_number]</td><td>$det[due_date_]</td><td style='text-align: right;' >$qtyitem</td> <td> pc 
		</td><td  > $price_</td><td>  PC</td><td style='text-align: right;'>$b </td></tr>";
		$t_item+=$det['qty_item'];
		$t_price+=$mount;
		}
		$p=number_format($t_price, 3,'.', ',');
		echo"</table>";
	}
?>
<br>
================================================================================
<br>
<span style="  font-weight: bold;    margin-left: 45%; font-family: lucida console ;">Total</span> <span style=" margin-left: 10%;font-family: lucida console ;"> <?php echo  number_format($t_item, 0); ?></span>  <span style="    margin-left: 26%;font-family: lucida console ;"><?php echo $p; ?></span>
<br>
</body>
<style type="text/css">
 body
 {
   font-family: "lucida console ";
   font-size:12px;
 }
 span{
  font-family: "lucida console ";
	font-size:12px;
 }
 table{
 width:100%;
 font-family: "lucida console";
   font-size:12;
 }
 </style>
</html>