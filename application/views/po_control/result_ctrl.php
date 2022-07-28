
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<style type="text/css" >
	#container{ width:100%; margin:0px auto; padding:5px 0; }
	#scrollbox{ width:100%; height:700px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
	#container > p{ background:#eee; color:#666; font-family:Arial, sans-serif; font-size:0.75em; padding:5px; margin:0; text-align:right;}
</style>
</head>

				

<body>


<div  class="tab_content" >
<div id="scrollbox" >
<table class="tablesorter"  width='99%' cellspacing="0">
<thead>
<tr> 
				<th>Number</th>
				<th>PO Number</th>
    				<th>Item Mfg</th> 
    				<th>Inv Item</th> 
    				<th>So Item</th> 
    				<th>Qty Order</th> 
    				<th>Qty So</th> 
    				<th>Qty Inv</th> 
    				<th>B/O</th> 
    				<th>Desc</th> 
				</tr>
</thead> 			
<?php 
$no=1;
foreach($data as $row) { ?>
		      <tbody> 
	   				<tr> 
						<td><?php   echo $no++; ?></td> 
						<td><?php   echo $row['po_nbr'] ?></td> 
						<td><?php   echo $row['pod_item_mfg'] ?></td> 
						<td><?php   echo $row['idh_part_qad']  ?></td> 
						<td><?php   echo $row['so_part_qad'] ?></td> 
						<td><?php   echo $row['QTY_PO'] ?></td>					
						<td><?php   echo $row['QTY_SO'] ?></td>					
						<td><?php   echo $row['QTY_INV'] ?></td> 																												
						<td><?php   echo $row['B_O'] ?></td> 																												
						<td><?php   echo $row['pod_from'] ?></td> 																																										
				    </tr> 
			  </tbody> 
<?php  }?>		
</table>
</div>
</div>
</body>