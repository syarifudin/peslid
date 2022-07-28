<?php
$x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
echo form_open('admin/search_item',$x);				
?>
			<input style="width: 24%;height: 18px; float: left;margin-left:10px"
			type="text" name="search_item"
			onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
			<input style="height: 24px;margin-right: 44%;" type="submit" value="Search">
</form>
<script type="text/javascript">
$('document').ready(function(){
	updatestatus();
	scrollalert();
});

function scrollalert(){
	var scrolltop=$('#scrollbox').attr('scrollTop');
	var scrollheight=$('#scrollbox').attr('scrollHeight');
	var windowheight=$('#scrollbox').attr('clientHeight');
	var scrolloffset=20;
	if(scrolltop>=(scrollheight-(windowheight+scrolloffset)))
	{
		//fetch new items
		$('#status').text('Loading more items...');
		$.get('new-items.html', '', function(newitems){
			$('#content').append(newitems);
			updatestatus();
		});
	}
	setTimeout('scrollalert();', 1500);
}
</script>
<style type="text/css" >
	#container{ width:100%; margin:0px auto; padding:5px 0; }
	#scrollbox{ width:100%; height:600px;  overflow:auto; overflow-x:hidden; border:1px solid #f2f2f2; }
	#container > p{ background:#eee; color:#666; font-family:Arial, sans-serif; font-size:0.75em; padding:5px; margin:0; text-align:right;}
</style>
</head>
<body>
  <div id="container">	
	<div id="scrollbox" >
<?php
  if(isset($_POST['serach_'])){
  }?>
 <hr>
<table class="tablesorter" cellspacing="0"> 
<thead> 
	<th>Kode Suplier</th>
	<th>Item Number</th>
	<th>Last Update</th>
	<th>Qty Item</th>
	<th>MOQ</th>
	<th>Safety Stock</th>
	<th>Price</th>
	<th>Consignee</th>
</thead>
<div id="content" >
			<div id="tab1" class="tab_content">
<tbody> 			
<?php
if(isset($item)){
 foreach($item as $row){
 echo"<tr>
     <td>$row[kode_supplier]</td>
     <td>$row[mstr_item_number]</td>
	 <td>$row[last_update]</td>
     <td>$row[qty_item]</td>
	 <td>$row[moq]</td>
	 <td>$row[safety_stock]</td>
	 <td>$row[price]</td>
	 <td>$row[destination]</td>
	  </tr>";
  }
}
if(isset($data_item)){
 foreach($data_item as $row){
 echo"<tr>
     <td>$row[kode_supplier]</td>
     <td>$row[mstr_item_number]</td>
	 <td>$row[last_update]</td>
     <td>$row[qty_item]</td>
	 <td>$row[moq]</td>
	 <td>$row[safety_stock]</td>
	 <td>$row[price]</td>
	 <td>$row[destination]</td>
	  </tr>";
     }
 } 
?>
</div>
		</div>
		</tbody>
	</div>
	<p><span id="status" ></span></p>
</div>
</table>
