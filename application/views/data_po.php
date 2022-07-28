<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('admin/search_Production_order',$x);				
?>
			<input style="width: 24%;height: 18px; float: left;margin-left:10px"
			type="text" name="search_po" placeholder=' po number'
			onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
			<input style="height: 24px;margin-right: 44%;" type="submit" value="Search">
</form>
<style type="text/css" >
	#container{ width:100%; margin:0px auto; padding:5px 0; }
	#scrollbox{ width:100%; height:600px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
	#container > p{ background:#eee; color:#666; font-family:Arial, sans-serif; font-size:0.75em; padding:5px; margin:0; text-align:right;}
</style>
<hr>
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
    				<th>Detail</th> 
				</tr> 
			</thead> 
		      <tbody> 
			<?php foreach($get_po as $po){ $time = strtotime($po['dlvy']);
											$dlvy = date('d/M/Y',$time);
											$rev['rev']=$po['rev'];
											?>
				<tr> 
       				<td><?php echo $po['ams_po']; ?></td> 
    				<td><?php echo $po['dest']; ?></td> 
    				<td><?php echo $dlvy; ?></td> 
    				<td><?php if(isset($po['gc_name'])){echo$po['gc_name'];} ?></td> 
    				<td>Fix</td> 
    				<td>01</td>
					<td><a href="<?=base_url();?>index.php/mli/detil/<?php echo $po['po_number']; ?>/<?php echo $rev['rev']; ?>">
					<input type="image"src="<?=base_url();?>images/detil.png" title="Detil"><a/>
					</td> 					
				</tr> 
			<?php }; ?>	
			  </tbody> 
			</table>
	</div>
	</div>
	</div>