    
        <!-- jQuery Library -->
        <script src="<?=base_url();?>e-app/js/jquery-3.3.1.min.js"></script>
        <!-- Datatable JS -->
      
  <!-- MAIN CONTENT-->
 <div class="main-content">
                <div class="section__content section__content--p30">
                        <div class="row">
                            <div class="col-md-12">
        <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">Approved Purchase Order</div>
                                    <div class="card-body card-block">
                                        <table id='po_apv' class='display dataTable' width='100%'>
											<thead>
											<tr>
												<th>PO Number</th>
												<th>Supplier</th>
												<th>Amount</th>
												<th>Status</th>
											</tr>
											</thead>
											
										</table>
                                    </div>
                                </div>
                            </div>
            <!-- Table -->
            
        </div>
        </div>
        </div>
        </div>
		
        
        <!-- Script -->
        <script>
        $(document).ready(function(){
            $('#po_apv').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'get_po_apv'
                },
                'columns': [
                    { data: 'SEGMENT1' },
                    { data: 'VENDOR_NAME' },
					{ data: 'TOTAL' },
                    { data: 'AUTHORIZATION_STATUS' }
                  
                ]
            });
        });
        </script>
		

