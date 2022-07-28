 <link rel="stylesheet" href="<?=base_url();?>css/jquery-ui.css">
  <script src="<?=base_url();?>js/jquery-1.12.4.js"></script>
  <script src="<?=base_url();?>js/jquery-ui.js"></script>
   <link rel="stylesheet" href="<?=base_url();?>css/bootstrap.min.css" />
   <script src="<?=base_url();?>js/bootstrap3-typeahead.min.js"></script>  
<?php echo form_open('npa/save_npa','class="form-horizontal"'); ?>
 <style>
.npa_head {
    text-align: center;
	font-family: Lucida Sans Unicode;
    font-size: 14.5px;
	font-weight: bold;
}
.input{
	    padding: 3px;
        width: 85%;
		font-family: Lucida Sans Unicode;
}
.typeahead{
	    padding: 3px;
		font-family: Lucida Sans Unicode;
}
.input1{
	    padding: 3px;
		font-family: Lucida Sans Unicode;
        width: 85%;
}
.wrapper {
  overflow-x:scroll;
  overflow-y:hidden;
  -webkit-overflow-scrolling:touch;
  width:100%;
  white-space:nowrap;
}

input{
	    padding: 5px;
}
select{
	    padding: 5px;
}
 </style>
  <script>
  $( function() {
	$( "#datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
  $( function() {
    $( "#datepicker1" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
  $( function() {
    $( "#datepicker2" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
   $( function() {
    $( "#datepicker3" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );
   $( function() {
    $( "#datepicker4" ).datepicker({ dateFormat: 'dd-M-yy' });
  } );

  $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td>"+ (i+1) +"</td><td><input type='text' name='item[]' placeholder ='item code'/></td><td><input type='text' name='desc[]' placeholder ='description'  /></td><td><input type='text' name='uom[]' placeholder ='uom'  ></td><td><select name='curr[]' ><option value='IDR' >IDR</option><option value='USD'>USD</option> <option value='JPY'>JPY</option></select></td><td><input type='text' name='price[]' placeholder ='price'  /></td><td><input type='text' name='spq[]' placeholder ='spq' /></td><td><input type='text' name='moq[]' placeholder ='moq' /></td><td><input type='text' name='lt[]' placeholder ='LT'/></td><td><select name='mode[]' class='input' ><option value='SEA' >SEA</option>  <option value='LAND'>LAND</option> <option value='AIR'>AIR</option></select></td><td><input type='text' name='maker[]' placeholder ='maker'  />	</td>");
      $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });
});
</script>
 <div class='npa_head'>
	<p> New Price Approval From</p>
	<hr>
 </div>
<table class="tablesorter" cellspacing="0">
  <tr>
		<td>Approval Date</td><td>   : <input type='text' name="a_date" class='input'  onclick="disableTxt()" id='datepicker' ></td>
		<td>Import/Local</td><td>   : 
  <select name="npa_type" class='input'  >
			  <option value='LCL'>Local</option>
			  <option value='IMP'>Import</option>
		</select>
  </td>
   <td>NPA Number</td><td>   : <input type='text' name="npa_number"  class='input' disabled ></td>
  </tr>
<tr>
		<td>Subject Category</td><td>   :  
		<select name="npa_cat" class='input'  >
		<?php foreach($cat->result_array() as $rw) { ?>
			  <option value='<?php echo trim($rw['category_code']);?>' ><?=$rw['category_name'];?></option>
		<?php } ?>
		</select>
		</td>
   <td>Quotation Received Date</td><td>   : <input type='text' name="q_r_date" class='input' id='datepicker2' ></td>
		<td>Quotation Date</td><td>   : <input type='text' name="q_date" class='input'  id='datepicker1' ></td>
  </tr>
  <tr> <td>Start Effective Date</td><td>   : <input type='text' name="s_eff_date" class='input'  id='datepicker3'></td>
		<td>End Effective Date</td><td>   : <input type='text' name="e_eff_date" class='input'  id='datepicker4'></td>
		<td>Type Of Price</td><td>   : <input type='text' name="t_of_price" class='input'  ></td>
  </tr>
  <tr> 
  <tr> <td>Material Type </td><td>   : <select name="mtl_type" class='input' >
			  <option value='Material' >Material</option>
			  <option value='Material'>Marchandise</option>
			  <option value='Outside'>Outside Process</option>
			  <option value='Mixed'>Mixed</option>
		</select></td>
		<td>Quotation Number</td><td>   : <input type='text' name="quotation_number" class='input'></td>
		<td>Price Incoterm</td><td>   : <select name="price_i_term" class='input' >
										<option value='EXW'>EXW</option>
										<option value='FOB'>FOB</option>
										<option value='CIF'>CIF</option>
										<option value='CFR'>CFR</option>	
										<option value='FCA'>FCA</option>	
										<option value='CPT'>CPT</option>
										<option value='CIP'>CIP</option>	
										<option value='DAT'>DAT</option>	
										<option value='DAP'>DAP</option>	
										<option value='DDP'>DDP</option>
										</select></td>
  </tr>
  <tr>
  <td>Supplier </td><td>   : <input type='text' name="supplier" class='typeahead'  onclick="disableTxt()" style="    width: 85%;"></td>
  </tr>
</table>
<div class='wrapper'>
<table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center" >
							No
						</th>
						<th class="text-center">
							Item Code
						</th>
						<th class="text-center">
							Item Desc
						</th>
						<th class="text-center">
							Uom
						</th>
						<th class="text-center">
							Curr
						</th>
						<th class="text-center">
							Price
						</th>
						<th class="text-center">
							SPQ
						</th>
						<th class="text-center">
							MOQ
						</th>
						<th class="text-center">
							LT (Days)
						</th>
						<th class="text-center">
							Delivery Mode
						</th>
						<th class="text-center">
							END Maker
						</th>
						
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td>
						<input type='text' name='item[]' placeholder ='item code'  />
						</td>
						<td>
						<input type='text' name='desc[]' placeholder ='description'  />
						</td>
						<td>
						<input type='text' name="uom[]" placeholder ='uom'  >
						</td>
						<td>
						<select name="curr[]"  >
						  <option value='IDR' >IDR</option>
						  <option value='USD'>USD</option>
						  <option value='JPY'>JPY</option>
						</select>
						</td>
						<td>
						<input type='text' name='price[]' placeholder ='price'  />
						</td>
						<td>
						<input type='text' name='spq[]' placeholder ='spq' />
						</td>
						<td>
						<input type='text' name='moq[]' placeholder ='moq' />
						</td>
						<td>
						<input type='text' name='lt[]' placeholder ='LT'  />
						</td>
						<td>
						<select name="mode[]" class='input' >
						  <option value='SEA' >SEA</option>
						  <option value='LAND'>LAND</option>
						  <option value='AIR'>AIR</option>
						</select>
						</td>
						<td>
						<input type='text' name='maker[]' placeholder ='maker'  />
						</td>
						
					</tr>
                    <tr id='addr1'>
					</tr>
				</tbody>
			</table>
		</div>
	<a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
	<a id="add_row" class="pull-right btn btn-default">Add Row</a>
 <div class='npa_head' style="    padding: 5px;">
<INPUT Type="button" VALUE="Back" onClick="history.go(-1);return true;"> <input type="submit" value='Kirim'>
</div>
<script type="text/javascript">
    $('input.typeahead').typeahead({
          autoSelect: true,
        minLength: 2,
		source:  function (query, process) {
        return $.get('get_supplier', { query: query }, function (data) {
                console.log(data);
                data = $.parseJSON(data);
                return process(data);
            });
        }
    });
</script>