<?php
 echo"<br>";
 $x=array('class'=>'form',
			    'id' =>'item_maintenance'); 
  echo form_open('orcl_dwn/oracle_discover',$x);				
 ?>
<table class="tablesorter" cellspacing="0">
<tr> <td> Data File</td><td>  
		: <select name="selection" style="width: 25%;font-family: Lucida Sans Unicode;font-size: 12px;">
			  <?php if($user_site=='222'){  ?>
			  <option value="data_so">Data Sales Order</option>
			  <option value="stock">Inv Onhand</option>
			  <option value="AP_PO">AP-PO RCV</option>
			  <option value="ds">Delivery Subcontract</option>
			  <option value="AR">AR</option>
			  <option value="EDI_SH">EDI SHIPPING INFORMATION</option>
			  <option value="prod">Production Controll Report</option>
			  <option value="po_rcv">PO RCV BY PRICE</option>
			  <option value="ap_ag">AP Aging Report</option>
			  <option value="ap_ex">AP Expense</option>
			  <option value="itm_cst">Item Cost</option>
			  <option value="ap_vchr">Voucher Register</option>
			  <option value="cash_flow">Cash Flow</option>
			  <option value="AR_Jurnal">AR Journal</option>
			  <option value="AP_Jurnal">AP Journal</option>
			  <option value="PO_print">PO Print</option>
			  <option value="payment_jurnal">Payment Journal</option>
			  <option value="gl_rpt">GL Journal Report</option>
			  <option value="adv_rpt">Advance Payment</option>
			  <option value="dncn_rpt">Debit/Credit Note</option>
			  <option value="gl_voucher">GL Journal Voucher</option>
			  <option value="grn">GRN Report</option>
			  <option value="tb_base">TB (Base)</option>
			  <option value="ic">Inventory Consumption</option>
			  <?php }  ?>
			  <?php if(($user_site=='222') OR($user_site=='182'))
			  {  ?>
			  <option value="AR_SOA">SOA</option>
			    <?php }?>
		</select>
</td></tr>
    <tr> <td> </td><td>   <input type="submit" value='submit' style="  margin-left: 4%;   width: 13%;"></td></tr>
</table>

