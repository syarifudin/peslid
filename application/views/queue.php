		<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Customer Order Number </th> 
    				<th>Item </th>
    				<th>Consignee</th> 
    				<th>Date Queue</th> 
				</tr> 
			</thead> 
		      <tbody> 
			<?php foreach($data_queue as $q){  ?>
				<tr> 
       				<td><?php echo $q['ams_po_queue']; ?></td> 
    				<td><?php echo $q['item_queue']; ?></td> 
    				<td><?php echo $q['cnee_queue']; ?></td> 
					<td><?php echo $q['date_queue']; ?></td> 					
					
					</td>					
				</tr> 
			<?php }; ?>	
			  </tbody> 
		</table>