 <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE -->
                                <span class="title-5 m-b-35">List Pending Approval</span>
								
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-select2" name="property">
                                                <option selected="selected">All Properties</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="time">
                                                <option selected="selected">Today</option>
                                                <option value="">3 Days</option>
                                                <option value="">1 Week</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter">
                                            <i class="zmdi zmdi-filter-list"></i>filters</button>
                                    </div>
                                    <div class="table-data__tool-right">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>add item</button>
                                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                                            <select class="js-select2" name="type">
                                                <option selected="selected">Export</option>
                                                <option value="">Option 1</option>
                                                <option value="">Option 2</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
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
                                                <th></th>
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
                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="<?=base_url();?>index.php/e_app/form/<?=$data=$row['SEGMENT1'];?>" class="item" data-toggle="tooltip" data-placement="top" title="Detail">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </a>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                                            <i class="zmdi zmdi-more"></i>
                                                        </button>
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
                        </div>