<?php
class Admin extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('po_model');
		$this->load->library('session');
		$this->load->library('dompdf_gen');
		define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);
		ROOT_PATH."/third_party/dompdf/dompdf_config.inc.php";
	}
	public function upload_po(){
	$se['search']='upload_production_order.php';
	$this->load->view('index.php',$se);
    }
	public function file_manager(){
		$dir="finish_po/";
		$file['file_manager']= scandir($dir);
		$file['file_']='file_manager.php';
		$this->load->view('index',$file);
	}
	public function pocsv(){
		$dir="po_csv/";
		$file['file_manager']= scandir($dir);
		$file['file_']='file_csv.php';
		$this->load->view('index',$file);
	}	
	public function item_maintenance(){
	$file['data_item']=$this->po_model->get_item();
	$file['itm_maintenance']='item_maintenance.php';
	$this->load->view('index',$file);
	}
	public function search_item(){
	$item=$this->input->post('search_item');
	$file['item']=$this->po_model->search_itm_($item);
	$file['itm_maintenance']='item_maintenance.php';
	$this->load->view('index',$file);
	}
	public function search_Production_order(){
	 $po_number=$this->input->post('search_po');
	 $po['get_po']=$this->po_model->searchpo($po_number);
	 $po['data_po'] = 'data_po.php';
     $this->load->view('index',$po); 
	}
	public function login(){
	$cek=$cek=$this->session->userdata('control');
	if(!empty($cek))
	{
		redirect('index.php/mli');
	}
	else
	{
		$this->load->view('login/index');
	}
	}
	public function D_I(){
	 $po['get_po']=$this->po_model->get_po();
	 $po['data_po'] = 'data_do.php';
     $this->load->view('index',$po);
	}
	public function detil_di($di)
	{
		$di_detil['detil']=$this->po_model->get_di_detil($di);
		$di_detil['di_detil']='di_detil.php';
		$this->load->view('index.php',$di_detil);
	}
	public function log_in()
	{
	  $user=$this->input->post('username');
	  $pass=md5($this->input->post('password'));
	  $set=$this->po_model->get_user($user,$pass);
		if(count($set)>0)
		{
		   foreach($set as $qad)
						{
							$sess_data['logged_in'] = 'yesGetMeLogin';
							$sess_data['username'] = $qad->username;
							$sess_data['password'] = $qad->password;
							$sess_data['control'] = $qad->control;
							$sess_data['login_attempts'] = $qad->login_attempts;
							$sess_data['user_site'] = $qad->user_site;
							$sess_data['user_segment'] = $qad->user_segment;
							$this->session->sess_expiration=7200;
							$this->session->set_userdata($sess_data);
						}
			redirect('mli');			
		}
		else
		{
			$message['messg']="  Fail.. Try / contact  IS Dept !";
			$this->load->view('login/index',$message);
		}
	}
	public function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php/admin/login');
		}
		else
		{
			$this->session->sess_destroy();
			header('location:'.base_url().'index.php/admin/login');
		}
	}
	public function get_view_user()
	{
	 $user['data_user']=$this->po_model->user_view();
	 $user['datauser']='login/data_user.php';
	 $this->load->view('index',$user);
	}
	public function maintanance_user()
	{
	 $main['main_user']='maintenance_user.php';
	 $this->load->view('index',$main);
	}
	public function register_user()
	{
	 $user['emp_id']=$this->input->post('emp_id');
	 $user['username']=$this->input->post('username');
	 $user['password']=md5($this->input->post('password'));
	 $user['control']=$this->input->post('control');
	 $user['user_group']=$this->input->post('user_group');
	 $user['login_attempts']=0;
	 $this->po_model->save_user($user);
	 redirect('mli');
	}
	public function edit_user($user)
	{
		$usr['eusr']=$this->po_model->edit_user($user);
		$usr['main_user']='maintenance_user.php';
		$this->load->view('index',$usr);
	}
	public function search_filepo(){
	$num_po=$this->input->post('search_filepo');
		$dir="finish_po/";
		$file= scandir($dir);
		$xfile=count($file);
		for($x=0;$x<$xfile;$x++){
		if(substr($file[$x],12,8)==$num_po){
		echo $fil['file_manager']=$file[$x];
		}
		}
		$fil['file_']='_file_manager.php';
		$this->load->view('index',$fil);
	}
	public function search_filepocsv(){
	    $num_po=$this->input->post('search_filepocsv');
		$dir="po_csv/";
		$file= scandir($dir);
		$xfile=count($file);
		for($x=0;$x<$xfile;$x++){
		if(substr($file[$x],3,-12)==$num_po){
		$fil['file_manager']=$file[$x];
		}
		}
		$fil['file_']='_file_pocsv.php';
		$this->load->view('index',$fil);
	}
	public function print_po_customer(){
	$fil['pocustomer_']='po_customer.php';
	$this->load->view('index',$fil);
	}
	public function search_po_customer()
	{
	$ams_po=$this->input->post('search_po_cus');
	$st=$this->input->post('st');
	if(empty($st))
	$st="0";
	$fil['po_customer']=$this->po_model->search_po_customer($ams_po,$st);
	if(!empty($fil['po_customer']))
	$this->load->view('print_po_cu',$fil);
	}
	public function ctrl_po_cus()
	{
	 $data['sales_forecast']=$this->po_model->get_sales_forecast();
	 $data['ctrl_po']='control_po_customer.php';
	 $this->load->view('index',$data);
	}
	public function send_po_to_supplier(){
	$data['send_po']='send_po_supplier.php';
	$this->load->view('index',$data);
	}
	public function send_posup(){ 
	$sup=$this->input->post('supplier');
	$per=$this->input->post('periode');
	$data['sup']=$sup;
	$data['per']=$per;
	$data['supplier']=$this->po_model->get_address($sup);
	//$this->load->view('po_supplier',$data);
	$html=$this->load->view('po_supplier',$data,true);
	$dompdf = new DOMPDF();
						 $dompdf->set_paper("A4");
						 $dompdf->load_html($html);
						 $dompdf->render();	
						 $canvas = $dompdf->get_canvas();
          $font = Font_Metrics::get_font("helvetica", "bold");
         $canvas->page_text(500, 20, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
	$file_save='./pdf_po/PO'.$sup."_".date('dmy').'.pdf';
	$output = $dompdf->output();
	$file_to_save =$file_save;
	file_put_contents($file_to_save, $output); 
	}
	public function data_queue()
	{
	 $cek=$cek=$this->session->userdata('control');
		if(empty($cek))
		{
			redirect('admin/login');
		}else
		{
	$data['data_queue']=$this->po_model->data_queue();
	$data['queue']='queue.php';
	$this->load->view('index',$data);
	}
	}
}