<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {

  /*function getUsersA($postData){

     $response = array();

     if(isset($postData['search']) ){
       // Select record
       $this->db->select('*');
       $this->db->where("Description like '%".$postData['search']."%' or Translated_value like '%".$postData['search']."%' ");

       $records = $this->db->get('ORC_ACC_CC')->result();

       foreach($records as $row ){
          $response[] = array("label"=>$row->Description,"value"=>$row->Translated_value);
       }

     }

     return $response;
  }
  function getUsersB($postData){

     $response = array();

     if(isset($postData['search']) ){
       // Select record
       $this->db->select('*');
       $this->db->where("ACCOUNT_DESC like '%".$postData['search']."%' or ACCOUNT_CODE like '%".$postData['search']."%' ");

       $recordsa = $this->db->get('ORC_ACC_CC')->result();

       foreach($recordsa as $rowa ){
          $responsea[] = array("label"=>$rowa->ACCOUNT_DESC,"value"=>$rowa->ACCOUNT_CODE);
       }

     }

     return $responsea;
  }*/

		function search_blog($title)
		{
			$this->db->like('Description', $title , 'both');
      $this->db->or_like('Translated_value', $title , 'both');
			$this->db->order_by('Description','Translated_value');
			$this->db->limit(10);
			return $this->db->get('ORC_ACC_CC')->result();
		}
		function search_bloga($title)
		{
			$this->db->like('ACCOUNT_DESC', $title , 'both');
      $this->db->or_like('ACCOUNT_CODE', $title , 'both');
			$this->db->order_by('ACCOUNT_DESC','ACCOUNT_CODE');
			$this->db->limit(10);
			return $this->db->get('ORC_ACC_CC')->result();
		}
    function search_blogpr($title)
    {
      $this->db->like('pr_supplier', $title, 'both');
      $this->db->or_like('pr_number', $title, 'both');
      $this->db->order_by('pr_supplier','pr_number');
      $this->db->limit(10);
      return $this->db->get('ORC_PR_HEADER')->result();
    }
    function search_blogpo($title)
    {
      $this->db->like('po_supplier', $title, 'both');
      $this->db->or_like('po_number', $title, 'both');
      $this->db->order_by('po_supplier','po_number');
      $this->db->limit(10);
      return $this->db->get('ORC_PR_HEADER')->result();
    }
}