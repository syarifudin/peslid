<!doctype html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Panasonic Admin Panel</title>
	<link rel="shortcut icon" href="<?=base_url();?>assets/ico/p.png">
	<link rel="stylesheet" href="<?=base_url();?>css/layout.css" type="text/css" media="screen" />
	<script src="<?=base_url();?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>js/hideshow.js" type="text/javascript"></script>
	<script src="<?=base_url();?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=base_url();?>js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {
	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
</head>
<body>
	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html"> Admin</a></h1>
		</hgroup>
	</header> <!-- end of header bar -->
	<section id="secondary_bar">
		<div class="user">
			<p><?=$this->session->userdata('username')?> <a href="#"> ( inbox ) </a> </p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>	
	</section><!-- end of secondary bar -->	
	<aside id="sidebar" class="column">
		<br/>
		<hr/>
		<h3>Content</h3>
		<ul class="toggle">
			<li class="  icn_new_article "><a href="<?=base_url();?>">Production Order</a></li>
			<li class="icn_search"><a href="<?=base_url();?>index.php/admin/upload_po">Maintenance Reply PO </a></li>
			<li class="icn_categories"><a href="<?=base_url();?>index.php/admin/file_manager">Print Production Order(P/O)</a></li>
			<li class="icn_tags"><a href="<?=base_url();?>index.php/admin/item_maintenance"> Item Maintenance</a></li>
			<li class="icn_tags"><a href="<?=base_url();?>index.php/prpo"> PR Maintenance</a></li>
			<li class="icn_tags"><a href="<?=base_url();?>index.php/prpo/create_po"> PO Maintenance</a></li>
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a target="_blank" href="http://peslid-svr-026/admin/?p=peg">PR Browse</a></li>
			<li class="icn_add_user"><a href="<?=base_url();?>index.php/prpo/dn_po">PO Receive</a></li>
			<li class="icn_add_user"><a href="<?=base_url();?>index.php/prpo/return_po">PO Return</a></li>
			<li class="icn_add_user"><a href="<?=base_url();?>index.php/ex/">Maintenance CTRL PO</a></li>
			<li class="icn_add_user"><a href="<?=base_url();?>index.php/prpo/print_popr">Print (PR,PO,GRN)</a></li>
			<?php $cek=$this->session->userdata('username');
			if(($cek)=="syarif")
				{ ?>
			<li class="icn_view_users"><a href="<?=base_url();?>index.php/admin/get_view_user">View Users</a></li>
			<?php } ?>
			<?php $cek=$this->session->userdata('username');
			if(($cek)=="syarif")
				{ ?>
			<li class="icn_profile"><a href="<?=base_url();?>index.php/admin/maintanance_user">Maintenance User</a></li>
			<?php } ?>
			<li class="icn_profile"><a href="<?=base_url();?>index.php/admin/pocsv">Po CSV</a></li>
			<li class="icn_profile"><a href="<?=base_url();?>index.php/ex/se_report">Report PO</a></li>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/admin/data_queue">Data Queue</a></li>
			<li class="icn_add_user"><a href="<?=base_url();?>index.php/orcl_dwn/oracle_data">Oracle Report</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/npa/">NPA Maintenance</a></li>
			<?php $cek=$this->session->userdata('username');
			if(($cek)=="syarif") 
				{ ?>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/maintenance/rev_po">C__ PO</a></li>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/maintenance/mnc_po">DLT PO</a></li>
			<?php } ?>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/u_p/po_control">CTRL PO GSID</a></li>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/u_p/">UP PO</a></li>
			<?php $cek=$this->session->userdata('username');
			if(($cek)=="syarif") 
				{ ?>
			<li class="icn_settings"><a href="<?=base_url();?>index.php/ex/file" target="_blank">file</a></li>
			<?php } ?>
			<!--<li class="icn_settings"><a href="<?=base_url();?>index.php/discrete_job" target="_blank">Print Discrete Job</a></li> -->
			<li class="icn_settings"><a href="<?=base_url();?>index.php/oracle/rj_note" target="_blank">Rejected Note</a></li>
			<li class="icn_security"><a href="<?=base_url();?>index.php/bom">BOM List Maintenance</a></li>
			<li class="icn_jump_back"><a href="<?=base_url();?>index.php/admin/logout">Logout</a></li>
		</ul>
		<footer>
			<hr />
			<p><strong>Copyright &copy;2016 Peslid</strong></p>
			<p>Build by <a href="" style="font-weight:bold;">Information System Dept.</a></p>
			<p style="font-weight:bold;">Ext: 191</a></p>
		</footer>
	</aside><!-- end of sidebar --><section id="main" class="column">				
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Content Manager</h3>
		<ul class="tabs">             
   			<li><a href="#tab1">Production Order</a></li>
    		<li><a href="#tab2">Comments</a></li>
		</ul>                         
		</header>                     
		<div class="tab_container">   
		 <?php if(isset($data_po)) $this->load->view($data_po);?>
		 <?php if(isset($po_detil)) $this->load->view($po_detil);?>
		 <?php if(isset($di_detil)) $this->load->view($di_detil);?>
		 <?php if(isset($search)) $this->load->view($search);?>
		 <?php if(isset($file_)) $this->load->view($file_);?>
		 <?php if(isset($itm_maintenance)) $this->load->view($itm_maintenance);?>
		 <?php if(isset($datauser)) $this->load->view($datauser);?>
		 <?php if(isset($main_user)) $this->load->view($main_user);?>
		 <?php if(isset($pocustomer_)) $this->load->view($pocustomer_);?>
		 <?php if(isset($excel)) $this->load->view($excel);?>
		 <?php if(isset($ctrl_po)) $this->load->view($ctrl_po);?>
		 <?php if(isset($send_po)) $this->load->view($send_po);?>
		 <?php if(isset($main_item)) $this->load->view($main_item);?>
		 <?php if(isset($form_report)) $this->load->view($form_report);?>
		 <?php if(isset($mnc_po)) $this->load->view($mnc_po);?>
		 <?php if(isset($rev)) $this->load->view($rev);?>
		 <?php if(isset($queue)) $this->load->view($queue);?>
		 <?php if(isset($pocustomer_gemvid)) $this->load->view($pocustomer_gemvid);?>
		 <?php if(isset($pib)) $this->load->view($pib);?>
		 <?php if(isset($src_pib)) $this->load->view($src_pib);?>
		 <?php if(isset($pib_save)) $this->load->view($pib_save);?>
		 <?php if(isset($u_p)) $this->load->view($u_p);?>
		 <?php if(isset($un)) $this->load->view($un);?>
		 <?php if(isset($mul)) $this->load->view($mul);?>
		 <?php if(isset($ctrl)) $this->load->view($ctrl);?>
		 <?php if(isset($ctrl_po_)) $this->load->view($ctrl_po_);?>
		 <?php if(isset($data_dis)) $this->load->view($data_dis);?>
		 <?php if(isset($oracle_data)) $this->load->view($oracle_data);?>
		 <?php if(isset($print_dj)) $this->load->view($print_dj);?>
		 <?php if(isset($dncn_rpt)) $this->load->view($dncn_rpt);?>
		 <?php if(isset($form_exp_adv)) $this->load->view($form_exp_adv);?>
		 <?php if(isset($gl_journal_rpt)) $this->load->view($gl_journal_rpt);?> 
		 <?php if(isset($grn_rpt)) $this->load->view($grn_rpt);?>
		 <?php if(isset($tb_base_rpt)) $this->load->view($tb_base_rpt);?>
		 <?php if(isset($note)) $this->load->view($note);?>
		 <?php if(isset($print_note)) $this->load->view($print_note);?>
		 <?php if(isset($npa)) $this->load->view($npa);?>
		 <?php if(isset($in)) $this->load->view($in);?>
		 <?php if(isset($pr)) $this->load->view($pr);?>
		 <?php if(isset($prtopo)) $this->load->view($prtopo);?>
		 <?php if(isset($pomain)) $this->load->view($pomain);?>
		 <?php if(isset($dn_po)) $this->load->view($dn_po);?>
		 <?php if(isset($dn_p)) $this->load->view($dn_p);?>
		 <?php if(isset($return_po)) $this->load->view($return_po);?>
		 
			<!-- end of #tab2 -->     
		</div>                        
		<!-- end of .tab_container -->
		</article>
	</section>                        
</body>                               
</html>                               