<?php class Acc_model extends CI_Model{
    function __construct()
    {
        parent::__construct();
		$this->load->helper('array');
	}
	public function get_group_category()
	{
		$query=$this->db->query(" select distinct group_category from orc_prodcat order by group_category asc ");
		return $query->result_array();
	}
	public function get_prod_type()
	{
		$query=$this->db->query(" select distinct prod_type from orc_prodcat order by prod_type asc ");
		return $query->result_array();
	}
	public function save_prodcat($pc_en){
		$item_num = $pc_en['item_number'];
		$query=$this->db->query(" select item_number from orc_prodcat where item_number = '$item_num' ");
		if ($query->num_rows()>0){
			//item sudah ada
			trigger_error("item sudah ada", E_USER_ERROR);	
		}
		else {
		$this->db->insert('orc_prodcat',$pc_en); }
	}
	public function get_sup_name()
	{
		$query=$this->db->query(" select vendor_name from orc_supmstr order by vendor_name asc ");
		return $query->result_array();
	}
	public function get_pic_name()
	{
		$query=$this->db->query(" select name from orc_user order by name asc ");
		return $query->result_array();
	}
	public function save_advan($adv_en)
	{
		$today=date("Y-m-d");
		$query=$this->db->query("select start_date from orc_advan_period where start_date <= '$today' and end_date >= '$today'");
		if ($query->num_rows()>0){
			//locked period
			trigger_error("Locked period!", E_USER_ERROR);	
		}
		else {
		$this->db->insert('orc_advmaint',$adv_en); }
	}
	public function get_adv_no()
	{
		$query=$this->db->query(" select max(adv_no)+1 as adv_no from orc_advmaint ");
		return $query->result_array();
	}
	public function f_adv_data($adv_num)
	{
		if ($adv_num['adv_no'] !== ''){
			$adv_no = $adv_num['adv_no'];}
		else {
			$adv_no = '%';}
		
		if ($adv_num['date1'] == ''){
			$adv_date1 = '01-01-1900';
		}
		else {
			$adv_date1 = $adv_num['date1'];
		}
		
		if ($adv_num['date2'] == ''){
			$adv_date2 = '12-31-2900';
		}
		else {
			$adv_date2 = $adv_num['date2'];
		}
		
		$query=$this->db->query(" select adv_no,vendor_name,vendor_new,pic,date,amount,currency,remark, creation_date, update_date from orc_advmaint where adv_no like '$adv_no' and date between '$adv_date1' and '$adv_date2' order by adv_no desc ");
		return $query->result_array();
	}
	public function f_adv_select($nom_adv)
	{
		
		$query=$this->db->query(" select adv_no,vendor_name,vendor_new,pic,date,amount,currency,remark, creation_date, update_date from orc_advmaint where adv_no like '$nom_adv' order by adv_no desc ");
		return $query->result_array();
	}
	public function f_adv_edit($adv_en)
	{
		if ($adv_en['vendor']=='true'){
			$adv_en['VENDOR_NAME']=null;
		}
		else{
			$adv_en['VENDOR_NEW']=null;
		}
		$today=date("Y-m-d");
		$query=$this->db->query("select start_date from orc_advan_period where start_date <= '$today' and end_date >= '$today'");
		if ($query->num_rows()>0){
			//locked period
			trigger_error("Locked period!", E_USER_ERROR);	
		}
		else {
		$query=$this->db->query(" update orc_advmaint set vendor_name='$adv_en[VENDOR_NAME]',vendor_new='$adv_en[VENDOR_NEW]',
		pic='$adv_en[PIC]',date='$adv_en[DATE]',amount=$adv_en[AMOUNT],currency='$adv_en[CURRENCY]',remark='$adv_en[REMARK]', 
		update_date='$adv_en[UPDATE_DATE]' where adv_no = $adv_en[ADV_NO]"); }

	}
	
	public function f_exp_adv()
	{
		$query=$this->db->query("select adv_no,vendor_name,vendor_new,pic,date,amount,currency,remark, creation_date, update_date from orc_advmaint ");
		return $query->result_array();
	}
	
	public function f_acc_aux()
	{
		$query=$this->db->query("select account, aux, acc_desc, aux_desc from orc_account_aux");
		return $query->result_array();
	}
	
	public function save_advan_period($adv)
	{
		$this->db->insert('orc_advan_period',$adv);
	}
	public function f_exp_tb()
	{
		$query=$this->db->query("SELECT tb.cost_center,tb.account,tb.aux,acc.AUX_DESC,tb.beg_bal,tb.activity,tb.end_bal
									FROM orc_tb tb left outer join orc_account_aux acc on tb.account = acc.ACCOUNT and tb.aux = acc.AUX
									order by account,cost_center,aux asc ");
		return $query->result_array();
	}
	
}

