<?php
class Ex extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('po_model');
		$this->load->library('session');
        $this->load->library('excel');
		$this->load->library('dompdf_gen');
		$this->load->library('email');
		define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);
		ROOT_PATH."/third_party/dompdf/dompdf_config.inc.php";
		}
	public function index(){
	$data['excel']='upload_forecast.php';
	$this->load->view('index',$data);	
	}	
	public function excel(){
	
		$file_ex=$_FILES["ex"]["name"];
		   if(!empty($file_ex))
		   {
		   $file ='./sales_forecast/'.$_FILES["ex"]["name"];
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
		   $this->po_model->sales_forecast($data); 
		 }
		 else
		 {
		  $this->input->post('global_code');
		  $this->input->post('item');
		  $this->input->post('periode');
		 }
		
		}
	public function trans_forcast($po,$des,$mod)
		{
		$data['ctrlpo_detil']=$this->po_model->ctrl_po_detil($po,$des,$mod);
		print_r($data['ctrlpo_detil']);
		}
	public function uplooad_reply_po()
	{
	   if(!empty($_FILES["ex_po"]["name"]))
	   {
	   $file ='/sales_forecast/'.$_FILES["ex_po"]["name"];
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
	   $this->po_model->upload_reply_po($data);
	 // redirect('admin/send_po_to_supplier');
	 }
	 else
	 {
	 $item=$this->input->post('item');
	 $periode=$this->input->post('periode');
	 $data['src_item']=$this->po_model->srcitem($item,$periode);
	 $data['main_item']='main_item.php';
	 $this->load->view('index',$data);
	 }
	 }
	 public function update_main_item()
	 {
		 $mstr_item_number=$this->input->post('mstr_item_number');
		 $data['descr']=$this->input->post('descr');
		 $data['date_reply_']=$this->input->post('date_reply_');
		 $data['price']=$this->input->post('price');
		 $data['kode_supplier']=$this->input->post('kode_supplier');
		 $data['qty_item']=$this->input->post('qty_item');
		 $this->po_model->update_main_item_($data,$mstr_item_number);
	 }
	 
	public function save_detil_po($detil_po) // ini untuk save po detil 
    {
		if(isset($detil_po['kode_suplier']))
	     {
			$this->po_model->simpan_detil_po($detil_po);
	     }
    }
	public function ordr()
	{
		$ordr='00025111';
		$data=$this->po_model->cek_order($ordr);
	} 
	
	public function kirim(){
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
					if(($selection)=="E91"){
					$due['ddate']=substr($baris2[$i],96,9);
					}
					if(($selection)=="A21")
					$data['tt']=$no=$get_item=substr($baris2[$i],80,3);
				
				if((($selection)=="A61"))
					$data['pymnt_term']=substr($baris2[$i],138,40);
					}
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="A21"){
					
					 $eta['eta']=substr($baris2[$i],181,8); 
					 $eta['ams_']=$no=$get_item=substr($baris2[$i],51,25);
					$this->po_model->simpan_eta($eta);
					
					}
					if(($selection)=="B11"){
					
					 $case['ams_case']=substr($baris2[$i],51,25);
					 $case['case0']=substr($baris2[$i],80,30);
					 $case['case1']=substr($baris2[$i],110,30);
					 $case['case2']=substr($baris2[$i],140,30);
					 $case['case3']=substr($baris2[$i],170,30);
					 $case['case4']=substr($baris2[$i],200,30);
					 $case['case5']=substr($baris2[$i],230,30);
					 $case['case6']=substr($baris2[$i],260,30);
					$this->po_model->simpan_case_mark($case);
					}
					if(($selection)=="A11"){
					$data['AMS_PO']=$no=$get_item=substr($baris2[$i],51,25);
					$data['ordr']=$no=$get_item=substr($baris2[$i],43,8);
					$data['accte']=substr($baris2[$i],83,8);
					$data['cnee']=$no=$get_item=substr($baris2[$i],91,8);
					$data['po_date']=$no=$get_item=substr($baris2[$i],200,8);
					$data['dest']=$no=$get_item=substr($baris2[$i],240,3);
					$data['dlvy']=$no=$get_item=substr($baris2[$i],227,8);
					$data['dlv']=$no=$get_item=substr($baris2[$i],235,5);
					$data['fm']=$no=$get_item=substr($baris2[$i],170,30);
					$data['date_po']=date('d-M-Y');
					$data['stat_po']="open";
				    $this->po_model->simpan_po($data);
					}
					if(($selection)=="E11"){
					$c_po['cus_po']=substr($baris2[$i],188,25);
					$id_=substr($baris2[$i],51,25);
					$this->po_model->update_po_customer($c_po,$id_);
					}
		}	$l=0;
		for($i=1;$i<=$counter2;$i++)
		{
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="A11"){$cnee=$no=$get_item=substr($baris2[$i],91,8);}
					if(($selection)=="E11")
					{
					$ams_queue=substr($baris2[$i],51,25);
					$item=$itm=substr($baris2[$i],80,20);
					$price_item=$this->po_model->search_itm($item,$cnee);
					if(count($price_item)>0)
					{
						foreach( $price_item as $prc)
						{
							$detil_po['item_number']=substr($baris2[$i],80,20);
							$detil_po['ams_po_det']=$no=$get_item=substr($baris2[$i],51,25);
							$due['ams_po_det']=$no=$get_item=substr($baris2[$i],51,25);					
							$detil_po['qty_item']=$qty=intval($get_item=substr($baris2[$i],141,6));
							$detil_po['price_item']=$harga=intval($get_item=substr($baris2[$i],150,14));
							$detil_po['kode_suplier']=$prc['kode_supplier'];
							$detil_po['price_item_peslid']=$prc['price'];
							$detil_po['standart_packing']=$prc['packing'];
							$detil_po['date_shipment']=date('Y-m-d');	
							$detil_po['date_po_']=date('d-M-Y');	
							$detil_po['stat_po_']="open";
							$detil_po['pr_pc']=intval(substr($baris2[$i],164,7));					
							$this->save_detil_po($detil_po);
							$this->po_model->duedate($due);	
						}				
					}
					  else
					{
						$que['ams_po_queue']=$ams_queue;
						$que['item_queue']=$item;
						$que['cnee_queue']=$cnee;
						$que['date_queue']=date('Y-m-d');
						$this->po_model->save_queue($que);
					}	
				}					
		}
		for($i=1;$i<=$counter2;$i++)
		{
					$selection=$get_item=substr($baris2[$i],14,3);
					$l=0;   
					if(($selection)=="A11"){		
					$l=$l+1;
					$po=$data['AMS_PO']=substr($baris2[$i],51,25);
					$cek_que=$this->po_model->get_queue($po);
					foreach($cek_que as $cek);
						if($cek['jml']==0){
						$sup['dlv_tt']=$this->po_model->cek_po_($po);
						 $get_p=$this->po_model->getpo($po);
						 $sup['case']=$get_p;
						foreach($get_p as $r){
						$sup['ams_po']=$r['ams_po'];
						$sup['vendor']=$r['kode_suplier'];
						$kode_supplier=$r['kode_suplier'];
						$cnee=$r['cnee'];
						$sup['cnee']=$this->po_model->get_cnee($cnee);
						$sup['supplier']=$this->po_model->get_address($kode_supplier);
						$number['po_number']=$this->po_model->last_num_po();
						$number['pc_order_number']=$r['ams_po'];
						$number['supplier_code']=$r['kode_suplier'];
						$this->po_model->save_po_number($number);
						$num['supplier_code']=$r['kode_suplier'];
						$num['pc_order_number']=$r['ams_po'];
						$sup['po_number']=$this->po_model->get_number_po($num);
						$html=$this->load->view('po_',$sup,true);
						foreach($sup['dlv_tt'] as $nomor);
							$dompdf = new DOMPDF();
							$dompdf->set_paper("A4");
							$dompdf->load_html($html);
							$dompdf->render();
							$canvas = $dompdf->get_canvas();
							$font = Font_Metrics::get_font("helvetica", "bold");
							$canvas->page_text(500, 20, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
					 		$cus_po=substr($nomor['ams_po'],0,7);
					 	    $file_save='./pdf_po/PO'.$kode_supplier.$sup['po_number']."-".trim($cus_po)."_".date('dmy')."1".$nomor['rev'].'.pdf';
							$output = $dompdf->output();
							$file_to_save =$file_save;
							file_put_contents($file_to_save, $output); 
					}
				}	
			} 
		}
	for($i=1;$i<=$counter2;$i++){
									$selection=$get_item=substr($baris2[$i],14,3);
									$l=0;
									if(($selection)=="A11"){ 
									$getcsv=$data['AMS_PO']=substr($baris2[$i],51,25);
									$po=$getcsv;
									$cek_que=$this->po_model->get_queue($po);
									foreach($cek_que as $cek);
									if($cek['jml']==0){
									$data=$this->po_model->get_po_number($po);
									foreach($data as $rows){
									$p['pc_order_number']=$rows['pc_order_number'];
									$p['supplier_code']=$rows['supplier_code'];
									$get_csv=$this->po_model->get_csv($p); //** Create PO.CSV -> Peslid
						$d="PO NBR,Supplier,Order date,Due Date,Buyer,Bill To,Remarks,Line,Item  Number,QtyOrder,UM"."\n";
						$l=1;					
						 foreach($get_csv as $row)
						 {
						   $ams_po=$row['ams_po'];
						   $st['stat_po']="close";
						   $date_po=$row['date_po'];
						   $stt['stat_po_']="close";
						   $date_po_=$row['date_po'];
						   $d.=$row['po_number'].",".$row['kode_suplier'].",".
						   date('m-d-Y',strtotime($row['dlvy'])).",".$row['due_date_'].","."301367".","."00038274".",".$row['dlv'].",".
						   $l++.",".$row['item_number'].",".$row['qty_item'].","."PC".","."\n";
						}
						$file = 'po_csv/PO_'.$row['po_number'].'.csv';
						file_put_contents($file,$d);// end po.csv
						}
						
					 $this->po_model->update_stat_po($ams_po,$st,$date_po);
					$this->po_model->update_stat_po_($ams_po,$stt,$date_po_);
					}
			 	}
		    } 
			copy($url,$new);
			unlink($url); 	
			redirect('email/send_po_do');			
		}
}
	public function file(){
	$this->load->view('file/index');
	}
	public function data(){
	$this->load->view('file/data');
	}
	public function se_report(){
	$report['form_report']='send_report.php';
	$this->load->view('index',$report);
	}
	public function report_po(){
	$sup="PIZ00003";        //$sup=$this->input->post('supplier');  $tgl=$this->input->post('tgl');
	$tgl=date('d-M-Y', strtotime(date('d-M-Y'). ' -1 day')); 
	$report=$this->po_model->get_report($sup,$tgl);
	$no=0;
	$messege="|SNo|Purchase Ord |Customer Ord | T.Item |T.Qty |CRD |TptMode|Doc|R"."\n";
						 foreach( $report as $row){ //Create SO.csv
						 $no=$no+1;
						 $dlvy=date('d-M-Y',strtotime($row['dlvy']));
						 $messege.="| ".$no."|".$row['ams_po']."|".$row['cus_po']."|".$row['jml_item']."|".$row['qty_order']."|".$dlvy."|".$row['dlv']."|".$row['rev']."\n";
						 }
	$count=count($report);					 
	if(($no)==null){ echo "tidak ada pesan";}else					 
	{$this->send_reprt($messege,$count);}
	}
	public function send_reprt($messege,$count){
				$_POST['subject']="PURCHASE ORDER TRANSMISSION LIST (1 TO $count )";
				$_POST['message']= "TO : TOSPO || ATTN : Yuki , Amy , Kiki , Mark || Joko, Harjaka, Afan, Pipit.
".$messege."
Please Do Not Reply To This Email

PT. Panasonic Lighting Indonesia";
				$_POST['email']='peslid_chukai@mli.panasonic.co.id';
				$_POST['name']='PT. PANASONIC LIGHTING INDONESIA';
				$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => '137.40.52.112',
				'smtp_user' => 'peslid_chukai@mli.panasonic.co.id',
				'smtp_pass' => 'P4nasonic',
				'smtp_port' => 25,
				'mailtype' => 'text',
				'newline'   => "\r\n" // kode yang harus di tulis pada konfigurasi controler email
					));
			 $to = array('mark.he@tospolighting.com',' yuki.ying@tospolighting.com','tim.huang@tospolighting.com','kiki.sun@tospolighting.com','amy.shen@tospolighting.com');
			$cc = array('muhammad.syarifuddin@mli.panasonic.co.id','sri.harjaka@id.panasonic.com','Rudy.Iswahyudi@id.panasonic.com','990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','nanik.haidaroh@mli.panasonic.co.id','fujisaki.ryuzo@jp.panasonic.com');
			//$to = array('muhammad.syarifuddin@mli.panasonic.co.id');
			$this->email->from($_POST['email'],$_POST['name'])
				->to($to) 
				->cc($cc) 
				->subject($_POST['subject'])
				->message($_POST['message']);
			if ($this->email->send()) 
			{
				$this->session->set_flashdata('messege', 'Email Suksess.');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
        }
