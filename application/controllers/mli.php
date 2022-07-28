<?php
class Mli extends CI_Controller {
    public function __construct()
    {
        parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('po_model');
		$this->load->library('dompdf_gen');
		$this->load->library('email');
		$this->load->library('session');
		define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);
		ROOT_PATH."/third_party/dompdf/dompdf_config.inc.php";
    }
    public function index() 
    {
	$cek=$this->session->userdata('control');
	if(!empty($cek))
	{
	$dir = 'copy_moq_po';
		if (is_dir($dir)){
		  $jumlah=0;
			if ($dh = opendir($dir)){
			 while (($file = readdir($dh)) !== false){
				if(($file)=="." or ($file)==".."){ " ";} else { $file."<br>";}
				$jumlah=$jumlah+1;  
				}
				$a= $jumlah-2;
				$po['done']=$a;
			}
		}
	$dir = 'moq_po';
		if (is_dir($dir)){
			$jumlah=0;
			if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				if(($file)=="." or ($file)==".."){ " ";} else { $file."<br>";}
				$jumlah=$jumlah+1;  
				}
				$o= $jumlah-2;
			}
		}
		if (($jumlah)==0){ 
		$o=0;
		}else{
		$po['order']=$o;
		$po['get_po']=$this->po_model->get_po();
		$po['data_po'] = 'data_po.php';
        $this->load->view('index',$po);  
		}   	
    }
	else
	{
		redirect('admin/login');
	}
}
	
 public function rule_safety_stock($item)
    {
     return $this->po_model->search_itm($item); 
    } 
 public function cek_item_exist($item,$so) //ini untuk cek item apakah ada apa tidak
   {
		$cek_item=$this->po_model->search_itm($item);
		if(empty($cek_item))
		   {
			echo "ada item yang tidak terdaftar";
			error_reporting(0);
		   }
		    else
		   {
		    $this->po_model->save_so($so);
		   }
   }
 public function save_detil_po($detil_po) // ini untuk save po detil 
  {
	 if(isset($detil_po['kode_suplier']))
	 {
	   $this->po_model->simpan_detil_po($detil_po);
	 }
  }	 
 public function purchase_order(){
 $dir = "moq_po";
			$cek=0;
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
				$cek=$cek+1;  
				if($file != ".." && $file != "."){
					$a="moq_po/$file";
					$file="$a";
					rename($a,$file);
					$url=$file;
					$new="copy_".$file;
				  }
			   }
			 $cek_file= $cek-2;
		  }
			closedir($dh);
	if(($cek_file)==0){
	    //action file false; 
		redirect('mli');
	}
	else
	{
		$lines2 = file($a);
		$counter2=0;		
		foreach ($lines2 as $line_num => $line) {
			$baris2[++$counter2] = $line;
			}
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="E31"){
					$due['ddate']=substr($baris2[$i],96,9);
					}
					if(($selection)=="A21")$data['tt']=$no=$get_item=substr($baris2[$i],80,3);
				}
		
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="A11"){
					$data['AMS_PO']=$no=$get_item=substr($baris2[$i],51,8);
					$data['cus_po']=$no=$get_item=substr($baris2[$i],107,25);
					$data['ordr']=$no=$get_item=substr($baris2[$i],43,8);
					$data['cnee']=$no=$get_item=substr($baris2[$i],91,8);
					$data['po_date']=$no=$get_item=substr($baris2[$i],200,8);
					$data['dest']=$no=$get_item=substr($baris2[$i],240,3);
					$data['dlvy']=$no=$get_item=substr($baris2[$i],227,8);
					$data['dlv']=$no=$get_item=substr($baris2[$i],235,5);
					$data['fm']=$no=$get_item=substr($baris2[$i],170,30);
					$this->po_model->simpan_po($data);
		}} $line_peslid=0; $l=0;
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="E11"){
					$so['ams_so_det']=$no=$get_item=substr($baris2[$i],51,8);
					$so['kode_item_so']=$item=$itm=substr($baris2[$i],80,20);
					$so['qty_item_so']=$qty=intval($get_item=substr($baris2[$i],142,5));
					$so['price_item_so']=$harga=intval($get_item=substr($baris2[$i],150,13));
					$so['so_cnee']=$data['cnee'];
					$so['so_number']='SO'.$data['cnee']."_".date('dmy');
					$due['so_number']='SO'.$data['cnee']."_".date('dmy');
					$this->po_model->save_so($so);
					$this->po_model->duedate_so($due);
					}  			
			}
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					$l=0;
					if(($selection)=="A11"){ 
					$l=$l+1;
					$do=$data['AMS_PO']=$no=$get_item=substr($baris2[$i],51,8);
					$last_po=$this->po_model->last_num_po();
					foreach($last_po as $nomor_po);
					$a=$nomor_po->po_nbr;
					$angka=substr($a,3);
					$po_n=(int)$angka+2;
					$sup['no_po']=$po_n;
					// create S/O && create D/O
					$moq=$this->rule_safety_stock($item);
					foreach($moq as $row);
					 $moq_item_peslid=$row['moq'];
					 //safety_stock
					 $qty_item_peslid=$row['qty_item']; 
					 $qty_item_customer=$qty+ $row['safety_stock'];
					 $nomor=$row['kode_supplier'];
					 //proses
				    $blance=$qty_item_peslid-$qty_item_customer;
					$item_inve=$itm;
					$inventory=$blance;
					$this->po_model->update_inventory($inventory,$item_inve);
					//create Do.pdf
						 $get_do['dosupplier']=$this->po_model->getdo($do);
						 $html=$this->load->view('do_supplier',$get_do,true);
						 $dompdf = new DOMPDF();
						 $dompdf->set_paper("A4");
						 $dompdf->load_html($html);
						 $dompdf->render();
						 $file_save='./pdf_po/DO'.$nomor.$row['qty_item'].$l."PLI".$po_ams."_".date('dmy').'.pdf';
						 $output = $dompdf->output();
						 $file_to_save =$file_save;
						 file_put_contents($file_to_save, $output);  //end Do.pdf
						 
						 $get_so=$this->po_model->get_so($do); //create So.csv
						 $a="So Number,Sold-To,Ship-To,Order Date,Purchase Order,Remarks,Credit Terms,Part Number,Cost Number,Due ,Qty Open,UM,Price,Total"."\n";
						 foreach( $get_so as $row){ //Create SO.csv
						 $a.=$row['so_number'].","."'".$row['ordr'].","."'".$row['cnee'].",".$row['dlvy'].",".$row['ams_so_det'].",".$row['dlv'].",".$row['tt'].",".$row['kode_item_so'].","."0".",".
						 $row['due_date_so'].",".$row['qty_item_so'].","."PC".",".$row['price_item_so'].","."0".",".","."\n";
						 }
						 $file = './doc_so/'.$do."$row[so_number]".$l++.".csv";
						 file_put_contents($file,$a);// end So.csv
						 
					}
				}
		
		}
				copy($url,$new);
				unlink($url);
			   // redirect('mli/send_po_do');
	}
 public function send_po_do(){
 $dir = "pdf_po/";
		if (is_dir($dir)){
		  $dh = opendir($dir);
			while (($file = readdir($dh)) !== false){
			$suplier=substr($file,2,8);	
			$doc=substr($file,0,10);	
			if(($suplier)=='PIZ00002'){
			   if(isset($file)){
					if(($doc)=='POPIZ00002'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					copy($filepo,$done_po);
					}
					if(($doc)=='DOPIZ00002'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
					copy($file_do,$done_do);
				    }
			   } 
			    $to = array('muhammad.syarifuddin@mli.panasonic.co.id'); 
				// $to = array('mark.he@tospolighting.com',' yuki.ying@tospolighting.com','tim.huang@tospolighting.com','kiki.sun@tospolighting.com','amy.shen@tospolighting.com');
		    }elseif(($suplier)=='PIL00003'){
			   if(isset($file)){
					if(($doc)=='POPIL00003'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					copy($filepo,$done_po);
					}
					if(($doc)=='DOPIL00003'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
					copy($file_do,$done_do);
				    }
			   } 
		        $to = array('nanik.haidaroh@mli.panasonic.co.id');
		       // $to = array('zhuguangyang.lkl@lekise.co.th');
			   }elseif(($suplier)=='LAM00001'){
			   if(isset($file)){
					if(($doc)=='POLAM00001'){
					$filepo="pdf_po/".$file;
					$done_po='finish_po/'.$file;
					copy($filepo,$done_po);
					}
					if(($doc)=='DOLAM00001'){
					$file_do="pdf_po/".$file;
					$done_do='doc_do_finish/'.$file;
					copy($file_do,$done_do);
				    }
			   } 
		        $to = array('muhammad.syarifuddin@mli.panasonic.co.id');
		       // $to = array('rattana_s@lamptan.co.th','kijsada@lamptan.co.th','trading@lamptan.co.th');
			   }
	  }
		if(isset($filepo))
		{
			$filepo;
		}else
		{
			$filepo="";
		}
		if(isset($file_do))
		{
			$file_do;
		}else
		{
			$file_do="";
		}
	    $this->email($to,$filepo,$file_do);
		//unlink($file_do);
		if(!empty($filepo)){
		unlink($filepo);
	   }
	  // redirect('mli/cel');
 }
 }
  public function email($to,$filepo,$file_do){
  $nomor=substr($filepo,18,9);
 $message="Dear Sir/Madam,
Please find as attachment.
PESLID PO: $nomor

Thank you and have a nice day.
------------------------------------------------------------
This e-mail is automatically sent from the system to the registered address.
Please do not reply to the sender.
------------------------------------------------------------
Peslid Chukai.
PT. Panasonic Lighting Indonesia
";
 				$_POST['subject']=substr($filepo,7,50);
				$_POST['message']= $message;
				$_POST['email']='peslid_chukai@mli.panasonic.co.id';
				$_POST['name']='System Chukai';
				$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => 'mli-svr-010.intranet.co.id',
				'smtp_user' => 'peslid_chukai@intranet.co.id',
				'smtp_pass' => 'P4nasonic',
				'smtp_port' => 25,
				'mailtype' => 'text',
				'newline'   => "\r\n" // kode yang harus di tulis pada konfigurasi controler email
					));
			$cc = array('990969@mli.panasonic.co.id');
			$bcc = array('muhammad.syarifuddin@mli.panasonic.co.id' );
			$this->email->from($_POST['email'],$_POST['name'])
				->to($to) 
				//->cc($cc)
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
}public function cel(){
$dir = "pdf_po/";
			$cek=0;
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
				$cek=$cek+1;  
			}
			 $cek_file= $cek-2;
		  }
			closedir($dh);
	if(($cek_file)==0){
	    //action file false; 
		redirect('mli');
	}else{
		redirect('mli/send_po_do');
	}
}
 public function detil($po,$rev)
 { 
   $po_detil['detil']=$this->po_model->get_podetil($po,$rev);
   $po_detil['po_detil']='po_detil.php';
   $this->load->view('index.php',$po_detil);
 }
} 