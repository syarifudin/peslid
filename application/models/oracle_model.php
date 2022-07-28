<?php class oracle_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		$this->orcl= $this->load->database('orcl_db',TRUE);
		$this->load->helper('array');
    }
    public function save_bom($data){
	$this->db->insert('orc_bom_list',$data);
	}
	public function save_ap_expense($data){
	$this->db->insert('orc_ap_expense',$data);
	}
	public function save_item_cost($data){
	$this->db->insert('orc_item_cost',$data);
	}
	public function save_consumption($data){
	$this->db->insert('orc_mtl_consumption',$data);
	} 
	public function save_voucher_reg($data){
	$this->db->insert('orc_ap_voucher',$data);
	}
	public function save_cash_flow($data){
	$this->db->insert('orc_cash',$data);
	}
	public function get_del_to()
	{
		$query = $this->db->query("select * from orc_delivery_to");
		return $query->result_array();	
	} 
	public function del_to($del)
	{
		$query = $this->db->query("select * from orc_delivery_to where delivery_code='$del'");
		return $query->result_array();

	}
	public function mtl_trans($data){
	$this->db->insert('orc_mtl_transaction',$data);
	}
	public function save_dj($data){
	$this->db->insert('orc_discrete_job',$data);
	}
	public function save_receive_by_price($data){
	$this->db->insert('orc_po_receipt_det',$data);
	}
	public function save_ap_aging($data){
	$this->db->insert('orc_ap_aging',$data);
	}
	public function save_ar_inv($data){
	$this->db->insert('orc_ar_hist',$data);
	}
	public function begstock($data){
		ini_set('memory_limit', '-1');
	$this->db->insert('orc_beg_stock',$data);
	}
	public function save_gl_journal($data)
	{
	$this->db->insert('orc_journal',$data);
	}
	public function save_adv_pay($data)
	{
	$this->db->insert('orc_advpay',$data);
	}
	public function delete_gl_journal()
	{
		$this->db->query("delete from orc_journal");
	}
	public function delete_adv_pay()
	{
		$this->db->query("delete from orc_advpay");
	}
	public function delete_so()
	{
		$this->db->query("delete from orc_so");
	}
	public function delete_cash_flow()
	{
		$this->db->query("delete from orc_cash");
	}
	public function delete_item_cost()
	{
		$this->db->query("delete from orc_item_cost");
	}
	public function delete_voucher_reg()
	{
		$this->db->query("delete from orc_ap_voucher");
	}
	
	public function delete_ap_expense()
	{
		$this->db->query("delete from orc_ap_expense");
	}
	public function po_receive_by_price_delete()
	{
		$this->db->query("delete from orc_po_receipt_det");
	}
	public function delete_apporcv()
	{
		$this->db->query("delete from orc_ap_po_rcv");
	}
	public function delete_ar()
	{
		$this->db->query("delete from orc_ar_hist");
	}
	public function delete_ap_aging()
	{
		$this->db->query("delete from orc_ap_aging");
	}
	public function prod()
	{
		$this->db->query("delete from orc_discrete_job");
		$this->db->query("delete from orc_mtl_transaction");
	}
	public function delete_onhand()
	{
		$this->db->query("delete from orc_inv_on_hand");
	}
	public function insert_so($data_so){
	$rv['ACTUAL_SHIPMENT_DATE']=NULL;
	$full['FULFILLMENT_DATE']=NULL;
	$ON_OR['ON_OR_ABOUT']=NULL;
	$this->db->insert('orc_so',$data_so);
	$this->db->where('ACTUAL_SHIPMENT_DATE','1970-01-01')
	          ->update('orc_so',$rv);
	$this->db->where('FULFILLMENT_DATE','1970-01-01')
	          ->update('orc_so',$full);
	$this->db->where('ON_OR_ABOUT','1970-01-01')
	          ->update('orc_so',$ON_OR);
	}
	public function save_inv_on_hand($data){
	$this->db->insert('orc_inv_on_hand',$data);
	}
	public function save_ap_po($data){
	$this->db->insert('orc_ap_po_rcv',$data);
	}
	public function save_po_receive($data){
	$this->db->insert('orc_po_receive',$data);
	}
	public function save_uom_conv($data){
	$this->db->insert('orc_uom_conv',$data);
	}
	public function save_po_asl($data){
	$this->db->insert('orc_po_asl',$data);
	}
	public function save_po_oustanding($data){
	$this->db->insert('orc_po_oustanding',$data);
	}
	public function transaction_completion($data)
	{
	$this->db->insert('orc_transaction_completion',$data);
	}
	public function bom_I($data)
	{
	$this->db->insert('ORC_CURR_BOM',$data);
	}
	public function bom_std($data)
	{
	$this->db->insert('ORC_BOM_STD',$data);
	}
	public function dlt_table()
	{
		$query = $this->db->query("delete from orc_bom_list ");
		$query = $this->db->query("delete from orc_uom_conv ");
		//$query = $this->db->query("delete from orc_inv_on_hand ");
		 $query = $this->db->query("delete from orc_po_receive");
		 $query = $this->db->query("delete from orc_po_asl ");
		 $query = $this->db->query("delete from orc_po_oustanding");
		 $query = $this->db->query("delete from orc_transaction_completion");
	}
	public function SO_INV()
		   {
				$query=$this->orcl->query("SELECT
				  om_line.LINE_NUMBER,
				  om_line.ORDERED_ITEM,  om_line.PROMISE_DATE,
				  om_line.UNIT_SELLING_PRICE,
				  om_line.SCHEDULE_SHIP_DATE,  om_line.ORDER_QUANTITY_UOM,om_header.TRANSACTIONAL_CURR_CODE,
				  om_line.PRICING_QUANTITY,
				  om_line.ORDERED_QUANTITY, dlv_det.SHIPPED_QUANTITY,  om_line.SHIPPING_QUANTITY_UOM,
				  mstr_del.DELIVERY_ID,
				  mstr_del.ATTRIBUTE7 as Surat_Jalan,
				  mstr_del.ATTRIBUTE4 as ON_OR_ABOUT,
				  om_header.ORDER_NUMBER,
				  om_line.ACTUAL_SHIPMENT_DATE,
				  om_header.PRICE_LIST_ID,
				  om_header.CUST_PO_NUMBER,
				  om_line.FULFILLMENT_DATE,
				  om_line.FULFILLED_QUANTITY,
				  om_line.INVOICE_INTERFACE_STATUS_CODE,
				  om_line.INVOICED_QUANTITY,
				  om_header.SHIP_TO_ORG_ID,
				  om_line.TAX_CODE,b.PARTY_NAME,f.PARTY_SITE_NAME,g.ADDRESS1
				FROM 
				APPS.MEW_C_HZ_LOCATIONS_ID_V g,
				APPS.MEW_C_HZ_PARTY_SITES_ID_V f,
				APPS.MEW_C_HZ_CUST_SITE_USES_ID_V d,
				APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V e,
				APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V a, APPS.MEW_C_HZ_PARTIES_ID_V b,
				APPS.MEW_C_OE_ORDER_LINES_ALL_ID_V om_line LEFT JOIN APPS.MEW_C_OE_ORDER_HEADERS_ID_V om_header
				ON  om_header.HEADER_ID=om_line.HEADER_ID LEFT JOIN APPS.MEW_C_WSH_DELIV_DETAILS_ID_V dlv_det ON  om_line.LINE_ID=dlv_det.SOURCE_LINE_ID 
				LEFT JOIN APPS.MEW_C_WSH_DELIV_ASSIGN_ID_V del_ass ON del_ass.DELIVERY_DETAIL_ID=dlv_det.DELIVERY_DETAIL_ID LEFT JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V mstr_del ON mstr_del.DELIVERY_ID=del_ass.DELIVERY_ID 
				where 
				a.PARTY_ID=b.PARTY_ID 
				and a.CUST_ACCOUNT_ID=om_header.SOLD_TO_ORG_ID
				and om_header.SHIP_TO_ORG_ID=d.site_USE_ID 
				and d.CUST_ACCT_SITE_ID=e.CUST_ACCT_SITE_ID
				and e.PARTY_SITE_ID=f.PARTY_SITE_ID 
				and f.LOCATION_ID=g.LOCATION_ID
				and om_line.ORG_ID='222'		
				and om_line.INVOICE_INTERFACE_STATUS_CODE='YES'
				and(om_line.FULFILLMENT_DATE	>='01-FEB-17'	or	om_line.FULFILLMENT_DATE	IS	NULL) order by om_line.INVOICE_INTERFACE_STATUS_CODE");
				return $query->result_array();
			}
	public function data_so($date)
	{
	$tgl="01-".$date;
	$dt=date('d-M-Y',strtotime($tgl));
	$query=$this->orcl->query("SELECT om_line.LINE_NUMBER,
							  dlv_det.SOURCE_LINE_NUMBER AS LINE_SPLIT,
							  om_line.ORDERED_ITEM,
							  om_line.PROMISE_DATE AS PROMISE_DATE,
							  om_line.SCHEDULE_SHIP_DATE,
							  om_header.TRANSACTIONAL_CURR_CODE,
							  case
                WHEN (dlv_det.REQUESTED_QUANTITY IS NULL AND om_line.FLOW_STATUS_CODE !='AWAITING_RETURN')
                then om_line.ORDERED_QUANTITY
                else dlv_det.REQUESTED_QUANTITY
                END AS ORDERED_QUANTITY,
							  dlv_det.SHIPPED_QUANTITY AS SHIPPED_QUANTITY,
							  om_line.CANCELLED_QUANTITY,
                om_line.SPLIT_BY,	
							  om_line.UNIT_SELLING_PRICE,
							  CASE
								WHEN (om_header.ORDER_NUMBER LIKE '%6000%'
								OR om_header.ORDER_NUMBER LIKE '%6400%')
								THEN om_line.UNIT_SELLING_PRICE * om_line.INVOICED_QUANTITY
								WHEN om_line.FLOW_STATUS_CODE = 'AWAITING_SHIPPING'
								THEN om_line.UNIT_SELLING_PRICE * om_line.ORDERED_QUANTITY
								ELSE om_line.UNIT_SELLING_PRICE * dlv_det.SHIPPED_QUANTITY
							  END AS Amount,
							  om_line.SHIPPING_QUANTITY_UOM,
							  om_header.ORDERED_DATE,
							  om_header.REQUEST_DATE,
							  om_line.ACTUAL_SHIPMENT_DATE,
							  mstr_del.DELIVERY_ID,
							  mstr_del.ATTRIBUTE7 AS Surat_Jalan,
							  AR_.ATTRIBUTE10,
							  mstr_del.ATTRIBUTE4 AS ON_OR_ABOUT,
							  om_header.ORDER_NUMBER,
							  om_header.CUST_PO_NUMBER,
							  om_line.FULFILLMENT_DATE,
							  om_line.FULFILLED_QUANTITY,
							  om_line.INVOICE_INTERFACE_STATUS_CODE,
                  CASE 
                      WHEN  (om_header.ORDER_NUMBER LIKE '%6000%' OR om_header.ORDER_NUMBER LIKE '%6400%')
                           THEN om_line.INVOICED_QUANTITY
                           else dlv_det.SHIPPED_QUANTITY
                           end as INVOICED_QUANTITY,
							  om_line.ACCEPTED_QUANTITY AS POSTED_QTY,
							  om_line.FLOW_STATUS_CODE  AS Status,
							 CASE
								WHEN AR.CT_REFERENCE IS NOT NULL
								THEN 'YES'
								ELSE 'NOT YET'
							  END AS STATUS_AR,
							  om_line.TAX_CODE,
							  b.PARTY_NAME,
							  f.PARTY_SITE_NAME,
							  g.ADDRESS1,
							  g.ADDRESS2,
							  g.ADDRESS3,
							  g.ADDRESS4,
							  g.CITY,
							  h.PACKING_STYLE_CODE,
							  h.QUANTITY_PER_PACKING,
							  h.NET_WEIGHT,
							  h.GROSS_WEIGHT,
							  h.WIDTH,
							  h.DEPTH,
							  h.HEIGHT,
							  (h.WIDTH                 * h.DEPTH * h.HEIGHT)    AS M3,
							  dlv_det.SHIPPED_QUANTITY / h.QUANTITY_PER_PACKING AS Total_Pack,
							  mstr_del.TP_ATTRIBUTE1,
							  mstr_del.TP_ATTRIBUTE2,
                AR_.ATTRIBUTE12
							FROM APPS.MEW_C_HZ_LOCATIONS_ID_V g,
							  APPS.MEW_C_HZ_PARTY_SITES_ID_V f,
							  APPS.MEW_C_HZ_CUST_SITE_USES_ID_V d,
							  APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V e,
							  APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V a,
							  APPS.MEW_C_HZ_PARTIES_ID_V b,
							  APPS.MEW_C_OE_ORDER_LINES_ALL_ID_V om_line 
							LEFT OUTER JOIN APPS.MEW_C_OE_ORDER_HEADERS_ID_V om_header
							ON om_header.HEADER_ID = om_line.HEADER_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_DELIV_DETAILS_ID_V dlv_det
							ON om_line.LINE_ID = dlv_det.SOURCE_LINE_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_DELIV_ASSIGN_ID_V del_ass
							ON del_ass.DELIVERY_DETAIL_ID = dlv_det.DELIVERY_DETAIL_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V mstr_del
							ON mstr_del.DELIVERY_ID = del_ass.DELIVERY_ID left JOIN (select a.ATTRIBUTE10,b.INTERFACE_LINE_ATTRIBUTE6,a.ATTRIBUTE12 from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V a,APPS.MEW_C_RA_CUST_TRX_LINES_ID_V b where a.CUSTOMER_TRX_ID=b.CUSTOMER_TRX_ID) AR_ ON om_line.line_ID=AR_.INTERFACE_LINE_ATTRIBUTE6
							LEFT OUTER JOIN
							  (SELECT INVENTORY_ITEM_ID,    PACKING_STYLE_CODE,    QUANTITY_PER_PACKING,    NET_WEIGHT,    GROSS_WEIGHT,    WIDTH,    DEPTH,    HEIGHT  FROM APPS.MEW_GEDI_ID_PACKING_ID_V  WHERE PACKING_STYLE_CODE = 'CB'  AND ORGANIZATION_ID      = '222'
							  ) h
							ON om_line.INVENTORY_ITEM_ID = h.INVENTORY_ITEM_ID
							LEFT  JOIN (select distinct(CT_REFERENCE)  from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V) AR
							ON AR.CT_REFERENCE                 = TO_CHAR(mstr_del.DELIVERY_ID)
							WHERE a.PARTY_ID                   = b.PARTY_ID
							AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID
							AND (om_line.ACTUAL_SHIPMENT_DATE >='$dt'
							OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL and om_line.FLOW_STATUS_CODE !='CANCELLED') 
							AND om_line.ORG_ID                 = 222
							ORDER BY om_line.INVOICE_INTERFACE_STATUS_CODE,om_header.ORDER_NUMBER");
		  return $query->result_array();	
	}
	public function get_onhand_item() // inventory item
	{
		$query=$this->orcl->query("select  item.SEGMENT1,item.ITEM_TYPE,item.DESCRIPTION,onhnd.INVENTORY_ITEM_ID, onhnd.SUBINVENTORY_CODE, SUM(onhnd.PRIMARY_TRANSACTION_QUANTITY) as QTY
		FROM APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V item RIGHT JOIN
		APPS.MEW_C_MTL_ONHAND_QTY_DET_ID_V onhnd
		on item.INVENTORY_ITEM_ID=onhnd.INVENTORY_ITEM_ID
		where
		item.ORGANIZATION_ID='222'
		group  by  item.SEGMENT1,item.ITEM_TYPE,item.DESCRIPTION,onhnd.INVENTORY_ITEM_ID, onhnd.SUBINVENTORY_CODE");
		return $query->result_array();							
	}
	public function get_po_ap($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		$query=$this->orcl->query("SELECT DISTINCT
									  RCV.TRANSACTION_DATE RCV_TRX_DATE,
									  RCV.CREATION_DATE RCV_CREATION_DATE,
									  PO.SEGMENT1 PO,
									  PO.AGENT_ID BUYER,
									  RCVH.RECEIPT_NUM RCV_NUM,
									  RCVH.PACKING_SLIP,
									  PO.CREATION_DATE PO_CREATION_DATE,
									  VEND.VENDOR_NAME,
									  VDET.VENDOR_SITE_CODE,
									  POD.LINE_NUM LINE,
									  PT.SEGMENT1 ITEM,
									  POD.QUANTITY QTY_PO,
									  POD.UNIT_MEAS_LOOKUP_CODE PO_UOM,
									  POD.UNIT_PRICE PRICE,
									  CST.MATERIAL_COST,
									  PO.CURRENCY_CODE CURR,
									  CASE WHEN RCV.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR') THEN (RCV.QUANTITY*-1)
										ELSE RCV.QUANTITY END AS QTY_RCV,
									  RCV.UNIT_OF_MEASURE RCV_UOM,
									  (POD.UNIT_PRICE*(CASE WHEN RCV.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR') THEN (RCV.QUANTITY*-1)
										ELSE RCV.QUANTITY END)) AS AMOUNT,
									  NVL(INV.EXCHANGE_RATE ,0) INV_RATE,
									  NVL(IVD.BASE_AMOUNT,0) INV_BASE_AMOUNT,
									  NVL(PO.RATE,0) PO_RATE,
									  ROUND(POD.UNIT_PRICE*(CASE WHEN RCV.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR') THEN (RCV.QUANTITY*-1)
										ELSE RCV.QUANTITY END)* NVL(PO.RATE,1),2) AS PO_BASE_AMOUNT,
									  NVL(TO_CHAR(INV.INVOICE_DATE),'NULL') INVOICE_DATE,
									  NVL(TO_CHAR(IVD.CREATION_DATE),'NULL') INV_CREATION_DATE,
									  INV.DOC_SEQUENCE_VALUE JV_NO,
									  INV.INVOICE_NUM,
									  CASE WHEN INV.CANCELLED_AMOUNT IS NOT NULL THEN 'CANCELLED'
										ELSE CASE WHEN AP.REVERSAL_FLAG = 'Y' THEN 'REVERSED' 
										ELSE CASE WHEN RCV.TRANSACTION_TYPE = 'RETURN TO RECEIVING' THEN 'RETURN'
										ELSE CASE WHEN RCV.TRANSACTION_TYPE = 'RETURN TO VENDOR' THEN 'RETURN'
										ELSE CASE WHEN RCV.TRANSACTION_TYPE = 'DELIVER' THEN 'CHECK'
										ELSE CASE WHEN (SELECT COUNT(RCVT.SHIPMENT_LINE_ID) FROM APPS.MEW_C_RCV_SHIPMENT_HEADER_ID_V RCVSH, APPS.MEW_C_RCV_TRANSACTIONS_ID_V RCVT 
										  WHERE RCVT.SHIPMENT_HEADER_ID = RCVSH.SHIPMENT_HEADER_ID 
										  AND RCVSH.RECEIPT_NUM = RCVH.RECEIPT_NUM 
										  AND RCVT.SHIPMENT_LINE_ID = RCV.SHIPMENT_LINE_ID
										  AND RCVSH.SHIP_TO_ORG_ID=222 and RCVT.ORGANIZATION_ID='222' 
										  AND RCVT.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR')) >= 1 THEN 'RETURN' END
										END END END END END AS INV_STATUS,
										RCV.TRANSACTION_TYPE,
									  AP.POSTED_FLAG
									FROM (SELECT * FROM APPS.MEW_C_RCV_TRANSACTIONS_ID_V WHERE ORGANIZATION_ID='222' AND TRANSACTION_DATE BETWEEN '$dt' AND '$dt1'
										AND USER_ENTERED_FLAG='Y') RCV
										LEFT OUTER JOIN (SELECT * FROM APPS.MEW_C_AP_INVOICE_LINES_ID_V WHERE MATCH_TYPE = 'ITEM_TO_RECEIPT') IVD 
										ON IVD.RCV_TRANSACTION_ID = RCV.TRANSACTION_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_INVOICES_ALL_ID_V INV ON INV.INVOICE_ID = IVD.INVOICE_ID 
										LEFT OUTER JOIN APPS.MEW_C_RCV_SHIPMENT_HEADER_ID_V RCVH ON RCV.SHIPMENT_HEADER_ID = RCVH.SHIPMENT_HEADER_ID
										LEFT OUTER JOIN APPS.MEW_C_PO_HEADERS_ALL_ID_V PO ON RCV.ORGANIZATION_ID = PO.ORG_ID AND RCV.PO_HEADER_ID = PO.PO_HEADER_ID
										LEFT OUTER JOIN APPS.MEW_C_PO_LINES_ARC_ALL_ID_V POD ON PO.PO_HEADER_ID = POD.PO_HEADER_ID AND RCV.PO_LINE_ID = POD.PO_LINE_ID
										LEFT OUTER JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT ON POD.ORG_ID = PT.ORGANIZATION_ID AND POD.ITEM_ID = PT.INVENTORY_ITEM_ID
										LEFT OUTER JOIN APPS.MEW_C_CST_ITEM_COSTS_ID_V CST ON CST.INVENTORY_ITEM_ID = PT.INVENTORY_ITEM_ID AND CST.ORGANIZATION_ID=222 AND CST.COST_TYPE_ID=3
										LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON RCV.VENDOR_ID = VEND.VENDOR_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON RCV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_INVOICE_DISTRIB_ID_V AP ON IVD.INVOICE_ID = AP.INVOICE_ID 
										AND IVD.LINE_NUMBER = AP.INVOICE_LINE_NUMBER AND RCV.TRANSACTION_ID = AP.RCV_TRANSACTION_ID AND AP.LINE_TYPE_LOOKUP_CODE='ACCRUAL'
									WHERE POD.LATEST_EXTERNAL_FLAG = 'Y'
									ORDER BY PO.SEGMENT1, POD.LINE_NUM, RCVH.RECEIPT_NUM ASC");
		return $query->result_array();	
	}
	public function dj($date)
	{
		
   $dt=$date;
   $query=$this->orcl->query("select b.WIP_ENTITY_NAME,c.SEGMENT1,c.ITEM_TYPE,a.CREATION_DATE,a.DATE_COMPLETED,a.SCHEDULED_COMPLETION_DATE,a.START_QUANTITY,
							a.QUANTITY_COMPLETED,a.NET_QUANTITY,a.COMPLETION_SUBINVENTORY,a.STATUS_TYPE,
							case when a.STATUS_TYPE =3 then 'RELEASE'
							when a.STATUS_TYPE =7 then 'CANCEL'
							else  'COMPLETED' end STATUS
							from APPS.MEW_C_WIP_DISCRETE_JOBS_ID_V a , APPS.MEW_C_WIP_ENTITIES_ID_V b,APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V c where a.WIP_ENTITY_ID=b.WIP_ENTITY_ID 
							and a.PRIMARY_ITEM_ID=c.INVENTORY_ITEM_ID  and to_char(a.SCHEDULED_COMPLETION_DATE,'mm-YYYY')='$dt' 
							and c.ORGANIZATION_ID='222'");
	return $query->result_array();						
	}

	public function mtl_transaction($date)
	{
	
	$dt=$date;
    $query=$this->orcl->query("select a.TRANSACTION_ID,c.SEGMENT1,c.ITEM_TYPE,a.CREATION_DATE,a.INVENTORY_ITEM_ID, a.SUBINVENTORY_CODE,a.TRANSFER_SUBINVENTORY,a.TRANSACTION_TYPE_ID,a.TRANSACTION_QUANTITY,a.TRANSACTION_DATE,
            a.TRANSACTION_SOURCE_NAME,a.TRANSACTION_REFERENCE, b.WIP_ENTITY_NAME AS WIP_SOURCE_NAME
								from 
								APPS.MEW_C_MTL_MATERIAL_TRN_ID_V a left JOIN APPS.MEW_C_WIP_ENTITIES_ID_V b ON b.WIP_ENTITY_ID=a.TRANSACTION_SOURCE_ID,
								APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V c
								where 
								a.INVENTORY_ITEM_ID=c.INVENTORY_ITEM_ID 
								and a.ORGANIZATION_ID='222'  and C.ORGANIZATION_ID='222' and to_char(a.TRANSACTION_DATE,'mm-YYYY')='$dt' 
								group by a.TRANSACTION_ID,c.SEGMENT1,c.ITEM_TYPE,a.CREATION_DATE,a.INVENTORY_ITEM_ID, a.SUBINVENTORY_CODE,a.TRANSFER_SUBINVENTORY,a.TRANSACTION_TYPE_ID,a.TRANSACTION_QUANTITY,
								a.TRANSACTION_DATE,a.TRANSACTION_SOURCE_NAME,a.TRANSACTION_REFERENCE,a.TRANSACTION_SOURCE_ID,b.WIP_ENTITY_NAME");
	return $query->result_array();						
	}
	
	public function beg_stock()
	{
	 $query=$this->orcl->query("select ITEM_CODE,TRANSACTION_UOM,DISPLAY_ITEM_TYPE,SUBINVENTORY_CODE,ACTUAL_QTY from 
	 APPS.MEW_PHYSICAL_COUNTS_ALL_ID_V where organization_id='222' AND PERIOD_NAME='Jun-17'");
	return $query->result_array();	
	 }	
    public function ar_invoice($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		 $query=$this->orcl->query("SELECT  DISTINCT CASE WHEN ARD.SALES_ORDER IS NULL THEN 'MANUAL'
									  ELSE 'IMPORT' END AS SOURCE,
									AR.TRX_NUMBER AR_NO,
									GL.STATUS,
									AR.ATTRIBUTE10 INVOICE_NO,
									AR.CT_REFERENCE DELIVERY_NO,
									ARD.SALES_ORDER,
									OM.CUST_PO_NUMBER,
									BILL_PARTY.PARTY_NAME BILL_TO,
									CUST.ACCOUNT_NUMBER,
									LOC.ADDRESS1 SHIP_TO,
									LOC.COUNTRY COUNTRY,
									LOC.CITY CITY,
									AR.CREATION_DATE,
									TO_DATE(NDLV.ATTRIBUTE4,'YYYY/MM/dd HH24:MI:SS') ON_OR_ABOUT,
									ARGL.GL_DATE,
									CASE BILL_PARTY.PARTY_NAME WHEN '26-PESGSID' THEN ARGL.GL_DATE 
										ELSE TO_DATE(NDLV.ATTRIBUTE4,'YYYY/MM/dd HH24:MI:SS') END AS INVOICE_DATE,
									AR.INVOICE_CURRENCY_CODE CURRENCY, 
									AR.EXCHANGE_RATE,
									ARD.LINE_NUMBER LINE,
									PT.SEGMENT1 ITEM_NUMBER,
                  case when cus.CUSTOMER_ITEM is null
                  then PT.SEGMENT1
                  else
                  cus.CUSTOMER_ITEM
                  end as CUSTOMER_ITEM,
									CC.SEGMENT2 COST_CENTER, 
									CC.SEGMENT3 ITEM_TYPE,
									ARD.QUANTITY_INVOICED QTY,
									ARD.UNIT_SELLING_PRICE PRICE,
									ARD.LINE_RECOVERABLE AMOUNT,
									NVL(ARD.TAX_RECOVERABLE,0) TAX,
									ARD.LINE_RECOVERABLE + NVL(ARD.TAX_RECOVERABLE,0) as TOTAL,
									ROUND((ARD.LINE_RECOVERABLE * NVL(AR.EXCHANGE_RATE,1)),2) BASE_AMOUNT
							 	 FROM  APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR LEFT JOIN APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V CUST
								  ON AR.BILL_TO_CUSTOMER_ID = CUST.CUST_ACCOUNT_ID LEFT JOIN APPS.MEW_C_HZ_PARTIES_ID_V BILL_PARTY
								  ON BILL_PARTY.PARTY_ID  = CUST.PARTY_ID LEFT JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V NDLV 
								  ON AR.CT_REFERENCE = TO_CHAR(NDLV.DELIVERY_ID) LEFT JOIN APPS.MEW_C_RA_CUST_TRX_LINES_ID_V ARD 
								  ON AR.CUSTOMER_TRX_ID = ARD.CUSTOMER_TRX_ID LEFT JOIN  APPS.MEW_C_OE_ORDER_HEADERS_ID_V OM
								  ON ARD.SALES_ORDER = OM.ORDER_NUMBER LEFT JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT
								  ON ARD.INVENTORY_ITEM_ID = PT.INVENTORY_ITEM_ID AND PT.ORGANIZATION_ID='222' left join
								  (select PT.SEGMENT1, MTL_CAT.SEGMENT2, MTL_CAT.SEGMENT3 
									  from APPS.MEW_C_MTL_ITEM_CATEGORIES_ID_V ITEM_CAT, APPS.MEW_C_MTL_CATEGORIES_ID_V MTL_CAT, APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT 
									  where PT.INVENTORY_ITEM_ID = ITEM_CAT.INVENTORY_ITEM_ID and ITEM_CAT.CATEGORY_ID = MTL_CAT.CATEGORY_ID 
									  and PT.ORGANIZATION_ID='222' and ITEM_CAT.ORGANIZATION_ID='222' and MTL_CAT.SEGMENT1='26') CC on PT.SEGMENT1=CC.SEGMENT1 LEFT JOIN 
                    (select  cust.part_number CUSTOMER_ITEM, cust.INVENTORY_ITEM_ID  from APPS.MEW_SO_EDI_PART_ITEM_MAP_ID_V cust where cust.ORGANIZATION_ID=222  group BY cust.INVENTORY_ITEM_ID,cust.part_number) cus ON PT.INVENTORY_ITEM_ID=cus.INVENTORY_ITEM_ID
								  left join (select distinct AR.TRX_NUMBER, GL.STATUS
											from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR
											left join apps.MEW_C_GL_JE_LINES_ID_V GLD on AR.DOC_SEQUENCE_VALUE = GLD.SUBLEDGER_DOC_SEQUENCE_VALUE
											left join APPS.MEW_C_GL_JE_HEADERS_ID_V GL on GLD.JE_HEADER_ID = GL.JE_HEADER_ID 
											where GL.JE_SOURCE='Receivables') GL on AR.TRX_NUMBER = GL.TRX_NUMBER  
								  left outer join (select DISTINCT GL_DATE, CUSTOMER_TRX_LINE_ID from apps.MEW_C_RA_TRX_LINE_GL_DIST_ID_V where account_class='REV' and ACCOUNT_SET_FLAG = 'N') ARGL on ARD.CUSTOMER_TRX_LINE_ID = ARGL.CUSTOMER_TRX_LINE_ID
								  left outer join (select DISTINCT GL_DATE, CUSTOMER_TRX_LINE_ID from apps.MEW_C_RA_TRX_LINE_GL_DIST_ID_V where account_class='REV' and ACCOUNT_SET_FLAG = 'N') ARGL on ARD.CUSTOMER_TRX_LINE_ID = ARGL.CUSTOMER_TRX_LINE_ID
								  left outer join APPS.MEW_C_HZ_CUST_SITE_USES_ID_V SITE on AR.SHIP_TO_SITE_USE_ID = SITE.SITE_USE_ID
								  left outer join APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V CUST_ACCT on SITE.CUST_ACCT_SITE_ID = CUST_ACCT.CUST_ACCT_SITE_ID
								  left outer join APPS.MEW_C_HZ_PARTY_SITES_ID_V P_SITE on CUST_ACCT.PARTY_SITE_ID = P_SITE.PARTY_SITE_ID
								  left outer join APPS.MEW_C_HZ_LOCATIONS_ID_V LOC on P_SITE.LOCATION_ID = LOC.LOCATION_ID
								WHERE 
								AR.ATTRIBUTE_CATEGORY='222'
								AND ARD.LINE_TYPE='LINE'
								AND  AR.CREATION_DATE BETWEEN '$dt' AND '$dt1'
								ORDER BY BILL_PARTY.PARTY_NAME, AR.CREATION_DATE, AR.TRX_NUMBER, ARD.LINE_NUMBER ASC");
						return $query->result_array();
	}
	
	public function po_receive_by_price($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		$query=$this->orcl->query("	select rcv.TRANSACTION_TYPE, vend.VENDOR_NAME,vdet.VENDOR_SITE_CODE,po_head.SEGMENT1,po_line.creation_date,po_loc.PROMISED_DATE,po_loc.NEED_BY_DATE,rcv.TRANSACTION_DATE,po_line.LINE_NUM,mstr.SEGMENT1 as ITEM_CODE,po_line.ITEM_DESCRIPTION,po_dist.QUANTITY_ORDERED,
								po_line.UNIT_PRICE ,rcv.PO_UNIT_PRICE,mstr.ITEM_TYPE,mstr.PRIMARY_UNIT_OF_MEASURE,po_line.UNIT_MEAS_LOOKUP_CODE,cst.MATERIAL_COST,po_head.CURRENCY_CODE,po_head.RATE,rcv.PRIMARY_QUANTITY,
								  case when rcv.TRANSACTION_TYPE = 'RETURN TO VENDOR' then (rcv.QUANTITY*-1)
								  when rcv.TRANSACTION_TYPE = 'RETURN TO RECEIVING' then (rcv.QUANTITY*-1)
									else rcv.QUANTITY end as QTY_RCV,
								  B.RECEIPT_NUM as GRN,B.PACKING_SLIP
								  from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head
								  LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
								  LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID LEFT JOIN 
								  APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V mstr ON 	mstr.INVENTORY_ITEM_ID=po_line.ITEM_ID	LEFT JOIN APPS.MEW_C_RCV_TRANSACTIONS_ID_V  rcv ON po_head.PO_HEADER_ID=rcv.PO_HEADER_ID 
								  LEFT JOIN APPS.MEW_C_RCV_SHIPMENT_HEADER_ID_V B ON rcv.shipment_header_id = B.shipment_header_id, apps.MEW_C_AP_SUPPLIERS_ID_V vend,apps.MEW_C_AP_SUPPLIER_SITES_ID_V vdet, APPS.MEW_C_PO_LINE_LOC_ALL_ID_V po_loc,
								   APPS.MEW_C_CST_ITEM_COSTS_ID_V cst
								  where 
								  rcv.VENDOR_ID = vend.VENDOR_ID AND 
								  mstr.INVENTORY_ITEM_ID = cst.INVENTORY_ITEM_ID
								  AND 
								  mstr.ORGANIZATION_ID     = cst.ORGANIZATION_ID 
								  AND cst.COST_TYPE_ID        = '1' and
								  rcv.VENDOR_SITE_ID = vdet.VENDOR_SITE_ID and  po_line.PO_LINE_ID=po_loc.PO_LINE_ID and
								  po_line.PO_LINE_ID=rcv.PO_LINE_ID AND mstr.ORGANIZATION_ID='222' and po_head.org_id='222'  and rcv.USER_ENTERED_FLAG='Y'  
								  and rcv.TRANSACTION_DATE BETWEEN '$dt' AND '$dt1'
								  order by rcv.TRANSACTION_DATE DESC");
		return $query->result_array();
	}
	public function expense($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
				$query=$this->orcl->query("select DISTINCT
				INV.DOC_SEQUENCE_VALUE JV_NO,
				INV.INVOICE_NUM,
				INV.INVOICE_DATE,
				VEND.VENDOR_NAME,
				VDET.VENDOR_SITE_CODE,
				INV.DESCRIPTION HEADER,
				IVD.DESCRIPTION,
				GLC.SEGMENT2 BU,
				GLC.SEGMENT3 COST_CENTER,
				GLC.SEGMENT4 ACCOUNT_CODE,
				GLC.SEGMENT5 AUX,
				INV.INVOICE_CURRENCY_CODE CURRENCY,
				IVD.AMOUNT,
				CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN IVD.AMOUNT
				ELSE IVD.BASE_AMOUNT END AS BASE_AMOUNT
				FROM APPS.MEW_C_AP_INVOICES_ALL_ID_V INV LEFT OUTER JOIN APPS.MEW_C_AP_INVOICE_LINES_ID_V IVL ON INV.INVOICE_ID = IVL.INVOICE_ID AND INV.ORG_ID=222
				LEFT OUTER JOIN APPS.MEW_C_AP_INVOICE_DISTRIB_ID_V IVD ON IVL.INVOICE_ID = IVD.INVOICE_ID
				LEFT OUTER JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON IVD.DIST_CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
				LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
				LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON INV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
				where GLC.SEGMENT4 between '400000' and '599999' AND INV.CANCELLED_AMOUNT IS NULL AND IVD.LINE_TYPE_LOOKUP_CODE = 'ITEM'
				AND INV.INVOICE_DATE BETWEEN '$dt' AND '$dt1' ORDER BY INV.DOC_SEQUENCE_VALUE");
	return $query->result_array();
	}
	public function consumption()
	{
		                $query=$this->orcl->query(" select d.pc_comp,c.SEGMENT1,c.ITEM_TYPE,a.CREATION_DATE,a.INVENTORY_ITEM_ID, a.SUBINVENTORY_CODE,a.TRANSFER_SUBINVENTORY,a.TRANSACTION_TYPE_ID,a.PRIMARY_QUANTITY,a.TRANSACTION_DATE
								from 
								APPS.MEW_C_MTL_MATERIAL_TRN_ID_V a left JOIN APPS.MEW_C_WIP_ENTITIES_ID_V b ON b.WIP_ENTITY_ID=a.TRANSACTION_SOURCE_ID,
								APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V C,(select SEGMENT1 as pc_comp,INVENTORY_ITEM_ID from APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V where ORGANIZATION_ID='222' group by SEGMENT1,INVENTORY_ITEM_ID) d
                where a.INVENTORY_ITEM_ID=c.INVENTORY_ITEM_ID  and b.PRIMARY_ITEM_ID=d.INVENTORY_ITEM_ID
								and a.ORGANIZATION_ID='222' and a.TRANSACTION_DATE between '01-MAY-17' AND '31-MAY-17'    and  a.TRANSACTION_TYPE_ID IN ('35','43')  and c.ORGANIZATION_ID='222' 
								group by c.SEGMENT1,c.ITEM_TYPE,a.CREATION_DATE,a.INVENTORY_ITEM_ID, a.SUBINVENTORY_CODE,a.TRANSFER_SUBINVENTORY,a.TRANSACTION_TYPE_ID,a.PRIMARY_QUANTITY,
								a.TRANSACTION_DATE,a.TRANSACTION_SOURCE_NAME,a.TRANSACTION_REFERENCE,a.TRANSACTION_SOURCE_ID,b.PRIMARY_ITEM_ID,d.pc_comp");
		return $query->result_array();						
		
	}
	public function item_cost()
	{
		$query=$this->orcl->query("SELECT itm.ORGANIZATION_ID,
								  itm.SEGMENT1,
								  itm.DESCRIPTION,
								  mew.cc, 
								  mew.acc, 
								  cst.LAST_UPDATE_DATE,
								  itm.CREATED_BY,
								  itm.PRIMARY_UOM_CODE,
								  itm.LAST_UPDATE_DATE,
								  itm.ITEM_TYPE,
								  cst.MATERIAL_COST,
								  cst.ITEM_COST,
								 itm.INVENTORY_ITEM_STATUS_CODE 
								FROM APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V itm left outer join (select PT.SEGMENT1 item, MTL_CAT.SEGMENT2 cc, MTL_CAT.SEGMENT3 tipe, MTL_CAT.SEGMENT4 acc, MTL_CAT.SEGMENT5 aux, MTL_CAT.SEGMENT6 dev 
										  from APPS.MEW_C_MTL_ITEM_CATEGORIES_ID_V ITEM_CAT, APPS.MEW_C_MTL_CATEGORIES_ID_V MTL_CAT, APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT 
										  where PT.INVENTORY_ITEM_ID = ITEM_CAT.INVENTORY_ITEM_ID and ITEM_CAT.CATEGORY_ID = MTL_CAT.CATEGORY_ID 
										  and PT.ORGANIZATION_ID='222' and ITEM_CAT.ORGANIZATION_ID='222' and MTL_CAT.SEGMENT1='26') mew on mew.item = itm.segment1,
								 APPS.MEW_C_CST_ITEM_COSTS_ID_V cst 
								WHERE itm.INVENTORY_ITEM_ID = cst.INVENTORY_ITEM_ID
								AND itm.ORGANIZATION_ID     = cst.ORGANIZATION_ID
								AND cst.COST_TYPE_ID='1' 
								AND itm.ORGANIZATION_ID IN ('222')");
		return $query->result_array();	
	}
	
	public function voucher_reg($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		
		$query=$this->orcl->query("SELECT INV.DOC_SEQUENCE_VALUE JV_NO, 
									GL.DOC_SEQUENCE_VALUE GL_NO,
									INV.INVOICE_NUM, 
									INV.INVOICE_DATE,
									IVD.ACCOUNTING_DATE GL_DATE,
									PO.SEGMENT1 PO, 
									VEND.SEGMENT1 VENDOR_NUMBER, 
									VEND.VENDOR_NAME,
									VDET.VENDOR_SITE_CODE, 
									INV.DESCRIPTION HEADER, 
									IVD.DESCRIPTION, 
									GLC.SEGMENT2 BU, 
									GLC.SEGMENT3 COST_CENTER, 
									GLC.SEGMENT4 ACCOUNT_CODE, 
									GLC.SEGMENT5 AUX, 
									INV.INVOICE_CURRENCY_CODE CURRENCY, 
									IVD.AMOUNT AMOUNT,
									CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN IVD.AMOUNT ELSE IVD.BASE_AMOUNT END AS BASE_AMOUNT, 
									INV.CANCELLED_AMOUNT
									FROM  APPS.MEW_C_AP_INVOICES_ALL_ID_V INV
									JOIN APPS.MEW_C_AP_INVOICE_DISTRIB_ID_V IVD ON INV.INVOICE_ID = IVD.INVOICE_ID AND INV.ORG_ID=222
									LEFT OUTER JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON IVD.DIST_CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
									LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON INV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
									LEFT OUTER JOIN APPS.MEW_C_XLA_DISTRIB_LINKS_ID_V XLD ON IVD.INVOICE_DISTRIBUTION_ID=XLD.SOURCE_DISTRIBUTION_ID_NUM_1
										and XLD.ROUNDING_CLASS_CODE in ('RTAX','AWT','ACCRUAL','FREIGHT','MISCELLANEOUS EXPENSE','IPV','TIPV','NRTAX','EXCHANGE_RATE_VARIANCE','ITEM EXPENSE')
									LEFT OUTER JOIN APPS.MEW_C_XLA_AE_LINES_ID_V XLL ON XLD.AE_HEADER_ID = XLL.AE_HEADER_ID AND XLD.AE_LINE_NUM = XLL.AE_LINE_NUM 
									LEFT OUTER JOIN APPS.MEW_C_GL_JE_LINES_ID_V GLD ON GLD.GL_SL_LINK_ID = XLL.GL_SL_LINK_ID
									LEFT OUTER JOIN APPS.MEW_C_GL_JE_HEADERS_ID_V GL ON GLD.JE_HEADER_ID = GL.JE_HEADER_ID
									left outer join APPS.MEW_C_PO_DISTRIB_ALL_ID_V POD ON IVD.PO_DISTRIBUTION_ID = POD.PO_DISTRIBUTION_ID
									left outer join APPS.MEW_C_PO_HEADERS_ALL_ID_V PO ON PO.PO_HEADER_ID = POD.PO_HEADER_ID
									where GLC.SEGMENT2 is not null AND INV.INVOICE_DATE BETWEEN '$dt' AND '$dt1'
									union all
									SELECT DISTINCT INV.DOC_SEQUENCE_VALUE JV_NO, 
									GL.DOC_SEQUENCE_VALUE GL_NO,
									INV.INVOICE_NUM, 
									INV.INVOICE_DATE,
									INV.GL_DATE,
									null as PO, 
									VEND.SEGMENT1 VENDOR_NUMBER, 
									VEND.VENDOR_NAME,
									VDET.VENDOR_SITE_CODE, 
									INV.DESCRIPTION HEADER, 
									INV.DESCRIPTION, 
									GLC.SEGMENT2 BU, 
									GLC.SEGMENT3 COST_CENTER, 
									GLC.SEGMENT4 ACCOUNT_CODE, 
									GLC.SEGMENT5 AUX, 
									INV.INVOICE_CURRENCY_CODE CURRENCY, 
									INV.INVOICE_AMOUNT AMOUNT,
									CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN INV.INVOICE_AMOUNT ELSE INV.BASE_AMOUNT END AS BASE_AMOUNT, 
									INV.CANCELLED_AMOUNT
									from APPS.MEW_C_AP_INVOICES_ALL_ID_V INV
									join APPS.MEW_C_XLA_DISTRIB_LINKS_ID_V XLD on inv.invoice_id=xld.applied_to_source_id_num_1 and INV.ORG_ID=222
									join APPS.MEW_C_XLA_AE_LINES_ID_V XLL on XLD.AE_HEADER_ID = XLL.AE_HEADER_ID and XLD.AE_LINE_NUM = XLL.AE_LINE_NUM
									   and XLD.ROUNDING_CLASS_CODE = 'LIABILITY'
									join APPS.MEW_C_GL_JE_LINES_ID_V GLD ON gld.gl_sl_link_id = xll.gl_sl_link_id
									join apps.MEW_C_GL_JE_HEADERS_ID_V gl on GLD.JE_HEADER_ID = GL.JE_HEADER_ID and gl.je_source='Payables' and gl.je_category='Purchase Invoices'
									left join APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC on GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
									LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON INV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
									where GLC.SEGMENT2 is not null AND INV.INVOICE_DATE between '$dt' AND '$dt1'
									order by JV_NO, ACCOUNT_CODE");
		return $query->result_array();
	}
	
	public function cash_flow($date)
	{
		echo $dt=$date['date1'];
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		
		$query=$this->orcl->query("SELECT 
								  BEG.ACCOUNT,
								  BEG.AUX,
								  BEG.CURRENCY_CODE CURRENCY,
								  CASE WHEN BEG.CURRENCY_CODE = 'USD' THEN
								  (NVL(BEG.BEG_BAL_BASE,0) + NVL(BACK.BALANCE_BASE,0))
								  ELSE
								  (NVL(BEG.BEG_BAL_FACE,0) + NVL(BACK.BALANCE_FACE,0)) END AS PREV_DAY,
								  NVL(CURR.RECEIPT,0) RECEIPT,
								  NVL(CURR.DISBURSEMENT,0) DISBURSEMENT,
								  CASE WHEN BEG.CURRENCY_CODE = 'USD' THEN
								  ((NVL(BEG.BEG_BAL_BASE,0) + NVL(BACK.BALANCE_BASE,0)) + NVL(CURR.RECEIPT,0) - NVL(CURR.DISBURSEMENT,0))
								  ELSE
								  ((NVL(BEG.BEG_BAL_FACE,0) + NVL(BACK.BALANCE_FACE,0)) + NVL(CURR.RECEIPT,0) - NVL(CURR.DISBURSEMENT,0)) END AS BALANCE,
								  (NVL(BEG.BEG_BAL_BASE,0) + NVL(BACK.BALANCE_BASE,0)) PREV_DAY_BASE,
								  NVL(CURR.RECEIPT_BASE,0) RECEIPT_BASE,
								  NVL(CURR.DISBURSEMENT_BASE,0) DISBURSEMENT_BASE,
								  ((NVL(BEG.BEG_BAL_BASE,0) + NVL(BACK.BALANCE_BASE,0)) + NVL(CURR.RECEIPT_BASE,0) - NVL(CURR.DISBURSEMENT_BASE,0)) BALANCE_BASE
								FROM
								(SELECT      
									 CC.SEGMENT4 ACCOUNT
									 ,CC.SEGMENT5 AUX
									 ,BAL.CURRENCY_CODE
									 ,NVL(SUM(BAL.BEGIN_BALANCE_DR - BAL.BEGIN_BALANCE_CR),0)   BEG_BAL_FACE
									 ,NVL(SUM(BAL.BEGIN_BALANCE_DR_BEQ - BAL.BEGIN_BALANCE_CR_BEQ),0)   BEG_BAL_BASE
								FROM  APPS.MEW_C_GL_CODE_COMBINATION_ID_V CC
								, APPS.MEW_C_GL_BALANCES_ID_V BAL
								WHERE CC.CODE_COMBINATION_ID = BAL.CODE_COMBINATION_ID
								AND   BAL.PERIOD_NAME        = '$dt' 
								AND   CC.SEGMENT2               = 'C11'
								AND   CC.SEGMENT4 IN ('000100','000200','000600','237700')
								GROUP BY
									 CC.SEGMENT4
									 ,CC.SEGMENT5
									 ,BAL.CURRENCY_CODE) BEG
								 LEFT OUTER JOIN
								 (SELECT 
								GCC.SEGMENT4 ACCOUNT,
								GCC.SEGMENT5 AUX,
								GJH.CURRENCY_CODE,
								SUM(NVL(GJL.ENTERED_DR,0)-NVL(GJL.ENTERED_CR,0)) BALANCE_FACE,
								SUM(NVL(GJL.ACCOUNTED_DR,0)-NVL(GJL.ACCOUNTED_CR,0)) BALANCE_BASE
								FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GJH,
								APPS.MEW_C_GL_JE_LINES_ID_V GJL,
								APPS.MEW_C_GL_LEDGERS_ID_V GL,
								APPS.MEW_C_GL_CODE_COMBINATION_ID_V GCC,
								APPS.MEW_C_GL_JE_BATCHES_ID_V GJB
								WHERE GJL.JE_HEADER_ID = GJH.JE_HEADER_ID
								AND GJH.JE_BATCH_ID=GJB.JE_BATCH_ID
								AND GJL.CODE_COMBINATION_ID=GCC.CODE_COMBINATION_ID
								AND GJH.LEDGER_ID=GL.LEDGER_ID
								AND GJH.STATUS='P' 
								AND GJH.ACTUAL_FLAG='A' 
								AND GJH.PERIOD_NAME='$dt' 
								AND GCC.SEGMENT2 = 'C11'
								AND GCC.SEGMENT4 IN ('000100','000200','000600','237700')
								AND GJH.DEFAULT_EFFECTIVE_DATE < '$dt1' 
								GROUP BY 
								GCC.SEGMENT4,
								GCC.SEGMENT5,
								GJH.CURRENCY_CODE) BACK
								ON BACK.ACCOUNT = BEG.ACCOUNT
								AND BACK.AUX = BEG.AUX
								AND BACK.CURRENCY_CODE = BEG.CURRENCY_CODE
								LEFT OUTER JOIN
								(SELECT 
								GCC.SEGMENT4 ACCOUNT,
								GCC.SEGMENT5 AUX,
								GJH.CURRENCY_CODE,
								SUM(NVL(GJL.ENTERED_DR,0))RECEIPT,
								SUM(NVL(GJL.ENTERED_CR,0))DISBURSEMENT,
								SUM(NVL(GJL.ACCOUNTED_DR,0))RECEIPT_BASE,
								SUM(NVL(GJL.ACCOUNTED_CR,0))DISBURSEMENT_BASE
								FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GJH,
								APPS.MEW_C_GL_JE_LINES_ID_V GJL,
								APPS.MEW_C_GL_LEDGERS_ID_V GL,
								APPS.MEW_C_GL_CODE_COMBINATION_ID_V GCC,
								APPS.MEW_C_GL_JE_BATCHES_ID_V GJB
								WHERE GJL.JE_HEADER_ID = GJH.JE_HEADER_ID
								AND GJH.JE_BATCH_ID=GJB.JE_BATCH_ID
								AND GJL.CODE_COMBINATION_ID=GCC.CODE_COMBINATION_ID
								AND GJH.LEDGER_ID=GL.LEDGER_ID
								AND GJH.STATUS='P' 
								AND GJH.ACTUAL_FLAG='A' 
								AND GJH.PERIOD_NAME='$dt' 
								AND GCC.SEGMENT2 = 'C11'
								AND GCC.SEGMENT4 IN ('000100','000200','000600','237700')
								AND GJH.DEFAULT_EFFECTIVE_DATE = '$dt1' 
								GROUP BY 
								GCC.SEGMENT4,
								GCC.SEGMENT5,
								GJH.CURRENCY_CODE) CURR
								ON BEG.ACCOUNT = CURR.ACCOUNT
								AND BEG.AUX = CURR.AUX
								AND BEG.CURRENCY_CODE = CURR.CURRENCY_CODE
								ORDER BY
								  BEG.ACCOUNT,
								  BEG.AUX,
								  BEG.CURRENCY_CODE");
		return $query->result_array();
	}
	public function get_subinv()
	{
		$query = $this->db->query("select subinventory, descr from orc_subinventory");
		return $query->result_array();
	}
	public function get_dj_item($data_dj)
	{
		$date_create=$data_dj['date_create'];
		$from=trim($data_dj['from']);
		$to=trim($data_dj['to']);
		if(!empty($data_dj['dj_name']))
			{
				$dj=$data_dj['dj_name'];
				$query=$this->orcl->query("select A.WIP_ENTITY_NAME,A.GEN_OBJECT_ID,c.SEGMENT1,c.ITEM_TYPE,B.SCHEDULED_START_DATE,B.DATE_RELEASED,B.START_QUANTITY,B.COMPLETION_SUBINVENTORY
                from APPS.MEW_C_WIP_ENTITIES_ID_V A,APPS.MEW_C_WIP_DISCRETE_JOBS_ID_V B,APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V C    
                where A.WIP_ENTITY_ID=B.WIP_ENTITY_ID AND A.PRIMARY_ITEM_ID=C.INVENTORY_ITEM_ID  AND C.ORGANIZATION_ID='222'
				 and B.STATUS_TYPE=3  AND A.WIP_ENTITY_NAME='$dj' ");
				  $data=$query->result();  
				 if(count($data)>0)
				 {	 
					return $query->result(); 
				 }
				 else
					{	
					echo "<script type='text/javascript'>
						alert ('Wrong Parameters');
						 window.location = 'discrete_job'
						</script> ";
					} 
			}
		elseif(!empty($date_create)&&($from )&&($to))
			{
				$query=$this->orcl->query("select A.WIP_ENTITY_NAME,A.GEN_OBJECT_ID,c.SEGMENT1,c.ITEM_TYPE,B.SCHEDULED_START_DATE,B.DATE_RELEASED,B.START_QUANTITY,B.COMPLETION_SUBINVENTORY
                from APPS.MEW_C_WIP_ENTITIES_ID_V A,APPS.MEW_C_WIP_DISCRETE_JOBS_ID_V B,APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V C    
                where A.WIP_ENTITY_ID=B.WIP_ENTITY_ID AND A.PRIMARY_ITEM_ID=C.INVENTORY_ITEM_ID  AND C.ORGANIZATION_ID='222'
				AND to_char(b.SCHEDULED_START_DATE,'YYYY-MM-DD')='$date_create' and B.STATUS_TYPE=3 AND B.COMPLETION_SUBINVENTORY BETWEEN '$from' AND '$to'");
				 $data=$query->result();  
				 if(count($data)>0)
				 {	 
					return $query->result(); 
				 }
				 else
					{	
					echo "<script type='text/javascript'>
						alert ('Wrong Parameters');
						 window.location = 'discrete_job'
						</script> ";
					}
			}
	}
	public function ap_aging($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		$query=$this->orcl->query("	SELECT 
                                    C.SEGMENT1 VENDOR_CODE,
									C.VENDOR_NAME VENDOR,
									B.INVOICE_NUM,
									B.DESCRIPTION,
									B.INVOICE_DATE,
									B.GL_DATE,
									A.DUE_DATE,
									D.SEGMENT4 ACC_CODE,
									D.SEGMENT5 AUX,
									B.INVOICE_CURRENCY_CODE CURR,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE) <= 30) THEN NVL(A.AMOUNT_REMAINING,0)
									ELSE 0 END ) AMOUNT_REMAINING,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE))>30 AND ((SYSDATE) - TRUNC(A.DUE_DATE))<=60  THEN NVL(A.AMOUNT_REMAINING,0)
									ELSE 0 END ) OVERDUE_30,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE))>60 AND ((SYSDATE) - TRUNC(A.DUE_DATE))<=90 THEN NVL(A.AMOUNT_REMAINING,0)
									ELSE 0 END ) OVERDUE_60,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE))>90 AND ((SYSDATE) - TRUNC(A.DUE_DATE))<=120 THEN NVL(A.AMOUNT_REMAINING,0)
									ELSE 0 END ) OVERDUE_90,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE) > 120) THEN NVL(A.AMOUNT_REMAINING,0)
									ELSE 0 END ) OVERDUE_120,
									B.DOC_SEQUENCE_VALUE VOUCHER,
									E.JV, 
									A.INVOICE_ID,
									CASE when (B.INVOICE_AMOUNT-A.AMOUNT_REMAINING)=0 then 
										ROUND(A.AMOUNT_REMAINING*B.EXCHANGE_RATE,2) END AS REV_AMOUNT
									FROM APPS.MEW_C_AP_PAYMENT_SCHED_ID_V A,
									APPS.MEW_C_AP_INVOICES_ALL_ID_V B left JOIN (select GL.DOC_SEQUENCE_VALUE as JV, substr(GL.DESCRIPTION,25,6) as IV,
														GL.JE_HEADER_ID, GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, (SUM(NVL(JD.ENTERED_DR,0))-SUM(NVL(JD.ENTERED_CR,0))) AS DIFF
														from apps.MEW_C_GL_JE_HEADERS_ID_V GL join apps.MEW_C_GL_JE_LINES_ID_V JD on GL.JE_HEADER_ID = JD.JE_HEADER_ID
														JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON JD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
														where gl.description like 'Invoice Voucher Number: %' and GLC.SEGMENT4 in ('220100','227100','230100','230300','237100','237300','237700','243200')
														GROUP BY GL.DOC_SEQUENCE_VALUE, GL.DESCRIPTION, GL.JE_HEADER_ID, GLC.SEGMENT3, GLC.SEGMENT4, GLC.SEGMENT5 ) E 
														on B.DOC_SEQUENCE_VALUE = E.IV and E.DIFF <> 0,
									APPS.MEW_C_AP_SUPPLIERS_ID_V C,
									APPS.MEW_C_GL_CODE_COMBINATION_ID_V D
									WHERE A.INVOICE_ID=B.INVOICE_ID
									AND B.VENDOR_ID=C.VENDOR_ID
									AND B.ACCTS_PAY_CODE_COMBINATION_ID = D.CODE_COMBINATION_ID
									AND A.ORG_ID='222'
									AND B.INVOICE_AMOUNT <> 0
									and A.AMOUNT_REMAINING <> 0
									AND B.CANCELLED_DATE IS NULL
									UNION ALL
									SELECT DISTINCT
									C.SEGMENT1 VENDOR_CODE,
									C.VENDOR_NAME VENDOR,
									B.INVOICE_NUM,
									B.DESCRIPTION,
									B.INVOICE_DATE,
									B.GL_DATE,
									A.DUE_DATE,
									D.SEGMENT4 ACC_CODE,
									D.SEGMENT5 AUX,
									B.INVOICE_CURRENCY_CODE CURR,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE) <= 30) THEN NVL(F.AMOUNT,0)
									ELSE 0 END ) AMOUNT_REMAINING,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE))>30 AND ((SYSDATE) - TRUNC(A.DUE_DATE))<=60  THEN NVL(F.AMOUNT,0)
									ELSE 0 END ) OVERDUE_30,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE))>60 AND ((SYSDATE) - TRUNC(A.DUE_DATE))<=90 THEN NVL(F.AMOUNT,0)
									ELSE 0 END ) OVERDUE_60,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE))>90 AND ((SYSDATE) - TRUNC(A.DUE_DATE))<=120 THEN NVL(F.AMOUNT,0)
									ELSE 0 END ) OVERDUE_90,
									(CASE WHEN((SYSDATE) - TRUNC(A.DUE_DATE) > 120) THEN NVL(F.AMOUNT,0)
									ELSE 0 END ) OVERDUE_120,
									B.DOC_SEQUENCE_VALUE VOUCHER,
									E.JV, 
									A.INVOICE_ID,
									null AS REV_AMOUNT
									FROM APPS.MEW_C_AP_PAYMENT_SCHED_ID_V A,
									APPS.MEW_C_AP_INVOICES_ALL_ID_V B JOIN (select GL.DOC_SEQUENCE_VALUE as JV, substr(GL.DESCRIPTION,25,6) as IV,
														GL.JE_HEADER_ID, GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, (SUM(NVL(JD.ENTERED_DR,0))-SUM(NVL(JD.ENTERED_CR,0))) AS DIFF
														from apps.MEW_C_GL_JE_HEADERS_ID_V GL join apps.MEW_C_GL_JE_LINES_ID_V JD on GL.JE_HEADER_ID = JD.JE_HEADER_ID
														JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON JD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
														where gl.description like 'Invoice Voucher Number: %' and GLC.SEGMENT4 ='057100'
														GROUP BY GL.DOC_SEQUENCE_VALUE, GL.DESCRIPTION, GL.JE_HEADER_ID, GLC.SEGMENT3, GLC.SEGMENT4, GLC.SEGMENT5 ) E 
														on B.DOC_SEQUENCE_VALUE = E.IV and E.DIFF <> 0,
									APPS.MEW_C_AP_SUPPLIERS_ID_V C,
									APPS.MEW_C_GL_CODE_COMBINATION_ID_V D,
                                    apps.MEW_C_AP_INVOICE_DISTRIB_ID_V F
									WHERE A.INVOICE_ID=B.INVOICE_ID
                                    AND B.INVOICE_ID=F.INVOICE_ID
									AND B.VENDOR_ID=C.VENDOR_ID
									AND F.DIST_CODE_COMBINATION_ID = D.CODE_COMBINATION_ID
                                    AND D.SEGMENT4='057100' AND F.LINE_TYPE_LOOKUP_CODE='ITEM'
									AND A.ORG_ID='222'
									AND B.CANCELLED_DATE IS NULL
									ORDER BY VENDOR, DUE_DATE");
		return $query->result_array();
	}
	public function f_journal_ar($date)
	{
		$dt=date('d-M-Y',strtotime($date['date1']));
		$dt1=date('d-M-Y',strtotime($date['date2']));
		$fdate="and ARGL.GL_DATE BETWEEN '$dt' and '$dt1'";
		$arn1=$date['ar_no1'];
		$arn2=$date['ar_no2'];
		$arn_con="and AR.TRX_NUMBER BETWEEN '$arn1' and '$arn2'";
		if($date['date1']=='')
		{
			$fdate='';
		}
		elseif ($date['date2']==''){
			$fdate='';	
		}
		else
		{
			$dt=$date['date1'];
			$dt1=$date['date2'];
		}
		if($date['invoice']=='')
		{
			$inv='%';
		}
		else{
			$inv=$date['invoice'];
		}
		if($date['status']=='p')
		{
			$stat="and GL.STATUS is not null";
		}
		elseif($date['status']=='u')
		{
			$stat="and GL.STATUS is null";
		}
		elseif($date['status']=='a')
		{
			$stat="";
		}
		if($date['ar_no1']=='')
		{
			$arn_con='';
		}
		elseif ($date['ar_no2']==''){
			$arn_con='';	
		}
		else
		{
			$arn1=$date['ar_no1'];
			$arn2=$date['ar_no2'];
		}
		$query=$this->orcl->query("select case when GL.STATUS is null then 'U' else 'P' end as POST, AR.TRX_NUMBER AR_NO, AR.ATTRIBUTE10 INVOICE_NO, BILL_PARTY.PARTY_NAME CUSTOMER,  ARGL.GL_DATE,  
									AR.INVOICE_CURRENCY_CODE CURRENCY, GLC.SEGMENT1 CODE,GLC.SEGMENT2 BU, 
									GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, 
									CASE when ARGL.account_class = 'REC' then case when SUM(ARGL.AMOUNT) >= 0 then SUM(ARGL.AMOUNT) end
										else case when SUM(ARGL.AMOUNT) <= 0 then SUM(ARGL.AMOUNT)*-1 end end as ENTERED_DR, 
									CASE when ARGL.account_class = 'REC' then case when SUM(ARGL.AMOUNT) <= 0 then SUM(ARGL.AMOUNT)*-1 end
										else case when SUM(ARGL.AMOUNT) >= 0 then SUM(ARGL.AMOUNT) end end as ENTERED_CR, 
									CASE when ARGL.account_class = 'REC' then case when SUM(ARGL.ACCTD_AMOUNT) >= 0 then SUM(ARGL.ACCTD_AMOUNT) end
										else case when SUM(ARGL.ACCTD_AMOUNT) <= 0 then SUM(ARGL.ACCTD_AMOUNT)*-1 end end as ACCOUNTED_DR, 
									CASE when ARGL.account_class = 'REC' then case when SUM(ARGL.ACCTD_AMOUNT) <= 0 then SUM(ARGL.ACCTD_AMOUNT)*-1 end
										else case when SUM(ARGL.ACCTD_AMOUNT) >= 0 then SUM(ARGL.ACCTD_AMOUNT) end end as ACCOUNTED_CR
									from apps.MEW_C_RA_TRX_LINE_GL_DIST_ID_V ARGL left JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON ARGL.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									LEFT OUTER JOIN apps.MEW_C_RA_CUST_TRX_LINES_ID_V ARD ON ARD.CUSTOMER_TRX_LINE_ID = ARGL.CUSTOMER_TRX_LINE_ID
									LEFT OUTER JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT ON ARD.INVENTORY_ITEM_ID = PT.INVENTORY_ITEM_ID AND PT.ORGANIZATION_ID='222'
									LEFT OUTER JOIN APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR ON AR.CUSTOMER_TRX_ID = ARGL.CUSTOMER_TRX_ID
									LEFT JOIN APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V CUST ON AR.BILL_TO_CUSTOMER_ID = CUST.CUST_ACCOUNT_ID 
									LEFT JOIN APPS.MEW_C_HZ_PARTIES_ID_V BILL_PARTY ON BILL_PARTY.PARTY_ID  = CUST.PARTY_ID
									left join (select distinct AR.TRX_NUMBER, GL.STATUS from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR left join apps.MEW_C_GL_JE_LINES_ID_V GLD on AR.DOC_SEQUENCE_VALUE = GLD.SUBLEDGER_DOC_SEQUENCE_VALUE left join APPS.MEW_C_GL_JE_HEADERS_ID_V GL on GLD.JE_HEADER_ID = GL.JE_HEADER_ID where GL.JE_SOURCE='Receivables') GL on AR.TRX_NUMBER = GL.TRX_NUMBER
									where ARGL.ORG_ID=222 and ARGL.ACCOUNT_SET_FLAG = 'N' $fdate $stat and AR.ATTRIBUTE10 like '$inv' $arn_con
									GROUP BY GL.STATUS, AR.TRX_NUMBER , AR.ATTRIBUTE10 , BILL_PARTY.PARTY_NAME , ARGL.GL_DATE, 
									GLC.SEGMENT1,GLC.SEGMENT2 , GLC.SEGMENT3 , GLC.SEGMENT4 , GLC.SEGMENT5, ARGL.ACCOUNT_CLASS, AR.INVOICE_CURRENCY_CODE 
									ORDER BY AR_NO, ACCOUNT_CODE, AUX");
		return $query->result_array();
	}
		public function f_journal_ap($date)
	{
		$apn1=$date['ap_no1'];
		$apn2=$date['ap_no2'];
		$apn_con="and INV.DOC_SEQUENCE_VALUE BETWEEN '$apn1' and '$apn2'";
		$jv="and TO_CHAR(trim(SUBSTR(DESCRIPTION,-5,5))) BETWEEN '$apn1' and '$apn2'";
		$dt=date('d-M-Y',strtotime($date['date1']));
		$dt1=date('d-M-Y',strtotime($date['date2']));
		$inv_date="AND INV.GL_DATE BETWEEN '$dt' AND '$dt1'";
		if($date['date1']=='')
		{
			$inv_date='';
		}
		else{
			$dt=$date['date1'];	
		}
		if($date['date2']=='')
		{
			$inv_date='';
		}
		else{
			$dt1=$date['date2'];
		}
		if($date['status']=='p')
		{
			$stat="and GL.STATUS is not null";
			$stat1="and IVD.POSTED_FLAG='Y'";
		}
		elseif($date['status']=='u')
		{
			$stat="and GL.STATUS is null";
			$stat1="and IVD.POSTED_FLAG='N'";
		}
		elseif($date['status']=='a')
		{
			$stat="";
			$stat1="";
		}
		if($date['ap_no1']=='')
		{
			$apn_con='';
			$jv='';
		}
		else{
			$apn1=$date['ap_no1'];	
		}
		if($date['ap_no2']=='')
		{
			$apn_con='';
			$jv='';
		}
		else{
			$apn2=$date['ap_no2'];
		}
		$query=$this->orcl->query("select DISTINCT case when GL.STATUS is null then 'U' else 'P' end as POST,
								INV.DOC_SEQUENCE_VALUE as JV_NO,
								INV.INVOICE_NUM,
								VEND.SEGMENT1 VENDOR_NUMBER, VEND.VENDOR_NAME,
								VDET.VENDOR_SITE_CODE,
								INV.INVOICE_CURRENCY_CODE CURR,
								INV.GL_DATE,
								SCH.DUE_DATE, 
								GLC.SEGMENT6 PARTY_CODE, GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, 
								INV.DESCRIPTION,
								case when INV.INVOICE_AMOUNT<=0 then (INV.INVOICE_AMOUNT*-1) end as ENTERED_DR,
								case when INV.INVOICE_AMOUNT>=0 then INV.INVOICE_AMOUNT end as ENTERED_CR,
								CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN 
									case when INV.INVOICE_AMOUNT<=0 then (INV.INVOICE_AMOUNT*-1) end
								else 
									case when INV.INVOICE_AMOUNT<=0 then (INV.BASE_AMOUNT*-1) end
								end as ACCOUNTED_DR,
								CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN 
									case when INV.INVOICE_AMOUNT>=0 then INV.INVOICE_AMOUNT end
								else 
									case when INV.INVOICE_AMOUNT>=0 then INV.BASE_AMOUNT end
								end as ACCOUNTED_CR
								from APPS.MEW_C_AP_INVOICES_ALL_ID_V INV
								LEFT OUTER JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON INV.ACCTS_PAY_CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID AND INV.ORG_ID=222
								LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
								LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON INV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
								left outer JOIN 
								(select DOC_SEQUENCE_VALUE as JV, REGEXP_SUBSTR(REGEXP_SUBSTR(DESCRIPTION,'Invoice Voucher Number: .*'),'[0-9]+', 1, 1) as IV, JE_HEADER_ID, NAME, DESCRIPTION, 
									JE_CATEGORY, JE_SOURCE, PERIOD_NAME, CURRENCY_CODE, DATE_CREATED, DEFAULT_EFFECTIVE_DATE, CREATED_BY, STATUS 
									from apps.MEW_C_GL_JE_HEADERS_ID_V where je_category='Purchase Invoices' and je_source='Payables' $jv) GL on INV.DOC_SEQUENCE_VALUE = GL.IV
								left outer join APPS.MEW_C_PO_HEADERS_ALL_ID_V PO ON PO.PO_HEADER_ID = INV.PO_HEADER_ID
								left outer join APPS.MEW_C_AP_PAYMENT_SCHED_ID_V SCH on inv.invoice_id = sch.invoice_id
								where GLC.SEGMENT2 is not null $inv_date $stat $apn_con
								UNION ALL
								select case when IVD.POSTED_FLAG = 'Y' then 'P' else 'U' end as POST,
								INV.DOC_SEQUENCE_VALUE as JV_NO,
								INV.INVOICE_NUM,
								VEND.SEGMENT1 VENDOR_NUMBER, VEND.VENDOR_NAME,
								VDET.VENDOR_SITE_CODE,
								INV.INVOICE_CURRENCY_CODE CURR,
								INV.GL_DATE,
								SCH.DUE_DATE, 
								GLC.SEGMENT6 PARTY_CODE, GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, 
								IVD.DESCRIPTION,
								case when SUM(IVD.AMOUNT)>=0 then SUM(IVD.AMOUNT) end as ENTERED_DR,
								case when SUM(IVD.AMOUNT)<=0 then SUM((IVD.AMOUNT*-1)) end as ENTERED_CR,
								CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN 
									case when SUM(IVD.AMOUNT)>=0 then SUM(IVD.AMOUNT) end
								else 
									case when SUM(IVD.AMOUNT)>=0 then SUM(IVD.BASE_AMOUNT) end
								end as ACCOUNTED_DR,
								CASE WHEN INV.INVOICE_CURRENCY_CODE='USD' THEN 
									case when SUM(IVD.AMOUNT)<=0 then SUM(IVD.AMOUNT*-1) end
								else 
									case when SUM(IVD.AMOUNT)<=0 then SUM((IVD.BASE_AMOUNT*-1)) end
								end as ACCOUNTED_CR
								FROM APPS.MEW_C_AP_INVOICE_DISTRIB_ID_V IVD 
								LEFT OUTER JOIN APPS.MEW_C_AP_INVOICES_ALL_ID_V INV ON INV.INVOICE_ID = IVD.INVOICE_ID AND INV.ORG_ID=222
								LEFT OUTER JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON IVD.DIST_CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
								LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
								LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON INV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
								left outer join APPS.MEW_C_AP_PAYMENT_SCHED_ID_V SCH on inv.invoice_id = sch.invoice_id
								where GLC.SEGMENT2 is not null $inv_date $stat1 $apn_con
								group by IVD.POSTED_FLAG, INV.DOC_SEQUENCE_VALUE, INV.INVOICE_NUM,VEND.SEGMENT1,VEND.VENDOR_NAME,VDET.VENDOR_SITE_CODE,INV.INVOICE_CURRENCY_CODE,
								INV.GL_DATE, SCH.DUE_DATE, GLC.SEGMENT6, GLC.SEGMENT3, GLC.SEGMENT4, GLC.SEGMENT5, IVD.DESCRIPTION
								order by POST, JV_NO, ACCOUNT_CODE, AUX");
		return $query->result_array();
	}
	public function f_gl_journal($date)
	{
		ini_set('memory_limit', '-1');
		$bu=$date['bu'];
		$dt=date('d-M-Y',strtotime($date['date1']));
		$dt1=date('d-M-Y',strtotime($date['date2']));
		
		$accode=$date['account1'];
		$accode1=$date['account2'];
		
		$glno=$date['glno1'];
		$glno1=$date['glno2'];
		
		$bu=$date['bu'];
		if($bu=='182'){
			$bu_cond="where GLC.SEGMENT2 ='B01'";
			$bu_org="WHERE INV.ORG_ID=182";	
		}
		else {
			$bu_cond="where GLC.SEGMENT2 ='C11'";
			$bu_org="WHERE INV.ORG_ID=222";
			
		}
		
		$gl_date="AND gl.default_effective_date BETWEEN '$dt' AND '$dt1'";
		if($date['date1']=='')
		{
			$gl_date='';
		}
		else{
			$dt=$date['date1'];	
		}
		if($date['date2']=='')
		{
			$gl_date='';
		}
		else{
			$dt1=$date['date2'];
		}
		
		$acc_code="and GLC.SEGMENT4 between '$accode' and '$accode1'";
		if ($date['account1']=='')
		{
			$acc_code='';
		}
		else 
		{
			$accode=$date['account1'];
		}
		if($date['account2']=='')
		{
			$acc_code='';
		}
		else{
			$accode1=$date['account2'];
		}
		
		$gl_no="and GL.DOC_SEQUENCE_VALUE between '$glno' and '$glno1'";
		if($date['glno1']=='')
		{
			$gl_no='';
		}
		else{
			$glno=$date['glno1'];	
		}
		if($date['glno2']=='')
		{
			$gl_no='';
		}
		else{
			$glno1=$date['glno2'];
		}
			
		$query=$this->orcl->query("SELECT GLC.SEGMENT2 BU, GL.JE_SOURCE, GL.JE_CATEGORY, GL.PERIOD_NAME, GL.DEFAULT_EFFECTIVE_DATE GL_DATE, GL.DOC_SEQUENCE_VALUE GL_NO, GL.NAME, GL.DESCRIPTION HEADER, GL.CURRENCY_CODE, 
									GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, GLD.DESCRIPTION, GLD.ENTERED_DR, GLD.ENTERED_CR, GLD.ACCOUNTED_DR, GLD.ACCOUNTED_CR,
									GL.STATUS, GL.CREATED_BY, GL.DATE_CREATED, GLD.LAST_UPDATE_DATE
									,NULL as JV_NO, NULL as INVOICE_NO, NULL as BUSINESS_PARTNER
									FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GL 
									LEFT JOIN APPS.MEW_C_GL_JE_LINES_ID_V GLD ON GLD.JE_HEADER_ID = GL.JE_HEADER_ID
									LEFT JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									$bu_cond AND GL.JE_CATEGORY NOT IN ('Purchase Invoices','Sales Invoices') 
									$gl_date $acc_code $gl_no
									UNION ALL
									SELECT GLC.SEGMENT2 BU, GL.JE_SOURCE, GL.JE_CATEGORY, GL.PERIOD_NAME, GL.DEFAULT_EFFECTIVE_DATE GL_DATE, GL.DOC_SEQUENCE_VALUE GL_NO, GL.NAME, GL.DESCRIPTION HEADER, GL.CURRENCY_CODE, 
									GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, GLD.DESCRIPTION, 
									XLD.UNROUNDED_ENTERED_DR ENTERED_DR, XLD.UNROUNDED_ENTERED_CR ENTERED_CR, XLD.UNROUNDED_ACCOUNTED_DR ACCOUNTED_DR, XLD.UNROUNDED_ACCOUNTED_CR ACCOUNTED_CR, 
									GL.STATUS, GL.CREATED_BY, GL.DATE_CREATED, GLD.LAST_UPDATE_DATE
									,TO_CHAR(INV.DOC_SEQUENCE_VALUE) JV_NO, INV.INVOICE_NUM INVOICE_NO, VEND.VENDOR_NAME BUSINESS_PARTNER
									FROM APPS.MEW_C_AP_INVOICES_ALL_ID_V INV
									JOIN APPS.MEW_C_XLA_DISTRIB_LINKS_ID_V XLD ON INV.INVOICE_ID=XLD.APPLIED_TO_SOURCE_ID_NUM_1
									JOIN APPS.MEW_C_XLA_AE_LINES_ID_V XLL ON XLD.AE_HEADER_ID = XLL.AE_HEADER_ID AND XLD.AE_LINE_NUM = XLL.AE_LINE_NUM
									   AND XLD.ROUNDING_CLASS_CODE = 'LIABILITY'
									JOIN APPS.MEW_C_GL_JE_LINES_ID_V GLD ON GLD.GL_SL_LINK_ID = XLL.GL_SL_LINK_ID
									JOIN APPS.MEW_C_GL_JE_HEADERS_ID_V GL ON GLD.JE_HEADER_ID = GL.JE_HEADER_ID AND GL.JE_SOURCE='Payables' AND GL.JE_CATEGORY='Purchase Invoices'
									LEFT JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
									$bu_org $gl_date $acc_code $gl_no
									UNION ALL
									SELECT GLC.SEGMENT2 BU, GL.JE_SOURCE, GL.JE_CATEGORY, GL.PERIOD_NAME, GL.DEFAULT_EFFECTIVE_DATE GL_DATE, GL.DOC_SEQUENCE_VALUE GL_NO, GL.NAME, GL.DESCRIPTION HEADER, GL.CURRENCY_CODE, 
									GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, IVD.DESCRIPTION,
									XLD.UNROUNDED_ENTERED_DR ENTERED_DR, XLD.UNROUNDED_ENTERED_CR ENTERED_CR, XLD.UNROUNDED_ACCOUNTED_DR ACCOUNTED_DR, XLD.UNROUNDED_ACCOUNTED_CR ACCOUNTED_CR, 
									GL.STATUS, GL.CREATED_BY, GL.DATE_CREATED, GLD.LAST_UPDATE_DATE
									,TO_CHAR(INV.DOC_SEQUENCE_VALUE) JV_NO, INV.INVOICE_NUM INVOICE_NO, VEND.VENDOR_NAME BUSINESS_PARTNER
									FROM APPS.MEW_C_AP_INVOICES_ALL_ID_V INV  
									JOIN APPS.MEW_C_AP_INVOICE_DISTRIB_ID_V IVD ON INV.INVOICE_ID = IVD.INVOICE_ID
									JOIN APPS.MEW_C_XLA_DISTRIB_LINKS_ID_V XLD ON IVD.INVOICE_DISTRIBUTION_ID=XLD.SOURCE_DISTRIBUTION_ID_NUM_1 AND XLD.ROUNDING_CLASS_CODE IN ('RTAX','AWT','ACCRUAL','FREIGHT','MISCELLANEOUS EXPENSE','IPV','TIPV','NRTAX','EXCHANGE_RATE_VARIANCE','ITEM EXPENSE')
									JOIN APPS.MEW_C_XLA_AE_LINES_ID_V XLL ON XLD.AE_HEADER_ID = XLL.AE_HEADER_ID AND XLD.AE_LINE_NUM = XLL.AE_LINE_NUM 
									JOIN APPS.MEW_C_GL_JE_LINES_ID_V GLD ON GLD.GL_SL_LINK_ID = XLL.GL_SL_LINK_ID
									JOIN APPS.MEW_C_GL_JE_HEADERS_ID_V GL ON GLD.JE_HEADER_ID = GL.JE_HEADER_ID AND GL.JE_SOURCE='Payables' AND GL.JE_CATEGORY='Purchase Invoices'
									LEFT JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
									$bu_org $gl_date $acc_code $gl_no
									UNION ALL
									SELECT GLC.SEGMENT2 BU, GL.JE_SOURCE, GL.JE_CATEGORY, GL.PERIOD_NAME, GL.DEFAULT_EFFECTIVE_DATE GL_DATE, GL.DOC_SEQUENCE_VALUE GL_NO, GL.NAME, GL.DESCRIPTION HEADER, GL.CURRENCY_CODE, 
									GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, GLD.DESCRIPTION, 
									GLD.ENTERED_DR, GLD.ENTERED_CR, GLD.ACCOUNTED_DR, GLD.ACCOUNTED_CR,
									GL.STATUS, GL.CREATED_BY, GL.DATE_CREATED, GLD.LAST_UPDATE_DATE
									,AR.TRX_NUMBER JV_NO, AR.ATTRIBUTE10 INVOICE_NO, BILL_PARTY.PARTY_NAME BUSINESS_PARTNER
									FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GL LEFT OUTER JOIN APPS.MEW_C_GL_JE_LINES_ID_V GLD ON GLD.JE_HEADER_ID = GL.JE_HEADER_ID 
									LEFT JOIN APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR ON AR.DOC_SEQUENCE_VALUE = GLD.SUBLEDGER_DOC_SEQUENCE_VALUE
									LEFT JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									LEFT JOIN APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V CUST ON AR.BILL_TO_CUSTOMER_ID = CUST.CUST_ACCOUNT_ID 
									LEFT JOIN APPS.MEW_C_HZ_PARTIES_ID_V BILL_PARTY ON BILL_PARTY.PARTY_ID  = CUST.PARTY_ID
									$bu_cond AND GL.JE_SOURCE='Receivables' AND GL.JE_CATEGORY='Sales Invoices'
									$gl_date $acc_code $gl_no
									ORDER BY GL_NO, ACCOUNT_CODE");
		return $query->result_array();
	}
	public function f_adv_pay($date)
	{
		echo $dt=date('d-M-Y',strtotime($date['date1']));
		echo $dt1=date('d-M-Y',strtotime($date['date2']));
		$query=$this->orcl->query("SELECT 
									C.SEGMENT1 VENDOR_CODE,
									C.VENDOR_NAME VENDOR,
									B.DESCRIPTION,
									D.SEGMENT4 ACC_CODE,
									B.INVOICE_CURRENCY_CODE CURR,
									A.DUE_DATE,
									B.INVOICE_AMOUNT AMOUNT,
									A.AMOUNT_REMAINING,
									B.INVOICE_NUM,
									B.INVOICE_DATE,
									B.DOC_SEQUENCE_VALUE VOUCHER,
									E.JV
									FROM APPS.MEW_C_AP_PAYMENT_SCHED_ID_V A 
										left outer join apps.MEW_C_AP_INVOICE_PAYMENTS_ID_V F on A.INVOICE_ID=F.INVOICE_ID AND F.ORG_ID=222 and F.REVERSAL_FLAG='N',
									APPS.MEW_C_AP_INVOICES_ALL_ID_V B left JOIN (select GL.DOC_SEQUENCE_VALUE as JV, substr(GL.DESCRIPTION,25,6) as IV,
														GL.JE_HEADER_ID, GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, (SUM(NVL(JD.ENTERED_DR,0))-SUM(NVL(JD.ENTERED_CR,0))) AS DIFF
														from apps.MEW_C_GL_JE_HEADERS_ID_V GL join apps.MEW_C_GL_JE_LINES_ID_V JD on GL.JE_HEADER_ID = JD.JE_HEADER_ID
														JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON JD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
														where gl.description like 'Invoice Voucher Number: %' and GLC.SEGMENT4 in ('220100','227100','230100','230300','237100','237300','237700','243200')
														GROUP BY GL.DOC_SEQUENCE_VALUE, GL.DESCRIPTION, GL.JE_HEADER_ID, GLC.SEGMENT3, GLC.SEGMENT4, GLC.SEGMENT5 ) E 
														on B.DOC_SEQUENCE_VALUE = E.IV and E.DIFF <> 0,
									APPS.MEW_C_AP_SUPPLIERS_ID_V C,
									APPS.MEW_C_GL_CODE_COMBINATION_ID_V D
									WHERE A.INVOICE_ID=B.INVOICE_ID
									AND B.VENDOR_ID=C.VENDOR_ID
									AND B.ACCTS_PAY_CODE_COMBINATION_ID = D.CODE_COMBINATION_ID
									AND A.ORG_ID='222'
									AND B.INVOICE_AMOUNT <> 0
									AND A.AMOUNT_REMAINING <> 0
									AND B.CANCELLED_DATE IS NULL
									UNION ALL
									select 
									null as VENDOR_CODE,
									null as VENDOR,
									GL.NAME as DESCRIPTION,
									GLC.SEGMENT4 ACC_CODE,
									GL.CURRENCY_CODE CURR,
									null as DUE_DATE,
									case when GLD.ENTERED_DR is null then GLD.ENTERED_CR else (GLD.ENTERED_DR*-1) end as AMOUNT,
									case when GLD.ENTERED_DR is null then GLD.ENTERED_CR else (GLD.ENTERED_DR*-1) end as AMOUNT_REMAINING,
									GLD.DESCRIPTION as INVOICE_NUM,
									null as INVOICE_DATE,
									null as VOUCHER,
									GL.DOC_SEQUENCE_VALUE
									from apps.MEW_C_GL_JE_HEADERS_ID_V gl join apps.MEW_C_GL_JE_LINES_ID_V gld on GLD.JE_HEADER_ID = GL.JE_HEADER_ID
									join APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC on GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									where gl.default_effective_date BETWEEN '$dt' and '$dt1' and GLC.SEGMENT2 = 'C11'
									and gl.je_source in ('Manual','21','AutoCopy') and gl.je_category in ('Other','Accrual','Adjustment')
									and GLC.SEGMENT4 in ('220100','227100','230100','230300','237100','237300','237700','243200')--('230300','237300','220100','227100','230100','237100')
									ORDER BY VENDOR, DUE_DATE");
		return $query->result_array();
	}
	public function f_dncn($date)
	{
		$no_dncn = $date['dncn_nomor'];

			$query=$this->orcl->query("select AR.TRX_NUMBER,AR.BILL_TO_CUSTOMER_ID,
							AR.BILL_TO_SITE_USE_ID,
							BILL_PARTY.PARTY_NAME BILL_TO,
							CUST.ACCOUNT_NUMBER,
							LOC.ADDRESS1,
							LOC.ADDRESS2,
							LOC.ADDRESS3,
							LOC.ADDRESS4,
							LOC.CITY ||' '||
							LOC.POSTAL_CODE ||' '||
							LOC.STATE ||' '||
							LOC.PROVINCE ||' '|| LOC.COUNTY ADDRESS5,
							AR.CREATION_DATE,
							PAY.DUE_DATE,
							ARGL.GL_DATE,
							AR.INVOICE_CURRENCY_CODE CURRENCY,
							ARD.DESCRIPTION,
							
							SUM(ARD.EXTENDED_AMOUNT) AS EXTENDED_AMOUNT
							from apps.MEW_C_RA_CUST_TRX_ALL_ID_V AR inner join
							apps.MEW_C_RA_CUST_TRX_LINES_ID_V ARD ON AR.CUSTOMER_TRX_ID = ARD.CUSTOMER_TRX_ID
							LEFT JOIN APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V CUST ON AR.BILL_TO_CUSTOMER_ID = CUST.CUST_ACCOUNT_ID 
							LEFT JOIN APPS.MEW_C_HZ_PARTIES_ID_V BILL_PARTY ON BILL_PARTY.PARTY_ID  = CUST.PARTY_ID
							LEFT JOIN APPS.MEW_C_HZ_CUST_SITE_USES_ID_V SITE ON AR.BILL_TO_SITE_USE_ID = SITE.SITE_USE_ID
							LEFT JOIN apps.MEW_C_HZ_CUST_ACCT_SITES_ID_V ACCT_SITE ON ACCT_SITE.cust_acct_site_id=SITE.cust_acct_site_id
							LEFT JOIN apps.MEW_C_HZ_PARTY_SITES_ID_V PARTY_SITE on PARTY_SITE.party_site_id    =ACCT_SITE.party_site_id
							LEFT JOIN APPS.MEW_C_HZ_LOCATIONS_ID_V LOC ON LOC.LOCATION_ID = PARTY_SITE.LOCATION_ID
							LEFT JOIN apps.MEW_C_AR_PAYMENT_SCHE_ID_V PAY ON AR.TRX_NUMBER = PAY.TRX_NUMBER
							LEFT JOIN (select distinct CUSTOMER_TRX_ID, GL_DATE from apps.MEW_C_RA_TRX_LINE_GL_DIST_ID_V) ARGL ON AR.CUSTOMER_TRX_ID=ARGL.CUSTOMER_TRX_ID
							where AR.INTERFACE_HEADER_ATTRIBUTE1 in ('DEBIT NOTE','CREDIT NOTE')
							and AR.ATTRIBUTE_CATEGORY=222
							and ARD.LINE_TYPE='LINE'
							AND AR.TRX_NUMBER LIKE '$no_dncn'
							GROUP BY 	
																AR.TRX_NUMBER,  
							BILL_PARTY.PARTY_NAME,
							CUST.ACCOUNT_NUMBER,
							LOC.ADDRESS1,
							LOC.ADDRESS2,
							LOC.ADDRESS3,
							LOC.ADDRESS4,
							LOC.CITY,
							LOC.POSTAL_CODE,
							LOC.STATE,
							LOC.PROVINCE,
							LOC.COUNTY,
							AR.CREATION_DATE,
							PAY.DUE_DATE,
							AR.INVOICE_CURRENCY_CODE,
							AR.BILL_TO_CUSTOMER_ID,
							AR.BILL_TO_SITE_USE_ID,
							ARD.DESCRIPTION,
							ARGL.GL_DATE ORDER BY ARD.DESCRIPTION");
		return $query->result_array();
	}
	public function f_voucher_gl($date)
	{
		ini_set('memory_limit', '-1');
		$gln1=$date['gl_no1'];
		$gln2=$date['gl_no2'];
		$gln_con="and GL.DOC_SEQUENCE_VALUE BETWEEN $gln1 and $gln2";
		$dt=date('d-M-Y',strtotime($date['date1']));
		$dt1=date('d-M-Y',strtotime($date['date2']));
		$gl_date="AND gl.default_effective_date BETWEEN '$dt' AND '$dt1'";
		if($date['date1']=='')
		{
			$gl_date='';
		}
		else{
			$dt=$date['date1'];	
		}
		if($date['date2']=='')
		{
			$gl_date='';
		}
		else
		{
			$dt1=$date['date2'];
		}
		if($date['status']=='p')
		{
			$stat="and GL.STATUS = 'P'";
		}
		elseif($date['status']=='u')
		{
			$stat="and GL.STATUS = 'U'";
		}
		elseif($date['status']=='a')
		{
			$stat='';
		}
		if($date['gl_no1']=='')
		{
			$gln_con='';
		}
		else{
			$gln1=$date['gl_no1'];	
		}
		if($date['gl_no2']=='')
		{
			$gln_con='';
		}
		else{
			$gln2=$date['gl_no2'];
		}
		$query=$this->orcl->query("select GL.CURRENCY_CODE, GL.JE_SOURCE, GL.JE_CATEGORY, GL.PERIOD_NAME, GL.DEFAULT_EFFECTIVE_DATE GL_DATE, GLB.NAME BATCH, GL.NAME, GL.DOC_SEQUENCE_VALUE GL_NO, GLD.JE_LINE_NUM,   
									GLC.SEGMENT1 COMPANY_CODE, GLC.SEGMENT3 COST_CENTER, GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, GLC.SEGMENT6 PARTY_CODE,  
									GLD.ENTERED_DR, GLD.ENTERED_CR, GLD.ACCOUNTED_DR, GLD.ACCOUNTED_CR,
									GL.CURRENCY_CONVERSION_RATE RATE, GL.CURRENCY_CONVERSION_TYPE RATE_TYPE, GL.CURRENCY_CONVERSION_DATE RATE_DATE,
									GL.DESCRIPTION HEADER, GL.STATUS, GLD.DESCRIPTION, GL.CREATED_BY, GL.DATE_CREATED, gld.last_update_date
									from apps.MEW_C_GL_JE_HEADERS_ID_V gl 
									left join apps.MEW_C_GL_JE_LINES_ID_V gld on GLD.JE_HEADER_ID = GL.JE_HEADER_ID
                                    left join apps.MEW_C_GL_JE_BATCHES_ID_V glb on glb.je_batch_id = GL.JE_BATCH_ID
									left join APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC on GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									where GLC.SEGMENT2 = 'C11' $gln_con $gl_date $stat
									order by GL_NO, JE_LINE_NUM");
		return $query->result_array();
	}
	
	public function f_grn($date)
	{
		$dt=date('d-M-Y',strtotime($date['date1']));
		$dt1=date('d-M-Y',strtotime($date['date2']));
		$rec1=$date['grn_1'];
		$rec2=$date['grn_2'];
		$vend=$date['vendor'];
		if($date['date1']==''){
			$cond1='';
		}
		else if($date['date2']==''){
			$cond1='';
		}
		else if($date['vendor']==''){
			$cond1='';
		}
		else {
			$cond1=" and RCV.TRANSACTION_DATE BETWEEN '$dt' AND '$dt1' and VEND.VENDOR_NAME like '$vend'";
		}
		if ($date['packing_slip']=='')
		{
			$cond2='';
		}
		else
		{
			$pack_slip=$date['packing_slip'];
			$cond2=" and RCVH.PACKING_SLIP like '$pack_slip'";
		}
		if ($date['po_numb']=='')
		{
			$cond3='';
		}
		else
		{
			$po_number=$date['po_numb'];
			$cond3=" and PO.SEGMENT1 like '$po_number'";
		}
		if($date['grn_1']==''){
			$cond4='';
		}
		else if($date['grn_2']==''){
			$cond4='';
		}
		else {
			$cond4=" and RCVH.RECEIPT_NUM BETWEEN $rec1 AND $rec2";
		}
		
		$query=$this->orcl->query("select RCVH.PACKING_SLIP, 
									RCV.SUBINVENTORY, 
									RCV.CURRENCY_CODE,
									VEND.VENDOR_NAME,
									VDET.VENDOR_SITE_CODE,
									RCVH.RECEIPT_NUM RCV_NUM,
									RCV.TRANSACTION_DATE,
									PO.SEGMENT1 PO,
									PT.SEGMENT1 ITEM,
									PT.DESCRIPTION,
									POD.QUANTITY QTY_PO,
									CASE WHEN RCV.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR') THEN (RCV.QUANTITY*-1)
										ELSE RCV.QUANTITY END AS QTY_RCV,
									  RCV.UNIT_OF_MEASURE RCV_UOM,
									  POD.UNIT_PRICE PRICE,
									  (POD.UNIT_PRICE*(CASE WHEN RCV.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR') THEN (RCV.QUANTITY*-1)
										ELSE RCV.QUANTITY END)) AS AMOUNT,
									RCVH.EMPLOYEE_ID
									from  (SELECT * FROM APPS.MEW_C_RCV_TRANSACTIONS_ID_V where transaction_type in ('DELIVER','RETURN TO RECEIVING')) RCV
										LEFT OUTER JOIN APPS.MEW_C_RCV_SHIPMENT_HEADER_ID_V RCVH ON RCV.SHIPMENT_HEADER_ID = RCVH.SHIPMENT_HEADER_ID
										LEFT OUTER JOIN APPS.MEW_C_PO_HEADERS_ALL_ID_V PO ON RCV.ORGANIZATION_ID = PO.ORG_ID AND RCV.PO_HEADER_ID = PO.PO_HEADER_ID
										LEFT OUTER JOIN APPS.MEW_C_PO_LINES_ALL_ID_V POD ON PO.PO_HEADER_ID = POD.PO_HEADER_ID AND RCV.PO_LINE_ID = POD.PO_LINE_ID
										LEFT OUTER JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT ON POD.ORG_ID = PT.ORGANIZATION_ID AND POD.ITEM_ID = PT.INVENTORY_ITEM_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON RCV.VENDOR_ID = VEND.VENDOR_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON RCV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
									where RCV.ORGANIZATION_ID='222' $cond1 $cond2 $cond3 $cond4
									order by SUBINVENTORY, TRANSACTION_DATE");
		return $query->result_array();
	}
	public function f_grn_sum_qty($date)
	{
		$dt=date('d-M-Y',strtotime($date['date1']));
		$dt1=date('d-M-Y',strtotime($date['date2']));
		$rec1=$date['grn_1'];
		$rec2=$date['grn_2'];
		$vend=$date['vendor'];
		
		if($date['date1']==''){
			$cond1='';
		}
		else if($date['date2']==''){
			$cond1='';
		}
		else if($date['vendor']==''){
			$cond1='';
		}
		else {
			$cond1=" and RCV.TRANSACTION_DATE BETWEEN '$dt' AND '$dt1' and VEND.VENDOR_NAME like '$vend'";
		}
		if ($date['packing_slip']=='')
		{
			$cond2='';
		}
		else
		{
			$pack_slip=$date['packing_slip'];
			$cond2=" and RCVH.PACKING_SLIP like '$pack_slip'";
		}
		if ($date['po_numb']=='')
		{
			$cond3='';
		}
		else
		{
			$po_number=$date['po_numb'];
			$cond3=" and PO.SEGMENT1 like '$po_number'";
		}
		if($date['grn_1']==''){
			$cond4='';
		}
		else if($date['grn_2']==''){
			$cond4='';
		}
		else {
			$cond4=" and RCVH.RECEIPT_NUM BETWEEN $rec1 AND $rec2";
		}
		$query=$this->orcl->query("select CASE WHEN RCV.TRANSACTION_TYPE IN ('RETURN TO RECEIVING','RETURN TO VENDOR') THEN (SUM(RCV.QUANTITY)*-1)
									ELSE SUM(RCV.QUANTITY) END AS QTY_RCV,
									RCV.UNIT_OF_MEASURE RCV_UOM,
									RCV.SUBINVENTORY,
									RCVH.EMPLOYEE_ID
									from  (SELECT * FROM APPS.MEW_C_RCV_TRANSACTIONS_ID_V WHERE parent_transaction_id <> -1) RCV
										LEFT OUTER JOIN APPS.MEW_C_RCV_SHIPMENT_HEADER_ID_V RCVH ON RCV.SHIPMENT_HEADER_ID = RCVH.SHIPMENT_HEADER_ID
										LEFT OUTER JOIN APPS.MEW_C_PO_HEADERS_ALL_ID_V PO ON RCV.ORGANIZATION_ID = PO.ORG_ID AND RCV.PO_HEADER_ID = PO.PO_HEADER_ID
										LEFT OUTER JOIN APPS.MEW_C_PO_LINES_ALL_ID_V POD ON PO.PO_HEADER_ID = POD.PO_HEADER_ID AND RCV.PO_LINE_ID = POD.PO_LINE_ID
										LEFT OUTER JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT ON POD.ORG_ID = PT.ORGANIZATION_ID AND POD.ITEM_ID = PT.INVENTORY_ITEM_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON RCV.VENDOR_ID = VEND.VENDOR_ID
										LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON RCV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID
									where RCV.ORGANIZATION_ID='222' $cond1 $cond2 $cond3 $cond4
									group by RCV.TRANSACTION_TYPE, RCV.UNIT_OF_MEASURE, RCV.SUBINVENTORY, RCVH.EMPLOYEE_ID
									order by RCV.SUBINVENTORY");
		return $query->result_array();
	}
	public function f_po_print($date)
	{
		$dt = $date['date1'];
		$dt1 = $date['date2'];

		$query=$this->orcl->query("select PO.SEGMENT1 PO_NUM,
									vdet.ADDRESS_LINE1 SUPPLIER,
									vdet.ADDRESS_LINE2 ADDRESS1,
									vdet.ADDRESS_LINE3 ADDRESS2,
									vdet.ADDRESS_LINE4 ADDRESS3,
									PO.CURRENCY_CODE,
									LOC.NEED_BY_DATE,
									case 
										when LOC.PROMISED_DATE IS NULL then  (LOC.NEED_BY_DATE-PT.FULL_LEAD_TIME)
										else LOC.PROMISED_DATE
										end as PROMISED_DATE,
									PO.REVISION_NUM,
									POD.LINE_NUM,
									PT.SEGMENT1 ITEM_NUMBER,
									POD.ITEM_DESCRIPTION,
									POD.UNIT_MEAS_LOOKUP_CODE UOM,
									POD.UNIT_PRICE,
									POD.QUANTITY,
									PO.AGENT_ID BUYER,
									PO.SHIP_VIA_LOOKUP_CODE,
									PO.FREIGHT_TERMS_LOOKUP_CODE,
									TO_CHAR(TO_DATE(PO.CREATION_DATE,'DD-MON-YY'),'DD-MM-YYYY') CREATION_DATE,
									PO.TERMS_ID,
									cst.ITEM_COST,
									PO.COMMENTS
									from APPS.MEW_C_PO_HEADERS_ALL_ID_V PO 
									left outer join apps.MEW_C_PO_LINES_ALL_ID_V pod on po.po_header_id=pod.po_header_id
									left outer join (select po_header_id,PO_LINE_ID,NEED_BY_DATE,PROMISED_DATE from apps.MEW_C_PO_LINE_LOC_ALL_ID_V
                                    group by po_header_id,PO_LINE_ID,NEED_BY_DATE,PROMISED_DATE ) LOC on po.po_header_id=loc.po_header_id and POD.PO_LINE_ID=LOC.PO_LINE_ID
									left outer join apps.MEW_C_AP_SUPPLIERS_ID_V vend on po.vendor_id = VEND.VENDOR_ID
									left outer join apps.MEW_C_AP_SUPPLIER_SITES_ID_V vdet on PO.VENDOR_SITE_ID=vdet.VENDOR_SITE_ID
									left outer JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT ON POD.ORG_ID = PT.ORGANIZATION_ID AND POD.ITEM_ID = PT.INVENTORY_ITEM_ID
									LEFT JOIN (select * from APPS.MEW_C_CST_ITEM_COSTS_ID_V where ORGANIZATION_ID IN(222) AND COST_TYPE_ID='1') cst ON PT.INVENTORY_ITEM_ID = cst.INVENTORY_ITEM_ID
									LEFT JOIN (select  PO_LINE_ID,QUANTITY_CANCELLED from APPS.MEW_C_PO_DISTRIB_ALL_ID_V group by PO_LINE_ID,QUANTITY_CANCELLED) po_dist ON pod.PO_LINE_ID=po_dist.PO_LINE_ID
									where po.org_id IN(222) AND PO.AUTHORIZATION_STATUS='APPROVED' and po_dist.QUANTITY_CANCELLED=0   and
                                	po.segment1 between '$dt' and '$dt1' and 
									PO.TYPE_LOOKUP_CODE='STANDARD'
									ORDER BY PO.SEGMENT1, POD.LINE_NUM");
		return $query->result_array();
	}
	public function f_soa_print($date,$st)
	{
		if($date['date1']=='')
		{
			$dt='%';
		}
		else{
			$dt = $date['date1'];
		}
		
		$query=$this->orcl->query("select AR.TRX_NUMBER AR_NO,
									AR.ATTRIBUTE10 INVOICE_NO, 
									BILL_PARTY.PARTY_NAME BILL_TO,
									CUST.ACCOUNT_NUMBER,
									BILL_PARTY.ADDRESS1,
									BILL_PARTY.ADDRESS2,
									BILL_PARTY.ADDRESS3,
									BILL_PARTY.ADDRESS4,
                                    LOC.ADDRESS1 SHIP_TO,
									case when NDLV.ATTRIBUTE4 is null then TO_CHAR(TO_DATE(AR.CREATION_DATE,'DD-MON-YY'),'MM/DD/YYYY')
											else
											TO_CHAR(SUBSTR(NDLV.ATTRIBUTE4,6,2)||'/'||SUBSTR(NDLV.ATTRIBUTE4,9,2)||'/'||SUBSTR(NDLV.ATTRIBUTE4,1,4)) end as INVOICE_DATE,
									PAY.DUE_DATE,
									AR.INVOICE_CURRENCY_CODE CURRENCY,
									(CASE WHEN((SYSDATE) - TRUNC(PAY.DUE_DATE) <= 30.9) THEN NVL(PAY.AMOUNT_DUE_REMAINING,0)
									ELSE 0 END ) AMOUNT_REMAINING,
									(CASE WHEN((SYSDATE) - TRUNC(PAY.DUE_DATE) BETWEEN 31 AND 60) THEN NVL(PAY.AMOUNT_DUE_REMAINING,0)
									ELSE 0 END ) OVERDUE_30,
									(CASE WHEN((SYSDATE) - TRUNC(PAY.DUE_DATE) BETWEEN 61 AND 90) THEN NVL(PAY.AMOUNT_DUE_REMAINING,0)
									ELSE 0 END ) OVERDUE_60,
									(CASE WHEN((SYSDATE) - TRUNC(PAY.DUE_DATE) >90) THEN NVL(PAY.AMOUNT_DUE_REMAINING,0)
									ELSE 0 END ) OVERDUE_90
									from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR
									LEFT JOIN APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V CUST ON AR.BILL_TO_CUSTOMER_ID = CUST.CUST_ACCOUNT_ID 
									LEFT JOIN APPS.MEW_C_HZ_PARTIES_ID_V BILL_PARTY ON BILL_PARTY.PARTY_ID  = CUST.PARTY_ID
                                    left outer join APPS.MEW_C_HZ_CUST_SITE_USES_ID_V SITE on AR.SHIP_TO_SITE_USE_ID = SITE.SITE_USE_ID
                                    left outer join APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V CUST_ACCT on SITE.CUST_ACCT_SITE_ID = CUST_ACCT.CUST_ACCT_SITE_ID
                                    left outer join APPS.MEW_C_HZ_PARTY_SITES_ID_V P_SITE on CUST_ACCT.PARTY_SITE_ID = P_SITE.PARTY_SITE_ID
                                    left outer join APPS.MEW_C_HZ_LOCATIONS_ID_V LOC on P_SITE.LOCATION_ID = LOC.LOCATION_ID
									LEFT JOIN apps.MEW_C_AR_PAYMENT_SCHE_ID_V PAY ON AR.TRX_NUMBER = PAY.TRX_NUMBER
									LEFT JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V NDLV ON AR.CT_REFERENCE = TO_CHAR(NDLV.DELIVERY_ID)
									WHERE 
									AR.ATTRIBUTE_CATEGORY='$st[site]' AND PAY.AMOUNT_DUE_REMAINING <> 0 and PAY.ORG_ID='$st[site]' and
									BILL_PARTY.PARTY_NAME like '$dt'   
									order by AR.INVOICE_CURRENCY_CODE");
									/*and (to_char(AR.TRX_DATE,'mm-YYYY')!=to_char(sysdate, 'mm-YYYY'))*/
		return $query->result_array();
	}
	public function selection_cust_aging($data)
	{
		$query=$this->orcl->query("select distinct BILL_PARTY.PARTY_NAME BILL_TO
									from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V AR
									LEFT JOIN APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V CUST ON AR.BILL_TO_CUSTOMER_ID = CUST.CUST_ACCOUNT_ID 
									LEFT JOIN APPS.MEW_C_HZ_PARTIES_ID_V BILL_PARTY ON BILL_PARTY.PARTY_ID  = CUST.PARTY_ID
									LEFT JOIN apps.MEW_C_AR_PAYMENT_SCHE_ID_V PAY ON AR.TRX_NUMBER = PAY.TRX_NUMBER
									LEFT JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V NDLV ON AR.CT_REFERENCE = TO_CHAR(NDLV.DELIVERY_ID)
									WHERE 
									AR.ATTRIBUTE_CATEGORY='$data[site]' AND PAY.AMOUNT_DUE_REMAINING <> 0");
		return $query->result();
	}
	public function f_journal_pay($date)
	{
		$dt = $date['date1'];
		$dt1 = $date['date2'];
		$gl_date = "and GL.DEFAULT_EFFECTIVE_DATE BETWEEN '$dt' AND '$dt1'";
		$apn1=$date['ap_no1'];
		$apn2=$date['ap_no2'];
		$apn_con="and REGEXP_SUBSTR(GL.DESCRIPTION,'[0-9]+', 1, 2) between '$apn1' and '$apn2'";
		if($date['date1']=='')
		{
			$gl_date='';
		}
		else{
			$dt=$date['date1'];	
		}
		if($date['date2']=='')
		{
			$gl_date='';
		}
		else{
			$dt1=$date['date2'];
		}
		if($date['ap_no1']=='')
		{
			$apn_con='';
		}
		else{
			$apn1=$date['ap_no1'];	
		}
		if($date['ap_no2']=='')
		{
			$apn_con='';
		}
		else{
			$apn2=$date['ap_no2'];
		}
		
		$query=$this->orcl->query("SELECT REGEXP_SUBSTR(GL.DESCRIPTION,'[0-9]+', 1, 2) VOUCHER, 
									REGEXP_SUBSTR(GL.DESCRIPTION,'[0-9]+', 1, 3) DOC_NUM,
									GL.JE_CATEGORY, GL.JE_SOURCE, GL.PERIOD_NAME, GL.DOC_SEQUENCE_VALUE GL_NO, GL.NAME, 
									PAID.VENDOR_NUMBER, PAID.VENDOR_NAME, PAID.VENDOR_SITE_CODE,
									GL.DESCRIPTION HEADER, GL.CURRENCY_CODE, GL.STATUS, GL.DATE_CREATED, GL.DEFAULT_EFFECTIVE_DATE,
									GLC.SEGMENT4 ACCOUNT_CODE, GLC.SEGMENT5 AUX, GLD.DESCRIPTION, 
									case when GLD.ENTERED_DR is null then 0 else GLD.ENTERED_DR end as ENTERED_DR,
									case when GLD.ENTERED_CR is null then 0 else GLD.ENTERED_CR end as ENTERED_CR,
									case when GLD.ACCOUNTED_DR is null then 0 else GLD.ACCOUNTED_DR end as ACCOUNTED_DR,
									case when GLD.ACCOUNTED_CR is null then 0 else GLD.ACCOUNTED_CR end as ACCOUNTED_CR
									FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GL 
									JOIN APPS.MEW_C_GL_JE_LINES_ID_V GLD ON GLD.JE_HEADER_ID = GL.JE_HEADER_ID
									LEFT OUTER JOIN APPS.MEW_C_GL_CODE_COMBINATION_ID_V GLC ON GLD.CODE_COMBINATION_ID = GLC.CODE_COMBINATION_ID
									left outer join (select distinct pay.accounting_event_id, VEND.SEGMENT1 VENDOR_NUMBER, VEND.VENDOR_NAME, VDET.VENDOR_SITE_CODE
													from apps.MEW_C_AP_INVOICE_PAYMENTS_ID_V pay
													join apps.MEW_C_AP_INVOICES_ALL_ID_V inv on pay.invoice_id=inv.invoice_id and INV.ORG_ID IN (222,182)
													LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIERS_ID_V VEND ON INV.VENDOR_ID = VEND.VENDOR_ID
													LEFT OUTER JOIN APPS.MEW_C_AP_SUPPLIER_SITES_ID_V VDET ON INV.VENDOR_SITE_ID = VDET.VENDOR_SITE_ID) PAID on GLD.REFERENCE_6 = PAID.ACCOUNTING_EVENT_ID
									WHERE GL.JE_CATEGORY ='Payments' AND GL.JE_SOURCE='Payables' and GLC.SEGMENT2 IN('C11','B01')
									$gl_date $apn_con
									ORDER BY VOUCHER, GL_NO, ACCOUNT_CODE");
		return $query->result_array();
	}
	public function save_tb_base($data){
	$this->db->insert('orc_tb',$data);
	}
public function delete_tb_base()
	{
		$this->db->query("delete from orc_tb");
	}
public function f_tb_base($date)
	{
		$period=$date['period'];
		if ($period == ''){
			echo "<script type='text/javascript'>alert('Please fill period!')</script>";
		}
		else {
		$bu=$date['bu'];
		$curr=$date['curr'];
		if ($curr=='STAT'){
			$query=$this->orcl->query("SELECT      
										 CC.SEGMENT3 cost_center
										 ,CC.SEGMENT4 account
										 ,CC.SEGMENT5 aux
										 ,NVL(SUM(BAL.BEGIN_BALANCE_DR - BAL.BEGIN_BALANCE_CR),0) as beg_bal
										 ,NVL(GL.BALANCE_BASE,0) as activity
										 ,NVL(SUM(BAL.BEGIN_BALANCE_DR - BAL.BEGIN_BALANCE_CR),0)+NVL(GL.BALANCE_BASE,0) as end_bal
									FROM  APPS.MEW_C_GL_CODE_COMBINATION_ID_V CC
									INNER JOIN APPS.MEW_C_GL_BALANCES_ID_V BAL
									ON CC.CODE_COMBINATION_ID = BAL.CODE_COMBINATION_ID
									AND   BAL.PERIOD_NAME        = '$period'
									AND   SEGMENT2               = '$bu'
									left outer join
									(SELECT 
									GCC.SEGMENT3 CC,  
									GCC.SEGMENT4 ACCOUNT,
									GCC.SEGMENT5 AUX,
									GJH.CURRENCY_CODE CURR,
									SUM(NVL(GJL.ACCOUNTED_DR,0)-NVL(GJL.ACCOUNTED_CR,0))BALANCE_BASE
									FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GJH,
									APPS.MEW_C_GL_JE_LINES_ID_V GJL,
									APPS.MEW_C_GL_LEDGERS_ID_V GL,
									APPS.MEW_C_GL_CODE_COMBINATION_ID_V GCC,
									APPS.MEW_C_GL_JE_BATCHES_ID_V GJB
									WHERE GJL.JE_HEADER_ID = GJH.JE_HEADER_ID
									AND GJH.JE_BATCH_ID=GJB.JE_BATCH_ID
									AND GJL.CODE_COMBINATION_ID=GCC.CODE_COMBINATION_ID
									AND GJH.LEDGER_ID=GL.LEDGER_ID
									AND GJH.STATUS='P' 
									AND GJH.ACTUAL_FLAG='A' 
									AND GJH.PERIOD_NAME='$period'
									AND GCC.SEGMENT2 = '$bu' 
									AND GJH.CURRENCY_CODE='STAT'
									GROUP BY 
									GCC.SEGMENT3,
									GCC.SEGMENT4,
									GCC.SEGMENT5
									,GJH.CURRENCY_CODE
									ORDER BY
									GCC.SEGMENT3,
									GCC.SEGMENT4,
									GCC.SEGMENT5 ASC) GL ON
									GL.CC = CC.SEGMENT3
									AND GL.ACCOUNT = CC.SEGMENT4
									AND GL.AUX = CC.SEGMENT5
									AND GL.CURR = BAL.CURRENCY_CODE
									where BAL.CURRENCY_CODE in ('STAT')
									GROUP BY
										CC.SEGMENT3
										 ,CC.SEGMENT4
										 ,CC.SEGMENT5
										 ,GL.BALANCE_BASE
									ORDER BY account, cost_center, aux");
		}
		else {
			
			$query=$this->orcl->query("SELECT      
									CC.SEGMENT3 cost_center
									,CC.SEGMENT4 account
									,CC.SEGMENT5 aux
									,NVL(SUM(BAL.BEGIN_BALANCE_DR_BEQ - BAL.BEGIN_BALANCE_CR_BEQ),0)   as beg_bal
									,NVL(GL.BALANCE_BASE,0) as activity
									,NVL(SUM(BAL.BEGIN_BALANCE_DR_BEQ - BAL.BEGIN_BALANCE_CR_BEQ),0)+NVL(GL.BALANCE_BASE,0) as end_bal
									FROM  APPS.MEW_C_GL_CODE_COMBINATION_ID_V CC
									INNER JOIN APPS.MEW_C_GL_BALANCES_ID_V BAL
									ON CC.CODE_COMBINATION_ID = BAL.CODE_COMBINATION_ID
									AND   BAL.PERIOD_NAME        = '$period'
									AND   SEGMENT2               = '$bu'
									left outer join
									(SELECT 
									GCC.SEGMENT3 CC,  
									GCC.SEGMENT4 ACCOUNT,
									GCC.SEGMENT5 AUX,
									SUM(NVL(GJL.ACCOUNTED_DR,0)-NVL(GJL.ACCOUNTED_CR,0))BALANCE_BASE
									FROM APPS.MEW_C_GL_JE_HEADERS_ID_V GJH,
									APPS.MEW_C_GL_JE_LINES_ID_V GJL,
									APPS.MEW_C_GL_LEDGERS_ID_V GL,
									APPS.MEW_C_GL_CODE_COMBINATION_ID_V GCC,
									APPS.MEW_C_GL_JE_BATCHES_ID_V GJB
									WHERE GJL.JE_HEADER_ID = GJH.JE_HEADER_ID
									AND GJH.JE_BATCH_ID=GJB.JE_BATCH_ID
									AND GJL.CODE_COMBINATION_ID=GCC.CODE_COMBINATION_ID
									AND GJH.LEDGER_ID=GL.LEDGER_ID
									AND GJH.STATUS='P' 
									AND GJH.ACTUAL_FLAG='A' 
									AND GJH.PERIOD_NAME='$period'
									AND GCC.SEGMENT2 = '$bu' 
									AND GJH.CURRENCY_CODE not in ('STAT')
									GROUP BY 
									GCC.SEGMENT3,
									GCC.SEGMENT4,
									GCC.SEGMENT5
									ORDER BY
									GCC.SEGMENT4,
									GCC.SEGMENT3,
									GCC.SEGMENT5 ASC) GL ON
									GL.CC = CC.SEGMENT3
									AND GL.ACCOUNT = CC.SEGMENT4
									AND GL.AUX = CC.SEGMENT5
									where BAL.CURRENCY_CODE not in ('STAT')
									GROUP BY
									CC.SEGMENT3
									,CC.SEGMENT4
									,CC.SEGMENT5
									,GL.BALANCE_BASE
									ORDER BY account, cost_center, aux");
		}
		return $query->result_array();
	}
	}
	public function get_rj_note($rj)
	{
		if ($rj['po']==''){
			$po_n='%';
		}else
		{
		   $po_n=$rj['po'];
		}	
		$rj_n=$rj['rj_numb'];
		
	$query=$this->orcl->query("select rcv.TRANSACTION_ID,rcv.TRANSACTION_DATE,rcv.TRANSACTION_TYPE, 
					  vend.VENDOR_NAME,vdet.VENDOR_SITE_CODE,po_head.SEGMENT1,po_line.LINE_NUM,mstr.SEGMENT1 as ITEM_CODE,po_line.ITEM_DESCRIPTION,
					  po_line.UNIT_PRICE ,mstr.ITEM_TYPE,mstr.PRIMARY_UNIT_OF_MEASURE,po_head.CURRENCY_CODE,rcv.PRIMARY_QUANTITY,
					  case when rcv.TRANSACTION_TYPE = 'RETURN TO VENDOR' then (rcv.QUANTITY*-1)
					  when rcv.TRANSACTION_TYPE = 'RETURN TO RECEIVING' then (rcv.QUANTITY*-1)
						else rcv.QUANTITY end as QTY_RCV,B.PACKING_SLIP
					  from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head
					  LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
					  LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID LEFT JOIN 
					  APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V mstr ON 	mstr.INVENTORY_ITEM_ID=po_line.ITEM_ID	LEFT JOIN APPS.MEW_C_RCV_TRANSACTIONS_ID_V  rcv ON po_head.PO_HEADER_ID=rcv.PO_HEADER_ID 
					  LEFT JOIN APPS.MEW_C_RCV_SHIPMENT_HEADER_ID_V B ON rcv.shipment_header_id = B.shipment_header_id, apps.MEW_C_AP_SUPPLIERS_ID_V vend,apps.MEW_C_AP_SUPPLIER_SITES_ID_V vdet, APPS.MEW_C_PO_LINE_LOC_ALL_ID_V po_loc  where rcv.VENDOR_ID = vend.VENDOR_ID 	 and rcv.VENDOR_SITE_ID = vdet.VENDOR_SITE_ID and  po_line.PO_LINE_ID=po_loc.PO_LINE_ID and  po_line.PO_LINE_ID=rcv.PO_LINE_ID AND mstr.ORGANIZATION_ID=222 
					  and po_head.org_id=222  and rcv.USER_ENTERED_FLAG='Y' and rcv.TRANSACTION_TYPE = 'RETURN TO VENDOR'   and (to_char(rcv.TRANSACTION_DATE,'mm-YYYY'))=to_char(sysdate, 'mm-YYYY') and rcv.TRANSACTION_ID IN($rj_n) 
					  and   po_head.SEGMENT1 like '$po_n'
					  order by rcv.TRANSACTION_DATE DESC");
	return $query->result(); 
	}
public function consumption_report($date)
	{
		$p=$date['p'];
		$bu=$date['bu'];
		$query=$this->orcl->query("select t.*
		,mgc.consumption_account           Consumption_Account
		,mgc.consumption_aux               Consumption_AUX
		from (
		SELECT t.organization_Id                 organization_id
			,t.inventory_item_Id               inventory_item_id
			,t.period                          period
			,t.segment1                        Company_Code
			,t.segment2                        Account_Unit
			,t.segment3                        Cost_Center
			,t.segment4                        Item_Account
			,t.segment5                        Item_AUX
			,t.segment7                        Inv_Code
			,t.item_Number                     Item_Number
			,MAX(t.last_mov_ave_price)         Average_Price_start
			,MAX(t.last_standard_price)        Standard_Price_start
			,SUM(decode(NVL(si.attribute6,'N'),'N',last_end_qty,0))                 BeginningQty_
			,ROUND(SUM(decode(NVL(si.attribute6,'N'),'N',last_end_bal,0)),2)        BeginningAmountSTAT
			,SUM(seg1_qty)                     Purchasing_Qty  
			,SUM(round(seg1_amt,2))            PurchasingAmount
			,SUM(seg3_qty)                     Incoming_Qty  
			,SUM(round(seg3_amt,2))            Incoming_Amount  
			,SUM(seg8_qty)                     Outgoing_Qty_  
			,SUM(round(seg8_amt,2))            Outgoing_Amount  
			,MAX(t.cur_mov_ave_price)          AveragePriceend
			,MAX(t.cur_standard_price)         StandardPriceend
			,SUM(decode(NVL(si.attribute6,'N'),'N',end_qty,0))             Ending_Qty
			,ROUND(SUM(decode(NVL(si.attribute6,'N'),'N',end_bal,0)),2)             EndingAmountSTAT
			,(
				SUM(decode(NVL(si.attribute6,'N'),'N',last_end_qty,0))
				+ SUM(seg1_qty)
				+ SUM(seg2_qty)
				+ SUM(seg3_qty)
				+ SUM(seg4_qty)
				+ SUM(seg5_qty)
				+ SUM(seg6_qty)
				+ SUM(seg7_qty)
				+ SUM(seg8_qty)
		--         + SUM(seg9_qty)
		--         - SUM(end_qty)
				- ROUND(SUM(decode(NVL(si.attribute6,'N'),'N',end_qty,0)),2)
			)                                 ConsumptionQty
			,(
				ROUND(SUM(decode(NVL(si.attribute6,'N'),'N',last_end_bal,0)),2)
				+ SUM(round(seg1_amt,2))
				+ SUM(round(seg2_amt,2))
				+ SUM(round(seg3_amt,2))
				+ SUM(round(seg4_amt,2))
				+ SUM(round(seg5_amt,2))
				+ SUM(round(seg6_amt,2))
				+ SUM(round(seg7_amt,2))
				+ SUM(round(seg8_amt,2))
				- ROUND(SUM(decode(NVL(si.attribute6,'N'),'N',end_bal,0)),2)
			)                                 ConsumptionAmount
			,od.organization_name legal_entity
			,o.organization_code organization_code
		FROM 
		(
		SELECT organization_id
			,period
			,subinventory_code
			,inventory_item_id
			,item_number
			,segment1
			,segment2
			,segment3
			,segment4
			,segment5
			,segment7  
			,last_end_bal
			,seg1_amt
			,seg2_amt
			,seg3_amt
			,seg4_amt
			,seg5_amt
			,seg6_amt
			,seg7_amt
			,seg8_amt
			,seg9_amt
			,end_bal
			,last_end_qty
			,seg1_qty
			,seg2_qty
			,seg3_qty
			,seg4_qty
			,seg5_qty
			,seg6_qty
			,seg7_qty
			,seg8_qty
			,seg9_qty
			,end_qty
			,cur_mov_ave_price
			,cur_standard_price
			,last_mov_ave_price
			,last_standard_price
			,journal_flag
		FROM
		(
				SELECT base.organization_id
					,base.gl_period                                  period
					,base.subinventory_code
					,base.inventory_item_id
					,base.item_number
					,gcc.segment1
					,gcc.segment2
					,base.segment3
					,base.segment4
					,base.segment5
					,base.segment7   
					,SUM(NVL(lstq.mn_end_inv_quantity,0) * NVL(lmiv.cur_mov_ave_price,0))     last_end_bal
					,0 seg1_amt
					,0 seg2_amt
					,0 seg3_amt
					,0 seg4_amt
					,0 seg5_amt
					,0 seg6_amt
					,0 seg7_amt
					,0 seg8_amt
					,0 seg9_amt

					,SUM(NVL(tstq.mn_end_inv_quantity,0) * NVL(tstq.actual_price,0))     end_bal    
					,SUM(NVL(lstq.mn_end_inv_quantity,0))         last_end_qty
					,0 seg1_qty
					,0 seg2_qty
					,0 seg3_qty
					,0 seg4_qty
					,0 seg5_qty
					,0 seg6_qty
					,0 seg7_qty
					,0 seg8_qty
					,0 seg9_qty

					,SUM(NVL(tstq.mn_end_inv_quantity,0))   end_qty
					,NVL(lmiv.cur_mov_ave_price,0)          last_mov_ave_price
					,NVL(lmiv.standard_price,0)             last_standard_price
					,NVL(tmiv.cur_mov_ave_price,0)          cur_mov_ave_price
					,NVL(tmiv.standard_price,0)             cur_standard_price
					,'0'                                    journal_flag
				FROM
					(SELECT DISTINCT
							organization_id
							,gl_period
							,segment3
							,subinventory_code
							,item_number
							,segment4
							,segment7 
							,segment5
							,inventory_item_id
					FROM  (SELECT DISTINCT
									organization_id
									,gl_period
									,segment3
									,subinventory_code
									,item_number
									,segment4
									,segment5
									,segment7
									,inventory_item_id
							FROM   apps.MEW_INV_ACCOUNT_TBL_ID_V 
							WHERE  NVL(primary_quantity,0)       != 0
							OR     NVL(base_transaction_value,0) != 0
							UNION
							SELECT DISTINCT
									organization_id
									,appli_yr_mn
									,department_code
									,subinventory_code
									,item_number
									,account
									,aux
									,inventory_code 
									,inventory_item_id
							FROM   apps.MEW_IV_STKQTY_ID_V 
							WHERE  NVL(mn_end_inv_quantity,0) != 0
							UNION
							SELECT DISTINCT
									organization_id
									,TO_CHAR(ADD_MONTHS(TO_DATE('01-'||appli_yr_mn,'DD-Mon-RR'),1),'Mon-RR')
									,department_code
									,subinventory_code
									,item_number
									,account
									,aux
									,inventory_code 
									,inventory_item_id
							FROM   apps.MEW_IV_STKQTY_ID_V 
							WHERE  NVL(mn_end_inv_quantity,0)!=0
							)
					)                       base
					,apps.MEW_IV_STKQTY_ID_V          tstq
					,apps.MEW_IV_STKQTY_ID_V          lstq
					,apps.MEW_IV_MOVAVEPRICE_ID_V     tmiv
					,apps.MEW_IV_MOVAVEPRICE_ID_V     lmiv
					,apps.MEW_C_MTL_PARAMETERS_ID_V    mp
					,apps.MEW_C_GL_CODE_COMBINATION_ID_V   gcc
				WHERE  base.organization_id    = tstq.organization_id    (+)
				AND    base.segment3           = tstq.department_code    (+)
				AND    base.subinventory_code  = tstq.subinventory_code  (+)
				AND    base.item_number        = tstq.item_number        (+)
				AND    base.segment4           = tstq.account            (+)
				AND    base.segment5           = tstq.aux                (+)
				AND    base.segment7           = tstq.inventory_code     (+) 
				AND    base.gl_period          = tstq.appli_yr_mn        (+)
				AND    base.organization_id    = lstq.organization_id    (+)
				AND    base.segment3           = lstq.department_code    (+)
				AND    base.subinventory_code  = lstq.subinventory_code  (+)
				AND    base.item_number        = lstq.item_number        (+)
				AND    base.segment4           = lstq.account            (+)
				AND    base.segment5           = lstq.aux                (+)
				AND    base.segment7           = lstq.inventory_code     (+)  
				AND    to_char(ADD_MONTHS(TO_DATE('01-'||base.gl_period ,'DD-Mon-RR'),-1),'Mon-RR') = lstq.appli_yr_mn(+)
				AND    base.organization_id       = tmiv.organization_id
				AND    base.gl_period             = tmiv.appli_yr_mn
				AND    base.inventory_item_id     = tmiv.inventory_item_id
				AND    lstq.organization_id+0     = lmiv.organization_id  (+)
				AND    lstq.appli_yr_mn           = lmiv.appli_yr_mn      (+)
				AND    lstq.inventory_item_id+0   = lmiv.inventory_item_id(+)
				AND    mp.organization_id         = base.organization_id
				AND    gcc.code_combination_id    = mp.material_account
				GROUP BY
					base.organization_id
					,base.gl_period
					,base.subinventory_code
					,base.inventory_item_id
					,base.item_number
					,gcc.segment1
					,gcc.segment2
					,base.segment3
					,base.segment4
					,base.segment5
					,base.segment7   
					,lmiv.cur_mov_ave_price
					,lmiv.standard_price
					,tmiv.cur_mov_ave_price
					,tmiv.standard_price
			)
			UNION ALL
			(
		SELECT NVL(miat.organization_id,decode(miat.segment1 || miat.segment2,'26B01',182,'26C11',222,0))    organization_id
					,miat.gl_period                                              period
					,miat.subinventory_code                                      subinventory_code
					,NVL(miat.inventory_item_id,0)                                      inventory_item_id
					,NVL(miat.item_number,'Manual')                                 item_number
					,miat.segment1                                               segment1
					,miat.segment2                                               segment2
					,miat.segment3                                               segment3
					,miat.segment4                                               segment4
					,miat.segment5                                               segment5
					,miat.segment7                                               segment7 
					,0 last_end_bal
					,SUM(DECODE(miat.segment8,'1',miat.base_transaction_value,0))   seg1_amt
					,SUM(DECODE(miat.segment8,'2',miat.base_transaction_value,0))   seg2_amt
					,SUM(DECODE(miat.segment8,'3',miat.base_transaction_value,0))   seg3_amt
					,SUM(DECODE(miat.segment8,'4',miat.base_transaction_value,0))   seg4_amt
					,SUM(DECODE(miat.segment8,'5',miat.base_transaction_value,0))   seg5_amt
					,SUM(DECODE(miat.segment8,'6',miat.base_transaction_value,0))   seg6_amt
					,SUM(DECODE(miat.segment8,'7',miat.base_transaction_value,0))   seg7_amt
					,SUM(DECODE(miat.segment8,'8',miat.base_transaction_value,0))   seg8_amt
					,SUM(DECODE(miat.segment8,'9',miat.base_transaction_value,0))   seg9_amt
					,0 end_bal
					,0 last_end_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'1',miat.primary_quantity,0)))         seg1_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'2',miat.primary_quantity,0)))         seg2_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'3',miat.primary_quantity,0)))         seg3_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'4',miat.primary_quantity,0)))         seg4_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'5',miat.primary_quantity,0)))         seg5_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'6',miat.primary_quantity,0)))         seg6_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'7',miat.primary_quantity,0)))         seg7_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'8',miat.primary_quantity,0)))         seg8_qty
					,SUM(DECODE(msi.item_type,'OP',0,DECODE(miat.segment8,'9',miat.primary_quantity,0)))         seg9_qty
					,0 end_qty
					,0 cur_mov_ave_price
					,0 cur_standard_price
					,0 last_mov_ave_price
					,0 last_standard_price
					,NVL(miat.attribute3,'1') journal_flag
				FROM   apps.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V  msi 
					,apps.MEW_INV_ACCOUNT_TBL_ID_V miat 
				WHERE  msi.inventory_item_id(+)=miat.inventory_item_id
				AND    msi.organization_id(+)  =miat.organization_id
				AND    ( miat.attribute3 = '1' or ( miat.attribute3 = '3' and miat.attribute2 in ( 'C','G') )) 
				GROUP BY
					NVL(miat.organization_id,decode(miat.segment1 || miat.segment2,'26B01',182,'26C11',222,0))
					,miat.gl_period
					,miat.subinventory_code
					,NVL(miat.inventory_item_id,0)
					,NVL(miat.item_number,'Manual')
					,miat.segment1
					,miat.segment2
					,miat.segment3
					,miat.segment4
					,miat.segment5
					,miat.segment7
					,NVL(miat.attribute3,'1')
			)
			)    t
			,apps.MEW_C_MTL_PARAMETERS_ID_V     o 
			,apps.MEW_C_MTL_PARAMETERS_ID_V     m 
			,apps.MEW_C_ORG_DEFINITIONS_ID_V    od 
			,apps.MEW_C_MTL_SEC_INVENTORIES_ID_V   si 
		WHERE    o.organization_id   = t.organization_id
		AND    m.organization_id   = o.master_organization_id
		AND    od.organization_id  = m.organization_id
		AND    t.organization_id = si.organization_id (+)  
		AND    t.subinventory_code = si.secondary_inventory_name (+)
		and   t.organization_id = '$bu'                 
		and   t.period = '$p'                     
		GROUP BY
			t.organization_Id
			,t.inventory_item_Id
			,t.period
			,t.segment1
			,t.segment2
			,t.segment3
			,t.segment4
			,t.segment5
			,t.segment7 
			,t.item_Number
			,od.organization_name
			,o.organization_code
		) t
		,apps.MEW_GL_CONSUMPTION_ID_V           mgc 
		where  t.Item_Account = mgc.inventory_account(+)
		AND    t.Item_AUX = mgc.inventory_aux(+)
		AND    mgc.set_of_books_id(+)      = 2061");
