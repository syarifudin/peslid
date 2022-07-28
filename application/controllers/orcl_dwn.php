<?php
class orcl_dwn extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->model('acc_model');
		$this->load->library('session');
		$this->load->library('encrypt');
		$this->load->library('email');
		$this->orcl= $this->load->database('orcl_db',TRUE);
	}
	public function index()
	{
	$dis['data_dis']='oracle/ds.php';
	$this->load->view('index.php',$dis);
	}
	public function get_data()
	{
		 $check=$this->input->post("selection");
		 $date=$this->input->post("date");
		if($check=='data_so')
		{
			$this->data_so($date);
		}	
		echo "<script type='text/javascript'>
		      alert('Request Success!');
		      document.location = 'oracle_data';
		      </script>";
	}
	public function get_prod()
	{
		$date=$this->input->post("date");
		 $this->oracle_model->prod();
		 $this->get_dj($date);
		 $this->mtl_trans($date);
		 echo "<script type='text/javascript'>
			alert('Request Success!');
			document.location = 'oracle_data';
			</script>";
	}
	public function ap_po_rcv()
	{
		 $date['date1']=$this->input->post("date");
		 $date['date2']=$this->input->post("date1");
		 $this->po_ap($date);
	}
	public function ar()
	{
		$date['date1']=$this->input->post("date");
		 $date['date2']=$this->input->post("date1");
		 $this->ar_inv($date);
	}
	public function oracle_data()
	{
	 $cek=$cek=$this->session->userdata('control');
		if(empty($cek))
		{
			redirect('admin/login');
		}else
		{
		$dis['user_site']=$this->session->userdata('user_site');			
		$dis['oracle_data']='oracle/dwn_oracle.php';
		$this->load->view('index.php',$dis);
		}	
	}
	public function get_po_rcv()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $this->receive_by_price($date);
	}
	public function ap_ag()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $this->ap_aging($date);
	}
	public function ap_ex()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $this->ap_expense($date);
	}
	public function ap_v()
	{
	 //echo "masih dilakukan perbaikan ";
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $this->voucher($date); 
	}
	public function cash_flw()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $this->get_cash_flow($date);
	}
	public function tb_base()
	{
	 $date['period']=$this->input->post("period");
	 $date['bu']=$this->input->post("bu_select");
	 $date['curr']=$this->input->post("curr_select");
	 $this->get_tb_base($date);
	}
	
    public function oracle_discover()  /*------------------DISCOVER---------------------*/
	{
		$check=$this->input->post("selection");
		if($check=='AP_PO')
		{
			$dis['data_dis']='oracle/ap_po.php';
			$this->load->view('index.php',$dis);
		}
		if($check=='ic')
		{
			

			$dis['data_dis']='oracle/cons_form.php';
			$this->load->view('index.php',$dis);
		}
		if($check=='data_so')
		{
			$dis['data_dis']='oracle/ds.php';
			$this->load->view('index.php',$dis);
		}
		if($check=='prod')
		{
			$dis['data_dis']='oracle/prod_report.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='AR')
		{
			$dis['data_dis']='oracle/AR.php';
		    $this->load->view('index.php',$dis);
		}	
		if($check=='po_rcv')
		{
			$dis['data_dis']='oracle/po_rcv.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='stock')
		{
			$dis['data_dis']='oracle/inv_onhand.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='ap_ag')
		{
			$dis['data_dis']='oracle/ap_aging.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='ap_ex')
		{
			$dis['data_dis']='oracle/ap_ex.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='itm_cst')
		{
			$dis['data_dis']='oracle/item_cost.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='ap_vchr')
		{
			$dis['data_dis']='oracle/ap_voucher.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='cash_flow')
		{
			$dis['data_dis']='oracle/cash_flw.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='AR_Jurnal')
		{	
			$dis['data_dis']='oracle/ar_journal.php';
			$this->load->view('index.php',$dis); 
		}
		if($check=='AP_Jurnal')
		{	
			$dis['data_dis']='oracle/ap_journal.php';
			$this->load->view('index.php',$dis); 
		}
		if($check=='PO_print')
		{	
			$dis['data_dis']='oracle/po_print.php';
			$dis['dat_dell']=$this->oracle_model->get_del_to();
			$this->load->view('index.php',$dis); 
		}
		if($check=='AR_SOA')
		{	
			//add user_site
			$data['site']=$this->session->userdata('user_site');
			$dis['data_dis']='oracle/ar_soa.php';
			$dis['data_cust']=$this->oracle_model->selection_cust_aging($data);
			$this->load->view('index.php',$dis); 
		}
		if($check=='payment_jurnal')
		{	
			$dis['data_dis']='oracle/pay_journal.php';
			$this->load->view('index.php',$dis); 
		}
		if($check=='gl_rpt')
		{
			$dis['data_dis']='oracle/gl_journal.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='adv_rpt')
		{
			$dis['data_dis']='oracle/adv_pay.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='dncn_rpt')
		{
			$dis['data_dis']='oracle/dn_cn.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='gl_voucher')
		{
			$dis['data_dis']='oracle/gl_voucher.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='grn')
		{
			$dis['data_dis']='oracle/grn.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='tb_base')
		{
			$dis['data_dis']='oracle/tb_base.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='ds')
		{
			$dis['data_dis']='oracle/dlvr_subcont.php';
		    $this->load->view('index.php',$dis);
		}
		if($check=='EDI_SH')
		{
			$dis['data_dis']='oracle/edi_sh.php';
		    $this->load->view('index.php',$dis);
		}
	}
	public function data_so($date)
	{	
		$this->oracle_model->delete_so();
		$data=$this->oracle_model->data_so($date);
		foreach($data as $row)
		{	
			$data_so=array('LINE_NUMBER				   '=>$row['LINE_NUMBER'],
						'ORDERED_ITEM				   '=>$row['ORDERED_ITEM'],
                        'PROMISE_DATE                  '=>date('d-M-Y',strtotime($row['PROMISE_DATE'])),
                        'SCHEDULE_SHIP_DATE            '=>date('d-M-Y',strtotime($row['SCHEDULE_SHIP_DATE'])),
                        'TRANSACTIONAL_CURR_CODE       '=>$row['TRANSACTIONAL_CURR_CODE'],
                        'ORDERED_QUANTITY              '=>$row['ORDERED_QUANTITY'],
                        'SHIPPED_QUANTITY              '=>$row['SHIPPED_QUANTITY'],
                        'CANCELLED_QUANTITY            '=>$row['CANCELLED_QUANTITY'],
                        'UNIT_SELLING_PRICE            '=>$row['UNIT_SELLING_PRICE'],
                        'AMOUNT                        '=>$row['AMOUNT'],
                        'SHIPPING_QUANTITY_UOM         '=>$row['SHIPPING_QUANTITY_UOM'],
                        'ORDERED_DATE                  '=>date('d-M-Y',strtotime($row['ORDERED_DATE'])),
                        'REQUEST_DATE                  '=>date('d-M-Y',strtotime($row['REQUEST_DATE'])),
                        'ACTUAL_SHIPMENT_DATE          '=>date('d-M-Y',strtotime($row['ACTUAL_SHIPMENT_DATE'])),
                        'DELIVERY_ID                   '=>$row['DELIVERY_ID'],
                        'SURAT_JALAN                   '=>$row['SURAT_JALAN'],
                        'ON_OR_ABOUT                   '=>date('d-M-Y',strtotime($row['ON_OR_ABOUT'])),
                        'ORDER_NUMBER                  '=>$row['ORDER_NUMBER'],
                        'CUST_PO_NUMBER                '=>$row['CUST_PO_NUMBER'],
                        'FULFILLMENT_DATE              '=>date('d-M-Y',strtotime($row['FULFILLMENT_DATE'])),
                        'FULFILLED_QUANTITY            '=>$row['FULFILLED_QUANTITY'],
                        'INVOICE_INTERFACE_STATUS_CODE '=>$row['INVOICE_INTERFACE_STATUS_CODE'],
                        'INVOICED_QUANTITY             '=>$row['INVOICED_QUANTITY'],
                        'TAX_CODE                      '=>$row['TAX_CODE'],
                        'PARTY_NAME                    '=>$row['PARTY_NAME'],
                        'PARTY_SITE_NAME               '=>$row['PARTY_SITE_NAME'],
                        'CONSIGNEE                      '=>$row['ADDRESS1'],			
                        'ADDRESS2                      '=>$row['ADDRESS2'],			
                        'ADDRESS3                      '=>$row['ADDRESS3'],			
                        'ADDRESS4                      '=>$row['ADDRESS4'],			
                        'STATUS                        '=>$row['STATUS'],			
                        'POSTED_QTY                    '=>$row['POSTED_QTY'],		
                        'PACKING_STYLE_CODE            '=>$row['PACKING_STYLE_CODE'],		
                        'QUANTITY_PER_PACKING          '=>$row['QUANTITY_PER_PACKING'],		
                        'NET_WEIGHT                    '=>$row['NET_WEIGHT'],		
                        'GROSS_WEIGHT                  '=>$row['GROSS_WEIGHT'],		
                        'WIDTH                   	   '=>$row['WIDTH'],		
                        'DEPTH                   	   '=>$row['DEPTH'],		
                        'HEIGHT                 	   '=>$row['HEIGHT'],	
                        'CASE_MARK1                    '=>$row['TP_ATTRIBUTE1'],
                        'CASE_MARK2                    '=>$row['TP_ATTRIBUTE2'],
                        'M3                   		   '=>$row['M3'],
                        'CITY                 		   '=>$row['CITY'],
                        'LINE_SPLIT                    '=>$row['LINE_SPLIT'],
                        'TOTAL_PACK                    '=>$row['TOTAL_PACK'],
                        'STATUS_AR                     '=>$row['STATUS_AR'],
                        'INV_NUMBER                    '=>$row['ATTRIBUTE10'],
                        'TRANSMISSION_DATE             '=>date('d-M-Y',strtotime($row['ATTRIBUTE12']))
					);  
			$this->oracle_model->insert_so($data_so); 
		}

	}
	public function inv_onhand()
	{
		$this->oracle_model->delete_onhand();
		$data_inv=$this->oracle_model->get_onhand_item();
		foreach($data_inv as $row)
		{
			$data=array(
			'inventory_org				   '=>'PLI',
			'subinventory_code			   '=>$row['SUBINVENTORY_CODE'],
			'item_number				   '=>$row['SEGMENT1'],
			'item_descrip				   '=>$row['DESCRIPTION'],
			'item_type   				   '=>$row['ITEM_TYPE'],
			'user_item_type   			   '=>'',
			'org_id         			   '=>'222',
			'on_hand_qty         		   '=>$row['QTY']
			);
		$this->oracle_model->save_inv_on_hand($data);
		}
	}
	public function po_ap($date)
	{
		$this->oracle_model->delete_apporcv();
		$data_ap_po=$this->oracle_model->get_po_ap($date);
		foreach($data_ap_po as $row)
		{
			$data=array('RCV_TRX_DATE	  '=>date('d-M-Y',strtotime($row['RCV_TRX_DATE'])),
						'RCV_CREATE_DATE  '=>date('d-M-Y',strtotime($row['RCV_CREATION_DATE'])),
						'PO               '=>$row['PO'],
						'RCV_NUM          '=>$row['RCV_NUM'],
						'PACKING_SLIP     '=>$row['PACKING_SLIP'],
						'PO_CREATION_DATE '=>date('d-M-Y',strtotime($row['PO_CREATION_DATE'])),
						'VENDOR_NAME      '=>$row['VENDOR_NAME'],
						'VENDOR_SITE_CODE '=>$row['VENDOR_SITE_CODE'],
						'LINE             '=>$row['LINE'],
						'ITEM             '=>$row['ITEM'],
						'QTY_PO           '=>$row['QTY_PO'],
						'PO_UOM           '=>$row['PO_UOM'],
						'PRICE            '=>$row['PRICE'],
						'CURR             '=>$row['CURR'],
						'QTY_RCV          '=>$row['QTY_RCV'],
						'RCV_UOM          '=>$row['RCV_UOM'],
						'AMOUNT           '=>$row['AMOUNT'],
						'INVOICE_DATE     '=>date('d-M-Y',strtotime($row['INVOICE_DATE'])),
						'INV_CREATION_DATE'=>date('d-M-Y',strtotime($row['INV_CREATION_DATE'])),
						'JV_NO            '=>$row['JV_NO'],
						'INVOICE_NUM      '=>$row['INVOICE_NUM'],
						'INVOICE_STATUS   '=>$row['INV_STATUS'],
						'MATERIAL_COST    '=>$row['MATERIAL_COST'],
						'POSTED_FLAG      '=>$row['POSTED_FLAG'],
						'INV_RATE          '=>$row['INV_RATE'],
						'INV_BASE_AMOUNT   '=>$row['INV_BASE_AMOUNT'],
						'PO_RATE           '=>$row['PO_RATE'],
						'PO_BASE_AMOUNT    '=>$row['PO_BASE_AMOUNT'],
						'BUYER            '=>$row['BUYER'],
						'TRANSACTION_TYPE  '=>$row['TRANSACTION_TYPE']
					);
		$this->oracle_model->save_ap_po($data);
	 } 
   }
   public function get_dj($date)
   {
	   $data_dj=$this->oracle_model->dj($date);
	   foreach($data_dj as $row)
		{
			$data=array('WIP_ENTITY_NAME		'=>$row['WIP_ENTITY_NAME'],		
						'ITEM_NUMBER            '=>$row['SEGMENT1'],
						'ITEM_TYPE              '=>$row['ITEM_TYPE'],
						'CREATION_DATE          '=>$row['CREATION_DATE'],
						'DATE_COMPLETED         '=>$row['DATE_COMPLETED'],
						'START_QUANTITY         '=>$row['START_QUANTITY'],
						'QUANTITY_COMPLETED     '=>$row['QUANTITY_COMPLETED'],
						'COMPLETION_SUBINVENTORY'=>$row['COMPLETION_SUBINVENTORY'],
						'STATUS                 '=>$row['STATUS']);
			$this->oracle_model->save_dj($data);
		}
   }
   public function mtl_trans($date)
   {
	   $data_mtl=$this->oracle_model->mtl_transaction($date);
	   foreach($data_mtl as $row)
		{
			$data=array('ITEM_NUMBER'=>$row['SEGMENT1'],		
						'ITEM_TYPE'=>$row['ITEM_TYPE'],
						'CREATION_DATE'=>$row['CREATION_DATE'],
						'TRANSACTION_DATE'=>$row['TRANSACTION_DATE'],
						'SUBINVENTORY_CODE'=>$row['SUBINVENTORY_CODE'],
						'TRANSACTION_TYPE_ID'=>$row['TRANSACTION_TYPE_ID'],
						'TRANSACTION_QUANTITY'=>$row['TRANSACTION_QUANTITY'],
						'TRANSACTION_SOURCE_NAME'=>$row['TRANSACTION_SOURCE_NAME'],
						'TRANSACTION_REFERENCE'=>$row['TRANSACTION_REFERENCE'],
						'WIP_SOURCE_NAME'=>$row['WIP_SOURCE_NAME'],
						'TRANSFER_SUBINVENTORY'=>$row['TRANSFER_SUBINVENTORY'],
						);
	$this->oracle_model->mtl_trans($data);
		}
   }
	public function beg_inventory()
	{
		$beg_inv=$this->oracle_model->beg_stock();
		foreach($beg_inv as $row)
		{
			$data=array('ITEM_CODE		   '=>$row['ITEM_CODE'],
						'TRANSACTION_UOM   '=>$row['TRANSACTION_UOM'],
						'DISPLAY_ITEM_TYPE '=>$row['DISPLAY_ITEM_TYPE'],
						'SUBINVENTORY_CODE '=>$row['SUBINVENTORY_CODE'],
						'ACTUAL_QTY        '=>$row['ACTUAL_QTY'] 
						);
	$this->oracle_model->begstock($data);
		}
	}
	public function ar_inv($date)
	{
		$this->oracle_model->delete_ar();
	 $ar_data=$this->oracle_model->ar_invoice($date);
	 foreach($ar_data as $row)
	 {
		$data=array('SOURCE			'=>$row['SOURCE'],
					'AR_NO          '=>$row['AR_NO'],
					'STATUS   		'=>$row['STATUS'],
					'INVOICE_NO     '=>$row['INVOICE_NO'],
					'DELIVERY_NO    '=>$row['DELIVERY_NO'],
					'SALES_ORDER    '=>$row['SALES_ORDER'],
					'CUST_PO_NUMBER '=>$row['CUST_PO_NUMBER'],
					'BILL_TO        '=>$row['BILL_TO'],
					'ACCOUNT_NUMBER '=>$row['ACCOUNT_NUMBER'],
					'SHIP_TO        '=>$row['SHIP_TO'],
					'COUNTRY   		'=>$row['COUNTRY'],
					'CITY   		'=>$row['CITY'],
					'CREATION_DATE  '=>$row['CREATION_DATE'],
					'ON_OR_ABOUT    '=>$row['ON_OR_ABOUT'],
					'GL_DATE   		'=>$row['GL_DATE'],
					'INVOICE_DATE   '=>$row['INVOICE_DATE'],
					'CURRENCY       '=>$row['CURRENCY'],
					'EXCHANGE_RATE  '=>$row['EXCHANGE_RATE'],
					'LINE_NUMBER    '=>$row['LINE'],
					'ITEM_NUMBER    '=>$row['ITEM_NUMBER'],
					'COST_CENTER    '=>$row['COST_CENTER'],
					'ITEM_TYPE      '=>$row['ITEM_TYPE'],
					'QTY            '=>$row['QTY'],
					'PRICE          '=>$row['PRICE'],
					'AMOUNT         '=>$row['AMOUNT'],
					'TAX            '=>$row['TAX'],
					'TOTAL          '=>$row['TOTAL'],
					'BASE_AMOUNT    '=>$row['BASE_AMOUNT'],
					'CUSTOMER_ITEM    '=>$row['CUSTOMER_ITEM']
					)	;
		$this->oracle_model->save_ar_inv($data);
		}
	}
	public function ap_aging($date)
	{
		$this->oracle_model->delete_ap_aging();
		$apag=$this->oracle_model->ap_aging($date);
		foreach($apag as $row)
		{
			$data=array('VENDOR_CODE	 '=>$row['VENDOR_CODE'],
			            'VENDOR          '=>$row['VENDOR'],
			            'INVOICE_NUM     '=>$row['INVOICE_NUM'],
			            'DESCRIPTION     '=>$row['DESCRIPTION'],
			            'INVOICE_DATE    '=>$row['INVOICE_DATE'],
						'GL_DATE    	 '=>$row['GL_DATE'],
			            'DUE_DATE        '=>$row['DUE_DATE'],
			            'ACC_CODE        '=>$row['ACC_CODE'],
			            'AUX             '=>$row['AUX'],
			            'CURR            '=>$row['CURR'],
			            'AMOUNT_REMAINING'=>$row['AMOUNT_REMAINING'],
			            'OVERDUE_30      '=>$row['OVERDUE_30'],
			            'OVERDUE_60      '=>$row['OVERDUE_60'],
			            'OVERDUE_90      '=>$row['OVERDUE_90'],
			            'OVERDUE_120     '=>$row['OVERDUE_120'],
			            'VOUCHER         '=>$row['VOUCHER'],
			            'JV              '=>$row['JV']);
		$this->oracle_model->save_ap_aging($data);
		}
	}
	public function receive_by_price($date)
	{
		$this->oracle_model->po_receive_by_price_delete();
		$rcv_price=$this->oracle_model->po_receive_by_price($date);
		foreach($rcv_price as $row)
		{
			$data=array('TRANSACTION_TYPE		 '=>$row['TRANSACTION_TYPE'],
			            'VENDOR_NAME             '=>$row['VENDOR_NAME'],
			            'VENDOR_SITE_CODE        '=>$row['VENDOR_SITE_CODE'],
			            'PO_NUMBER               '=>$row['SEGMENT1'],
			            'CREATION_DATE           '=>$row['CREATION_DATE'],
			            'PROMISED_DATE           '=>$row['PROMISED_DATE'],
			            'NEED_BY_DATE            '=>$row['NEED_BY_DATE'],
			            'TRANSACTION_DATE        '=>$row['TRANSACTION_DATE'],
			            'LINE_NUMBER             '=>$row['LINE_NUM'],
			            'ITEM_NUMBER             '=>$row['ITEM_CODE'],
			            'ITEM_DESC               '=>"",
			            'QUANTITY_ORDERED        '=>$row['QUANTITY_ORDERED'],
			            'UNIT_PRICE              '=>$row['UNIT_PRICE'],
			            'PO_UNIT_PRICE           '=>$row['PO_UNIT_PRICE'],
			            'ITEM_TYPE               '=>$row['ITEM_TYPE'],
			            'PRIMARY_UNIT_OF_MEASURE '=>$row['PRIMARY_UNIT_OF_MEASURE'],
						'UNIT_MEAS_LOOKUP_CODE   '=>$row['UNIT_MEAS_LOOKUP_CODE'],
						'MATERIAL_COST           '=>$row['MATERIAL_COST'],
						'CURRENCY_CODE           '=>$row['CURRENCY_CODE'],
						'RATE                    '=>$row['RATE'],
						'PRIMARY_QUANTITY        '=>$row['PRIMARY_QUANTITY'],
						'QTY_RCV                 '=>$row['QTY_RCV'],
						'GRN                     '=>$row['GRN'],
						'PACKING_SLIP            '=>$row['PACKING_SLIP']);
		$this->oracle_model->save_receive_by_price($data);
		}
	}
	public function ap_expense($date)
	{
		$expense=$this->oracle_model->delete_ap_expense();
		$expense=$this->oracle_model->expense($date);
		foreach($expense as $row)
		{
			$data=array( 'JV_NO				'=>$row['JV_NO'],
			             'INVOICE_NUM        '=>$row['INVOICE_NUM'],
			             'INVOICE_DATE       '=>$row['INVOICE_DATE'],
			             'VENDOR_NAME        '=>$row['VENDOR_NAME'],
			             'VENDOR_SITE_CODE   '=>$row['VENDOR_SITE_CODE'],
			             'HEADER             '=>$row['HEADER'],
			             'DESCRIPTION        '=>$row['DESCRIPTION'],
			             'BU                 '=>$row['BU'],
			             'COST_CENTER        '=>$row['COST_CENTER'],
			             'ACCOUNT_CODE       '=>$row['ACCOUNT_CODE'],
			             'AUX                '=>$row['AUX'],
			             'CURRENCY           '=>$row['CURRENCY'],
			             'AMOUNT             '=>$row['AMOUNT'],
			             'BASE_AMOUNT        '=>$row['BASE_AMOUNT']);
		$this->oracle_model->save_ap_expense($data);
		}
	}
	public function orc_consumption()
	{
		$data_con=$this->oracle_model->consumption();
		foreach($data_con as $row)
		{
			$data=array( 'parent_item'=>$row['PC_COMP'],
			             'comp_item '=>$row['SEGMENT1'],
			             'item_type '=>$row['ITEM_TYPE'],
			             'transaction_date '=>$row['TRANSACTION_DATE'],
			             'subinventory '=>$row['SUBINVENTORY_CODE'],
			             'qty_consumption '=>$row['PRIMARY_QUANTITY']);
		$this->oracle_model->save_consumption($data); 
	}
	}
	public function get_item_cost()
	{
		$this->oracle_model->delete_item_cost();
		$data_cost=$this->oracle_model->item_cost();
		foreach($data_cost as $row)
		{
			$data=array( 'item_number'=>$row['SEGMENT1'],
			             'descr '=>$row['DESCRIPTION'],
			             'primary_uom_code '=>$row['PRIMARY_UOM_CODE'],
			             'last_update_date '=>$row['LAST_UPDATE_DATE'],
			             'item_type '=>$row['ITEM_TYPE'],
			             'material_cost '=>$row['MATERIAL_COST'],
			             'item_cost '=>$row['ITEM_COST'],
			             'cost_center '=>$row['CC'],
			             'item_status '=>$row['INVENTORY_ITEM_STATUS_CODE'],
			             'planner_code'=>'LT',
			             'account_code '=>$row['ACC']);
		$this->oracle_model->save_item_cost($data); 
	    }
		echo "<script type='text/javascript'>
		alert('Request Success!');
		document.location = 'oracle_data';
		</script>";
	}
	public function voucher($date){
		$this->oracle_model->delete_voucher_reg();
		$voucher_reg=$this->oracle_model->voucher_reg($date);
		foreach($voucher_reg as $row)
		{
			
			$data=array( 'JV_NO'=>$row['JV_NO'],
			             'GL_NO'=>$row['GL_NO'],
			             'INVOICE_NUM'=>$row['INVOICE_NUM'],
			             'INVOICE_DATE'=>$row['INVOICE_DATE'],
						 'GL_DATE'=>$row['GL_DATE'],
						 'PO'=>$row['PO'],
			             'VENDOR_NUMBER'=>$row['VENDOR_NUMBER'],
			             'VENDOR_NAME'=>$row['VENDOR_NAME'],
			             'VENDOR_SITE_CODE'=>$row['VENDOR_SITE_CODE'],
			             'HEADER'=>$row['HEADER'],
			             'DESCRIPTION'=>$row['DESCRIPTION'],
			             'BU'=>$row['BU'],
			             'COST_CENTER'=>$row['COST_CENTER'],
			             'ACCOUNT_CODE'=>$row['ACCOUNT_CODE'],
			             'AUX'=>$row['AUX'],
			             'CURRENCY'=>$row['CURRENCY'],
			             'AMOUNT'=>$row['AMOUNT'],
			             'BASE_AMOUNT'=>$row['BASE_AMOUNT'],
						 'CANCELLED_AMOUNT'=>$row['CANCELLED_AMOUNT']);
		$this->oracle_model->save_voucher_reg($data); 
		}
	}
	public function get_cash_flow($date)
	{
		$this->oracle_model->delete_cash_flow();
		$cash_flow=$this->oracle_model->cash_flow($date);
		foreach($cash_flow as $row)
		{
			$data=array( 'ACCOUNT			'=>$row['ACCOUNT'],			
			             'AUX                '=>$row['AUX'],                
			             'CURRENCY           '=>$row['CURRENCY'],           
			             'PREV_DAY           '=>$row['PREV_DAY'],          
			             'RECEIPT            '=>$row['RECEIPT'] ,           
			             'DISBURSEMENT       '=>$row['DISBURSEMENT'],       
			             'BALANCE            '=>$row['BALANCE'],            
			             'PREV_DAY_BASE      '=>$row['PREV_DAY_BASE'],      
			             'RECEIPT_BASE       '=>$row['RECEIPT_BASE'] ,      
			             'DISBURSEMENT_BASE  '=>$row['DISBURSEMENT_BASE'],  
			             'BALANCE_BASE       '=>$row['BALANCE_BASE']);            
		$this->oracle_model->save_cash_flow($data);
		}
			echo "<script type='text/javascript'>
		alert('Request Success!');
		document.location = 'oracle_data';
		</script>";
	}
	public function f_ar_journal()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $date['invoice']=$this->input->post("inv_no");
	 $date['status']=$this->input->post("stat_select");
	 $date['ar_no1']=$this->input->post("ar1");
	 $date['ar_no2']=$this->input->post("ar2");
	 $this->get_ar_journal($date);
	}
	public function f_ap_journal()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $date['status']=$this->input->post("stat_select");
	 $date['ap_no1']=$this->input->post("ap1");
	 $date['ap_no2']=$this->input->post("ap2");
	 $this->get_ap_journal($date);
	}
	public function f_print_po()
	{
	 $check=$this->input->post("selection");	
	 $date['date1']=$this->input->post("date");
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $date['status']=$this->input->post("stat_select");
	 $date['pph']=$this->input->post("pph");
	 $date['status1']=$this->input->post("deliv_select");
	 $date['fob']=$this->input->post("term_select");
	 $date['cname']=$this->input->post("cname");
	 if($check=='prod'){
	 $this->get_po_print($date);
	 }else
	 {
		 $po = explode(',',$this->input->post("po_sub"));
		 $a=isset($po[0])?$po[0]:"";
		 $b=isset($po[1])?$po[1]:"";
		 $c=isset($po[2])?$po[2]:"";
		 $d=isset($po[3])?$po[3]:"";
		 $e=isset($po[4])?$po[4]:"";
		 $f=isset($po[5])?$po[5]:"";
		 $g=isset($po[6])?$po[6]:"";
		$po_="("."'".$a."'".","."'".$b."'".","."'".$c."'".","."'".$d."'".","."'".$e."'".","."'".$f."'".","."'".$g."'".")";
		 
		$this->po_sub($date,$po_);
	 }	 
	}
	public function f_ar_soa()
	{
	 $date['date1']=$this->input->post("cust_select");
	 $date['soa_period']=$this->input->post("date");
	 $this->get_soa_print($date);
	}
	public function f_pay_journal()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $date['ap_no1']=$this->input->post("ap1");
	 $date['ap_no2']=$this->input->post("ap2");
	 $this->get_pay_journal($date);
	}
	public function get_ar_journal($date)
	{
		$data['data_ar_journal']=$this->oracle_model->f_journal_ar($date);
		$data['data_ar_detail']=$this->oracle_model->f_journal_ar($date);
		$this->load->view('oracle/ar_journal_report.php',$data);
	}
	public function get_ap_journal($date)
	{
		$data['data_ap_journal']=$this->oracle_model->f_journal_ap($date);
		//$data['data_ap_detail']=$this->oracle_model->f_journal_ap($date);
		$data['data_acc_aux']=$this->acc_model->f_acc_aux();
		$this->load->view('oracle/ap_journal_report.php',$data);
		
	}
	public function get_po_print($date)
	{
		$data['data_po_print']=$this->oracle_model->f_po_print($date);
		$data['data_po_detail']=$this->oracle_model->f_po_print($date);
		$data['data_select']=$date['status'];
		$del=$date['status1'];
		$data['data_delivery_to']=$this->oracle_model->del_to($del);
		$data['data_term']=$date['fob'];
		$data['pph']=$date['pph'];
		$data['cname']=$date['cname'];
		$this->load->view('oracle/po_print_report.php',$data);
	}
	public function get_soa_print($date)
	{
	    //add site
		$st['site']=$this->session->userdata('user_site');
		$data['data_ar_soa']=$this->oracle_model->f_soa_print($date,$st);
		$data['data_soa_detail']=$this->oracle_model->f_soa_print($date,$st);
		$data['data_soa_period']=$date['soa_period'];
		$this->load->view('oracle/ar_soa_report.php',$data);
	}
	public function get_pay_journal($date)
	{
		$data['data_pay_journal']=$this->oracle_model->f_journal_pay($date);
		$data['data_pay_detail']=$this->oracle_model->f_journal_pay($date);
		$data['data_acc_aux']=$this->acc_model->f_acc_aux();
		$this->load->view('oracle/pay_journal_report.php',$data);
	}
	public function get_dncn_print($date)
	{
		$data['data_dncn']=$this->oracle_model->f_dncn($date);
		$data['data_dncn_detail']=$this->oracle_model->f_dncn($date);
		$data['attention_data']=$date['attention'];
		$data['email_data']=$date['email'];
		$data['due_data']=$date['due'];
		$data['conv']=$date['conv'];
		$data['ttd']=$date['ttd'];
		$this->load->view('oracle/dn_cn_report.php',$data);
	}
	public function get_gl_journal($date){
		ini_set('memory_limit', '-1');
		$this->oracle_model->delete_gl_journal();
		$gl_jrnl=$this->oracle_model->f_gl_journal($date);
		foreach($gl_jrnl as $row)
		{
			$data=array( 'BU'=>$row['BU'],
						 'JE_SOURCE'=>$row['JE_SOURCE'],
			             'JE_CATEGORY'=>$row['JE_CATEGORY'],
			             'PERIOD_NAME'=>$row['PERIOD_NAME'],
						 'GL_DATE'=>$row['GL_DATE'],
						 'GL_NO'=>$row['GL_NO'],
			             'NAME'=>$row['NAME'],
			             'HEADER'=>$row['HEADER'],
			             'CURRENCY_CODE'=>$row['CURRENCY_CODE'],
						 'COST_CENTER'=>$row['COST_CENTER'],
			             'ACCOUNT_CODE'=>$row['ACCOUNT_CODE'],
			             'AUX'=>$row['AUX'],
			             'DESCRIPTION'=>htmlspecialchars($row['DESCRIPTION']),			             
						 'ENTERED_DR'=>$row['ENTERED_DR'],
						 'ENTERED_CR'=>$row['ENTERED_CR'],					
						 'ACCOUNTED_DR'=>$row['ACCOUNTED_DR'],
						 'ACCOUNTED_CR'=>$row['ACCOUNTED_CR'],
			             'STATUS'=>$row['STATUS'],
						 'CREATED_BY'=>$row['CREATED_BY'],
			             'DATE_CREATED'=>$row['DATE_CREATED'],
			             'LAST_UPDATE_DATE'=>$row['LAST_UPDATE_DATE'],
			             'JV_NO'=>$row['JV_NO'],
						 'INVOICE_NO'=>$row['INVOICE_NO'],
			             'BUSINESS_PARTNER'=>$row['BUSINESS_PARTNER']);
		$this->oracle_model->save_gl_journal($data);
		}
		echo "<script type='text/javascript'>
		alert('Request Success!');
		document.location = 'oracle_data';
		</script>";
	}
	public function get_adv_pay($date){
		$this->oracle_model->delete_adv_pay();
		$adv_p=$this->oracle_model->f_adv_pay($date);
		foreach($adv_p as $row)
		{
			$data=array( 'VENDOR_CODE'=>$row['VENDOR_CODE'],
			             'VENDOR'=>$row['VENDOR'],
			             'DESCRIPTION'=>$row['DESCRIPTION'],
						 'ACC_CODE'=>$row['ACC_CODE'],
			             'CURR'=>$row['CURR'],
			             'DUE_DATE'=>$row['DUE_DATE'],
			             'AMOUNT'=>$row['AMOUNT'],
			             'AMOUNT_REMAINING'=>$row['AMOUNT_REMAINING'],
			             'INVOICE_NUM'=>$row['INVOICE_NUM'],
			             'INVOICE_DATE'=>$row['INVOICE_DATE'],
			             'VOUCHER'=>$row['VOUCHER'],
			             'JV'=>$row['JV']);
		$this->oracle_model->save_adv_pay($data);
		}
	}	  
	public function get_gl_voucher($date)
	{
		ini_set('memory_limit', '-1');
		$data['data_gl_voucher']=$this->oracle_model->f_voucher_gl($date);
		$data['data_gl_detail']=$this->oracle_model->f_voucher_gl($date);
		$data['data_acc_aux']=$this->acc_model->f_acc_aux();
		$this->load->view('oracle/gl_voucher_rpt.php',$data);
	}
	public function get_grn_rpt($date)
	{
		$data['data_grn']=$this->oracle_model->f_grn($date);
		$data['data_grn_detail']=$this->oracle_model->f_grn($date);
		$data['data_grn_sum_qty']=$this->oracle_model->f_grn_sum_qty($date);
		$this->load->view('oracle/grn_rpt.php',$data);
	}
public function gl_j()
	{
	 $date['bu']=$this->input->post("bu_select");
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $date['account1']=$this->input->post("account");
	 $date['account2']=$this->input->post("account1");
	 $date['glno1']=$this->input->post("no");
	 $date['glno2']=$this->input->post("no1");
	 $this->get_gl_journal($date);
	}
	public function adv_pay()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $this->get_adv_pay($date);
	}
	public function f_print_dncn()
	{
	 $date['dncn_nomor']=$this->input->post("dncn_no");
	 $date['attention']=$this->input->post("attention_input");
	 $date['email']=$this->input->post("email_input");
	 $date['due']=$this->input->post("due_input");
	 $date['conv']=$this->input->post("conv");
	 $date['ttd']=$this->input->post("ttd");
	 $this->get_dncn_print($date);
	}
	public function f_gl_voucher()
	{
	 $date['date1']=$this->input->post("date");
	 $date['date2']=$this->input->post("date1");
	 $date['status']=$this->input->post("stat_select");
	 $date['gl_no1']=$this->input->post("gl1");
	 $date['gl_no2']=$this->input->post("gl2");
	 $this->get_gl_voucher($date);
	}
	public function f_grn_rpt()
	{
		$date['date1']=$this->input->post("date");
		$date['date2']=$this->input->post("date1");
		$date['vendor']=$this->input->post("vendor_select");
		$date['packing_slip']=$this->input->post("pack_select");
		$date['po_numb']=$this->input->post("po");
		$date['grn_1']=$this->input->post("grn1");
		$date['grn_2']=$this->input->post("grn2");
		$this->get_grn_rpt($date);
	}
	public function get_tb_base($date)
    {
		$this->oracle_model->delete_tb_base();
		$tb_base_curr=$this->oracle_model->f_tb_base($date);
		foreach($tb_base_curr as $row)
		{
			$data=array( 'COST_CENTER'=>$row['COST_CENTER'],
			             'ACCOUNT'=>$row['ACCOUNT'],
			             'AUX'=>$row['AUX'],
						 'BEG_BAL'=>$row['BEG_BAL'],
			             'ACTIVITY'=>$row['ACTIVITY'],
			             'END_BAL'=>$row['END_BAL']);
			$this->oracle_model->save_tb_base($data);
		}
			$data['data_exp_tb']=$this->acc_model->f_exp_tb();
			$data['period']=$date['period'];
			$data['bu']=$date['bu'];
			$data['curr']=$date['curr'];
			$this->load->view('oracle/tb_base_xls.php',$data);
		
	   }
	public function get_consumption()
	{
		//$p=$this->input->post('period');
		$date['p']=$this->input->post('period');;
		$date['bu']=$this->input->post("bu_select");
		$data['cons']=$this->oracle_model->consumption_report($date);
		$this->load->view('oracle/cons_report.php',$data);
	}
	function po_sub($date,$po_)
	{
		
		$data['data_po_print']=$this->oracle_model->f_po_print_sub($po_);
		$data['data_po_detail']=$this->oracle_model->f_po_print_sub($po_);
		$data['data_select']=$date['status'];
		$data['data_deliv']=$date['status1'];
		$data['data_term']=$date['fob'];
		$data['pph']= $date['pph'];
		$data['cname']= $date['cname'];
		$this->load->view('oracle/po_print_report_sub.php',$data); 
	}
	Function check_query()
	{	
		$date['date1']='01-01-2019';
		$date['date2']='15-01-2019';
		$date['bu']='182';
		$date['account1']='';
		$date['account2']='';
		$date['glno2']='';
		$date['glno1']='';
		$gl_jrnl=$this->oracle_model->f_gl_journal($date);
		print_r($gl_jrnl);
		
		//$this->load->view('oracle/gl_report.php',$data);
	}
	
	public function po_subcon()
	{
		$po=$this->input->post('po');
		$data['header']=$this->oracle_model->subcon_header($po);
		$this->load->view('oracle/delivery_subcon.php',$data); 
	}
	public function adv_py()
	{
		$data=$this->oracle_model->adv();
		$d="GL_Reference,GL_Date,Cus_Sup,Curr,Amount,Rate,Amount_USD,Rate_1,Amount_USD_2,Amount_USD_3,Remarks,PIC,Eff_Date,Term,Due_date,status,counter,Description"."\n";
						$l=1;					
						 foreach($data as $row)
						 {
						
							if($row['status']==0)
							{$st="Over Due";}
							else
							{
								$st="On Schedule";
							}
						  $d.=$row['GL_Reference'].",".$row['GL_Date'].",".$row['Cus_Sup'].",".$row['Curr'].",".$row['Amount'].",".$row['Rate'].",".$row['Amount_USD'].",".
						  $row['Rate_1'].",".$row['Amount_USD_2'].",".$row['Amount_USD_3'].",".$row['Remarks'].",".$row['PIC'].",".$row['Eff_Date'].",".$row['Term'].",".$row['Due_date'].",".$st.",".$row['counter'].",".$row['Description'].","."\n";
						}
						$file = '/adv/adv.csv';
						file_put_contents($file,$d);
 $message="
Advance Payment Overdue

Please find as attachment.

Thank You .
------------------------------------------------------------
This is an automatically generated email.
Please do not reply to it.
------------------------------------------------------------
PT. PANASONIC GOBEL LIFE SOLUTIONS MANUFACTURING IND";
 				$_POST['subject']="Advance Payment";
				$_POST['message']= $message;
				$_POST['email']='peslid_chukai@mli.panasonic.co.id';
				$_POST['name']='ACCOUNTING';
				$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => '157.8.1.150',
				'smtp_user' => 'peslid_chukai@mli.panasonic.co.id',
				'smtp_pass' => '',
				'smtp_port' => 25,
				'mailtype' => 'text',
				'newline'   => "\r\n" // kode yang harus di tulis pada konfigurasi controler email
					));
			//$cc = array('990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','dewi.karimah@mli.panasonic.co.id');
			//$cc = array('muhammad.syarifuddin@mli.panasonic.co.id');
			//$bcc = array('muhammad.syarifuddin@mli.panasonic.co.id');
			$this->email->from($_POST['email'],$_POST['name'])
				->to('rudi.heryanto@mli.panasonic.co.id') 
				//->cc('fajar.wahyulaksono@gmail.com','rudi.heryanto@mli.panasonic.co.id')
				->subject($_POST['subject'])
				->message($_POST['message'])
				->attach($file);
			if ($this->email->send()) 
			{
				$this->session->set_flashdata('messege', 'Email Suksess.');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
unlink($file);
	}
}	