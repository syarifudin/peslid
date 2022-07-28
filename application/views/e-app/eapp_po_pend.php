 <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <span class="title-5 m-b-35">Pending Approval</span>
								
                                
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </th>
                                                <th>PO Number</th>
                                                <th>SUPPLIER</th>
                                                <th>Creation Date</th>
                                                <th style='text-align:right;'>PO Amount</th>
                                                <th>Currency</th>
                                                <th>buyer</th>
                                                <th>Status</th>
                                                <th>Detail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($list as $row){ ?>
                                            <tr class="tr-shadow">
                                                <td>
                                                    <label class="au-checkbox">
                                                        <input type="checkbox">
                                                        <span class="au-checkmark"></span>
                                                    </label>
                                                </td>
                                                <td><?=$row['SEGMENT1'];?></td>
                                                <td>
                                                    <?=$row['VENDOR_NAME'];?>
                                                </td>
                                                <td><?=date('d-M-Y',strtotime($row['CREATION_DATE']));?></td>
                                                <td style='text-align: right;'> <?=number_format($row['TOTAL'] ,2,'.',',');?></td>
                                                <td style="text-align: center;">
                                                    <span ><?=$row['CURRENCY_CODE']?></span>
                                                </td>
                                                <td class="desc">
                                                <?php 
                                                if ($row['AGENT_ID'] == 452){ echo $buyer_name = 'Ida Chuto Ifa';} 
                                                if ($row['AGENT_ID'] == 451){ echo $buyer_name = 'Bagus Yuwono';} 
                                                if ($row['AGENT_ID'] == 447){ echo $buyer_name = 'Nur Fitriyani Dewi';} 
                                                if ($row['AGENT_ID'] == 455){ echo $buyer_name = 'Willy Wijaya';} 
                                                if ($row['AGENT_ID'] == 443){ echo $buyer_name = 'Rudy Iswahyudi';}
                                                if ($row['AGENT_ID'] == 951){ echo $buyer_name = 'Hafizhul Islam';}
                                                if ($row['AGENT_ID'] == 952){ echo $buyer_name = 'Jundi';}
                                                ?>
                                                </td>
												<td><?=$row['AUTHORIZATION_STATUS']?></td>
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="<?=base_url();?>index.php/e_app/form/<?=$data=$row['SEGMENT1'];?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            </div>
                        </div>
                        </div>
                     