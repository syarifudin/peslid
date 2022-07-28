<?php class mnc_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->load->helper('array');
    } 
	public function mnc_chek($mnc,$rev)
	 {
	  $this->db->select('*')
			  ->from('open_po as p')
			  ->join('pc_po_number as pc','pc.pc_order_number=p.ams_po')
			  ->join('open_po_detil od','od.ams_po_det=p.ams_po')
			  ->join('eta as e','e.ams_=p.ams_po')
			 // ->join('pc_destination as de','de.city_code=p.dest')
			  ->where('ams_po',$mnc)
			  ->where('rev',$rev)
			  ->where('rev_',$rev)
			  ->where('stat_po','close');
			  $query = $this->db->get();
	  return $query->result_array();
	 }	  
	 public function mnc_delete($ams_po){
	 $query = $this->db->query("delete from open_po where ams_po='$ams_po'");
	 $query = $this->db->query("delete from pc_po_number where pc_order_number='$ams_po'");
	 $query = $this->db->query("delete from open_po_detil where ams_po_det='$ams_po'");
	 $query = $this->db->query("delete from eta where ams_='$ams_po'");
	 $query = $this->db->query("delete from pc_case_mark where ams_case='$ams_po'");
	 }
}