<html lang="en">
<head>
<title>jQuery UI Datepicker - Default functionality</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
  <script type="text/javascript">
  $( function() {
    $( "#datepicker, #datepicker2" ).datepicker();
  } );
  
  
		function getDate()
		{
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm}
			today = mm+"/"+dd+"/"+yyyy;

			document.getElementById("todayDate").value = today;
		}

		//call getDate() when loading the page
		getDate();
		</script>
</head>
<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/f_grn_rpt',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 30%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <option value="prod">GRN Print</option>
		  </select>
</td></tr>
    <tr><td> GL Date</td>  <td>  : <input type="text" name="date" placeholder='dd-mm-yyyy' id="datepicker"> 
			to <input type="text" name="date1" placeholder='dd-mm-yyyy' id="datepicker2"></td>
	<td>Supplier</td><td>  : <input type="text" name="vendor_select" placeholder=' ' ></td></tr>
	<tr><td>Packing List</td><td>  : <input type="text" name="pack_select" placeholder=' ' ></td></tr>
	<tr><td>PO</td><td>  : <input type="text" name="po" placeholder=' ' ></td></tr>
	<tr><td>GRN</td><td>  : <input type="text" name="grn1" placeholder=' ' > to <input type="text" name="grn2" placeholder=' ' ></td></tr>
	<tr><td></td><td>   <input type="submit" value='submit' style="  margin-left: 4%;width: 13%;"></td></tr>
	
</table>
</html>