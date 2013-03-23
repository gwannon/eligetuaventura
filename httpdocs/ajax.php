<?php

header('Access-Control-Allow-Origin: *');  

require_once(dirname(__FILE__)."/config.php");
//ini_set('display_errors', 1);
$json = array();

$action = $_REQUEST['action'];

$items = array ();
$items[1] = array ("id" => 1, "name" => "Guanteletes de Fuerza", "bonus" => "+2|fue", "gold" => 200);
$items[2] = array ("id" => 2, "name" => "Sandalias de Ladr&oacute;n", "bonus" => "+2|des", "gold" => 250);
$items[3] = array ("id" => 3, "name" => "Capa de Esplendor", "bonus" => "+2|car", "gold" => 250);
$items[4] = array ("id" => 4, "name" => "Gorro del Saber", "bonus" => "+2|sab", "gold" => 250);
$items[5] = array ("id" => 5, "name" => "Cintur&oacute;n de Resistencia", "bonus" => "+2|con", "gold" => 250);
$items[6] = array ("id" => 6, "name" => "Anillo &Eacute;lfico", "bonus" => "+2|int", "gold" => 250);
$items[7] = array ("id" => 7, "name" => "Faja de Superfuerza", "bonus" => "+4|fue", "gold" => 600);
$items[8] = array ("id" => 8, "name" => "Guantes de Ladr&oacute;n", "bonus" => "+4|des", "gold" => 600);	

