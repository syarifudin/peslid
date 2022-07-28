<style type="text/css" >
	#container{ width:100%; margin:0px auto; padding:5px 0; }
	#scrollbox{ width:100%; height:600px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
	#container > p{ background:#eee; color:#666; font-family:Arial, sans-serif; font-size:0.75em; padding:5px; margin:0; text-align:right;}
</style>
<div id="container">	
	<div id="scrollbox" >
<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Cust Po </th> 
    				<th>Destination</th> 
    				<th>Delivery Date</th> 
    				<th>CNEE</th> 
    				<th>Status</th> 
    				<th>Actions</th> 
    				<th>Detil</th> 
				</tr> 
			</thead> 
		      <tbody> 
			<?php foreach($get_po as $di){ $time = strtotime($di['dlvy']);
											$dlvy = date('d/M/Y',$time); ?>
				<tr> 
       				<td><?php echo $di['ams_po']; ?></td> 
    				<td><?php echo $di['dest']; ?></td> 
    				<td><?php echo $dlvy; ?></td> 
    				<td><?php echo $di['gc_name']; ?></td> 
    				<td>Fix</td> 
    				<td>01</td>
					<td><a href="<?=base_url();?>index.php/admin/detil_di/<?php echo $di['ams_po']; ?>">
					<input type="image"src="<?=base_url();?>images/detil.png" title="Detil"><a/>
					</td> 					
				</tr> 
			<?php }; ?>	
				</tbody> 
			</table>
	</div>
	</div>
	</div>