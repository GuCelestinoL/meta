<?php
require('includes/misc/headers.php'); //Load sessions, erorr reporting & ob.

define('INIT_SITE', TRUE);

require('includes/configuration.php'); //Load configuratio  n file

require('includes/misc/connect.php');
require('includes/misc/func_lib.php'); 
require('includes/classes/account.php'); 
require('includes/classes/website.php'); 
require('includes/classes/cache.php'); 
require('includes/classes/plugins.php'); 

/******* LOAD PLUGINS ***********/
plugins::init('classes');
plugins::init('javascript');
plugins::init('modules');
plugins::init('styles');
plugins::init('pages');

$account = new account;
$account->getRemember(); //Remember thingy.

//This is to prevent the error "Undefined index: p"
if (!isset($_GET['p'])) 
	$_GET['p'] = 'home';

###SESSION SECURITY###
if(!isset($_SESSION['last_ip']) && isset($_SESSION['cw_user'])) 
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
	
elseif(isset($_SESSION['last_ip']) && isset($_SESSION['cw_user'])) 
{
	if($_SESSION['last_ip']!=$_SERVER['REMOTE_ADDR'])
    {
		header("Location: ?p=logout");
        exit;
    }
	$_SESSION['last_ip']=$_SERVER['REMOTE_ADDR'];
}
