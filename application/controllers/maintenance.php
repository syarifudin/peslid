<?php
class Maintenance extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('mnc_model');
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
	public function mnc_po(){
	$mnc['mnc_po']='mnc_po.php';
	$this->load->view('index',$mnc);
	}
	public function mnc_view(){
	$mnc=$this->input->post('mnc_po');
	$rev=0;
	$mnc_['mnc_view']=$this->mnc_model->mnc_chek($mnc,$rev); 
	$mnc_['mnc_po']='mnc_po.php';
	$this->load->view('index',$mnc_);
	}
	public function mnc_dlt($ams_po){
	$this->mnc_model->mnc_delete($ams_po);
	}
	public function rev_po(){
	$data['rev']='rev_po.php';
	$this->load->view('index',$data);
	}
	public function po_rev_(){
	$po=$this->input->post('pc_order_number');
						$sup['dlv_tt']=$this->po_model->cek_po_rev($po);
						 $get_p=$this->po_model->getpo($po);
						 $sup['case']=$get_p;
						 foreach($get_p as $r);
						 $sup['ams_po']=$po;
						 $sup['vendor']=$r['kode_suplier'];
						 $kode_supplier=$r['kode_suplier'];
						 $cnee=$r['cnee'];
						 $sup['cnee']=$this->po_model->get_cnee($cnee);
						 $sup['supplier']=$this->po_model->get_address($kode_supplier);
						 $html=$this->load->view('po_rev__',$sup,true);
						foreach($sup['dlv_tt'] as $nomor);
							$dompdf = new DOMPDF();
							$dompdf->set_paper("A4");
							$dompdf->load_html($html);
							$dompdf->render();
							$canvas = $dompdf->get_canvas();
							$font = Font_Metrics::get_font("helvetica", "bold");
							$canvas->page_text(500, 20, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
						 $file_save='./pdf_po_rev/PO'.$kode_supplier.$nomor['po_number']."-".$nomor['ams_po']."_".date('dmy').$nomor['rev'].'.pdf';
						 $output = $dompdf->output();
						 $file_to_save =$file_save;
						 file_put_contents($file_to_save, $output);
	}
}