return $query->result_array();							
}
public function f_po_print_sub($po)
	{
		$query=$this->orcl->query("select PO.SEGMENT1 PO_NUM,
		vdet.ADDRESS_LINE1 SUPPLIER,
		vdet.ADDRESS_LINE2 ADDRESS1,
		vdet.ADDRESS_LINE3 ADDRESS2,
		vdet.ADDRESS_LINE4 ADDRESS3,
		PO.CURRENCY_CODE,
		LOC.NEED_BY_DATE,
		LOC.PROMISED_DATE,
		PO.REVISION_NUM,
		POD.LINE_NUM,
		PT.SEGMENT1 ITEM_NUMBER,
		POD.ITEM_DESCRIPTION,
		POD.UNIT_MEAS_LOOKUP_CODE UOM,
		cst.ITEM_COST,
		POD.UNIT_PRICE,
		POD.QUANTITY,
		PO.AGENT_ID BUYER,
		PO.SHIP_VIA_LOOKUP_CODE,
		PO.FREIGHT_TERMS_LOOKUP_CODE,
		TO_CHAR(TO_DATE(PO.CREATION_DATE,'DD-MON-YY'),'DD-MM-YYYY') CREATION_DATE,
		PO.TERMS_ID,
		PO.COMMENTS
		from APPS.MEW_C_PO_HEADERS_ALL_ID_V PO 
		left outer join apps.MEW_C_PO_LINES_ALL_ID_V pod on po.po_header_id=pod.po_header_id
		left outer join apps.MEW_C_PO_LINE_LOC_ALL_ID_V LOC on po.po_header_id=loc.po_header_id and POD.PO_LINE_ID=LOC.PO_LINE_ID
		left outer join apps.MEW_C_AP_SUPPLIERS_ID_V vend on po.vendor_id = VEND.VENDOR_ID
		left outer join apps.MEW_C_AP_SUPPLIER_SITES_ID_V vdet on PO.VENDOR_SITE_ID=vdet.VENDOR_SITE_ID
		left outer JOIN APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V PT ON POD.ORG_ID = PT.ORGANIZATION_ID AND POD.ITEM_ID = PT.INVENTORY_ITEM_ID
											LEFT JOIN (select * from APPS.MEW_C_CST_ITEM_COSTS_ID_V where ORGANIZATION_ID=222 AND COST_TYPE_ID='1') cst ON PT.INVENTORY_ITEM_ID = cst.INVENTORY_ITEM_ID
		where po.org_id=222 AND PO.AUTHORIZATION_STATUS='APPROVED' and PT.ORGANIZATION_ID=222 and
		po.segment1 in$po and
		PO.TYPE_LOOKUP_CODE='STANDARD'
		ORDER BY PO.SEGMENT1, POD.LINE_NUM");
		return $query->result_array();

	}
	public function subcon_header($po)
	{
		$query=$this->orcl->query("select vdet.ADDRESS_LINE1 SUPPLIER,vdet.ADDRESS_LINE2 ADDRESS1,	vdet.ADDRESS_LINE3 ADDRESS2,po_head.SEGMENT1 PO_NUMBER,wip.WIP_ENTITY_NAME DJ,to_char(po_line.creation_date,'dd-mm-YYYY')  PO_CREATION,
								   po_line.LINE_NUM PO_LINE,mstr.SEGMENT1 as ITEM_CODE,itm.item,po_line.ITEM_DESCRIPTION,po_dist.QUANTITY_ORDERED,dj.START_QUANTITY DJ_QTY,
								   po_line.UNIT_PRICE ,mstr.ITEM_TYPE,mstr.PRIMARY_UNIT_OF_MEASURE UOM,po_head.CURRENCY_CODE CURR
                                  from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head 
								  LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
								  LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID LEFT JOIN 
								  APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V mstr ON 	mstr.INVENTORY_ITEM_ID=po_line.ITEM_ID left JOIN APPS.MEW_C_WIP_DISCRETE_JOBS_ID_V dj ON po_dist.WIP_ENTITY_ID=dj.WIP_ENTITY_ID
                                  LEFT JOIN  APPS.MEW_C_WIP_ENTITIES_ID_V wip ON dj.WIP_ENTITY_ID=wip.WIP_ENTITY_ID left JOIN (select SEGMENT1 item,ITEM_TYPE type,INVENTORY_ITEM_ID FROM APPS.MEW_C_MTL_SYSTEM_ITEMS_B_ID_V where ORGANIZATION_ID='222' ) itm ON
                                  dj.PRIMARY_ITEM_ID=itm.INVENTORY_ITEM_ID,apps.MEW_C_AP_SUPPLIER_SITES_ID_V vdet
								  where 
								   mstr.ORGANIZATION_ID='222' and po_head.org_id='222' and   dj.STATUS_TYPE !=7 and
                                    po_head.VENDOR_SITE_ID=vdet.VENDOR_SITE_ID and mstr.ITEM_TYPE='OP'
                                 and po_head.SEGMENT1='$po'");
		return $query->result_array();
	}
	
	public function adv()
	{
		$query = $this->db->query("select * from ORC_ADV_PAY where status=0");
		return $query->result_array();	
	}

	public function e_app()
	{
					$query=$this->db->query("select top 12* FROM OPENQUERY(ORAC, 'select po_head.SEGMENT1,vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.CREATION_DATE,
					SUM(po_dist.QUANTITY_ORDERED*po_line.UNIT_PRICE) Total, po_head.CURRENCY_CODE,po_head.AGENT_ID
														from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head 
														LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
														LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID  left JOIN apps.MEW_C_AP_SUPPLIERS_ID_V vend  ON po_head.VENDOR_ID=vend.VENDOR_ID
																					 where    
														po_head.org_id=222  and po_head.TYPE_LOOKUP_CODE=''STANDARD''   and po_head.CREATION_DATE >''2020-APR-17''       and  po_head.AUTHORIZATION_STATUS=''APPROVED''   
														GROUP BY   vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.SEGMENT1,po_head.CREATION_DATE, po_head.CURRENCY_CODE,po_head.AGENT_ID') where SEGMENT1 NOT IN(select app_po_number from ORC_APPROVAL_MASTER)");
					return $query->result_array();
	}
	public function save_eapp_data($row)
	{
	$this->db->insert('ORC_APPROVAL_MASTER',$row);
	} 
	
	public function get_eapp_apv($filter)
	{
		## Search 
		$searchQuery = " ";
		if($searchValue != ''){
			$searchQuery = " and (SEGMENT1 like '%".$searchValue."%' ) ";
		}
	$query=$this->db->query("select count(*) as allcount from ORC_APPROVAL_MASTER");
	$allcount=$query->result_array();
	foreach ($allcount as $rw);
	$totalRecords =$rw['allcount'];
	
	$query1=$this->db->query("select count(*) as allcount1 from ORC_APPROVAL_MASTER  WHERE".$searchQuery);
	$allcount1=$query1->result_array();
	foreach ($allcount1 as $rw);
	$totalRecordwithFilter =$rw['allcount1'];
	
	$apvQuery =$this->db->query("select top 12* FROM OPENQUERY(ORAC, 'select po_head.SEGMENT1,vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.CREATION_DATE,
					SUM(po_dist.QUANTITY_ORDERED*po_line.UNIT_PRICE) Total, po_head.CURRENCY_CODE,po_head.AGENT_ID
														from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head 
														LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
														LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID  left JOIN apps.MEW_C_AP_SUPPLIERS_ID_V vend  ON po_head.VENDOR_ID=vend.VENDOR_ID
																					 where    
														po_head.org_id=222  and po_head.TYPE_LOOKUP_CODE=''STANDARD''   and po_head.CREATION_DATE >''2020-APR-17''     and  po_head.AUTHORIZATION_STATUS=''APPROVED''   
														GROUP BY   vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.SEGMENT1,po_head.CREATION_DATE, po_head.CURRENCY_CODE,po_head.AGENT_ID') where SEGMENT1 NOT IN(select app_po_number from ORC_APPROVAL_MASTER) where ".$searchQuery." order by ".$columnName);
	return $apvQuery->result_array();													
	}
	public function check_appvd($po_number)
	{
	$query1=$this->db->query("select count(*) as allcount from ORC_APPROVAL_MASTER  WHERE app_po_number = '$po_number'");
	$allcount1=$query1->result_array();
	foreach ($allcount1 as $rw);
	return $rw['allcount'];
	}
	public function e_app_pending()
	{
					$query=$this->orcl->query("select po_head.SEGMENT1,vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.CREATION_DATE,
									SUM(po_dist.QUANTITY_ORDERED*po_line.UNIT_PRICE) Total, po_head.CURRENCY_CODE,po_head.AGENT_ID
								  from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head 
								  LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
								  LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID  left JOIN apps.MEW_C_AP_SUPPLIERS_ID_V vend  ON po_head.VENDOR_ID=vend.VENDOR_ID
                                 where    
                  po_head.org_id=222  and po_head.TYPE_LOOKUP_CODE='STANDARD'    and po_head.CREATION_DATE >='17-APR-2020' 
				  and  (po_head.AUTHORIZATION_STATUS<>'APPROVED' OR po_head.AUTHORIZATION_STATUS IS NULL  )   
                  GROUP BY   vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.SEGMENT1,po_head.CREATION_DATE, po_head.CURRENCY_CODE,po_head.AGENT_ID");
					return $query->result_array();
	}
	
}


















