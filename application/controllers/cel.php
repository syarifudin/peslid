<?php
//echo $id_nums = array($itm);
				//$item['data_item']=$this->po_model->cek_po($itm);
			/*	foreach($item['data_item'] as $da){
				 $da->vd_addr."<br>";
				// $b=$da->pc_part."<br>";
				// $c=$da->pc_amt."<br>";
				 //$e=$da->vd_sort."<br>";
				if(($da->vd_addr)=='PIZ00002'){
				// generate file pdf................//
				// Load all views as normal
				$html=$this->load->view('viewfile',$item,true);
				$dompdf = new DOMPDF();
				$dompdf->set_paper("A4");
				$dompdf->load_html($html);
				$dompdf->render();
				$file_save='./pdf_po/POPIZ00002'.date('dmy').'.pdf';
				$output = $dompdf->output();
				$file_to_save =$file_save;
				file_put_contents($file_to_save, $output);
				}
				if(($da->vd_addr)=='PIL00003'){
				$html=$this->load->view('viewfile',$item,true);
				$dompdf = new DOMPDF();
				$dompdf->set_paper("A4");
				$dompdf->load_html($html);
				$dompdf->render();
				$file_save='./pdf_po/POPIL00003'.date('dmy').'.pdf';
				$output = $dompdf->output();
				$file_to_save =$file_save;
				file_put_contents($file_to_save, $output);
				}
				}*/

		/*$this->po_model->simpan_po($data);
		copy($url,$new);
		unlink($url);
		// generate file pdf................//
		//define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);
		//ROOT_PATH."/third_party/dompdf/dompdf_config.inc.php";
		// Load all views as normal
		$html=$this->load->view('viewfile',$data,true);
		$dompdf = new DOMPDF();
		$dompdf->set_paper("A4");
		$dompdf->load_html($html);
		$dompdf->render();
		$file_save='./pdf_po/PO'.date('dmy').'.pdf';
		$output = $dompdf->output();
		$file_to_save =$file_save;
		file_put_contents($file_to_save, $output);
		//home
		redirect('Mli');*/
		/*public function pdf() {	
	$this->load->library('dompdf_gen');
	//define('ROOT_PATH',$_SERVER['DOCUMENT_ROOT']);
	//ROOT_PATH."/third_party/dompdf/dompdf_config.inc.php";
		// Load all views as normal
	$html=$this->load->view('viewfile','',true);
	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4");
    $dompdf->load_html($html);
    $dompdf->render();
	$output = $dompdf->output();
    $file_to_save = './pdf_po/file.pdf';
    file_put_contents($file_to_save, $output);
		}*/
		  public function sent_email1(){
	$dir = "pdf_po/";
		if (is_dir($dir)){
		  $dh = opendir($dir);
			while (($file = readdir($dh)) !== false){
			$suplier=substr($file,2,8);	
			 if(($suplier)=='PIL00003'){
				if(isset($file)){
			    $file_po="pdf_po/".$file;
				$to = array('nanik.haidaroh@mli.panasonic.co.id');
				$this->email($to,$file_po);
				unlink($file_po);}else{exit;}
			  }
		  }
	   }
 }
 //**Create po_lks
					if(($cek['vd_addr'])=='PIL00003'){
						$html=$this->load->view('po_lks','',true);
						$dompdf = new DOMPDF();
						$dompdf->set_paper("A4");
						$dompdf->load_html($html);
						$dompdf->render();
						$file_save='./pdf_po/POPIL00003_'."PLI".$po_n."_".date('dmy').'.pdf';
						$output = $dompdf->output();
						$file_to_save =$file_save;
						file_put_contents($file_to_save, $output);
						}
						
 public function html(){
 //$this->po_model->cek_item();
   //$this->load->view('DO_supplier');
    /*$dir="//Pli-svr-002/gis/SALES/POChukai";
    if (is_dir($dir)){
    if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
      echo "filename:" . $file . "<br>";
    }
    closedir($dh);
    }
   }*/
    public function sent_email(){
	$dir = "pdf_po/";
		if (is_dir($dir)){
		  $dh = opendir($dir);
			while (($file = readdir($dh)) !== false){
			$suplier=substr($file,2,8);	
			 if(($suplier)=='PIZ00002'){
			 if(isset($file)){
			    $file_po="pdf_po/".$file;
				$to = array('muhammad.syarifuddin@mli.panasonic.co.id');
				$this->email($to,$file_po);
				$done_po="finish_po/".$file;
				//copy($file_po,$done_po);
				//unlink($file_po);
				}else{exit;}
				 }elseif(($suplier)=='PIL00003'){
				  if(isset($file)){
			    $file_po="pdf_po/".$file;
				$to = array('nanik.haidaroh@mli.panasonic.co.id');
				$this->email($to,$file_po);
				$done_po="finish_po/".$file;
				copy($file_po,$done_po);
				unlink($file_po);
				}else{exit;}
			  }elseif(($suplier)=='PIL00004'){
			    if(isset($file)){
			    $file_po="pdf_po/".$file;
				$to = array('nanik.haidaroh@mli.panasonic.co.id');
				$this->email($to,$file_po);
				$done_po="finish_po/".$file;
				//copy($file_po,$done_po);
				//unlink($file_po);
		      }
		   }
	    } 
    }
 }
 }	
