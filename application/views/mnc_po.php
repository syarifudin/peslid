<div style="margin-bottom: 1%;">
<?php

$x=array('class'=>'form',
			    'id' =>'po_maintenance'); 
echo form_open('maintenance/mnc_view',$x);				
?>
			<input style="width: 24%;height: 18px; float: left;margin-left:10px"
			type="text" name="mnc_po"
			onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
			<input style="height: 24px;margin-right: 44%;bottom: 4%;" type="submit" value="EX">
</form>
</div>
<hr>
<?php if(isset($mnc_view)) { ?>
<div id="container">	
	<div id="scrollbox" >
<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>PC Order Number </th> 
    				<th>Destination</th> 
    				<th>Delivery Date</th> 
    				<th>PO Number</th> 
    				<th>Item Number</th> 
				</tr> 
			</thead> 
		      <tbody> 
			<?php foreach($mnc_view as $po){ $time = strtotime($po['dlvy']);
											$dlvy = date('d/M/Y',$time);
											$rev['rev']=$po['rev'];
											?>
				<tr> 
       				<td><?php echo $po['ams_po']; ?></td> 
    				<td><?php echo $po['dest']; ?></td> 
    				<td><?php echo $dlvy; ?></td> 
    				<td><?php echo $po['po_number']; ?></td> 					
    				<td><?php echo $po['item_number']; ?></td> 					
				</tr> 
			<?php }}; ?>	
			<?php if(isset($po['ams_po'])){ ?> <tr> <td><a href='<?=base_url();?>index.php/maintenance/mnc_dlt/<?php echo $po['ams_po']; ?>'>Delete<td></tr>
		<?php	} ?>
			 </tbody> 
			</table>
	</div>
	</div>
	</div>