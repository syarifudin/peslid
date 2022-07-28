<?php
class e_app extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
    $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->library('session');
		$this->orcl= $this->load->database('orcl_db',TRUE);
	}
	public function index()
	{
		$cek=$cek=$this->session->userdata('logged_in');
	if(!empty($cek))
	{
		$data['list']=$this->oracle_model->e_app();
		$data['list_po']='e-app/po_list.php';
		$this->load->view('e-app/index.php',$data);
	}
		else
		{
			redirect('e_app/login');
		}
	}
	function login()
	{	
	$cek=$cek=$this->session->userdata('logged_in');
	if(!empty($cek))
	{
		redirect('e_app');
	}
	else
	{
		$this->load->view('e-app/login.php');
	}
		
	}	
	function detail_po($data)
	{
	  $date['date1']= $data;
		$date['date2']= $data;
		$row['det_list']='e-app/detail_po.php';
		$row['data_po_detail']=$this->oracle_model->f_po_print($date);
	  $this->load->view('e-app/index.php',$row);
	}
	function form($data)
	{
		$date['date1']= $data;
		$date['date2']= $data;
		$po_number= $data;
		$row['data_po_detail']=$this->oracle_model->f_po_print($date);
		$row['confirm']=$this->oracle_model->check_appvd($po_number);
		$row['form']='e-app/form_eapp.php';
		$this->load->view('e-app/index.php',$row);
	}
	function save_eapp()
	{
		$row['app_id_number']=rand(1,1000000);
		$row['app_data_time']=date('Y-M-d H:i:s');
		$row['app_po_number']=$this->input->post('po_number');
		$row['app_supplier']=$this->input->post('supp');
		$data=$this->input->post('po_number');
		$row['app_status']=1;
		$this->oracle_model->save_eapp_data($row);
		$this->form($data);
	}
	public function eapp_apv()
	{
	 $row['form_avp']='e-app/eapp_po_approved.php';
	 $this->load->view('e-app/index.php',$row);
	}
	public function get_po_apv()
	{
		## Read value
			$draw= $this->input->post('draw');
			$row = $this->input->post('start');
			$rowperpage = $this->input->post('length'); // Rows display per page
			$columnIndex =  $this->input->post('order')[0]['column']; // Column index
			$columnName =  $this->input->post('columns')[$columnIndex]['data']; // Column name
			$columnSortOrder = $this->input->post('order')[0]['dir']; // asc or desc
			$searchValue = $this->input->post('search')['value']; // Search value
			
			## Search 
		$searchQuery = " ";
			$searchQuery = "   '%".$searchValue."%' ";
			
	$query=$this->db->query("select count(*) as allcount from ORC_APPROVAL_MASTER");
	$allcount=$query->result_array();
	foreach ($allcount as $rw);
	$totalRecords =$rw['allcount'];
	
	$query1=$this->db->query("select count(*) as allcount1 from ORC_APPROVAL_MASTER where (app_po_number like ".$searchQuery.")");
	$allcount1=$query1->result_array();
	foreach ($allcount1 as $rw);
	 $totalRecordwithFilter =$rw['allcount1'];
	
	$apvQuery =$this->db->query("select * FROM         OPENQUERY(ORAC, 'select po_head.SEGMENT1,vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.CREATION_DATE,
					SUM(po_dist.QUANTITY_ORDERED*po_line.UNIT_PRICE) Total, po_head.CURRENCY_CODE,po_head.AGENT_ID
														from APPS.MEW_C_PO_HEADERS_ALL_ID_V  po_head 
														LEFT JOIN APPS.MEW_C_PO_LINES_ALL_ID_V  po_line on po_head.PO_HEADER_ID=po_line.PO_HEADER_ID
														LEFT JOIN APPS.MEW_C_PO_DISTRIB_ALL_ID_V po_dist ON po_line.PO_LINE_ID=po_dist.PO_LINE_ID  left JOIN apps.MEW_C_AP_SUPPLIERS_ID_V vend  ON po_head.VENDOR_ID=vend.VENDOR_ID
																					 where    
														po_head.org_id=222  and po_head.TYPE_LOOKUP_CODE=''STANDARD''   and po_head.CREATION_DATE >''2020-APR-01''  
														and PO_LINE.CLOSED_CODE<>''CLOSED''      and  po_head.AUTHORIZATION_STATUS=''APPROVED''   
														GROUP BY   vend.VENDOR_NAME,po_head.AUTHORIZATION_STATUS,po_head.SEGMENT1,po_head.CREATION_DATE, po_head.CURRENCY_CODE,po_head.AGENT_ID') 
														where SEGMENT1  IN(select app_po_number from ORC_APPROVAL_MASTER) and SEGMENT1 like".$searchQuery." Order by ".$columnName." ".$columnSortOrder);
	 $record=$apvQuery->result_array();	
	 $data = array();

			foreach($record as $raw){
				$data[] = array(
						"SEGMENT1"=>$raw['SEGMENT1'],
						"VENDOR_NAME"=>$raw['VENDOR_NAME'],
						"TOTAL"=>number_format($raw['TOTAL'] ,2,'.',','),
						"AUTHORIZATION_STATUS"=>$raw['AUTHORIZATION_STATUS'],
						
					);

			}

			## Response
			$response = array(
				"draw" => intval($draw),
				"iTotalRecords" => $totalRecords,
				"iTotalDisplayRecords" => $totalRecordwithFilter,
				"aaData" => $data
			);

			echo json_encode($response);
			
	}
	public function eapp_pend_apv()
	{
		$data['list']=$this->oracle_model->e_app_pending();
		$data['list_pend']='e-app/eapp_po_pend.php';
		$this->load->view('e-app/index.php',$data);
		
	}
	
}