public function report_po_lks(){
	$sup="PIL00006";       
	$tgl=date('d-M-Y', strtotime(date('d-M-Y'). ' -1 day')); 
	$report=$this->po_model->get_report($sup,$tgl);
	$no=0;
	$messege="|SNo|Purchase Ord |Customer Ord | T.Item |T.Qty |CRD |TptMode|Doc|R"."\n";
						 foreach( $report as $row){ //Create SO.csv
						 $no=$no+1;
						 $dlvy=date('d-M-Y',strtotime($row['dlvy']));
						 $messege.="| ".$no."|".$row['ams_po']."|".$row['cus_po']."|".$row['jml_item']."|".$row['qty_order']."|".$dlvy."|".$row['dlv']."|".$row['rev']."\n";
						 }
	$count=count($report);					 
	if(($no)==null){ echo "tidak ada pesan";}else					 
	{$this->send_reprt_lks($messege,$count);}
	}
public function send_reprt_lks($messege,$count){
				$_POST['subject']="PURCHASE ORDER TRANSMISSION LIST (1 TO $count )";
				$_POST['message']= "TO : LKS || ATTN : Seby || Joko, Harjaka, Afan, Pipit.
".$messege."
Please Do Not Reply To This Email

PT. Panasonic Lighting Indonesia";
				$_POST['email']='peslid_chukai@mli.panasonic.co.id';
				$_POST['name']='PT. PANASONIC LIGHTING INDONESIA';
				$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => '137.40.52.112',
				'smtp_user' => 'peslid_chukai@mli.panasonic.co.id',
				'smtp_pass' => 'P4nasonic'
				'smtp_port' => 25,
				'mailtype' => 'text',
				'newline'   => "\r\n" // kode yang harus di tulis pada konfigurasi controler email
					));
			$to = array('zhuguangyang.lkl@lekise.co.th');
			$cc = array('muhammad.syarifuddin@mli.panasonic.co.id','sri.harjaka@id.panasonic.com','Rudy.Iswahyudi@id.panasonic.com','990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','nanik.haidaroh@mli.panasonic.co.id','fujisaki.ryuzo@jp.panasonic.com');
			$this->email->from($_POST['email'],$_POST['name'])
				->to($to) 
				->cc($cc) 
				->subject($_POST['subject'])
				->message($_POST['message']);
			if ($this->email->send()) 
			{
				$this->session->set_flashdata('messege', 'Email Suksess.');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
        }		
		
