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

$smarty->assign("adventures", getAllAdventures ());

$chars = array();
$sql = "SELECT  `charname`, `charclass`, `charrace`, `xp` FROM  `AVE_chars` ORDER BY `AVE_chars`.`xp` DESC LIMIT 0, 50";
$res = mysql_query($sql);
while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
	$chars[] = $row;
}
$smarty->assign("rchars", $chars);

$smarty->display('index.tpl');
die;
