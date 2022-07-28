<!DOCTYPE html>
<html>
	<head>
		<script src="<?=base_url();?>js/jspdf.js"></script>
		<script src="<?=base_url();?>js/FileSaver.js"></script>
		<script src="<?=base_url();?>js/jspdf.plugin.table.js"></script>
		<script>
				function generatefromjson() {
				var data = [], fontSize = 12, height = 0, doc;
				doc = new jsPDF('p', 'pt', 'a4', true);
				doc.setFont("times", "normal");
				doc.setFontSize(fontSize);
				doc.text(20, 20, "hi table");
				data = [];
				for (var insert = 0; insert <= 20; insert++) {
					data.push({
						"name" : "jspdf plugin",
						"version" : insert,
						"author" : "Prashanth Nelli",
						"Designation" : "jspdf table plugin"
					});
				}
				height = doc.drawTable(data, {
					xstart : 10,
					ystart : 10,
					tablestart : 40,
					marginright :100,
					xOffset : 10,
					yOffset : 10
				});
				doc.text(50, height + 20, 'hi world');
				doc.save("some-file.pdf");
			};
			function generatefromtable() {
				var data = [], fontSize = 8, height = 0, doc;
				doc = new jsPDF('p', 'pt', 'a4', true);
				doc.setFont("times", "normal");
				doc.setFontSize(fontSize);
				data = [];
				data = doc.tableToJson('tbl');
				height = doc.drawTable(data, {
					xstart : 10,
					ystart : 10,
					tablestart : 40,
					marginleft : 10,
					xOffset : 10,
					yOffset : 15
				});
				doc.save("some-file.pdf");
			}
		</script>
	</head>
	<body>
		<button onclick="generatefromtable()">
			Generate 
		</button>
		ini adalah tableee
		<?php 
$this->load->database();
			echo "<table id='tbl' border='1'>";
							echo"<tr>
								<td>Ln</td>
								<td>Item Number</td>
								<td>T Due Date</td>
								<td>Qty Open/UM</td>
								
								<td>Unit Cost</td>
								<td>Extended Cost</td>
								 </tr>";
						$month=date('m',strtotime($per));
	                    $year=date('Y',strtotime($per));
						$query = $this->db->query("select  * from pc_item_master");
	                    $data=$query->result_array(); 
				
					$line=0;
					$total=0;					
					foreach($data as $row){		
					$line=$line+1;
					//$ext=$row['price_item_peslid']*$row['qty_item'];
					//$total+=$ext;
					 	echo"<tr><td>$line</td>
						  <td>$row[mstr_item_number]</td>
						  <td>--</td>
						  <td>$row[qty_item]/pc</td>
						 
						  <td>--</td>
						  <td>--</td>
						</tr>";
					  }
				echo"</table>";		
 ?>
	</body>
</html>
