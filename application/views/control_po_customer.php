<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('',$x);				
?>
			<input style="width: 10%;height: 18px; float: left;margin-left:10px" type="text" name="bulan" placeholder="month ex 08"">
			<input style="width: 10%;height: 18px; float: left;margin-left:10px" type="text" name="tahun" placeholder="year ex 2015"">
			<input style="height: 24px;margin-right: 44%;" type="submit" value="Search">
</form>
<hr>
<style type="text/css" >
	#container{ width:100%; margin:0px auto; padding:5px 0; }
	#scrollbox{ width:100%; height:300px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
	#container > p{ background:#eee; color:#666; font-family:Arial, sans-serif; font-size:0.75em; padding:5px; margin:0; text-align:right;}
</style>
</head>
<body>
  <div id="container">
  
  
			
	<div id="scrollbox" >
	<table class="tablesorter" cellspacing="0">
<thead> 
				<tr> 
    				<td>Destination</td> 
    				<td>Model</td>
					<td>Request</td>
					<td>Date Reply</td> 					
    				<td>Reply</td> 
    				<td>Qty Total</td> 
    				<td>Balance</td> 
    				<td>Detail</td> 
				</tr> 
			</thead>	
		<div id="content" >
			<div id="tab1" class="tab_content">		      
			<tbody> 
			<?php foreach($sales_forecast as $po){ ?>
				<tr> 
       				<td><?php echo $des=$po['global_code']; ?></td> 
    				<td><?php echo $mod=$po['kode_model']; ?></td> 
    				<td><?php echo $po['request_forecast']; ?></td> 
    				<td><?php echo $po['date_reply']; ?></td> 
    				<td><?php echo $po['reply_forecast']; ?></td> 
    				<td><?php echo $po['qty_item']; ?></td> 
    				<td><?php echo $po['balance']; ?></td>
    				<td><a href="<?=base_url();?>ex/trans_forcast/<?php echo $po['date_reply'];?>/<?php echo $des ?>/<?php echo $mod ?>">
					<input type="image"src="<?=base_url();?>images/detil.png" title="Detil"><a/>
					</td>		
				</tr> 
			<?php }; ?>	
		</div>
		</div>
	  </tbody>
	</div>
	<p><span id="status" ></span></p>
</div>
</table>
