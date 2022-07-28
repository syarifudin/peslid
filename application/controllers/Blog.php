<?php
class Blog extends CI_Controller{
function __construct(){
parent::__construct();
$this->load->model('blog_model');
}
function index(){
//$this->load->view('blog_view');
$file['cat']=$this->db->query("select * from npa_category");
      $file['npa']='prpo/form_pr.php';
      $this->load->view('index',$file);

}
function get_autocomplete(){
if (isset($_GET['term'])) {
$result = $this->blog_model->search_blog($_GET['term']);
	if (count($result) > 0) {
			foreach ($result as $row)
			$arr_result[] = array("label"=>$row->Description.'-'.$row->Translated_value,"labela"=>$row->Translated_value,"value"=>$row->Translated_value);
		echo json_encode($arr_result);
		}
	}
}
function get_autocompletee(){
if (isset($_GET['term'])) {
$result = $this->blog_model->search_bloga($_GET['term']);
	if (count($result) > 0) {
			foreach ($result as $row)
			$arr_result[] = array("label"=>$row->ACCOUNT_DESC.'-'.$row->ACCOUNT_CODE,"labela"=>$row->ACCOUNT_CODE,"value"=>$row->ACCOUNT_CODE);
		echo json_encode($arr_result);
		}
	}
}
function get_prautocomplete(){
	if (isset($_GET['term'])){
	$result = $this->blog_model->search_blogpr($_GET['term']);
		if (count($result) > 0){
			foreach ($result as $row) 
				$arr_result[] = array("label"=>$row->pr_number.'-'.$row->pr_supplier,"labela"=>$row->pr_number,"value"=>$row->pr_supplier);
			echo json_encode($arr_result);
				
			}
		}
	}
 
 function get_poautocomplete(){
 	if (isset($_GET['term'])){
 		$result = $this->blog_model->search_blogpo($_GET['term']);
 			if (count($result) > 0){
 				foreach ($result as $row)
 					$arr_result[] = array("label"=>$row->po_number.'-'.$row->po_supplier,"labela"=>$row->po_number,"value"=>$row->po_supplier);
 				echo json_encode($arr_result);
 			}
 		}
	 }

}