<?php class Po_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
		$this->load->helper('array');
	}
	public function simpan_po($data)
	{
			 $ams=$data['AMS_PO'];
			 $this->db->select('*')
					->from('open_po')
					->where('ams_po',$ams);
				$query = $this->db->get();
				if ($query->num_rows() <= 0)
				{
				$data['rev']="0";
				$this->db->insert('open_po',$data); 
				}
				elseif($query->num_rows() == 1)
				{
				$data['rev']="1";
				$this->db->insert('open_po',$data);
				}
				elseif($query->num_rows() == 2)
				{
				$data['rev']="2";
				$this->db->insert('open_po',$data);
				}
				elseif($query->num_rows() == 3)
				{
				$data['rev']="3";
				$this->db->insert('open_po',$data);
				}
	}
	public function count_rev($po)
	{
	  $query = $this->db->query("select COUNT(*) as rv from open_po  where ams_po='$po'");
		return $query->result_array();	
	}
	public function simpan_case_mark($case)
	{
	$this->db->insert('pc_case_mark',$case);
	}
	public function simpan_eta($eta)
	{
		$et=$eta['ams_'];
		$etaa=$eta['eta'];
		$this->db->select('*')
			 ->from('eta')
			 ->where('ams_',$et);
		$query = $this->db->get();
		if ($query->num_rows() <= 0){
		$this->db->insert('eta',$eta); 
		}
		else
		{
		$this->db->where('ams_',$et)
	         ->update('eta',$eta);
		}
	}
	public function update_rev_po($rev,$rv)
	{
	 $this->db->where('ams_po',$rev['ams_po'])
			  ->where('date_po',$rev['date_po'])
	          ->update('open_po',$rv);
	}
	public function save_queue($que)
	{
	$this->db->insert('po_queue',$que);
	}
	public function data_queue()
	{
		$this->db->select('*')
			  ->from('po_queue');
			  $query = $this->db->get();
	   return $query->result_array();
	}
	public function update_stat_po($ams_po,$st,$date_po)
	{
	 $this->db->where('ams_po',$ams_po)
			  ->where('date_po',$date_po)
	          ->update('open_po',$st);
	}
	public function update_stat_po_($ams_po,$stt,$date_po_)
	{
	 $this->db->where('ams_po_det',$ams_po)
			  ->where('date_po_',$date_po_)
	         ->update('open_po_detil',$stt);
	}
	public function update_po_customer($c_po,$id_){
	$this->db->where('ams_po',$id_)
	         ->update('open_po',$c_po);
	}
	public function save_po_number($number) // baru harus dicopi ke server 26
	{
	$pc_order=$number['pc_order_number'];
	$supplier_code=$number['supplier_code'];
	$this->db->select('*')
			 ->from('pc_po_number')
			 ->where('pc_order_number',$pc_order)
			 ->where('supplier_code',$supplier_code);
    $query = $this->db->get();
	if ($query->num_rows() <= 0)
	 $this->db->insert('pc_po_number',$number);
	}
	public function get_po_number($po) // baru harus dicopi ke server 26
	{
		$this->db->select('*')
			 ->from('pc_po_number')
			 ->where('pc_order_number',$po);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_number_po($num) // baru harus dicopi ke server 26
	{
		$A=$num['pc_order_number'];
		$B=$num['supplier_code'];
		$this->db->select('po_number')
			 ->from('pc_po_number')
			 ->where('pc_order_number',$A)
			 ->where('supplier_code',$B);
		$query = $this->db->get();
		$data=$query->result_array();
		foreach($data as $row){
		return $row['po_number'];
		}
	}	
	public function simpan_detil_po($detil_po){
	  
	  $ams=$detil_po['ams_po_det'];
	  $item=$detil_po['item_number'];
	  $this->db->select('*')
			 ->from('open_po_detil')
			 ->where('ams_po_det',$ams)
			 ->where('item_number',$item);
		$query = $this->db->get();
		if ($re=$query->num_rows() <= 0)
		{
		$detil_po['rev_']="0";
		$this->db->insert('open_po_detil',$detil_po);  
		}
		elseif($re=$query->num_rows() ==1)
		{
		$detil_po['rev_']="1";
		$this->db->insert('open_po_detil',$detil_po); 
		}
		elseif($re=$query->num_rows() ==2)
		{
		$detil_po['rev_']="2";
		$this->db->insert('open_po_detil',$detil_po); 
		}
		elseif($re=$query->num_rows() ==3)
		{
		$detil_po['rev_']="3";
		$this->db->insert('open_po_detil',$detil_po); 
		}
	}
	public function cek_po($itm)
	{
		$query = $this->db->query("select top 1* from openquery(qad_connect,
								'select pc.pc_part,pc.pc_amt,
								pc.pc_um from  pub.pc_mstr as pc
								where  pc.pc_part=''$itm''')");
		return $query->result_array();	
	}
	public function get_po(){
		$query = $this->db->query("select  *  from pc_consignee,open_po,pc_po_number where pc_consignee.global_code=open_po.cnee and pc_po_number.pc_order_number=open_po.ams_po");
		return $query->result_array();
	}
	public function get_address($kode_supplier)
	{
	$query=$this->db->query("select * from  orc_supplier  where ad_addr='$kode_supplier'");
	return  $query->result_array();
	}
	public function get_cnee($cnee)
	{
	$query=$this->db->query(" select top 1* from pc_consignee where global_code='$cnee'");
	return $query->result_array();
	}
	public function last_num_po(){ // wajib dicopy ke server 26
	$query=$this->db->query("select  top 1 po_number from pc_po_number  where po_number LIKE '%PC%' order by po_number DESC ");
	$data=$query->result_array();
	foreach($data as $row){
		$nu=(float)substr($row['po_number'],4)+1;
					if(strlen($nu)==3){$po="PC".date('y')."0".$nu;}
					elseif(strlen($nu)==2){$po="PC".date('y')."00".$nu;}
					elseif (strlen($nu)==1){$po="PC".date('y')."000".$nu;}
		return $po;
		}
	}
	public function duedate($due)
	{
			$du_date[]=$due;
			foreach($du_date as $row){
			$ams=$row['ams_po_det'];
			if(isset($row['ddate'])){
			$due=$row['ddate'];
			$du =date('Y-m-d',strtotime($due));
			$query = $this->db->query("update open_po_detil set due_date_='$du' 
			where ams_po_det='$ams'");
		}
	  }	
	}
	public function cek_po_($cek_po)
	{
	$this->db->select('*')
			  ->from('open_po as p')
			  ->join('open_po_detil od','od.ams_po_det=p.ams_po')
			  ->join('eta as e','e.ams_=p.ams_po')
			  ->join('pc_destination as de','de.city_code=p.dest')
			  ->join('eta as et','et.ams_=p.ams_po')
			  ->where('ams_po',$cek_po)
			  ->where('stat_po','open');
			  $query = $this->db->get();
	   return $query->result_array();
	}
	public function cek_po_rev($po){
	$this->db->select('*')
			  ->from('open_po as p')
			  ->join('pc_po_number as pc','pc.pc_order_number=p.ams_po')
			  ->join('open_po_detil od','od.ams_po_det=p.ams_po')
			  ->join('eta as e','e.ams_=p.ams_po')
			  ->join('pc_destination as de','de.city_code=p.dest')
			  ->join('eta as et','et.ams_=p.ams_po')
			  ->where('ams_po',$po)
			  ->where('stat_po','close');
			  $query = $this->db->get();
	   return $query->result_array();
	}
	public function get_csv($p){ //copy to server 26
	$this->db->select('*')
			  ->from('open_po as p')
			  ->join('pc_po_number as pc','pc.pc_order_number=p.ams_po')
			  ->join('open_po_detil od','od.ams_po_det=p.ams_po','od.date_po_=p.date_po_')
			  ->where('ams_po',$p['pc_order_number'])
			  ->where('ams_po_det',$p['pc_order_number'])
			  ->where('supplier_code',$p['supplier_code'])
			  ->where('kode_suplier',$p['supplier_code'])
			  ->where('stat_po','open')
			  ->where('stat_po_','open');
			  $query = $this->db->get();
	   return $query->result_array();
	}
	public function get_podetil($po,$rev)
	{
	$this->db->select('*')
			 ->from('open_po as a')
			 ->join('pc_consignee as pc','pc.global_code=a.cnee')
			 ->join('open_po_detil as b','b.ams_po_det=a.ams_po','right')
			 ->join('pc_po_number as c','c.pc_order_number=a.ams_po','right')
			 ->where('b.rev_',$rev)
			 ->where('a.rev',$rev)
			 ->where('c.po_number',$po);
			 $query = $this->db->get();
	return $query->result_array();
	}
	public function get_item()
	{
	$this->db->select('*')
			 ->from('pc_item_master')
			 ->where('status','ac');
			 $query=$this->db->get();
	return $query->result_array();		
	}
	public function get_queue($po)
	{
	$this->db->select('count(*) as jml')
			 ->from('po_queue')
			 ->where('ams_po_queue',$po);
			$query = $this->db->get();
	return $query->result_array();		
	}
	public function search_itm($item,$cnee){
	$this->db->select('top 1*')
			 ->from('pc_item_master')
			 ->where('mstr_item_number',$item)
			 ->where('destination',$cnee)
			 ->order_by('last_update','desc');
			 $query=$this->db->get();
	return $query->result_array();
	}
	public function search_itm_($item){
	$this->db->select('top 1*')
			 ->from('pc_item_master')
			 ->where('mstr_item_number',$item);
			 $query=$this->db->get();
	return $query->result_array();
	}
	public function update_inventory($inventory,$item_inve){
	  $this->db->set("qty_item", $inventory);
	  $this->db->set("last_update",date('Y-m-d'));
	  $this->db->where("mstr_item_number",$item_inve);
      $this->db->update("pc_item_master");
	}
	public function save_so($so){
	$this->db->insert('open_so_detil',$so); 
	}
	public function duedate_so($due){
	$du_date[]=$due;
			foreach($du_date as $row){
			$ams=$row['so_number'];
			if(isset($row['ddate'])){
			$due=$row['ddate'];
			$du =date('Y-m-d',strtotime($due));
			$query = $this->db->query("update open_so_detil set due_date_so='$du' where so_number='$ams'");
		}
	  }	
	}
	public function update_nopo($poup){
	$po_sup[]=$poup;
	foreach( $po_sup as $row){
	$query = $this->db->query("update open_po_detil set po_number_peslid='$row[po_number_peslid]'
			where ams_po_det='$row[ams_po_det]'");
		}
	}
	public function getdo($do){
	$this->db->select('top 1*')
			 ->from('open_po as a')
	         ->join('pc_consignee as pc','pc.global_code=a.cnee')
	         ->join('open_so_detil op','op.ams_so_det=a.ams_po','left')
			 ->where('a.ams_po',$do);
			 $query=$this->db->get();
	return $query->result_array();
	}
	public function get_so($do){
	$this->db->select('*')
			 ->from('open_po as a')
	         ->join('pc_consignee as pc','pc.global_code=a.cnee')
	         ->join('open_so_detil op','op.ams_so_det=a.ams_po','left')
			 ->where('a.ams_po',$do);
			 $query=$this->db->get();
	return $query->result_array();
	}
	public function get_di_detil($di){
	$this->db->select('*')
			 ->from('open_po as a')
			 ->join('pc_consignee as pc','pc.global_code=a.cnee')
			 ->join('open_so_detil as b','b.ams_so_det=a.ams_po','left')
			 ->join('pc_item_master pcm','pcm.mstr_item_number=b.kode_item_so','lesft')
			 ->where('a.ams_po',$di);
			 $query = $this->db->get();
	return $query->result_array();
	}
	public function get_user($user,$pass){
	$this->db->select('top 1 *')
			 ->from('orc_pc_user')
			 ->where('emp_id',$user)
			 ->where('password',$pass);
	$query = $this->db->get();
	return $query->result();
	}
	public function searchpo($po_number)
	{
		$this->db->select('top 1*')
				 ->from('open_po as o')
				 ->join('open_po_detil as po','po.ams_po_det=o.ams_po','left')
				 ->join('pc_po_number as p','p.pc_order_number=o.ams_po','left')
				 ->where('po_number',$po_number);
				  $query = $this->db->get();
		return $query->result_array();
	}
	public function user_view()
	{
	 $this->db->select('top 15*')
			  ->from('orc_pc_user');
	 $query = $this->db->get();
	 return $query->result_array();
	}
	public function save_user($user){
	 $this->db->insert('orc_pc_user',$user); 
	}
	public function edit_user($user)
	{
	$this->db->select('top 1 *')
			 ->from('orc_pc_user')
			 ->where('emp_id',$user);
			 $query = $this->db->get();
	return $query->result_array();
	}
	public function price_qad($item){
	$query = $this->db->query("select top 1* from openquery(qad_train,
								'select pc.pc_part,pc.pc_amt,
								pc.pc_um from  pub.pc_mstr as pc
								where  pc.pc_part=''$item''')");
		$data=$query->result_array();
		if (!empty($data))
		foreach($data as $row)
		 $qad['pc_part']=$row['pc_part'];
		 $qad['pc_amt']=number_format((float)$row['pc_amt'],2);
		 $qad['pc_um']=$row['pc_um'];
		return $qad;
     }
	 public function search_po_customer($ams_po,$st){
	 $query = $this->db->query("select * from open_po as o ,eta as e, open_po_detil as po ,
								pc_consignee p, pc_destination dest where 
								o.ams_po=po.ams_po_det and e.ams_=o.ams_po and o.rev=po.rev_ and 
								dest.city_code=o.dest
								and	p.global_code=o.cnee and ams_po='$ams_po' and o.rev='$st' ");
		return $query->result_array();
	 }
	 public function sales_forecast($data){
	 foreach($data as $key => $row)
	 { 
		$r['kode_model']=$row['A'];
		$r['global_code']=$row['B'];
		$r['request_forecast']=$row['C'];
		$r['reply_forecast']=$row['D'];
		$date=$row['E'];
		$r['date_reply'] =date('Y-m-d',strtotime($date));
		$this->db->insert('pc_sales_forecast',$r);
	   }
	}
	 public function upload_reply_po($data){
		$upload=1;
		foreach($data as $key => $row)
	 {
		$r['mstr_item_number']=$item=$row['A'];
		$r['descr']=$row['B'];
		$lastup=$row['C'];
		$r['last_update']=date('Y-m-d',strtotime($lastup));
		$r['qty_item']=$qt=$row['D'];
		$r['kode_supplier']=$row['E'];
		$r['moq'] =$row['F'];
		$r['safety_stock'] =$row['G'];
		$dtrply=$row['H'];
		$r['date_reply_'] =$dtr=date('Y-m-d',strtotime($dtrply));
		$r['start_date'] =$dtr=date('Y-m-d',strtotime($dtrply));
		$r['price']=(float)$row['I'];
		$r['destination']=$row['J'];
		$r['status']="ac";
		$this->db->insert('pc_item_master',$r); 
		
		//$this->db->set('qty_item','qty_item +'.$qt,false);
		//$this->db->set('date_reply_',$dtr);
		//$this->db->where('mstr_item_number',$item);
		//$this->db->update('pc_item_master');
		$upload++;
		}
		echo $upload-1;
	 }
	 public function get_sales_forecast(){
		$query=$this->db->query(" select  s.global_code,s.kode_model,s.request_forecast,s.date_reply,
								s.reply_forecast,o.qty_item ,s.reply_forecast-o.qty_item as balance
								from ctrl_po as o  , pc_sales_forecast as s
								where s.global_code=o.cnee  and MONTH(s.date_reply)=MONTH(o.due_date_)
								and YEAR(s.date_reply)=YEAR(o.due_date_)
								and s.kode_model=o.item_number Group BY 
								s.global_code,s.kode_model,s.date_reply,s.reply_forecast,s.request_forecast,o.qty_item ");
		return $query->result_array();
	}
	 public function ctrl_po_detil($po,$des,$mod)
	 {
		$year=date('Y',strtotime($po));
		$month=date('m',strtotime($po));
		$this->db->select(' *')
			    ->from('open_so_detil')
				->where('YEAR(due_date_so)',$year)
				->where('MONTH(due_date_so)',$month)
				->where('so_cnee',$des)
				->like('kode_item_so',$mod);
				$query = $this->db->get();
	   return $query->result_array(); 
	 }
	 public function get_itm_mstr($sup,$per){
	 $month=date('m',strtotime($per));
	 $year=date('Y',strtotime($per));
	 $this->db->select('*')
			  ->from('pc_item_master')
			  ->where('kode_supplier',$sup)
			  ->where('MONTH(date_reply_)',$month)
			  ->where('YEAR(date_reply_)',$year);
	   $query = $this->db->get();
	   return $query->result_array(); 
	 }
	 public function srcitem($item,$periode){
	 $month=date('m',strtotime($periode));
	 $year=date('Y',strtotime($periode));
		 $this->db->select('*')
			  ->from('pc_item_master')
			  ->where('mstr_item_number',$item)
			  ->where('MONTH(date_reply_)',$month)
			  ->where('YEAR(date_reply_)',$year);
	   $query = $this->db->get();
	   return $query->result_array(); 
	 }
	 public function getpo($po)
	 {
	 $this->db->select('*')
			  ->from('open_po as p')
			  ->join('open_po_detil od','od.ams_po_det=p.ams_po')
			  ->where('ams_po',$po);
			  $query = $this->db->get();
	   return $query->result_array();
	 }
	 public function getpo_rev($po)
	 {
	 $this->db->select('*')
			  ->from('open_po as p')
			  ->join('open_po_detil od','od.ams_po_det=p.ams_po')
			  ->join('pc_case_mark c','c.ams_case=p.ams_po')
			  ->where('ams_po',$po)
			  ->where('stat_po','open');
			  $query = $this->db->get();
	   return $query->result_array();
	 }
	public function get_report($sup,$tgl)
	{
		$query=$this->db->query("select o.rev, o.ams_po,o.cus_po,o.dlvy,o.dlv,p.kode_suplier, count(p.item_number) 
					  as jml_item,SUM(qty_item) as qty_order from open_po as o,open_po_detil
	                 as p where p.ams_po_det=o.ams_po
					 and date_po='$tgl' and kode_suplier='$sup' group by rev,ams_po,cus_po,dlv,dlvy,kode_suplier");
	    return $query->result_array();		 
	} 
	public function update_main_item_($data,$mstr_item_number)
	{
	$this->db->where('mstr_item_number',$mstr_item_number)
	         ->update('pc_item_master',$data);
	} 
	public function cek_order($ordr)
	{
	 $this->db->select('*')
			  ->from('pc_order')
			  ->where('ordr',$ordr);
			  $query = $this->db->get();
	 $data=$query->result_array();
	 return count($data);
	}
	public function save($table,$data)
	{
		$this->db->insert($table, $data);
	}

	/*public function getsearchresult($description)
		{   
		    $select = $this->db->query("SELECT * FROM ORC_ACC_CC WHERE Description LIKE '%".$description."%'");
		    return $select->result_array();
		}
	*/
}