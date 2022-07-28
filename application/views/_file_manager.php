			<input style="width: 24%;height: 18px; float: left;margin-left:10px"
			type="text" name="search_filepo"
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
    				<th>Kode Supplier</th> 
    				<th>Date Shipment</th> 
    				<th>Supplier Name</th> 
    				<th>Action</th> 
				</tr> 
			</thead> 
		      <tbody> 
	   				<tr> 
       				<td><?php   echo (trim(substr($file_manager,10,10))); ?></td> 
    				<td><?php  echo (trim(substr($file_manager,2,8)));  ?></td> 
    				<td>Fix</td> 
    				<td>01</td>
					<td><a href="<?php echo base_url().'finish_po/'.$file_manager;?>">
					<input type="image"src="<?=base_url();?>images/pdf_print.png" title="Print"><a/>
					</td> 					
				    </tr> 
				</tbody> 
			</table>
</div>
<?php }?>