<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('admin/search_filepo',$x);				
?>
			<input style="width: 24%;height: 18px; float: left;margin-left:10px"
			type="text" name="search_filepo" placeholder=' po number'
			onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
			<input style="height: 24px;margin-right: 44%;" type="submit" value="Search">
</form>
<style type="text/css" >
	#container{ width:100%; margin:0px auto; padding:5px 0; }
	#scrollbox{ width:100%; height:300px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
	#container > p{ background:#eee; color:#666; font-family:Arial, sans-serif; font-size:0.75em; padding:5px; margin:0; text-align:right;}
</style>
<hr>
<div id="container">	
	<div id="scrollbox" >
<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Number</th> 
    				<th>No PO</th> 
    				<th>Kode Supplier</th> 
    				<th>Date Shipment</th> 
    				<th>Supplier Name</th> 
    				<th>Action</th> 
				</tr> 
			</thead> 
		      <tbody> 
				<?php $xfile=count($file_manager);
		$no=0;
	   for($x=0;$x<$xfile;$x++){
	   $no=$no+1;
		if(substr($file_manager[$x],0,2)=="PO"){ $file=base_url().'finish_po/'.$file_manager[$x];?>
	   				<tr> 
       				<td><?php   echo $no-2; ?></td> 
       				<td><?php   echo (trim(substr($file_manager[$x],11,10))); ?></td> 
    				<td><?php  echo (trim(substr($file_manager[$x],2,8)));  ?></td> 
    				<td>Fix</td> 
    				<td>01</td>
					<td><a href="<?php echo $file;?>">
					<input type="image"src="<?=base_url();?>images/pdf_print.png" title="Print"><a/>
					</td> 					
				</tr> 
				<?php }} ?>
				</tbody> 
			</table>
	</div>
	</div>
	</div>