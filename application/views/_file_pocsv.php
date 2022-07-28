			<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('admin/search_filepocsv',$x);				
?>
			<input style="width: 24%;height: 18px; float: left;margin-left:10px"
			type="text" name="search_filepocsv"
			onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
			<input style="height: 24px;margin-right: 44%;" type="submit" value="Search">
</form>
<hr>
<?php if(isset($file_manager)) { ?>
<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>No PO</th> 
    				<th>File</th> 
    				<th>Action</th> 
				</tr> 
			</thead> 
		      <tbody> 
	   				<tr> 
       				<td><?php   echo (trim(substr($file_manager,3,-4))); ?></td> 
    				<td><?php  echo (trim(substr($file_manager,0)));  ?></td> 
					<td><a href="<?php echo base_url().'po_csv/'.$file_manager;?>">
					<input type="image"src="<?=base_url();?>images/csv.png" title="Print"><a/>
					</td> 					
				    </tr> 
				</tbody> 
			</table>
</div>
<?php }?>