<?php

header('Access-Control-Allow-Origin: *');  

require_once(dirname(__FILE__)."/config.php");
//ini_set('display_errors', 1);
$json = array();

$action = $_REQUEST['action'];

if($action == "sell" && isset($_REQUEST['charid']) && $_REQUEST['charid'] > 0 && isset($_REQUEST['item']) && $_REQUEST['item'] > 0) {
	$charid = $_REQUEST['charid'];
	$char_datas = getChar($charid);
	$json = $_REQUEST;
	
	$item_id = $_REQUEST['item'];
	if (array_key_exists ($items[$item_id]['name'], $char_datas['equip'])) { //Comprabamos que no lo haya comprado antes
		//metemos a pasta al Jugador
		$sql = " UPDATE `AVE_chars` SET gold = gold + ".($items[$item_id]['gold']/2)." WHERE id = $charid";
		$res = mysql_query ($sql);
		
		//Actualziamos su equipo
		$current_equip = array();
		foreach ($char_datas['equip'] as $name=>$bonus) {
			if($items[$item_id]['name'] != $name) $current_equip[$name] = $bonus;
		}
		$json =json_encode ($current_equip);
		$sql = " UPDATE `AVE_chars` SET equip = '".$json."' WHERE id = $charid";
		$res = mysql_query ($sql);
		$char_datas = getChar($charid);
		$char_datas['equip'] = json_decode ($char_datas['equip']);
	}

} else if($action == "buy" && isset($_REQUEST['charid']) && $_REQUEST['charid'] > 0 && isset($_REQUEST['item']) && $_REQUEST['item'] > 0) {
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
	$slots = array();
	foreach ($items as $key=>$item) {
		if(array_key_exists ($item['name'], $char_datas['equip']) && !in_array($item['slot'], $slots)) $slots[] = $item['slot'];
	}
	//print_pre ($slots);
	foreach ($items as $key=>$item) {
		if(in_array($item['slot'], $slots) && !array_key_exists ($item['name'], $char_datas['equip'])) { 
			$json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => $item['gold'], "bonus" => $item['bonus'], "status" => "noslot", "slot" => $item['slot']);
		
		} else if (array_key_exists ($item['name'], $char_datas['equip'])) {
			 $json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => ($item['gold']/2), "bonus" => $item['bonus'], "status" => "bought", "slot" => $item['slot']); } else if ($item['gold'] <= $char_datas['gold']) {
			 $json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => $item['gold'], "bonus" => $item['bonus'], "status" => "buy", "slot" => $item['slot'], "key" => $key);
		

		} else { 
			$json[] = array("id" => $item['id'], "name" => $item['name'], "gold" => $item['gold'], "bonus" => $item['bonus'], "status" => "nogold", "slot" => $item['slot']);
		}
	}	

} else if ($action == "createchar" && isset($_REQUEST['charname']) && $_REQUEST['charname'] != '') { // Crear peronajes

	$charname = $_REQUEST['charname'];
	$charclass = $_REQUEST['charclass'];
	$charrace = $_REQUEST['charrace'];
	$chargod = $_REQUEST['chargod'];
	$user_profile_id = $_REQUEST ['userid'];
	
	$fue = $player_classes[$charclass]['fue'] + $player_races[$charrace]['fue'] + $player_races[$chargod]['fue']; 
	$des = $player_classes[$charclass]['des'] + $player_races[$charrace]['des'] + $player_races[$chargod]['des']; 
	$con = $player_classes[$charclass]['con'] + $player_races[$charrace]['con'] + $player_races[$chargod]['con'];  
	$int = $player_classes[$charclass]['int'] + $player_races[$charrace]['int'] + $player_races[$chargod]['int'];  
	$sab = $player_classes[$charclass]['sab'] + $player_races[$charrace]['sab'] + $player_races[$chargod]['sab'];  
	$car = $player_classes[$charclass]['car'] + $player_races[$charrace]['car'] + $player_races[$chargod]['car']; 


	foreach ($items as $item) {
		if ($item['name'] == $player_classes[$charclass]['weapon']) {
			$equip_label = $item['name'];
			$equip_bonus = $item['bonus'];
			$equip[$equip_label] = $equip_bonus;
			break;
		}
	}

	$equip = json_encode ($equip);

	$char_id = createChar ($charname, $charclass, $charrace, $user_profile_id, $fue, $des, $con, $int, $sab, $car, $initial_gold, $equip, $chargod);
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
	/*print_pre ($char);
	$char['charclass'] = html_entity_decode($char['charclass']);
	print_pre ($char);	
	$char['charrace'] = html_entity_decode($char['charrace']);*/
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
		$temp = checkFail($step->getFail(), $session);
		$json['message'] .= "<br/>" . $temp['text'];
		$check_id = $temp['id'];
		if ($check_id > 0) {
			$step = new steps ($check_id); 
			$temp = checkFail($step->getFail(), $session);
			$json['message'] .= "<br/>" . $temp['text'];
		}
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
