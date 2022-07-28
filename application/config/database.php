<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = 'peslid-svr-012';
$db['default']['username'] = 'sa';
$db['default']['password'] = 'under300';
$db['default']['database'] = 'purchasing';
$db['default']['dbdriver'] = 'sqlsrv';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


$tnsname ='(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=xadsrv06.arrow.mew.co.jp)(PORT=1521) ))(CONNECT_DATA=(SERVICE_NAME = sutfasp01_usr)))';
$db['orcl_db']['hostname'] = $tnsname;
$db['orcl_db']['username'] = "USR_70L5968";
$db['orcl_db']['password'] = "PWD_70L5968";
$db['orcl_db']['database'] = "sutfasp01_usr";
$db['orcl_db']['dbdriver'] = "oci8";
$db['orcl_db']['dbprefix'] = "";
$db['orcl_db']['pconnect'] = TRUE;
$db['orcl_db']['db_debug'] = TRUE;
$db['orcl_db']['cache_on'] = FALSE;
$db['orcl_db']['cachedir'] = "";
$db['orcl_db']['char_set'] = "utf8";
$db['orcl_db']['dbcollat'] = "utf8_general_ci";