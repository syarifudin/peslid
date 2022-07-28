<?php
class discrete_job extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->library('session');
	}
	public function index()
	{
		$data['suninventory']=$this->oracle_model->get_subinv();
		$data['print_dj']='dj/dj.php';
		$this->load->view('index',$data);	
	}
	public function create_dj()
	{
		$data_dj['dj_name']=trim($this->input->post('dj_name'));
		$data_dj['from']=$this->input->post('subinventory_from');
		$data_dj['to']=$this->input->post('subinventory_to');
		$data_dj['date_create']=date('Y-m-d',strtotime($this->input->post('date_create')));
		$data['dj']=$this->oracle_model->get_dj_item($data_dj);
		$html=$this->load->view('dj/print_dj',$data); 
	}	
	public function n_create_dj()
	{
		$data_dj['dj_name']=trim('2AGC1F-D-04FEB2021-325399');
		$data_dj['from']='';
		$data_dj['to']='';
		$data_dj['date_create']='2021-02-03';
		$data['dj']=$this->oracle_model->get_dj_item($data_dj);
		$html=$this->load->view('dj/n_print_dj',$data); 
	}
}