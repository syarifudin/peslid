<html>
<head>
	<title>Trial Balance (Base)</title>    		
   </head>
   <body>
<form method='POST' >
<table cellspacing="0">
<tr><th colspan="2">GL Trial Balance (Base)</th></tr>
<tr><td>Period</td><td>: <?= $period; ?></td></tr>
<tr><td>Currency</td><td>: <?= $curr; ?></td></tr>
<tr><td>Business Unit</td><td>: <?= $bu; ?></td></tr>
<tr><td></td><td></td></tr>
</table>
<style> .str{ mso-number-format:\@; } </style>
<table cellspacing="0"  border=1>
	<thead>
		<tr>			
			<th>Cost Center</th>			
			<th>Account</th>			
			<th>AUX</th>
			<th width="50%">Description</th>
			<th>Beg Bal Ptd SUM</th>			
			<th>Activity Ptd SUM</th>			
			<th>End Bal Ptd SUM</th>			
			
		</tr>
	</thead>
	<?php foreach ($data_exp_tb  as $row){
		?>
		<tr>
		
			<td class='str'><?php echo strval($row['cost_center']); ?></td>
			<td class='str'><?php echo strval($row['account']); ?></td>
			<td class='str'><?php echo strval($row['aux']); ?></td>
			<td class='str'><?php echo $row['AUX_DESC']; ?></td>
			<td align="right"><?php echo number_format($row['beg_bal'],2,'.',','); ?></td>
			<td align="right"><?php echo number_format($row['activity'],2,'.',','); ?></td>
			<td align="right"><?php echo number_format($row['end_bal'],2,'.',','); ?></td>
		</tr>
 <?php  }
		?>
</table>
</form>
<?php
////////////////////////////////// BEGIN SETUP
    $filename ="tb_base.xls";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
////////////////////////////////// END SETUP
////////////////////////////////// BEGIN GATHER
    // Your MySQL queries, fopens, et cetera go here.
    // Cells are delimited by \t
    // \n is just like you might expect; new line/row below
    // E.G:
    //$stuff="PART\tQTY\tVALUE\t\n";
    //$stuff=$stuff."01-001-0001\t37\t28.76\t\n";
    //$stuff=$stuff."01-001-0002\t6\t347.06\t\n";
    //$stuff=$stuff."01-001-0003\t12\t7.11\t\n";
////////////////////////////////// END GATHER
// The point is to get all of your data into one string and then:
////////////////////////////////// BEGIN DUMP
    //echo $stuff;
////////////////////////////////// END DUMP
?>
</body>
</html>