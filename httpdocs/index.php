<?php 
require_once(dirname(__FILE__)."/config.php"); 

//Obtenemos el listado de pjs del usuario
if ($user_profile['id'] > 0) {
	$smarty->assign("chars", getChars ($user_profile['id']));
	$smarty->assign("adventures", getAllAdventures ());
	$smarty->assign("session", getSession($user_profile['id']));
} else {
	$chars = array();
	$sql = "SELECT  `charname`, `charclass`, `charrace`, `xp` FROM  `AVE_chars` ORDER BY `AVE_chars`.`xp` DESC LIMIT 0, 50";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
		$chars[] = $row;
	}
	$smarty->assign("chars", $chars);	
}
$smarty->display('index.tpl');
die;
?>