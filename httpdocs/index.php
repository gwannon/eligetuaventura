<?php 
require_once(dirname(__FILE__)."/config.php"); 


//Datos apra la ayuda
$smarty->assign("player_classes", $player_classes);
$smarty->assign("player_races", $player_races);
$smarty->assign("player_gods", $player_gods);
$smarty->assign("player_items", $items);
$player_levels = array();	
$current_level 	= 0;
for ($i = 1000; $i < 50000; $i = $i + 1000) {
	$lvlbonus = getLvlBonus ($i);
	if($current_level !=  $lvlbonus['level'] ) {	
		$player_levels[] = array("px" => $i, "bonus" => $lvlbonus['bonus'], "level" => $lvlbonus['level']);
		$current_level =  $lvlbonus['level'];
	}
}
$smarty->assign("player_levels", $player_levels);


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
