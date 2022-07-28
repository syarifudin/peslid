<?php
class npa extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->model('po_model');
		$this->load->library('session');
		$this->orcl= $this->load->database('orcl_db',TRUE);
	}
	public function index()
	{
	$file['cat']=$this->db->query("select * from npa_category");
	$file['npa']='npa/form_npa.php';
	$this->load->view('index',$file);
	
	}	
	
	function get_supplier()
	{      
		$data=array();
		$query =$this->input->get('query');
		if($query!="")
		{
        $this->orcl->like('VENDOR_NAME', $query);
        $this->orcl->select('VENDOR_NAME', $query);
        $data1 = $this->orcl->get("APPS.MEW_C_AP_SUPPLIERS_ID_V")->result_array();
		foreach($data1 as $rw)
		{
			$data2=$rw['VENDOR_NAME'];
			  array_push($data, $data2);
		}
        echo json_encode($data);
	    }
	}
	function save_npa()
	{
		$query=$this->db->query("select MAX(header_id) as num from orc_npa_header");
			foreach($query->result_array() as $row);
		$num=$row['num']+1;
		$rw['apvl_date']=$this->input->post('a_date');
		$rw['npa_type']=$this->input->post('npa_type');
		$rw['npa_cat']=$this->input->post('npa_cat');
		$rw['q_r_date']=$this->input->post('q_r_date');
		$rw['q_date']=$this->input->post('q_date');
		$rw['s_eff_date']=$this->input->post('s_eff_date');
		if($this->input->post('e_eff_date')=="")
			{
				$eff=NULL;
			}else
			{
			$eff=$this->input->post('e_eff_date');
			}		
		$rw['e_eff_date']=$eff;
		$rw['t_of_price']=$this->input->post('t_of_price');
		$rw['mtl_type']=$this->input->post('mtl_type');
		$rw['quotation_number']=$this->input->post('quotation_number');
		$rw['price_i_term']=$this->input->post('price_i_term');
		$rw['supplier']=$this->input->post('supplier');
		$rw['npa_number']=trim($rw['npa_type']."/".trim($rw['npa_cat']).'/'.date('m/Y')."/".$num);
		$this->db->insert("orc_npa_header",$rw);
		
	 	$item =$this->input->post('item');
	 	$desc =$this->input->post('desc');
	 	$uom_po =$this->input->post('uom');
	 	$curr =$this->input->post('curr');
	 	$price =$this->input->post('price');
	 	$spq =$this->input->post('spq');
	 	$moq =$this->input->post('moq');
	 	$lt =$this->input->post('lt');
	 	$mode =$this->input->post('mode');
	 	$maker =$this->input->post('maker');
	 	$npa_no =$this->input->post('npa_no');
	 	$supplier1 =$this->input->post('supplier1');
	 	$curr1 =$this->input->post('curr1');
	 	$price2 =$this->input->post('price2');
	 	$stt_date =$this->input->post('stt_date');
	 	$e_date =$this->input->post('e_date');
	 	$uom_1 =$this->input->post('uom_1');
	 	$curr_2 =$this->input->post('curr_2');
	 	$price_3 =$this->input->post('price_3');
	 	$rate =$this->input->post('rate');
	 	$conv =$this->input->post('conv');
	 	$last =$this->input->post('last');
	 	$std =$this->input->post('std');
		foreach($item as $key => $n )
		{
			$det['npa_number_det']=$rw['npa_number'];
			$det['item_code']=$item[$key];
			$det['item_desc']=$desc[$key];
			$det['uom']=$uom_po[$key];
			$det['curr_item']=$curr[$key];
			$det['price_item']=$price[$key];
			$det['spq']=$spq[$key];
			$det['moq']=$moq[$key];
			$det['lt']=$lt[$key];
			/*$curr[$key];
			$price[$key];
			$spq[$key];
			$moq[$key];
			$lt[$key];
			$mode[$key];
			$maker[$key];
			$npa_no[$key];
			$supplier1[$key];
			$curr1[$key];
			$price2[$key];
			$stt_date[$key];
			$e_date[$key];
			$uom_1[$key];
			$curr_2[$key];
			$price_3[$key];
			$rate[$key];
			$conv[$key];
			$last[$key];
			$std[$key]; */
		$this->db->insert("orc_npa_detail",$det);	
		}
		$this->db->insert("orc_npa_header",$rw);
	}
}