<?php
class Email extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('po_model');
		$this->load->library('dompdf_gen');
		$this->load->library('email');
		$this->load->library('session');
		
    }
public function send_po_do(){
 $dir = "pdf_po/";
		if (is_dir($dir)){
		  $dh = opendir($dir);
			while (($file = readdir($dh)) !== false){
			$suplier=substr($file,2,8);	
			$doc=substr($file,0,10);	
			if(($suplier)=='PIZ00003'){
			   if(isset($file)){
					if(($doc)=='POPIZ00003'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					//copy($filepo,$done_po);
					}
					if(($doc)=='DOPIZ00003'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
					//copy($file_do,$done_do);
				    }
			   } 
			$ttn="TO : TOSPO || ATTN : Yuki / Amy  / Kiki/York/Aki";
			$to = array('990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','dewi.karimah@mli.panasonic.co.id');
			//array(' yuki.ying@tospolighting.com','kiki.sun@tospolighting.com','amy.shen@tospolighting.com','york.zhan@tospolighting.com','aki.qian@tospolighting.com');
		   }elseif(($suplier)=='PIL00006'){
			   if(isset($file)){
					if(($doc)=='POPIL00006'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					//copy($filepo,$done_po);
					}
					if(($doc)=='DOPIL00006'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
					//copy($file_do,$done_do);
				    }
			   } 
				$ttn="TO : LKS || ATTN : Pathamaporn / Kanchana";
				$to = array('990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','dewi.karimah@mli.panasonic.co.id');//array('pathamaporn_t.lkl@lekise.co.th','kanchana.lks@lekise.co.th');
			}elseif(($suplier)=='PIL00007'){
					if(isset($file)){
					if(($doc)=='POPIL00007'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					//copy($filepo,$done_po);
					}
					if(($doc)=='DOPIL00007'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
					//copy($file_do,$done_do);
				    }
			   } 
		        //$to = array('muhammad.syarifuddin@mli.panasonic.co.id');
				$ttn="TO : LAMPTAN || ATTN : Rattana";
		        $to = array('990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','dewi.karimah@mli.panasonic.co.id');//array('rattana_s@lamptan.co.th','kijsada@lamptan.co.th','trading@lamptan.co.th');
			}elseif(($suplier)=='PIZ00006'){
					if(isset($file)){
					if(($doc)=='POPIZ00006'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					}
					if(($doc)=='DOPIZ00006'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
				    }
			   } 
				$ttn="TO : TCP. || ATTN : bao / Qi hao yan";
		        $to = array('990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','dewi.karimah@mli.panasonic.co.id');//array('baoxiaoqun@qlightsource.com','qihaoyang@qlightsource.com');
			}
			 
	  }
		if(isset($filepo))
		{
			$filepo;
		}else
		{
			$filepo="";
			redirect('mli');
		}
		copy($filepo,$done_po);
	    $this->email($to,$filepo,$ttn);
	   redirect('email/cel');
 }
 }
  public function email($to,$filepo,$ttn){
  $sub=substr($filepo,18,19);
  $nomor=substr($filepo,18,9);
  $pc_or=substr($filepo,28,8);
  $rev =substr($filepo,-15,1);
  $status=substr($filepo,-14,1);
  if(($status)=="0"){ $status=" NEW "; }else{ $status=" REV "; }
  if(($rev)=="1"){ $rev=" NEW";}else{ $rvisi=$rev-1; $rev=" REVISE(R$rvisi)" ; }
 $message="

$ttn
PRODUCTION ORDER = PC ORDER NUMBER :$pc_or  || PESLID PO: $nomor || $rev

Please find as attachment.

Thank You .
------------------------------------------------------------
This is an automatically generated email.
Please do not reply to it.
------------------------------------------------------------
Pesgmfid Chukai.
PT. PANASONIC GOBEL ECO SOLUTIONS MANUFACTURING IND";
 				$_POST['subject']=$sub.$rev;
				$_POST['message']= $message;
				$_POST['email']='peslid_chukai@mli.panasonic.co.id';
				$_POST['name']='PT. PANASONIC GOBEL ECO SOLUTIONS MANUFACTURING IND';
				$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => '157.8.1.150',
				'smtp_user' => 'peslid_chukai@mli.panasonic.co.id',
				'smtp_pass' => '',
				'smtp_port' => 25,
				'mailtype' => 'text',
				'newline'   => "\r\n" // kode yang harus di tulis pada konfigurasi controler email
					));
			//$cc = array('990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','dewi.karimah@mli.panasonic.co.id');
			$cc = array('muhammad.syarifuddin@mli.panasonic.co.id');
			//$bcc = array('muhammad.syarifuddin@mli.panasonic.co.id');
			$this->email->from($_POST['email'],$_POST['name'])
				->to($to) 
				->cc($cc)
				//->bcc($bcc)
				->subject($_POST['subject'])
				->message($_POST['message'])
				->attach($filepo);
			if ($this->email->send()) 
			{
				$this->session->set_flashdata('messege', 'Email Suksess.');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
unlink($filepo);
}
public function cel(){
$dir = "pdf_po/";
			$cek=0;
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
				$cek=$cek+1;  
			}
			echo $cek_file= $cek-3;
		  }
			closedir($dh);
	if(($cek_file)==0){
	    //action file false; 
		redirect('mli');
	}else{
		redirect('email/send_po_do');
	}
  }
}