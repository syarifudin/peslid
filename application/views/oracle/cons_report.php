<?php 
header("Content-Type: application/xls"); 
header("Content-Disposition: attachment; filename=consumption_report.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
?>
<table  border='1'>
 <thead>
<th>ORGANIZATION_ID</th>
<th>INVENTORY_ITEM_ID </th>
<th>PERIOD</th>
<th>COMPANY_CODE</th>
<th>ACCOUNT_UNIT</th>
<th>COST_CENTER </th>
<th>ITEM_ACCOUNT</th>
<th>ITEM_AUX </th>
<th>INV_CODE </th>
<th>ITEM_NUMBER </th>
<th>AVERAGE_PRICE_START  </th>
<th>STANDARD_PRICE_START </th>
<th>BEGINNINGQTY_  </th>
<th>BEGINNINGAMOUNTSTAT  </th>
<th>PURCHASING_QTY </th>
<th>PURCHASINGAMOUNT  </th>
<th>INCOMING_QTY</th>
<th>INCOMING_AMOUNT</th>
<th>OUTGOING_QTY_  </th>
<th>OUTGOING_AMOUNT</th>
<th>AVERAGEPRICEEND</th>
<th>STANDARDPRICEEND  </th>
<th>ENDING_QTY  </th>
<th>ENDINGAMOUNTSTAT  </th>
<th>CONSUMPTIONQTY </th>
<th>CONSUMPTIONAMOUNT </th>
<th>LEGAL_ENTITY</th>
<th>ORGANIZATION_CODE </th>
<th>CONSUMPTION_ACCOUNT  </th>
<th>CONSUMPTION_AUX</th>
</head>
	 <tbody>
	<?php
		foreach($cons as $row)
		{
	?>
<tr>
		<td><?php echo $row['ORGANIZATION_ID']; ?> </td>
		<td><?php echo $row['INVENTORY_ITEM_ID']; ?> </td>
		<td><?php echo $row['PERIOD'];?> </td>
		<td><?php echo $row['COMPANY_CODE']; ?> </td>
		<td><?php echo $row['ACCOUNT_UNIT']; ?> </td>
		<td><?php echo $row['COST_CENTER']; ?> </td>
		<td><?php echo $row['ITEM_ACCOUNT']; ?> </td>
		<td><?php echo $row['ITEM_AUX']; ?> </td>
		<td><?php echo $row['INV_CODE']; ?> </td>
		<td><?php echo $row['ITEM_NUMBER']; ?> </td>
		<td><?php echo $row['AVERAGE_PRICE_START']; ?> </td>
		<td><?php echo $row['STANDARD_PRICE_START']; ?> </td>
		<td><?php echo $row['BEGINNINGQTY_']; ?> </td>
		<td><?php echo $row['BEGINNINGAMOUNTSTAT']; ?> </td>
		<td><?php echo $row['PURCHASING_QTY']; ?> </td>
		<td><?php echo $row['PURCHASINGAMOUNT'] ;?> </td>
		<td><?php echo $row['INCOMING_QTY']; ?> </td>
		<td><?php echo $row['INCOMING_AMOUNT']; ?> </td>
		<td><?php echo $row['OUTGOING_QTY_']; ?> </td>
		<td><?php echo $row['OUTGOING_AMOUNT']; ?> </td>
		<td><?php echo $row['AVERAGEPRICEEND']; ?> </td>
		<td><?php echo $row['STANDARDPRICEEND']; ?> </td>
		<td><?php echo $row['ENDING_QTY']; ?> </td>
		<td><?php echo $row['ENDINGAMOUNTSTAT']; ?> </td>
		<td><?php echo $row['CONSUMPTIONQTY']; ?> </td>
		<td><?php echo $row['CONSUMPTIONAMOUNT']; ?> </td>
		<td><?php echo $row['LEGAL_ENTITY']; ?> </td>
		<td><?php echo $row['ORGANIZATION_CODE']; ?> </td>
		<td><?php echo $row['CONSUMPTION_ACCOUNT']; ?> </td>
		<td><?php echo $row['CONSUMPTION_AUX']; ?> </td>
</tr>
	<?php
	 	}
	?>
 </tbody>
  </table>