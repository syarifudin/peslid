		<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>emp id </th> 
    				<th>username</th>
    				<th>control</th> 
    				<th>user group</th> 
					<th>edit</th>
				</tr> 
			</thead> 
		      <tbody> 
			<?php foreach($data_user as $user){  ?>
				<tr> 
       				<td><?php echo $user['emp_id']; ?></td> 
    				<td><?php echo $user['username']; ?></td> 
    				<td><?php if(isset($user['control'])){echo$user['control'];} ?></td> 
					<td><?php echo $user['user_group']; ?></td> 					
					<td><a href="<?=base_url();?>index.php/admin/edit_user/<?php echo $user['emp_id'];?>">
					<input type="image"src="<?=base_url();?>images/icn_edit.png" title="Detil"><a/>
					</td>					
				</tr> 
			<?php }; ?>	
			  </tbody> 
		</table>