public function baca()
	{
		// Membuka direktori dan membaca dan menampilkan isinya
		$dir = "po";
		if (is_dir($dir)) {
			$cek=0;
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
				$cek=$cek+1;  
				if($file != ".." && $file != "."){
					$a="po/$file";
					$po="$file";
					$file="$a";
					rename($a,$file);
					$url=$file;
					$new="copy_".$file;
				  }
				}
			 $cek_file= $cek-2;
		closedir($dh);
		  }
	  }
		if(($cek_file)==0){
			echo "tidak file ada";
			redirect('mli');
		}else{
			// Read 14 characters starting from the 21st character
			$data['AMS_PO'] =$amspo= file_get_contents($url, NULL, NULL, 51, 8);
			$due['AMS_PO'] = file_get_contents($url, NULL, NULL, 51, 8);
			$data['ordr'] = file_get_contents($url, NULL, NULL, 43, 8);
			$data['cnee'] = file_get_contents($url, NULL, NULL, 91, 8);
			$cnee=$data['cnee'];
			$sup['cnee']=$this->po_model->get_cnee($cnee);
			$data['dest'] = file_get_contents($url, NULL, NULL, 240, 3);
			$data['dlvy'] = file_get_contents($url, NULL, NULL, 200, 8);
			$data['dlv']  = file_get_contents($url, NULL, NULL, 235, 5);
			$data['TT']   = file_get_contents($url, NULL, NULL, 1, 1);
			$data['fm']   = file_get_contents($url, NULL, NULL, 170, 30);
			//save master PO
			$this->po_model->simpan_po($data);
			$lines2 = file($a);
			$counter2=0;
			foreach ($lines2 as $line_num => $line) {
			   $baris2[++$counter2] = $line;
				}
			//get last num_po
				    $last_po=$this->po_model->last_num_po();
					foreach($last_po as $nomor_po);
					$a=$nomor_po->po_nbr;
					$angka=substr($a,3);
					$po_n=(int)$angka+2;
					$sup['no_po']=$po_n;
					$line=1;
			        //Untuk memanggil line tertentu bisa kita panggil array-nya
				    for($i=1;$i<=$counter2;$i++){
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="E31"){
					$line=$line+1;
					$due['ddate']=substr($baris2[$i],96,9);
					}
					$selection=$get_item=substr($baris2[$i],14,3);
					if(($selection)=="E11"){
					$data['line']=$no=$get_item=substr($baris2[$i],75,5);
					$data['itm']=$itm=substr($baris2[$i],80,20);
					$data['qty']=$qty=intval($get_item=substr($baris2[$i],142,5));
					$data['harga']=$harga=intval($get_item=substr($baris2[$i],150,13));
					$item['get']=$this->po_model->cek_po($itm);	
						foreach($item['get'] as $cek){	
						$data['suplier']=$cek['vd_addr'];
						$data['pc_amt']=substr($cek['pc_amt'],0,5);
					//** Setting nomor po 
						$data['no_po']=$po_n;
						$data['lin_peslid']=$line;
						$detil_po[]=$data;
						$this->po_model->simpan_detil_po($detil_po);
					}
					//**update duedate
					$du_date[]=$due;
					$this->po_model->duedate($du_date);	
					//**Create po_tospo
					    $kode_supplier=$cek['vd_addr'];
						$sup['supplier']=$this->po_model->get_address($kode_supplier);
						$sup['vendor']=$cek['vd_addr'];
						$html=$this->load->view('po_supplier',$sup,true);
						$dompdf = new DOMPDF();
						$dompdf->set_paper("A4");
						$dompdf->load_html($html);
						$dompdf->render();
						$file_save='./pdf_po/PO'."$cek[vd_addr]"."PLI".$po_n."_".date('dmy').'.pdf';
						$output = $dompdf->output();
						$file_to_save =$file_save;
						file_put_contents($file_to_save, $output);
					//**export data to CSV
					 $csv['ams']=$amspo;
					 $getcsv[]=$csv;
					 $get_csv=$this->po_model->get_csv($getcsv);
					 foreach ($get_csv as $rows){
						$data['peslid_num']=$rows['po_number_peslid'];
						$data['peslid_line']=$rows['line_peslid'];
						$data['duedate']=$rows['due_date_'];
						$data['itm_num']=$rows['item_number'];
					  }
					  $data_po[]=$data;
					 // end no Po **// 
						$d = "PO Customer,PO NBR, Supplier,Order date,Due Date,Buyer,Remarks,Line PLI,Line Cus,Item Number, Qty Order,UM,Ship To"."\n";
						foreach($data_po as $row){
						 //**line Peslid
						   $d.=$row['AMS_PO'].",".$row['peslid_num'].",".$row['suplier'].",".
						   $row['dlvy'].",".$row['duedate'].",".$row['itm_num'].",".$row['dlv'].","
						   .$row['peslid_line'].",".$row['line'].","
						   .$row['itm'].",".$row['qty'].","."UM".","."'".$row['cnee']."\n";
						}
						$file = 'po_csv/'.'fileposuplier.csv';
						chmod($file, 0777);
						file_put_contents($file,$d);
					//**end data export to csv
			     }
			}			
		}
		copy($url,$new);
		unlink($url);
		//$this->sent_email();
   } 
						public function coba(){
$lines2 = file('moq_po/pa20150304H08');
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
					$data['ordr']=$no=$get_item=substr($baris2[$i],43,8);
					$data['cnee']=$no=$get_item=substr($baris2[$i],91,8);
					$data['dest']=$no=$get_item=substr($baris2[$i],240,3);
					$data['dlvy']=$no=$get_item=substr($baris2[$i],200,8);
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
		redirect('mli/send_po_do');
		}
		