public function report_po_lamptan(){
	$sup="PIL00007";       
	$tgl=date('d-M-Y', strtotime(date('d-M-Y'). ' -1 day')); 
	$report=$this->po_model->get_report($sup,$tgl);
	$no=0;
	$messege="|SNo|Purchase Ord |Customer Ord | T.Item |T.Qty |CRD |TptMode|Doc|R"."\n";
						 foreach( $report as $row){ //Create SO.csv
						 $no=$no+1;
						 $dlvy=date('d-M-Y',strtotime($row['dlvy']));
						 $messege.="| ".$no."|".$row['ams_po']."|".$row['cus_po']."|".$row['jml_item']."|".$row['qty_order']."|".$dlvy."|".$row['dlv']."|".$row['rev']."\n";
						 }
	$count=count($report);					 
	if(($no)==null){ echo "tidak ada pesan";}else					 
	{$this->send_reprt_lamptan($messege,$count);}
	}
public function send_reprt_lamptan($messege,$count){
				$_POST['subject']="PURCHASE ORDER TRANSMISSION LIST (1 TO $count )";
				$_POST['message']= "TO : LAMPTAN || ATTN : Rattana || Joko, Harjaka, Afan, Pipit.
".$messege."
Please Do Not Reply To This Email

PT. Panasonic Lighting Indonesia";
				$_POST['email']='peslid_chukai@mli.panasonic.co.id';
				$_POST['name']='PT. PANASONIC LIGHTING INDONESIA';
				$this->email->initialize(array(
				'protocol' => 'smtp',
				'smtp_host' => '137.40.52.112',
				'smtp_user' => 'peslid_chukai@mli.panasonic.co.id',
				'smtp_pass' => 'P4nasonic',
				'smtp_port' => 25,
				'mailtype' => 'text',
				'newline'   => "\r\n" // kode yang harus di tulis pada konfigurasi controler email
					));
			$to = array('rattana_s@lamptan.co.th','kijsada@lamptan.co.th','trading@lamptan.co.th');
			$cc = array('muhammad.syarifuddin@mli.panasonic.co.id','sri.harjaka@id.panasonic.com','Rudy.Iswahyudi@id.panasonic.com','990969@mli.panasonic.co.id','fitriani.dewi@mli.panasonic.co.id','nanik.haidaroh@mli.panasonic.co.id','fujisaki.ryuzo@jp.panasonic.com');
			$this->email->from($_POST['email'],$_POST['name'])
				->to($to) 
				->cc($cc) 
				->subject($_POST['subject'])
				->message($_POST['message']);
			if ($this->email->send()) 
			{
				$this->session->set_flashdata('messege', 'Email Suksess.');
			}
			else
			{
				show_error($this->email->print_debugger());
			}
        }
}