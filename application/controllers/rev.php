<?php
class rev extends CI_Controller {
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
	public function save_detil_po($detil_po) // ini untuk save po detil 
    {
	 if(isset($detil_po['kode_suplier']))
	     {
		$this->po_model->simpan_detil_po($detil_po);
	     }
    }
	public function kirim_revisi(){
	 $dir = "moq_po_rev";
			$cek=0;
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
				$cek=$cek+1;  
				if($file != ".." && $file != "."){
					$a="moq_po_rev/$file";
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
					
				
				
					}
					
					
		$last_po=$this->po_model->last_num_po();
					foreach($last_po as $nomor_po);
				    $a=$nomor_po->po_number;
					$angka=substr($a,4);
					$po_n=(float)$angka;
					$nu=$po_n;
					
		for($i=1;$i<=$counter2;$i++){
		
					$selection=$get_item=substr($baris2[$i],14,3);
					
					if(($selection)=="A21"){
					$et=substr($baris2[$i],43,8);
					if(($et)=='00025006'){
					 $eta['eta']=substr($baris2[$i],180,9); 
					 $eta['ams_']=$no=$get_item=substr($baris2[$i],51,8);
					$this->po_model->simpan_eta($eta);
					}
					}
					if(($selection)=="B11"){
					$ce=substr($baris2[$i],43,8);
					if(($ce)=='00025006'){
					 $case['ams_case']=substr($baris2[$i],51,8);
					 $case['case0']=substr($baris2[$i],80,30);
					 $case['case1']=substr($baris2[$i],110,30);
					 $case['case2']=substr($baris2[$i],140,30);
					 $case['case3']=substr($baris2[$i],170,30);
					 $case['case4']=substr($baris2[$i],200,30);
					 $case['case5']=substr($baris2[$i],230,30);
					 $case['case6']=substr($baris2[$i],260,30);
					$this->po_model->simpan_case_mark($case);
					}
					}
					if((($selection)=="A61")){
					$data['rev_remark']=substr($baris2[$i],80,50);}
					if(($selection)=="A11"){
					$supplier_code=substr($baris2[$i],43,8);
					if(($supplier_code)=='00025006'){
					$sup['no_po']=$nu=$nu+1;
					if(strlen($nu)==3){$po="PLIC0".$nu;}elseif(strlen($nu)==2){$po="PLIC00".$nu;}
					$data['AMS_PO']=$no=$get_item=substr($baris2[$i],51,8);
					$number['pc_order_number']=$no=$get_item=substr($baris2[$i],51,8);
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
					$number['po_number']=$po;
				    $this->po_model->save_po_number($number);
				    $this->po_model->simpan_po($data);
				    }
					}
					if((($selection)=="A61")){
					 $rev['ams_po']=substr($baris2[$i],51,8);
					 $rv['rev_remark']=substr($baris2[$i],80,50);
					 $rev['date_po']=date('d-M-Y');
					 $this->po_model->update_rev_po($rev,$rv);
					}
					if(($selection)=="E11"){
					$c_po['cus_po']=substr($baris2[$i],188,25);
					$id_=substr($baris2[$i],51,8);
					$this->po_model->update_po_customer($c_po,$id_);
					}
		}	$l=0;
					
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="A11"){$cnee=$no=$get_item=substr($baris2[$i],91,8);}
					if(($selection)=="E11"){
					$order=substr($baris2[$i],43,8);
					if(($order)=='00025006'){
					$item=$itm=substr($baris2[$i],80,20);
					$price_item=$this->po_model->search_itm($item,$cnee);
					foreach( $price_item as $prc){
						if(isset($prc['price'])){
						$detil_po['item_number']=substr($baris2[$i],80,20);
						$detil_po['ams_po_det']=$no=$get_item=substr($baris2[$i],51,8);
						$due['ams_po_det']=$no=$get_item=substr($baris2[$i],51,8);					
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
					}
					}					
			}
			
		for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					$l=0;
					if(($selection)=="A11"){
					$supplier=substr($baris2[$i],43,8);
					if(($supplier)=='00025006'){					
					$l=$l+1;
					$nu=$nu+1;
					$po=$data['AMS_PO']=substr($baris2[$i],51,8);
						$sup['dlv_tt']=$this->po_model->cek_po_($po);
						 $get_p=$this->po_model->getpo_rev($po);
						 $sup['case']=$get_p;
						 foreach($get_p as $r);
						 $sup['ams_po']=$po;
						 $sup['vendor']=$r['kode_suplier'];
						 $kode_supplier=$r['kode_suplier'];
						 $cnee=$r['cnee'];
						 $sup['cnee']=$this->po_model->get_cnee($cnee);
						 $re=$this->po_model->count_rev($po);
						 foreach($re as $rv);
						 $rvi=$rv['rv'];
						 $sup['supplier']=$this->po_model->get_address($kode_supplier);
						 $html=$this->load->view('po_',$sup,true);
						foreach($sup['dlv_tt'] as $nomor);
							$dompdf = new DOMPDF();
							$dompdf->set_paper("A4");
							$dompdf->load_html($html);
							$dompdf->render();
							$canvas = $dompdf->get_canvas();
							$font = Font_Metrics::get_font("helvetica", "bold");
							$canvas->page_text(500, 20, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
						 $file_save='./pdf_po/PO'.$kode_supplier.$nomor['po_number']."-".$nomor['ams_po']."_".date('dmy').$rvi.$nomor['rev'].'.pdf';
						 $output = $dompdf->output();
						 $file_to_save =$file_save;
						 file_put_contents($file_to_save, $output); 
			}	} 
} 
				for($i=1;$i<=$counter2;$i++){
									$selection=$get_item=substr($baris2[$i],14,3);
									$l=0;
									if(($selection)=="A11"){ 
									$getcsv=$data['AMS_PO']=substr($baris2[$i],51,8);
									$get_csv=$this->po_model->get_csv($getcsv); //** Create PO.CSV -> Peslid
						$d="PO NBR,Supplier,Order date,Due Date,Buyer,Remarks,Line,Item  Number,QtyOrder,UM"."\n";
						$l=1;					
						 foreach($get_csv as $row){
						 $ams_po=$row['ams_po'];
						 $st['stat_po']="close";
						 $date_po=$row['date_po'];
						 $stt['stat_po_']="close";
						 $date_po_=$row['date_po'];
						$d.=$row['po_number'].",".$row['kode_suplier'].",".
						date('m-d-Y',strtotime($row['dlvy'])).",".$row['due_date_'].","."301367".",".$row['dlv'].",".
						$l++.",".$row['item_number'].",".$row['qty_item'].","."PC".","."\n";
						}
						$file = 'po_csv/PO_'.$row['po_number']."_".$ams_po.'.csv';
						file_put_contents($file,$d);// end po.csv
					    $this->po_model->update_stat_po($ams_po,$st,$date_po);
						$this->po_model->update_stat_po_($ams_po,$stt,$date_po_);
				}
		}  
			copy($url,$new);
			unlink($url); 
	}
}	
}