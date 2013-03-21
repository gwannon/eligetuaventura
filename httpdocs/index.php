<?php 
require_once(dirname(__FILE__)."/config.php"); 

//Obtenemos el listado de pjs del usuario
if ($user_profile['id'] > 0) {
	$smarty->assign("chars", getChars ($user_profile['id']));
	$smarty->assign("adventures", getAllAdventures ());
	$smarty->assign("session", getSession($user_profile['id']));
}
$smarty->display('index.tpl');
die;
?>