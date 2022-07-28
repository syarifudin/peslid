<?php class u_p_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
		$this->load->helper('array');
		  }
	public function u_p_po($data)
	{
	 foreach($data as $key => $row)
		{
			$r['pod_nbr']=$row['A'];
			$r['pod_cnee']=$row['B'];
			$date=$row['C'];
			$r['pod_ord_date']=date('Y-m-d',strtotime($date));
			$date_=$row['D'];
			$r['pod_duedate']=date('Y-m-d',strtotime($date_));
			$r['pod_line_item']=$row['E'];
			$r['pod_item_c']=$row['F'];
			$r['pod_item_mfg']=$row['G'];
			$r['pod_qty']=$row['H'];
			$r['pod_curr']=$row['I'];
			$r['pod_price']=$row['J'];
			$r['pod_from']=$row['K'];
			$r['pod_dlvy_to']=$row['L'];
			$r['pod_add1']=$row['M'];
			$r['pod_add2']=$row['N'];
			$r['pod_city']=$row['O'];
			$this->db->insert('po_c',$r);
		}
    }
	public function get_ctrl($po)
	{
		$query=$this->db->query("select a.po_nbr,c.idh_inv_nbr_qad,b.pod_item_mfg,c.idh_part_qad,d.so_part_qad,ISNULL(b.pod_qty,0) as QTY_PO,
										ISNULL(c.idh_qty_inv,0) QTY_INV,ISNULL(d.so_qty_odr_qad,0) as QTY_SO,
										ISNULL(b.pod_qty,0)-ISNULL(d.so_qty_odr_qad,0)-ISNULL(c.idh_qty_inv,0) B_O,
										b.pod_from from po_mstr_ as a left join po_c as b
										ON a.po_nbr=b.pod_nbr 
										left join inv_mstr_qad as c	ON 	a.po_nbr=c.ih_po_qad
										and b.pod_item_mfg=c.idh_part_qad
										left join (select so_part_qad,so_po_qad,SUM(so_qty_odr_qad) as so_qty_odr_qad from so_mstr_qad  group by 
										so_part_qad,so_po_qad) as d
										on	a.po_nbr=d.so_po_qad and
										b.pod_item_mfg=d.so_part_qad
										where a.po_nbr IN('$po')");
		return $query->result_array();
		
	}
}