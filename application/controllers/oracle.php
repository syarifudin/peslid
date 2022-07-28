<?php
class oracle extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->library('session');
		
	}
	public function index(){
		echo "Selamat datang";
	}
	public function insert_table()
	{
		$this->po_received();
		$this->po_oustanding();
		$this->transaction_completion();
		$this->po_asl();
		$this->inv_uom_conversion();
		$this->bom_list();
	}
	function oracle_data(){
	$dir = "oracle_data";
			$cek=0;
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
				$cek=$cek+1;  
				if($file != ".." && $file != "."){
					$a="oracle_data/$file";
					$name="$file";
					$url=$file;
					$new="copy_oracle_data/".$file;
					echo $a;
				  }
			   }
			 $cek_file= $cek-2;		 
		  }
		  closedir($dh);
		if(($cek_file)==0){
		redirect('oracle');
	}
	//$this->bom_list($a);
	//copy($a,$new);
	//unlink($a);
  }
  public function bom_list()
  {
	  $tab = "\t";
	$file_handle = fopen("/FTP/data/BOM_LIST.txt", "r");
	while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'p_item'=>$line_of_text[0],
					'p_item_desc'=>$line_of_text[1],
					'p_uom'=>$line_of_text[2],
					'Alternate'=>$line_of_text[3],
					'inventory'=>$line_of_text[4],
					'c_item'=>$line_of_text[5],
					'c_item_desc'=>$line_of_text[6],
					'c_uom'=>$line_of_text[7],
					'qty_com'=>$line_of_text[8],
					'yield'=>$line_of_text[9],
					'effective_date_from'=>$line_of_text[10],
					'effective_date_to'=>$line_of_text[11],
					'supply_subinventory'=>$line_of_text[12],
					'source_subinventory'=>$line_of_text[13],
					'op_unit'=>$line_of_text[14],
					'org_id'=>$line_of_text[15]
					);
	$this->oracle_model->save_bom($data);
	}
	}
 }
 /* public function inv_on_hand(){
  $file_handle = fopen("oracle_data/INV_ON_HAND.csv", "r");
	while (!feof($file_handle)) {
		$line_of_text = fgetcsv($file_handle, 1024);
		$data=array(
					'inventory_org'=>$line_of_text[0],
					'subinventory_code'=>$line_of_text[1],
					'item_number'=>$line_of_text[2],
					'item_descrip'=>"",
					'item_type'=>$line_of_text[4],
					'user_item_type'=>$line_of_text[5],
					'on_hand_qty'=>$line_of_text[6],
					'org_id'=>$line_of_text[7]
					);
		$this->oracle_model->save_inv_on_hand($data);
				}
	}*/
  public function po_received(){
	$tab = "\t";
	$file_handle = fopen("/FTP/data/PO_RECEIVED.txt", "r");
	while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'item_number'=>$line_of_text[0],
					'item_name'=>$line_of_text[1],
					'receipt_num'=>$line_of_text[2],
					'trans_date'=>$line_of_text[3],
					'uom'=>$line_of_text[4],
					'primary_uom'=>$line_of_text[5],
					'curr_code'=>$line_of_text[6],
					'qty'=>$line_of_text[7],
					'primary_qty'=>$line_of_text[8],
					'po_unit_price'=>$line_of_text[9],
					'curr_conver_rate'=>$line_of_text[10],
					'item_type'=>$line_of_text[11],
					'po_number'=>$line_of_text[12],
					'packing_slip'=>$line_of_text[14],
					'line_num'=>$line_of_text[13],
					'ouc'=>$line_of_text[15],
					'oun'=>$line_of_text[16],
					'org_id'=>$line_of_text[17]
					);
	$this->oracle_model->save_po_receive($data);
    	}
	 }	
	}
	public function  inv_uom_conversion()
	{
		$tab = "\t";
		$file_handle = fopen("/FTP/data/INV_UOM_CONVERSION.txt", "r");
		while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'item_number'=>$line_of_text[0],
					'item_desc'=>$line_of_text[1],
					'uom'=>$line_of_text[2],
					'uom_code'=>$line_of_text[3],
					'conversion_rate'=>$line_of_text[4],
					'primary_uom'=>$line_of_text[5]
					);
		$this->oracle_model->save_uom_conv($data);
		}
	  }
	}
	public function po_asl()
	{
		$tab = "\t";
		$file_handle = fopen("/FTP/data/PO_ASL.txt", "r");
		while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'quotation_number	 '=>$line_of_text[0],
					'Supplier            '=>$line_of_text[1],
					'Site                '=>$line_of_text[2],
					'Category            '=>$line_of_text[3],
					'Buyer               '=>$line_of_text[4],
					'Num                 '=>$line_of_text[5],
					'Types               '=>$line_of_text[6],
					'Item                '=>$line_of_text[7],
					'Description         '=>"",
					'UOM                 '=>$line_of_text[9],
					'Currency            '=>$line_of_text[10],
					'Price               '=>$line_of_text[11],
					'Effective_Date      '=>$line_of_text[12],
					'Disable_Date        '=>$line_of_text[13],
					'Status              '=>$line_of_text[14],
					'Shipment_Num        '=>$line_of_text[15],
					'BREAK_QUANTITY      '=>$line_of_text[16],
					'UNIT                '=>$line_of_text[17],
					'Break_Price         '=>$line_of_text[18],
					'EFFECTIVE_DATE_BREAK'=>$line_of_text[19],
					'DISABLE_DATE_BREAK  '=>$line_of_text[20]
					);
		$this->oracle_model->save_po_asl($data);
		}
		}
	}
	public function po_oustanding()
	{
		$tab = "\t";
		$file_handle = fopen("/FTP/data/PO_OUTSTANDING.txt", "r");
		while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'Supplier_Name		  '=>$line_of_text[0],
					'Vendor_Site_Code     '=>$line_of_text[1],
					'Approval_Status      '=>$line_of_text[2],
					'Shipment_Status      '=>$line_of_text[3],
					'Purchase_Order_Number'=>$line_of_text[4],
					'Line_Number          '=>$line_of_text[5],   
					'So_Number_Att2       '=>$line_of_text[6],
					'So_Line_Number_Att3  '=>$line_of_text[7],
					'Group_Number         '=>$line_of_text[8],
					'Item_Number          '=>$line_of_text[9],
					'Item_Description     '=>"",
					'Description          '=>$line_of_text[11],
					'Loc_Ordered_Qty_SUM  '=>$line_of_text[12],
					'Loc_Received_Qty_SUM '=>$line_of_text[13],
					'Loc_Cancelled_Qty_SUM'=>$line_of_text[14],
					'Outstd_Qty           '=>$line_of_text[15],
					'Uom                  '=>$line_of_text[16],
					'Promised_Date        '=>$line_of_text[17],
					'Need_By_Date         '=>$line_of_text[18],
					'Currency             '=>$line_of_text[19],
					'Itm_Attr1            '=>$line_of_text[20],
					'Edi_Po_Num_Att1      '=>"",
					'Unit_Price_Sum       '=>$line_of_text[22],
					'So_Unit_Selling_Price'=>$line_of_text[23],
					'Document_Number      '=>$line_of_text[24],
					'Document_Line        '=>$line_of_text[25],
					'Ship_To_Loc_Code     '=>$line_of_text[26],
					'Buyer                '=>$line_of_text[27],
					'Via_Attr1            '=>$line_of_text[28],
					'User_Status_Att11    '=>$line_of_text[29],
					'Edi_Status_Att7      '=>$line_of_text[30],
					'Extract_Status_Att10 '=>$line_of_text[31],
					'Mew_Seq_No_Att6     '=>$line_of_text[32],
					'Order_Entry_Date     '=>$line_of_text[33],
					'Po_num'=>$line_of_text[4]
					);      
					$this->oracle_model->save_po_oustanding($data);
			}
		 }
		}
	public function transaction_completion()
	{
		$tab = "\t";
		$file_handle = fopen('/FTP/data/INV_TRX_PRODUCT_COMP.txt', 'r');
		while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'Item_Number'=>$line_of_text[0],
					'Subinventory_From'=>$line_of_text[1],
					'Subinventory_To'=>$line_of_text[2],
					'Transaction_Quantity'=>$line_of_text[3],
					'Transaction_Uom'=>$line_of_text[4],
					'Transaction_Date'=>$line_of_text[5],   
					'Transaction_Type'=>$line_of_text[6],
					'Transaction_Action'=>$line_of_text[7],
					'Locator'=>$line_of_text[8],
					'Revision'=>$line_of_text[9],
					'Transfer_Locator'=>$line_of_text[10],
					'Transfer_Org'=>$line_of_text[11],
					'Primary_Quantity'=>$line_of_text[12],
					'Primary_UOM'=>$line_of_text[13],
					'Source_Type'=>$line_of_text[14],
					'Shipment_Number'=>$line_of_text[15],
					'Waybill_Airbill'=>$line_of_text[16],
					'Freight_Code'=>$line_of_text[17],
					'Containers'=>$line_of_text[18],
					'Reason'=>$line_of_text[19],
					'Reference'=>"",
					'Costed'=>$line_of_text[21],
					'Supplier_Lot'=>$line_of_text[22],
					'Source_Code'=>$line_of_text[23],
					'Department_Code'=>$line_of_text[24],
					'Operation_Sequence'=>$line_of_text[25],
					'Expenditure_Type'=>$line_of_text[26],
					'Error_Code'=>$line_of_text[27],
					'Error_Explanation'=>$line_of_text[28],
					'Description'=>"",
					'Item_Type'=>$line_of_text[30],
					'Inventory_Item_Status_Code'=>$line_of_text[31],
					'Mew_Account'=>$line_of_text[32],
					'Mew_Export'=>$line_of_text[33],
					'Mew_Export_Desc'=>$line_of_text[34],
					'Mew_Item'=>$line_of_text[35],
					'Mew_Wip'=>$line_of_text[36],
					'Primary_Unit_Of_Measure'=>$line_of_text[37],
					'Unit_Weight'=>$line_of_text[38],
					'Unit_Volume'=>$line_of_text[39],
					'Unit_Length'=>$line_of_text[40],
					'Unit_Width'=>$line_of_text[41],
					'Unit_Height'=>$line_of_text[42],
					'Fixed_Lead_Time'=>$line_of_text[43],
					'Processing_Lead_Time'=>$line_of_text[44],
					'Postprocessing_Lead_Time'=>$line_of_text[45],
					'Planner_Code'=>$line_of_text[46],
					'Fixed_Lot_Multiplier'=>$line_of_text[47],
					'Legal_Entity'=>$line_of_text[48],
					'Operating_Unit_Code'=>$line_of_text[49],
					'Operating_Unit_Name'=>$line_of_text[50],
					'Code_unit'=>$line_of_text[51]);      
					$this->oracle_model->transaction_completion($data); 
			} 
		}
	}
	public function delete_table()
	{
		$this->oracle_model->dlt_table();
	}	
	
	public function SO_INV_GET()
	{ 
		$data=$this->oracle_model->SO_INV();
		
		foreach($data as $row)
		{
			print_r($row);
		}
	}
	public function dir()
	{
		$dir="/FTP/data/";
		$file= scandir($dir);
		$xfile=count($file);
		for($x=0;$x<$xfile;$x++){
		echo $fil['file_manager']=$file[$x];
	}
	}
	public function rj_note()
	{
	$file['note']='rj_note/form_rj.php';
	$this->load->view('index',$file);
	}
	public function src_rj()
	{
		$rj['po']=$this->input->post('po_number');
		$rj['rj_numb']=$this->input->post('rj_number');
		if($rj['rj_numb']==''){
			echo "<script type='text/javascript'>
						alert ('Wrong Parameters');
						 window.location = 'rj_note'
						</script> ";
		}else
		{	
		$file['data_rj']=$this->oracle_model->get_rj_note($rj);
		if(!empty($file['data_rj'])){
		$this->load->view('rj_note/print_rj.php',$file);
		}else
		{
			echo "<script type='text/javascript'>
						alert ('Data Empty');
						 window.location = 'rj_note'
						</script> ";
		}	
		}
	}
	public function bom_()
  {
	  $tab = "\t";
	$file_handle = fopen("/FTP/data/BOM_CURR.txt", "r");
	while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'Top_item			  '=>$line_of_text[0],
					'Level_               '=>$line_of_text[1],
					'Parent_item          '=>$line_of_text[2],
					'Parent_item_type     '=>$line_of_text[3],
					'Parent_description   '=>preg_replace('/[^A-Za-z0-9\-]/', ' ', $line_of_text[4]),
					'Alternate            '=>$line_of_text[5],
					'Completion_subinv    '=>$line_of_text[6],
					'Item_num             '=>$line_of_text[7],
					'Child_item           '=>$line_of_text[8],
					'Child_item_type      '=>$line_of_text[9],
					'Child_description    '=>preg_replace('/[^A-Za-z0-9\-]/', ' ', $line_of_text[10]),
					'Uom                  '=>$line_of_text[11],
					'Usage                '=>$line_of_text[12],
					'Extended_usage       '=>$line_of_text[13],
					'Effectivity_date_from'=>date('d-M-Y',strtotime($line_of_text[14])),
					'Supply_subinv        '=>$line_of_text[16],
					'Source_subinv        '=>$line_of_text[17],
					'Standard_cost        '=>$line_of_text[18],
					'Average_cost         '=>$line_of_text[19],
					'Substitute_Item      '=>$line_of_text[20],
					'Substitute_Uom       '=>$line_of_text[21],
					'Substitute_Quantity  '=>$line_of_text[22]
					);
	$this->oracle_model->bom_I($data);
		}
	}
  }
  public function bom_std()
  {
	  $tab = "\t";
	$file_handle = fopen("/FTP/data/BOM_STD.txt", "r");
	while ( !feof($file_handle) )
		{
		$line=fgets($file_handle,4096);
		$line_of_text = str_getcsv($line,$tab);
		if(isset($line_of_text[0])){
		$data=array(
					'Top_item			  '=>$line_of_text[0],
					'Level_               '=>$line_of_text[1],
					'Parent_item          '=>$line_of_text[2],
					'Parent_item_type     '=>$line_of_text[3],
					'Parent_description   '=>preg_replace('/[^A-Za-z0-9\-]/', ' ', $line_of_text[4]),
					'Alternate            '=>$line_of_text[5],
					'Completion_subinv    '=>$line_of_text[6],
					'Item_num             '=>$line_of_text[7],
					'Child_item           '=>$line_of_text[8],
					'Child_item_type      '=>$line_of_text[9],
					'Child_description    '=>preg_replace('/[^A-Za-z0-9\-]/', ' ', $line_of_text[10]),
					'Uom                  '=>$line_of_text[11],
					'Usage                '=>$line_of_text[12],
					'Extended_usage       '=>$line_of_text[13],
					'Effectivity_date_from'=>date('d-M-Y',strtotime($line_of_text[14])),
					'Supply_subinv        '=>$line_of_text[16],
					'Source_subinv        '=>$line_of_text[17],
					'Standard_cost        '=>$line_of_text[18],
					'Average_cost         '=>$line_of_text[19],
					'Substitute_Item      '=>$line_of_text[20],
					'Substitute_Uom       '=>$line_of_text[21],
					'Substitute_Quantity  '=>$line_of_text[22]
					);
	$this->oracle_model->bom_std($data);
		}
	 }
  }
}	