<?php
class prpo extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->model('po_model');
    $this->load->model('blog_model'); //autocomple model aldi;
		$this->load->library('session');
		$this->orcl= $this->load->database('orcl_db',TRUE);
	}
	public function index()
	{
    $cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php/admin/login');
		}
    else
    {
      $file['cat']=$this->db->query("select * from npa_category");
      $file['npa']='prpo/form_pr.php';
      $this->load->view('index',$file);
    }
  }	
  function get_supplier()
	{      
		$data=array();
		$query =$this->input->get('query');
		if($query!="")
		{
        $this->orcl->like('ADDRESS_LINE1', $query);
        $this->orcl->select('ADDRESS_LINE1,ADDRESS_LINE2,ADDRESS_LINE3', $query);
        $data1 = $this->orcl->get("APPS.MEW_C_AP_SUPPLIER_SITES_ID_V")->result_array();
		foreach($data1 as $rw)
		{
			$data2=$rw['ADDRESS_LINE1'].", ".$rw['ADDRESS_LINE2']."".$rw['ADDRESS_LINE3'];
			  array_push($data, $data2);
		}
        echo json_encode($data);
	  }
  }
  public function save_pr()
  {
    if($this->uri->segment(3)!="")
    {
      $rw['pr_number']=$this->uri->segment(3);
      $file['msg']=$this->uri->segment(4);
    }else{
      $rw['pr_number']=trim($this->input->post('pr'));
    }
     $check = $this->db->get_where("ORC_PR_HEADER", array("pr_number" =>$rw['pr_number']));
     if( $check->num_rows()>=1)
    {
        $file['query']=$check;
        $file['query_det'] = $this->db->query("select * from  ORC_PR_HEADER as a,ORC_PR_DET as b 
                                             where a.pr_number=b.pr_det_number and a.pr_number= '$rw[pr_number]' ");
	      $file['npa']='prpo/form_update_pr.php';
	      $this->load->view('index',$file);                                      
    }else{

          $rw['pr_number']=$this->input->post('pr');
          $rw['pr_due_date']=$this->input->post('due_date');
          $rw['pr_supplier']=$this->input->post('supplier');
          $rw['pr_rq']=$this->input->post('rq');
          $rw['pr_need_by_date']=$this->input->post('need_by_date');
          $rw['pr_buyer']=$this->input->post('buyer');
          $rw['pr_shipto']=$this->input->post('shipto');
          if((($this->input->post('pr')!="")&&$this->input->post('supplier')!="")&&$this->input->post('shipto')!="")
          {
            echo "<script>
		        var userPreference;
	        	if(confirm('Do you want to save changes?') == true) {
		      	userPreference = 'Data saved successfully!';
	        	} else {
		      	window.history.back();
		        }
	        	document.getElementById('msg').innerHTML = userPreference; 
           </script>";
               $this->db->insert("ORC_PR_HEADER",$rw);	

                $item=$this->input->post('item');
                $desc=$this->input->post('desc');
                $qty=$this->input->post('qty');
                $uom=$this->input->post('uom');
                $cc=$this->input->post('cc');
                $pa=$this->input->post('pa');
                foreach($item as $key => $n )
                {
                  $det['pr_det_number']=$rw['pr_number'];
                  $det['pr_det_item']=$item[$key];
                  $det['pr_det_desc']=$desc[$key];
                  $det['pr_det_qty']=$qty[$key];
                  $det['pr_det_uom']=$uom[$key];
                  $det['pr_det_cost_center']=$cc[$key];
                  $det['pr_det_purc_account']=$pa[$key];
                  $this->db->insert("ORC_PR_DET",$det);	
                }
                $msg=1;
                header('location:'.base_url().'index.php/prpo/save_pr/'.terim($rw['pr_number'])."/".$msg);     
          }else
          {
            echo "<script type='text/javascript'>
            alert('Data Not Exist, Please Complete Entry Data !!!');
            window.history.back();
            </script>";
          }
        }
  } 
  public function print_pr($popr)
  {
    $data['query'] = $this->db->query("select * from ORC_PR_HEADER where pr_number='$popr' ");
    $data['query_det'] = $this->db->query("select * from  ORC_PR_HEADER as a,ORC_PR_DET as b where a.pr_number=b.pr_det_number and a.pr_number='$popr' ");
    $this->load->view('prpo/pr_print_report.php',$data);
  }
  function create_po()
  {
    $cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php/admin/login');
		}
    else
    {
    if($this->input->post('prno')!=""&&$this->input->post('pono')!="")
    {
        $pr=$this->input->post('prno');
        $file['po']=$this->input->post('pono');
        $file['h'] = $this->db->query("select * from ORC_PR_HEADER where pr_number='$pr'");
        $file['dt'] = $this->db->query("select * from  ORC_PR_HEADER as a,ORC_PR_DET as b where a.pr_number=b.pr_det_number and pr_det_number='$pr'");
        $file['pomain']='prpo/form_po_main.php';
        $this->load->view('index',$file);
      
    }elseif($this->input->post('prno')==""&&$this->input->post('pono')!="")
    {
      $file['po']=$po=$this->input->post('pono');
      $file['h'] = $this->db->query("select * from ORC_INDIRECT_PO_HEADER where po_number='$po'");
      if( $file['h']->num_rows()>=1){
         $file['dt'] = $this->db->query("select * from  ORC_PR_HEADER as a,ORC_PR_DET as b where a.pr_number=b.pr_det_number and pr_det_po_number='$po'");
         $file['pomain']='prpo/form_po_main.php';
         $this->load->view('index',$file);
        }else
        {
          echo "<script type='text/javascript'>
          alert(' Data Not Exist !!!');
          window.history.back();
          </script>";
        }   
    }elseif($this->input->post('prno')==""&&$this->input->post('pono')=="" && $this->uri->segment(3)!="")
    {
      $file['msg']=$this->uri->segment(4);
      $file['po']=$po=$this->uri->segment(3);
      $file['h'] = $this->db->query("select * from ORC_INDIRECT_PO_HEADER where po_number='$po'");
      $file['dt'] = $this->db->query("select * from  ORC_PR_HEADER as a,ORC_PR_DET as b where a.pr_number=b.pr_det_number and pr_det_po_number='$po'");
      $file['pomain']='prpo/form_po_main.php';
      $this->load->view('index',$file);
    }  
    else
    {
        $file['prtopo']='prpo/form_po.php';
        $this->load->view('index',$file);
    }
   }
  }
  function save_po_creation()
  {   
    $po_header['po_number']=trim($this->input->post('po_number'));
    $po_header['po_buyer']=$this->input->post('buyer');
    $po_header['po_shipto']=$this->input->post('shipto');
    $po_header['po_supplier']=$this->input->post('supplier');
    $po_header['po_vat']=$this->input->post('vat');
    $po_header['po_remarks']=$this->input->post('remarks');
    $po_header['po_currency']=$this->input->post('curr');
    $po_header['po_need_by_date']=$this->input->post('need_by_date');
    $po_header['po_due_date']=$this->input->post('due_date');
    $query = $this->db->get_where('ORC_INDIRECT_PO_HEADER', array('po_number' =>$po_header['po_number']));
    if( $query->num_rows()>=1)
    {
      echo "<script>
		        var userPreference;
	        	if(confirm('Do you want to save changes?') == true) {
		      	userPreference = 'Data saved successfully!';
	        	} else {
		      	window.history.back();
		        }
	        	document.getElementById('msg').innerHTML = userPreference; 
           </script>";
      $this->db->update('ORC_INDIRECT_PO_HEADER', $po_header, "po_number ='$po_header[po_number]'");
    }else{
      echo "<script>
		        var userPreference;
	        	if(confirm('Do you want to save changes?') == true) {
		      	userPreference = 'Data saved successfully!';
	        	} else {
		      	window.history.back();
		        }
	        	document.getElementById('msg').innerHTML = userPreference; 
           </script>";
    $po_header['po_creation_date']=date('d-M-Y');   
    $this->db->insert("ORC_INDIRECT_PO_HEADER",$po_header);	
    }
    $value=$this->input->post('save');
    if ($this->input->post('save'))
     {
      $qty=$this->input->post('qty');
      $price=$this->input->post('price');
      foreach($value as $key => $n )
      {
        $count_id= $value[$key];
        $det['pr_det_qty_po']=$qty[$key];
        $det['pr_det_price_po']=$price[$key];
        $det['pr_det_po_number']=$this->input->post('po_number');
        $this->db->update('ORC_PR_DET', $det, "count_id ='$count_id'");
      }
      $msg=1;
      header('location:'.base_url().'index.php/prpo/create_po/'.$po_header['po_number']."/".$msg);  
    }else
    {
      echo "<script type='text/javascript'>
      alert(' Please Entry Detail PO !!!');
      window.history.back();
      </script>";
    }
  }
  function indrct_po_print($popr)
  {
    $data['query'] = $this->db->query("select * from ORC_INDIRECT_PO_HEADER a, orc_delivery_to b where a.po_shipto=b.delivery_code and po_number='$popr'");
    $data['query_det'] = $this->db->query("select * from  ORC_INDIRECT_PO_HEADER as a,ORC_PR_DET as b where a.po_number=b.pr_det_po_number and b.pr_det_qty_po!=0 and a.po_number='$popr' ");
    $this->load->view('prpo/idr_po_print_report.php',$data);
  }
  function update_pr() 
  {
    echo "<script>
    var userPreference;
    if(confirm('Do you want to save changes?') == true) {
    userPreference = 'Data saved successfully!';
    } else {
    window.history.back();
    }
    document.getElementById('msg').innerHTML = userPreference; 
   </script>";
    if((($this->input->post('pr')!="")&&$this->input->post('supplier')!="")&&$this->input->post('shipto')!="")
    {
        $rw['pr_number']=$this->input->post('pr');
        $rw['pr_due_date']=$this->input->post('due_date');
        $rw['pr_supplier']=$this->input->post('supplier');
        $rw['pr_rq']=$this->input->post('rq');
        $rw['pr_need_by_date']=$this->input->post('need_by_date');
        $rw['pr_buyer']=$this->input->post('buyer');
        $rw['pr_shipto']=$this->input->post('shipto');
         $this->db->update('ORC_PR_HEADER',$rw, "pr_number ='$rw[pr_number]'");
         
            $id=$this->input->post('save');
            $item=$this->input->post('item'); 
            $desc=$this->input->post('desc');
            $qty=$this->input->post('qty');
            $uom=$this->input->post('uom');
            $cc=$this->input->post('cc');
            $pa=$this->input->post('pa');
          foreach($id as $key => $n )
          {
            $count_id=$id[$key];
            $det['pr_det_number']=$rw['pr_number'];
            $det['pr_det_item']=$item[$key];
            $det['pr_det_desc']=$desc[$key];
            $det['pr_det_qty']=$qty[$key];
            $det['pr_det_uom']=$uom[$key];
            $det['pr_det_cost_center']=$cc[$key];
            $det['pr_det_purc_account']=$pa[$key];
            $query = $this->db->get_where('ORC_PR_DET',array('count_id' =>$id[$key]));
            if($query->num_rows()>=1){
            $this->db->update('ORC_PR_DET', $det, "count_id ='$count_id'");
              }else{
                $this->db->insert("ORC_PR_DET",$det);
              }
          }
          $msg=1;
          header('location:'.base_url().'index.php/prpo/save_pr/'.$rw['pr_number']."/".$msg);   
    }
  }
 function  print_popr()
 {
  $fil['pocustomer_']='po_customer.php';
	$this->load->view('index',$fil);
 }
 function get_prpo()
 {
       $popr= $this->input->post('data');
   if($this->input->post('select')=="PR"){
        $this->print_pr($popr);
      }elseif($this->input->post('select')=="PO")
      {
        $this->indrct_po_print($popr);
      }elseif($this->input->post('select')=="GRN")
      {
        $this->indrct_grn_print($popr);
      }elseif($this->input->post('select')=="")
     {
      echo "<script type='text/javascript'>
      alert('Please select Selection Data!!!');
      window.history.back();
      </script>";
     }
 }
 function dn_po()
 {
  $fil['dn_po']='prpo/form_dn.php';
	$this->load->view('index',$fil);
 }
 function dn_slection()
 {
  $popr= $this->input->post('data');
  if($this->input->post('select')=="DN"){
      $this->dn_process($popr);
     }elseif($this->input->post('select')=="RETURN")
     {
      // $this->indrct_po_print($popr);
     }elseif($this->input->post('select')=="")
    {
     echo "<script type='text/javascript'>
     alert('Please select Selection Data!!!');
     window.history.back();
     </script>";
    }
 }
 function dn_process($popr)
 {
  $file['query'] = $this->db->query("select * from ORC_INDIRECT_PO_HEADER a, orc_delivery_to b where a.po_shipto=b.delivery_code and po_number='$popr'");
  $file['query_det'] = $this->db->query("select a.count_id,line_id,c.po_number,c.po_buyer,pr_det_price_po,pr_det_po_number,pr_det_item,pr_det_desc, 
  pr_det_qty_po,b.rcv_qty,pr_det_uom,pr_det_cost_center,pr_det_purc_account,(pr_det_qty_po-rcv_qty) as remaining from ORC_PR_DET as a LEFT JOIN 
  (select line_id, sum(rcv_qty) as rcv_qty from ORC_DN_DET group by line_id) as b
  ON  a.count_id=b.line_id RIGHT JOIN ORC_INDIRECT_PO_HEADER as c ON c.PO_number=a.pr_det_po_number where  c.po_number='$popr' ");
  $file['dn_p']='prpo/form_dn_process.php';
  $this->load->view('index',$file);
}
function save_dn()
{
  if($this->input->post('pc')!=""&&$this->input->post('rcv_date')!="")
  {
    $hed['rcv_received_date']=$this->input->post('rcv_date');
    $hed['rcv_inv_packing']=$this->input->post('pc');
    $hed['rcv_po_number']=$this->input->post('po_number');
    $hed['rcv_transaction_date']=date('d-M-Y H:i:s');
    $hed['rcv_segment']='DN';
   $this->db->insert("ORC_DN_HEADER",$hed);	
   $query = $this->db->get_where('ORC_DN_HEADER', array('rcv_inv_packing' =>$this->input->post('pc'),'rcv_segment'=>$hed['rcv_segment'],'rcv_transaction_date'=>$hed['rcv_transaction_date']))->result_array();
   foreach($query as $row );
     $value=$this->input->post('save');
     $rv_qty=$this->input->post('rcv_qty');
     $price=$this->input->post('price');
      if($this->input->post('save'))
     {
           foreach($value as $key => $n )
        {
          $det['line_id']=$value[$key];
          $det['rcv_qty']=$rv_qty[$key];
          $det['rcv_grn_det']=$row['rcv_grn_number'];
          $det['rcv_price']=$price[$key];
          $det['rcv_transaction_date_det']= $hed['rcv_received_date'];
          if($rv_qty[$key]>0){
          $this->db->insert("ORC_DN_DET",$det);	
           }
        }
      }
        $file['query'] = $this->db->query("select * from ORC_DN_HEADER a, ORC_INDIRECT_PO_HEADER b where a.RCV_PO_NUMBER=b.po_number and rcv_grn_number='$row[rcv_grn_number]'");
        $file['query_det'] = $this->db->query("select * from ORC_DN_HEADER as H, ORC_DN_DET D,ORC_PR_DET pr where H.rcv_grn_number=D.rcv_grn_det and D.line_id=pr.count_id and rcv_grn_det='$row[rcv_grn_number]'");
        $file['dn_p']='prpo/form_dn_process.php';
        $this->load->view('index',$file);
      }else{
          echo "<script type='text/javascript'>
          alert('Please Complete Entry Data!!!');
          window.history.back();
          </script>";
       }   
  }
  function indrct_grn_print($popr)
  {
    $data['query_h'] = $this->db->query("select * from ORC_DN_HEADER a, ORC_INDIRECT_PO_HEADER b where a.RCV_PO_NUMBER=b.po_number and rcv_grn_number='$popr'");
    $data['query'] = $this->db->query("select * from ORC_DN_HEADER as H, ORC_DN_DET D,ORC_PR_DET pr where H.rcv_grn_number=D.rcv_grn_det and D.line_id=pr.count_id and rcv_grn_det='$popr'");
    $this->load->view('prpo/dn_print_report.php',$data);
  }
  function ex_supplier()
	{      
    $data=array();
		$query =$this->input->get('query');
		if($query!="")
		{
        $this->orcl->like('ADDRESS_LINE1', $query);
        $this->orcl->or_like('VENDOR_SITE_CODE', $query);
        $this->orcl->select('VENDOR_SITE_CODE,ADDRESS_LINE1,ADDRESS_LINE2,ADDRESS_LINE3', $query);
        $data1 = $this->orcl->get("APPS.MEW_C_AP_SUPPLIER_SITES_ID_V")->result_array();
		foreach($data1 as $rw)
		{
      $data['suggestions'][] = [
        'value' => $rw['ADDRESS_LINE1'],
        'supplier' => $rw['VENDOR_SITE_CODE']
    ];
		}
        echo json_encode($data);
	  }
  }
  function return_po()
  {
      if($this->input->post('grn')&&$this->input->post('rcv_qty')=="")
      {
        $grn=$this->input->post('grn');
        $file['query_det'] = $this->db->query("select a.line_id as id,c.rcv_po_number as po_number,c.rcv_received_date,d.po_supplier,b.pr_det_desc as descr,b.pr_det_uom,c.rcv_inv_packing as packing_slip,
        c.rcv_grn_number as grn,b.pr_det_item as item,b.pr_det_qty_po as qty_po,rcv_qty,d.po_currency,a.rcv_price,rcv_qty * a.rcv_price as t_amount,b.pr_det_cost_center,b.pr_det_purc_account from 
		(select  line_id,rcv_grn_det,sum(rcv_qty) as rcv_qty,rcv_price  from  ORC_DN_DET   group by line_id,rcv_grn_det,rcv_price) as a LEFT JOIN ORC_PR_DET as b
        ON a.line_id=b.count_id LEFT JOIN  ORC_DN_HEADER as c ON a.rcv_grn_det=c.rcv_grn_number left JOIN ORC_INDIRECT_PO_HEADER as d on d.po_number=b.pr_det_po_number
        where c.rcv_grn_number=$grn");
        $file['return_po']='prpo/form_po_return.php';
        $this->load->view('index',$file);
      }
      elseif($this->input->post('grn')&&$this->input->post('rcv_qty')!="")
      {
              echo "<script>
              var userPreference;
              if(confirm('Do you want to save return?') == true) {
              userPreference = 'Data saved successfully!';
              }else {
              window.history.back();
              }
              document.getElementById('msg').innerHTML = userPreference; 
            </script>";
    
               $value=$this->input->post('save');
               $price=$this->input->post('price');
               $rtn_qty=$this->input->post('rtn_qty');
              foreach($value as $key => $n )
               {
                $det['rcv_grn_det']=$this->input->post('grn');
                $det['line_id']=$value[$key];
                $det['rcv_qty']=$rtn_qty[$key]*-1;
                $det['rcv_price']=$price[$key];
                $det['rcv_transaction_date_det']= $this->input->post('rcv_date');
                if($rtn_qty[$key]>0){
                $this->db->insert("ORC_DN_DET",$det);	
                }
                }
                $file['query_det'] = $this->db->query("select a.line_id as id,c.rcv_po_number as po_number,d.po_supplier,c.rcv_received_date,b.pr_det_desc as descr,b.pr_det_uom,c.rcv_inv_packing as packing_slip,
                c.rcv_grn_number as grn,b.pr_det_item as item,b.pr_det_qty_po as qty_po,rcv_qty,d.po_currency,a.rcv_price,rcv_qty * a.rcv_price as t_amount,b.pr_det_cost_center,b.pr_det_purc_account from 
                  (select  line_id,rcv_grn_det,sum(rcv_qty) as rcv_qty,rcv_price  from  ORC_DN_DET  group by line_id,rcv_grn_det,rcv_price) as a LEFT JOIN ORC_PR_DET as b
                ON a.line_id=b.count_id LEFT JOIN  ORC_DN_HEADER as c ON a.rcv_grn_det=c.rcv_grn_number left JOIN ORC_INDIRECT_PO_HEADER as d on d.po_number=b.pr_det_po_number
                where c.rcv_grn_number=$det[rcv_grn_det]");
                $file['return_po']='prpo/form_po_return.php';
                $this->load->view('index',$file);  
      }else
      {
        $file['return_po']='prpo/form_po_return.php';
        $this->load->view('index',$file);
      }
  }

  /*ALDI PRPO*/
   public function userList(){
    // POST data
    $postData = $this->input->post();

    // Get data
    $data = $this->Blog_model->getUsersA($postData);

    echo json_encode($data);
  }
  public function userLista(){
    // POST data
    $postData = $this->input->post();

    // Get data
    $datab = $this->Blog_model->getUsersB($postData);

    echo json_encode($datab);
  }

  function get_autocomplete(){
      if (isset($_GET['term'])) {
      $result = $this->blog_model->search_blog($_GET['term']);
        if (count($result) > 0) {
            foreach ($result as $row)
            $arr_result[] = array("label"=>$row->Description.'-'.$row->Translated_value,"labela"=>$row->Translated_value,"value"=>$row->Translated_value);
          echo json_encode($arr_result);
          }
        }
      }
      function get_autocompletee(){
      if (isset($_GET['term'])) {
      $result = $this->blog_model->search_bloga($_GET['term']);
        if (count($result) > 0) {
            foreach ($result as $row)
            $arr_result[] = array("label"=>$row->ACCOUNT_DESC.'-'.$row->ACCOUNT_CODE,"labela"=>$row->ACCOUNT_CODE,"value"=>$row->ACCOUNT_CODE);
          echo json_encode($arr_result);
          }
        }
      }
      function get_prautocomplete(){
        if (isset($_GET['term'])){
        $result = $this->blog_model->search_blogpr($_GET['term']);
          if (count($result) > 0){
            foreach ($result as $row) 
              $arr_result[] = array("label"=>$row->pr_number.'-'.$row->pr_supplier,"labela"=>$row->pr_number,"value"=>$row->pr_supplier);
            echo json_encode($arr_result);
              
            }
          }
        }
       
       function get_poautocomplete(){
        if (isset($_GET['term'])){
          $result = $this->blog_model->search_blogpo($_GET['term']);
            if (count($result) > 0){
              foreach ($result as $row)
                $arr_result[] = array("label"=>$row->po_number.'-'.$row->po_supplier,"labela"=>$row->po_number,"value"=>$row->po_supplier);
              echo json_encode($arr_result);
            }
          }
         }
    
         /*ALDI PRPO*/

  
}