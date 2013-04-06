<?php 
require_once(dirname(__FILE__)."/config.php"); 

$smarty->assign("player_classes", $player_classes);
$smarty->assign("player_races", $player_races);
$smarty->assign("player_gods", $player_gods);

//Obtenemos el listado de pjs del usuario
if ($user_profile['id'] > 0) {
	$smarty->assign("chars", getChars ($user_profile['id']));
	$smarty->assign("session", getSession($user_profile['id']));
}

//Listado de aventuras
$smarty->assign("adventures", getAllAdventures ());

//Listado de personajes del ranking
$smarty->assign("rchars", getRanking ());

$smarty->display('index.tpl');
die;

?>
