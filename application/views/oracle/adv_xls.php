<html>
<head>
	<title>Advance Payment Over Due</title>    		
   </head>
   <body>
<form method='POST' >
<table cellspacing="0">
<tr><th colspan="2">Advance Payment Over Due</th></tr>
<tr><td>Period</td><td></td></tr>
<tr><td>Currency</td><td></td></tr>
<tr><td>Business Unit</td><td></td></tr>
<tr><td></td><td></td></tr>
</table>
<style> .str{ mso-number-format:\@; } </style>
<table cellspacing="0"  border=1>
	<thead>
		<tr>			
			<th>GL Reference</th>			
			<th>GL Date</th>					
		</tr>
	</thead>
	<?php foreach ($xls  as $row){
		?>
		<tr>
		
			<td class='str'><?php echo strval($row['GL_Reference']); ?></td>
			<td class='str'><?php echo $row['GL_Date']; ?></td>
		</tr>
 <?php  }
		?>
</table>
</form>
<?php
    $filename ="tb_base.xls";
    header('Content-type: application/ms-excel');
    header('Content-Disposition: attachment; filename='.$filename);
?>
</body>
</html>