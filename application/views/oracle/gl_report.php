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
		foreach($gl_jrnl as $row)
		{
	?>
<tr>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
		<td><?php echo $row['BU']; ?> </td>
</tr>
	<?php
	
	 	}
		
	?>
 </tbody>
  </table>