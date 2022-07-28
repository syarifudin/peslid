<?php
class chart extends CI_Model {
public function __construct()
{
		$this->load->helper('array');
		$this->orcl= $this->load->database('orcl_db',TRUE);
}
public function graph()
  {
	$data = $this->db->query("select  PARTY_NAME,TRANSACTIONAL_CURR_CODE,
							case when TRANSACTIONAL_CURR_CODE='IDR' then isnull(SUM(AMOUNT), 0)/13427 
							when TRANSACTIONAL_CURR_CODE='JPY' then isnull(SUM(AMOUNT), 0)*0.0089
							else isnull(SUM(AMOUNT), 0)*1 end as TOTAL
							from orc_so where DELIVERY_ID is NOT NULL  
							group by PARTY_NAME,TRANSACTIONAL_CURR_CODE");
	return $data->result();
  }
  
  public function delivery_chart()
  {
	  
	  $data = $this->orcl->query("SELECT 	COUNT(DISTINCT mstr_del.DELIVERY_ID) Delivery,
                count(DISTINCT om_header.CUST_PO_NUMBER) Purchase
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
							ON mstr_del.DELIVERY_ID = del_ass.DELIVERY_ID 
							WHERE a.PARTY_ID                   = b.PARTY_ID
							AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID AND PARTY_NAME='26-PESGSID' AND(to_char(om_line.ACTUAL_SHIPMENT_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY')
							OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL AND om_line.FLOW_STATUS_CODE !='CANCELLED')  and om_line.ORDERED_QUANTITY !=0 AND om_line.ORG_ID                 = 222");
						 return $data->result_array();
  }
  public function transmission_data()
  {
	  $data=$this->orcl->query("SELECT 			case 
             WHEN
              (om_line.FLOW_STATUS_CODE ='AWAITING_SHIPPING') 
              THEN  
              '1.SHIPPING'
              WHEN
             (om_line.FLOW_STATUS_CODE ='PRE-BILLING_ACCEPTANCE') THEN  ('2.FULFILLMENT')
              WHEN
              (om_line.FLOW_STATUS_CODE ='CLOSED') and ( TRUNC(ADD_MONTHS(AR_.ATTRIBUTE12,0), 'MONTH')  IS NULL ) THEN '3.TRANSMIT'
              WHEN
              (TRUNC(ADD_MONTHS(AR_.ATTRIBUTE12,0), 'MONTH')is not NULL) THEN '4.TRANSMITTED'
              ELSE om_line.FLOW_STATUS_CODE
              END as FLOW_STATUS_CODE,
          case
              WHEN (om_line.FLOW_STATUS_CODE ='ENTERED')
              THEN
                count(DISTINCT om_header.ORDER_NUMBER) 
              ELSE
                count(DISTINCT mstr_del.DELIVERY_ID) 
              END AS  Jumlah
							FROM APPS.MEW_C_HZ_LOCATIONS_ID_V g,
							  APPS.MEW_C_HZ_PARTY_SITES_ID_V f,
							  APPS.MEW_C_HZ_CUST_SITE_USES_ID_V d,
							  APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V e,
							  APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V a,
							  APPS.MEW_C_HZ_PARTIES_ID_V b,
							  APPS.MEW_C_OE_ORDER_LINES_ALL_ID_V om_line 
                left JOIN (select a.ATTRIBUTE10,b.INTERFACE_LINE_ATTRIBUTE6,a.ATTRIBUTE12,b.CREATION_DATE from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V a,APPS.MEW_C_RA_CUST_TRX_LINES_ID_V b where a.CUSTOMER_TRX_ID=b.CUSTOMER_TRX_ID) AR_ 
              ON om_line.line_ID=AR_.INTERFACE_LINE_ATTRIBUTE6
							LEFT OUTER JOIN APPS.MEW_C_OE_ORDER_HEADERS_ID_V om_header
							ON om_header.HEADER_ID = om_line.HEADER_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_DELIV_DETAILS_ID_V dlv_det
							ON om_line.LINE_ID = dlv_det.SOURCE_LINE_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_DELIV_ASSIGN_ID_V del_ass
							ON del_ass.DELIVERY_DETAIL_ID = dlv_det.DELIVERY_DETAIL_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V mstr_del
							ON mstr_del.DELIVERY_ID = del_ass.DELIVERY_ID left JOIN (select a.ATTRIBUTE10,b.INTERFACE_LINE_ATTRIBUTE6,a.ATTRIBUTE12,b.CREATION_DATE from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V a,APPS.MEW_C_RA_CUST_TRX_LINES_ID_V b where a.CUSTOMER_TRX_ID=b.CUSTOMER_TRX_ID) AR_ 
              ON om_line.line_ID=AR_.INTERFACE_LINE_ATTRIBUTE6
							WHERE a.PARTY_ID                   = b.PARTY_ID
							AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID AND PARTY_NAME='26-PESGSID' and mstr_del.DELIVERY_ID IS NOT NULL
             AND (to_char(om_line.ACTUAL_SHIPMENT_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY') OR om_line.FLOW_STATUS_CODE ='PRE-BILLING_ACCEPTANCE' OR  to_char(AR_.CREATION_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY')
             OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL AND om_line.FLOW_STATUS_CODE !='CANCELLED')  and om_line.ORDERED_QUANTITY !=0 
						 AND om_line.ORG_ID                 = 222 	GROUP BY om_line.FLOW_STATUS_CODE, TRUNC(ADD_MONTHS(AR_.ATTRIBUTE12,0), 'MONTH') ORDER BY  1");
		return $data->result_array();
  }
  public function PO_BY_MONTH()
  {
	   $data=$this->orcl->query("  select     TRUNC(ADD_MONTHS(om_header.ORDERED_DATE,0), 'MONTH') MONTH,
              SUM(om_line.UNIT_SELLING_PRICE * TO_BINARY_FLOAT (om_line.ORDERED_QUANTITY)) AS AMOUNT
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
							WHERE a.PARTY_ID                   = b.PARTY_ID
						AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID AND PARTY_NAME='26-PESGSID'
             AND (to_char(om_line.ACTUAL_SHIPMENT_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY') 
             OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL AND om_line.FLOW_STATUS_CODE !='CANCELLED')  and om_line.ORDERED_QUANTITY !=0 
						 AND om_line.ORG_ID                 = 222 GROUP BY TRUNC(ADD_MONTHS(om_header.ORDERED_DATE,0), 'MONTH') ORDER BY 1");
		return $data->result_array();
  } 
  public function PO_BY_DATE()
  {
	   $data=$this->orcl->query("   select    to_char(om_header.ORDERED_DATE,'dd-mm-YYYY') Order_Date,
              SUM(om_line.UNIT_SELLING_PRICE * TO_BINARY_FLOAT (om_line.ORDERED_QUANTITY)) AS AMOUNT
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
							WHERE a.PARTY_ID                   = b.PARTY_ID
						AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID AND PARTY_NAME='26-PESGSID'
             AND (to_char(om_header.ORDERED_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY')) 
						 AND om_line.ORG_ID = 222 GROUP BY to_char(om_header.ORDERED_DATE,'dd-mm-YYYY')order by 1");
		return $data->result_array();
  }
  
  public function dlv_amount(){
	  
	   $data=$this->orcl->query("SELECT 	   SUM(dlv_det.REQUESTED_QUANTITY*om_line.UNIT_SELLING_PRICE) Amount
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
							ON mstr_del.DELIVERY_ID = del_ass.DELIVERY_ID 
							WHERE a.PARTY_ID                   = b.PARTY_ID
							AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID AND PARTY_NAME='26-PESGSID' AND(to_char(om_line.ACTUAL_SHIPMENT_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY')
							OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL AND om_line.FLOW_STATUS_CODE !='CANCELLED')  and om_line.ORDERED_QUANTITY !=0 AND om_line.ORG_ID = 222 and dlv_det.ORGANIZATION_ID=222  and mstr_del.DELIVERY_ID IS NOT NULL");
		return $data->result_array();
	  
  }
  public function tot_po_amount(){
	  $data=$this->orcl->query("SELECT 	  sum (om_line.ORDERED_QUANTITY *om_line.UNIT_SELLING_PRICE)t_amount
							  FROM APPS.MEW_C_HZ_PARTY_SITES_ID_V f,
							  APPS.MEW_C_HZ_CUST_SITE_USES_ID_V d,
							  APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V e,
							  APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V a,
							  APPS.MEW_C_HZ_PARTIES_ID_V b,
							  APPS.MEW_C_OE_ORDER_LINES_ALL_ID_V om_line 
							LEFT OUTER JOIN APPS.MEW_C_OE_ORDER_HEADERS_ID_V om_header
							ON om_header.HEADER_ID = om_line.HEADER_ID
							WHERE a.PARTY_ID                   = b.PARTY_ID
							AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND PARTY_NAME='26-PESGSID' AND(to_char(om_line.ACTUAL_SHIPMENT_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY')
							OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL AND om_line.FLOW_STATUS_CODE !='CANCELLED')  and om_line.ORDERED_QUANTITY !=0 AND om_line.ORG_ID = 222 ");
	  return $data->result_array();
  }
  public function progress_transaction ()
  {
	  	  $data=$this->orcl->query("SELECT 			case 
             WHEN
              (om_line.FLOW_STATUS_CODE ='AWAITING_SHIPPING') 
              THEN  
              '1.SHIPPING'
              WHEN
             (om_line.FLOW_STATUS_CODE ='PRE-BILLING_ACCEPTANCE') THEN  ('2.FULFILLMENT')
              WHEN
              (om_line.FLOW_STATUS_CODE ='CLOSED') and (AR_.ATTRIBUTE12 IS NULL ) THEN '3.WAITING_TRANSMIT'
              WHEN
              (AR_.ATTRIBUTE12 IS NOT NULL) THEN '4.TRANSMITTED'
              ELSE om_line.FLOW_STATUS_CODE
              END as FLOW_STATUS_CODE,
          case
              WHEN (om_line.FLOW_STATUS_CODE ='ENTERED')
              THEN
                count(DISTINCT om_header.ORDER_NUMBER) 
              ELSE
                count(DISTINCT mstr_del.DELIVERY_ID) 
              END AS  Jumlah,
              to_char(to_date(SUBSTR(mstr_del.ATTRIBUTE4,1,10),'yyyy/mm/dd'), 'W') Weeks
							FROM APPS.MEW_C_HZ_LOCATIONS_ID_V g,
							  APPS.MEW_C_HZ_PARTY_SITES_ID_V f,
							  APPS.MEW_C_HZ_CUST_SITE_USES_ID_V d,
							  APPS.MEW_C_HZ_CUST_ACCT_SITES_ID_V e,
							  APPS.MEW_C_HZ_CUST_ACCOUNTS_ID_V a,
							  APPS.MEW_C_HZ_PARTIES_ID_V b,
							  APPS.MEW_C_OE_ORDER_LINES_ALL_ID_V om_line 
                left JOIN (select a.ATTRIBUTE10,b.INTERFACE_LINE_ATTRIBUTE6,a.ATTRIBUTE12,b.CREATION_DATE from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V a,APPS.MEW_C_RA_CUST_TRX_LINES_ID_V b where a.CUSTOMER_TRX_ID=b.CUSTOMER_TRX_ID) AR_ 
              ON om_line.line_ID=AR_.INTERFACE_LINE_ATTRIBUTE6
							LEFT OUTER JOIN APPS.MEW_C_OE_ORDER_HEADERS_ID_V om_header
							ON om_header.HEADER_ID = om_line.HEADER_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_DELIV_DETAILS_ID_V dlv_det
							ON om_line.LINE_ID = dlv_det.SOURCE_LINE_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_DELIV_ASSIGN_ID_V del_ass
							ON del_ass.DELIVERY_DETAIL_ID = dlv_det.DELIVERY_DETAIL_ID
							LEFT OUTER JOIN APPS.MEW_C_WSH_NEW_DELIVERIES_ID_V mstr_del
							ON mstr_del.DELIVERY_ID = del_ass.DELIVERY_ID left JOIN (select a.ATTRIBUTE10,b.INTERFACE_LINE_ATTRIBUTE6,a.ATTRIBUTE12,b.CREATION_DATE from APPS.MEW_C_RA_CUST_TRX_ALL_ID_V a,APPS.MEW_C_RA_CUST_TRX_LINES_ID_V b where a.CUSTOMER_TRX_ID=b.CUSTOMER_TRX_ID) AR_ 
              ON om_line.line_ID=AR_.INTERFACE_LINE_ATTRIBUTE6
							WHERE a.PARTY_ID                   = b.PARTY_ID
							AND a.CUST_ACCOUNT_ID              = om_header.SOLD_TO_ORG_ID
							AND om_header.SHIP_TO_ORG_ID       = d.site_USE_ID
							AND d.CUST_ACCT_SITE_ID            = e.CUST_ACCT_SITE_ID
							AND e.PARTY_SITE_ID                = f.PARTY_SITE_ID
							AND f.LOCATION_ID                  = g.LOCATION_ID AND PARTY_NAME='26-PESGSID' and mstr_del.DELIVERY_ID IS NOT NULL
             AND (to_char(om_line.ACTUAL_SHIPMENT_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY') OR om_line.FLOW_STATUS_CODE ='PRE-BILLING_ACCEPTANCE' OR  to_char(AR_.CREATION_DATE,'mm-YYYY')=to_char(sysdate, 'mm-YYYY')
             OR om_line.ACTUAL_SHIPMENT_DATE   IS  NULL AND om_line.FLOW_STATUS_CODE !='CANCELLED')  and om_line.ORDERED_QUANTITY !=0 
						 AND om_line.ORG_ID                 = 222 	GROUP BY om_line.FLOW_STATUS_CODE,AR_.ATTRIBUTE12,to_char(to_date(SUBSTR(mstr_del.ATTRIBUTE4,1,10),'yyyy/mm/dd'),'W') ORDER BY  1");
		  return $data->result_array();
  }
}

