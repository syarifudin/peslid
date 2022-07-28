<?php
class u_p extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('u_p_model');
		$this->load->library('session');
        $this->load->library('excel');;
		}
	public function index()
	{
		$data['excel']='po_control/u_p_view.php';
		$this->load->view('index',$data);	
	}	
	
	public function row_po()
	{
		
	}
	public function excel()
	{
	
		$file_ex=$_FILES["ex"]["name"];
		   if(!empty($file_ex))
		   {
		   $file ='./u_p/'.$_FILES["ex"]["name"];
			//load the excel library
			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			//header will/should be in row 1 only. of course this can be modified to suit your need.
			if ($row == 1) {
				$header[$row][$column] = $data_value;
			} else {
				$arr_data[$row][$column] = $data_value;
			}
		 }
		   $data= $arr_data;
		  $this->u_p_model->u_p_po($data); 
		}
	}
	public function po_control()
	{
		$data['ctrl']='po_control/po_c.php';
		$this->load->view('index',$data);	
	}
	public function result_control()
	{
		$po=$this->input->post('po_number');
		$result['data']=$this->u_p_model->get_ctrl($po);
		$result['ctrl_po_']='po_control/result_ctrl.php';
		$this->load->view('index',$result);
		
	}
}