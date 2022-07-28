<?php
class orcl_chart extends CI_Controller {
 
public function __construct()
{
parent::__construct();
$this->load->model('chart');
 $this->load->helper('url');
$this->load->helper('form');
}
 
public function index()
{
$data['graph'] = $this->chart->graph();
$this->load->view('oracle/index_chart', $data);
}
public function get_delivery_chart()
 {
	$data['tr']=$this->chart->transmission_data();
	$data['dl_po'] = $this->chart->delivery_chart();
	$data['PO'] = $this->chart->PO_BY_MONTH();
	$data['PO_'] = $this->chart->PO_BY_DATE();
	$data['da'] = $this->chart->dlv_amount();
	$data['tpa'] = $this->chart->tot_po_amount();
	$this->load->view('oracle/chart_of_sales.php',$data);
 }
public function transaction_progress()
 {
	$data['trans']=$this->chart->progress_transaction();
	print_r($data['trans']);
 }
}