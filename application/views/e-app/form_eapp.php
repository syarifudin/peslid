<div class="main-content">
                <div class="section__content section__content--p30">
                        <div class="row">
							<div class="col-lg-6">
								<div class="card">
                                    <div class="card-header" style="    text-align: center;">Detail Purchase Order</div>
                                    <div class="card-body">
                                        <div class="card-title">
											<div class='hdr'>
                                           <?php foreach($data_po_detail as $row); ?>
											   <table style="width: 81%;">
											   <tr>
													<td>PO Number   </td> <td> : <?=$row['PO_NUM']. " | ".$row['COMMENTS'];?></td> <td>SHIP VIA   </td> <td> : <?=$row['SHIP_VIA_LOOKUP_CODE'];?></td>
											   </tr>
											   <tr>
													<td>SUPPLIER   </td> <td> : <?=$row['SUPPLIER'];?></td> <td>FREIGHT TERMS </td> <td> : <?=$row['FREIGHT_TERMS_LOOKUP_CODE'];?></td>
											   </tr>  
											   <tr>
													<td>ETD</td> <td> : <?=$row['PROMISED_DATE'];?></td> <td>ETA </td> <td> : <?=$row['NEED_BY_DATE'];?></td>
											   </tr> 
											   </table>
										   </div>
                                        </div>
                                        <hr>
                                        <?php
											 $x=array('class'=>'form',
															'id' =>'approval'); 
											  echo form_open('e_app/save_eapp',$x);				
											 ?>
										 <input type="hidden" id="custId" name="po_number" value="<?=$row['PO_NUM'];?>">
										 <input type="hidden" id="custId" name="supp" value="<?=$row['SUPPLIER'];?>">
                                         
                                <div class="top-campaign">
                                    <div class="table-responsive">
									<div id="section1" class="container-fluid">
                                        <table class="table table-top-campaign">
                                            <tbody>
											<tr>
                                                    <td>No</td>
                                                    <td>Item</td>
                                                    <td>UOM</td>
                                                    <td style='    text-align: right;'>Quantity</td>
                                                    <td style='    text-align: right;'>Price</td>
                                                    <td>Amount</td>
                                                </tr>
												<?php 	foreach($data_po_detail as $detail){ 					                             
												 ?>
                                                <tr>
                                                    <td><?=$detail['LINE_NUM']?></td>
                                                    <td><?=$detail['ITEM_NUMBER']?></td>
                                                    <td><?=$detail['UOM']?></td>
                                                    <td style='text-align: right;'><?=number_format($detail['QUANTITY'],0,'.',',');?></td>
                                                    <td style='text-align: right;'><?= number_format($detail['UNIT_PRICE'],5,'.',',');?></td>
                                                    <td><?=number_format($detail['QUANTITY']*$detail['UNIT_PRICE'],2,'.',',');?></td>
                                                </tr>
												<?php } ?>
												
                                            </tbody>
                                        </table>
									</div>
                                    </div>
                                </div>		<?php if ($confirm >=1){?>
											<div class="sufee-alert alert with-close alert-primary alert-dismissible fade show">
											<span class="badge badge-pill badge-primary">Success</span>
											You successfully read this important alert.
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											</div>
											<?php }else{?>
											<button type="submit" class="btn btn-success btn-lg btn-block">Approve</button>
											<?php }?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
	<style>					
	.col-lg-6 {
    margin-left: 26%;
	}
	</style>					
                               