if($action == "buy" && isset($_REQUEST['charid']) && $_REQUEST['charid'] > 0 && isset($_REQUEST['item']) && $_REQUEST['item'] > 0) {
	$charid = $_REQUEST['charid'];
	$char_datas = getChar($charid);
	$json = $_REQUEST;
	
	$item_id = $_REQUEST['item'];
	if ($char_datas['gold'] >= $items[$item_id]['gold']) //Comprobamos que tenga pasta
	{
		if (!array_key_exists ($items[$item_id]['name'], $char_datas['equip'])) //Comprabamos que no lo haya comprado antes
		{
			//Quitamos a pasta al Jugador
			$sql = " UPDATE `AVE_chars` SET gold = gold - ".$items[$item_id]['gold']." WHERE id = $charid";
			$res = mysql_query ($sql);
			
			//Actualziamos su equipo
			$current_equip = array();
			foreach ($char_datas['equip'] as $name=>$bonus)
			{
				$current_equip[$name] = $bonus;
			}
			$new_object = $items[$item_id]['name'];
			$current_equip[$new_object] = $items[$item_id]['bonus'];
			//print_r ($current_equip);
			$json =json_encode ($current_equip);
			$sql = " UPDATE `AVE_chars` SET equip = '".$json."' WHERE id = $charid";
			//echo "<li>$sql";
			$res = mysql_query ($sql);
		
			$char_datas = getChar($charid);
			$char_datas['equip'] = json_decode ($char_datas['equip']);
		}
	}
} else if($action == "shop" && isset($_REQUEST['charid']) && $_REQUEST['charid'] > 0) {

	$charid = $_REQUEST['charid'];
	$char_datas = getChar($charid);
	//$char_datas['equip'] = json_decode ($char_datas['equip']);
	//print_pre($char_datas['equip']);
	//print_pre($items);	
	foreach ($items as $key=>$item)
	{
		if (array_key_exists ($item['name'], $char_datas['equip'])) $json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => $item['gold'], "bonus" => $item['bonus'], "status" => "bought");
		else if ($item['gold'] <= $char_datas['gold'])  $json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => $item['gold'], "bonus" => $item['bonus'], "status" => "buy", "key" => $key);
		else $json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => $item['gold'], "bonus" => $item['bonus'], "status" => "nogold");
	}	

} else if ($action == "createchar" && isset($_REQUEST['charname']) && $_REQUEST['charname'] != '') { // Crear peronajes

	$charname = $_REQUEST['charname'];
	$charclass = $_REQUEST['charclass'];
	$charrace = $_REQUEST['charrace'];
	$user_profile_id = $_REQUEST ['userid'];
	
	if ($charclass == "Picaro") { $fue = 16; $des = 20; $con = 16; $int = 14; $sab = 14; $car = 20; }
	else if ($charclass == "Guerrero") { $fue = 20; $des = 20; $con = 16; $int = 14; $sab = 16; $car = 14; }
	else if ($charclass == "Barbaro") { $fue = 20; $des = 16; $con = 20; $int = 14; $sab = 16; $car = 14; }
	else if ($charclass == "Mago") { $fue = 14; $des = 16; $con = 14; $int = 20; $sab = 20; $car = 16; }
	else if ($charclass == "Clerigo") { $fue = 14; $des = 14; $con = 16; $int = 20; $sab = 20; $car = 16; }

	if ($charrace == "Humano") {  }
	else if ($charrace == "Enano") { $con = $con + 2; $car = $car - 2;  }
	else if ($charrace == "Elfo") { $des = $des +2; $con = $con - 2; }
	else if ($charrace == "Gnomo") { $car = $car + 2; $fue = $fue - 2; }
	else if ($charrace == "Halfling") { $des = $des +2; $fue = $fue - 2; }

	$char_id = createChar ($charname, $charclass, $charrace, $user_profile_id, $fue, $des, $con, $int, $sab, $car);
	$json = getChar($char_id);
} else if ($action == "getchar") { //SACAMOS LOS DATOS DEL PERSONAJE
	$char = getChar(intval($_REQUEST['charid']));
	$equip = array();
	foreach($char['equip'] as $key => $bonus) {
		foreach($items as $item) {
			if ($item['name'] ==  $key) {
				$equip[] = $item;
				break;
			}
		}
		
	}
	$char['equip'] = $equip;
	$json = $char;
} else if ($action == "initadv") { //INICIAMOS LA AVENTURA

	$json = array();
	$user_profile_id = $_REQUEST ['userid'];
	$session = getSession($user_profile_id);
	if (isset($_REQUEST['stepid']) && intval($_REQUEST['stepid']) > 0) $step_id = intval($_REQUEST['stepid']);
	else $step_id = $session['step'];
	if (isset($_REQUEST['charid']) && intval($_REQUEST['charid']) > 0) $char_id = intval($_REQUEST['charid']);
	else $step_id = $session['step'];
	updateSession($user_profile_id, 'charid', $char_id);
	updateSession($user_profile_id, 'step', $step_id);
	$session = getSession($user_profile_id);
	
	$step = new steps ($step_id);
	$temp = checkFail($step->getFail(), $session);
	$check_id = $temp['id'];
	$json['message'] = $temp['text'];

	if ($check_id > 0) {
		$step = new steps ($check_id); 
	}
	
	if ($step->getXP() != 0) $json['message'] .= addXP ($session['charid'], $step->getXP());
	if ($step->getGold() != 0) $json['message'] .= addGold ($session['charid'], $step->getGold());
	
	$json['step'] = $step->showStep();
	
	updateSession($user_profile_id, 'time', $session['time']+$step->getTime());
	$session = getSession($user_profile_id);
	
	if($step->isEnd()) {
		$ave = getAdventure ($step->getAveId());
		$tokens = array('adventure' => $ave['title'], 'turns' => $session['time']);
		$char_datas = getChar($session['charid']);
		updateSession($user_profile_id, 'step', 0);
		updateSession($user_profile_id, 'time', 0);
		$session = getSession($user_profile_id);
		deleteAllCharExtraByAveId ($session['charid'], $step->getAveId());
		$json['next'] = "";
	}
	else {
		$json['next'] = $step->showNexts();
	}
		
	$json['session'] = $session;
	
	$json['adv'] = getAdventure ($step->getAveId());
	$json['objects'] = getCharExtra ($session['charid'], 'object');
	$json['persons'] = getCharExtra ($session['charid'], 'person');
	$json['status'] = getCharExtra ($session['charid'], 'status');
}
echo json_encode($json);

?>