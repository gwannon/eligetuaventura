<?php

ini_set('display_errors', 0);

//Cargamos las librerias que vamos a usar
require(dirname(__FILE__)."/libs/class.adventure.php");
require(dirname(__FILE__)."/libs/smarty/libs/Smarty.class.php");
require(dirname(__FILE__)."/libs/facebook/facebook.php");

//Datos generales
$db_name = "eligetuaventura";
$db_user = "root";
$db_password = "pfr07pCE02";
$db_host = "localhost";

$link = mysql_connect($db_host, $db_user, $db_password);
mysql_select_db ($db_name, $link);
mysql_set_charset('utf8', $link);


//Configuramos el sistema de plantilla
$smarty = new Smarty;
require(dirname(__FILE__)."/libs/smarty/libs/plugins/smarty-gettext.php");
$smarty->template_dir = array(dirname(__FILE__)."/templates/");
$smarty->compile_dir = dirname(__FILE__)."/templates/templates_c/";
$smarty->registerPlugin("block","t", "smarty_translate");
$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

//Config
$config['url'] = "http://eligetuaventura.gwannon.com/";
$config['canvas_url'] = "http://eligetuaventura.gwannon.com/";
$config['root_dir'] = "/var/www/vhosts/eligetuaventura.gwannon.com/httpdocs/";
$Name = "Elige tu Aventura";
$smarty->assign("Name", $Name);
$Domain = "www.gwannon.com/eligetuaventura";
$smarty->assign("Domain", $Domain);
$smarty->assign("URI", $_SERVER['REQUEST_URI']);


//Conexión con Facebook --------------------------------------------------------------------------
//------------------------------------------------------------------------------------------------
$facebook = new Facebook(array(
	'appId'  => '75982369444',
	'secret' => '21b8ccc4f7705954914bab4afc3583c4',
));
$smarty->assign("facebook", $facebook);
$user = $facebook->getUser();
if ($user) {
	try {
		$user_profile = $facebook->api('/me');
		$smarty->assign("user", $user);
		$smarty->assign("user_profile", $user_profile);
		$smarty->assign("logout_url", $facebook->getLogoutUrl());
	} catch (FacebookApiException $e) {
		/*echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
		$user = null;
		die;*/
	}
}

?>
