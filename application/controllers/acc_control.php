<?php
class Acc_control extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('acc_model');
		$this->load->library('session');
		
	}
	public function data_prodcat()
	{
		$pc['data_prodcat']='prod_cat_maint.php';
		$pc['data_groupcat']=$this->acc_model->get_group_category();
		$pc['data_protype']=$this->acc_model->get_prod_type();
		$this->load->view('index.php',$pc);
			
	}
	public function register_prodcat()
	{
		$pc_en['item_number']=$this->input->post('item_num');
		if ($pc_en['item_number']=='') {
			//item tidak boleh kosong
			trigger_error("item tidak boleh kosong", E_USER_ERROR);
		}
		else {
			$pc_en['item_number'];}
		$pc_en['group_category']=$this->input->post('groupcat_select');
		$pc_en['prod_type']=$this->input->post('protype_select');
		if (($pc_en['group_category'] == 'LOC / Bulb LED' && $pc_en['prod_type'] == 'Bulb') or
			($pc_en['group_category'] == 'LOC / Bulb LS' && $pc_en['prod_type'] == 'Bulb') or
			($pc_en['group_category'] == 'OS / Bulb LED' && $pc_en['prod_type'] == 'Bulb') or
			($pc_en['group_category'] == 'OS / Bulb LS' && $pc_en['prod_type'] == 'Bulb') or
			($pc_en['group_category'] == 'LOC / Aquarium' && $pc_en['prod_type'] == 'Fixture') or
			($pc_en['group_category'] == 'LOC / FIX - Project' && $pc_en['prod_type'] == 'Fixture') or
			($pc_en['group_category'] == 'LOC / FIX - Retail' && $pc_en['prod_type'] == 'Fixture') or
			($pc_en['group_category'] == 'OS / B to B (Parts)' && $pc_en['prod_type'] == 'Fixture') or
			($pc_en['group_category'] == 'OS / FIX' && $pc_en['prod_type'] == 'Fixture')) {
			$this->acc_model->save_prodcat($pc_en);
			return $this->data_prodcat();
			}
		else {
			//kombinasi salah
			trigger_error("kombinasi salah", E_USER_ERROR);
		}
		
	}
	public function data_adv()
	{
		$adv['data_adv']='advan_maint.php';
		$adv['data_sup']=$this->acc_model->get_sup_name();
		$adv['data_pic']=$this->acc_model->get_pic_name();
		$adv['nomer']=$this->acc_model->get_adv_no();
		$this->load->view('index.php',$adv);
			
	}
	public function register_advan()
	{
		$adv_en['ADV_NO']=$this->input->post('nomor');
		
		$sup_check=$this->input->post('sup_other');
		if ($sup_check == 'false' ){
			$adv_en['VENDOR_NAME']=$this->input->post('sup_select');
		}
		else {
			$adv_en['VENDOR_NEW']=$this->input->post('ot_sup');
		}
		
		$adv_en['PIC']=$this->input->post('pic');
		$adv_en['DATE']=$this->input->post('date');
		$adv_en['CURRENCY']=$this->input->post('curr_select');
		$adv_en['AMOUNT']=$this->input->post('amount');
		$adv_en['REMARK']=$this->input->post('remark');
		$adv_en['CREATION_DATE']=$this->input->post('cdate');
		
		/*echo $adv_en['VENDOR_NAME'];
		echo $adv_en['VENDOR_NEW'];
		echo $adv_en['PIC'];
		echo $adv_en['DATE'];
		echo $adv_en['CURRENCY'];
		echo $adv_en['AMOUNT'];
		echo $adv_en['REMARK'];*/
		
		$this->acc_model->save_advan($adv_en);
		return $this->data_adv();
		
	}
	
	public function get_adv_data()
	{
		$adv_num['adv_no']=$this->input->post('adv_number');
		$adv_num['date1']=$this->input->post('date');
		$adv_num['date2']=$this->input->post('date1');
		$data['adv_data_tbl']=$this->acc_model->f_adv_data($adv_num);
		$data['get_adv_data']='advan_tbl.php';
		$this->load->view('index.php',$data);
	}
	
	public function edit_adv()
	{
		$nom_adv= $this->input->post('input_adv_no');
		$data['adv_data_edit']=$this->acc_model->f_adv_select($nom_adv);
		$data['data_sup']=$this->acc_model->get_sup_name();
		$data['data_pic']=$this->acc_model->get_pic_name();
		$data['edit_adv']='advan_edit.php';
		$this->load->view('index.php',$data);
		
	}
	
	public function update_advan()
	{
		$adv_en['ADV_NO']=$this->input->post('nomor');
		$adv_en['VENDOR_NAME']=$this->input->post('sup_select');
		$adv_en['VENDOR_NEW']=$this->input->post('ot_sup');
		$adv_en['PIC']=$this->input->post('pic');
		$adv_en['DATE']=$this->input->post('date');
		$adv_en['CURRENCY']=$this->input->post('curr_select');
		$adv_en['AMOUNT']=$this->input->post('amount');
		$adv_en['REMARK']=$this->input->post('remark');
		$adv_en['UPDATE_DATE']=$this->input->post('udate');
		$adv_en['vendor']=$this->input->post('sup_other');
		
		$this->acc_model->f_adv_edit($adv_en);
		return $this->data_adv();
	}
	
	public function exp_adv()
	{
		$data['data_exp_adv']=$this->acc_model->f_exp_adv();
		$this->load->view('advan_tbl_xls.php',$data);
	}
	public function advan_period()
	{
		$adv['advan_period']='advan_period.php';
		$this->load->view('index.php',$adv);		
	}
	public function reg_advan_period()
	{
		$adv['START_DATE']=$this->input->post('date');
		$adv['END_DATE']=$this->input->post('date1');
		//echo $adv['START_DATE'];
		//echo $adv['END_DATE'];
		$this->acc_model->save_advan_period($adv);
		return $this->advan_period();
	}
	
}