<?php
class ldap extends CI_Controller {
    public function __construct()
    {
	  parent::__construct(); 
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('oracle_model');
		$this->load->library('session');
		$this->orcl= $this->load->database('orcl_db',TRUE);
	}
	public function index()
	{
		$data['user']=$this->input->post('user');
		$data['pwd']=$this->input->post('pwd');
		if ($data['pwd']!="" &&$data['user']!=""){
		$this->ldap_login($data);
		}else
		{
				$msg = "Invalid user  / password";
				$this->ldap_error_login($msg);
		}
	}
	function ldap_login($data)
	{
		if(isset($data['user'])&& isset($data['pwd'])){
			$adServer = "ldap://peslid-svr-028.intranet.co.id";
			$ldap = ldap_connect($adServer);
			$username =$data['user'];
			$password =$data['pwd'];
			$ldaprdn = 'intranet' . "\\" . $username;
			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			$bind = @ldap_bind($ldap, $ldaprdn, $password);
			 if ($bind) {
				$filter="(sAMAccountName=$username)";
				$result = ldap_search($ldap,"DC=intranet,DC=co,DC=id",$filter);
				ldap_sort($ldap,$result,"sn");
				$info = ldap_get_entries($ldap, $result);
				for ($i=0; $i<$info["count"]; $i++)
				{
					if($info['count'] > 1)
						break;
							$sess_row['logged_in'] = 'yesGetMeLogin';
							$sess_row['username'] = $info[$i]["sn"][0] ." ". $info[$i]["givenname"][0];
							$sess_row['user_id'] =$info[$i]["samaccountname"][0];
							$sess_row['desc'] =$info[$i]["description"][0];
							$sess_row['email'] =$info[$i]["mail"][0];
							$this->session->sess_expiration=7200;
							$this->session->set_userdata($sess_row);
						  //$userDn = $info[$i]["distinguishedname"][0]; 
						  redirect('e_app');
				}
				@ldap_close($ldap);
			} else {
				$msg = "Invalid user  / password";
				$this->ldap_error_login($msg);
			} 
		}else{
			echo "emaillengkapidata";
			} 
	}
	function ldap_error_login($msg)
	{
		$mes['msg']=$msg; 
		$this->load->view('e-app/login.php',$mes);
	}
	function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php/e_app/login');
		}
		else
		{
			$this->session->sess_destroy();
			header('location:'.base_url().'index.php/e_app/login');
		}
	}
}	