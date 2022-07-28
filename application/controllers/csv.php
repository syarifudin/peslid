<?php
class Csv extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('po_model');
		$this->load->library('dompdf_gen');
		$this->load->library('email');
		$this->load->library('session');
        $this->load->helper('csv');
		}
		
	public function index(){
	$list=$this->po_model->get_po();
	$data = "PO Customer,PO NBR, Supplier,Order date,Due Date,Buyer,Remarks,Line PLI,Line Cus,Item Number, Qty Order,UM,Ship To"."\n";
	foreach($list as $row){
	$data.="'".$row['global_code'].",".$row['gc_name'].",".$row['global_code'].",".$row['gc_name'].",".$row['gc_name'].",".$row['gc_name'].",".$row['gc_name'].",".$row['gc_name'].",".$row['gc_name']."\n";
	}
	$file = 'po_csv/'.'fileposuplier.csv';
	chmod($file, 0777);
	file_put_contents($file,$data);
	}		
}