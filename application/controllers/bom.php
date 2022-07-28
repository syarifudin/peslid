<?php
class bom extends CI_Controller {
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
		$data['in']='bom/index.php';
		$this->load->view('index',$data);	
	}	
	public function check()
	{
		$data=$this->input->post('bm');
		If($data=='std')
		{
			echo "STD";
		}if ($data=='cur')
		{
			echo "CURR";
		}if ($data=='sim')
		{
			echo "SIM";
		}
	}
}