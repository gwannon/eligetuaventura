<?php

class steps
{
	var $id;
	var $text;
	var $ave_id;
	var $video_url;
	var $nexts;
	var $fail;
	var $time;
	var $xp;
	var $gold;
	var $equip;

	function steps ($id)
	{
		$sql = "SELECT * FROM AVE_step WHERE id = $id";
		$res = mysql_query ($sql);
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
		$this->id = $id;
		$this->text = $row['text'];
		$this->ave_id = $row['ave_id'];
		$this->video_url = $row['video_url'];
		$this->nexts = getNextSteps ($id);
		$this->fail = $row['fail']; 
		$this->time = $row['time']; 
		$this->xp = $row['xp'];
		$this->gold = $row['gold'];
		$this->equip = json_decode($row['gold']);
		return $this;
	} #function steps
	function getId() { return $this->id; }
	function getText() { return $this->text; }
	function getRenderedText($charid) 
	{
		$char = getChar($charid);
		$string = $this->text;
		$string = eregi_replace ("\[charname\]", $char['charname'], $string);
		$string = eregi_replace ("\[charrace\]", $char['charrace'], $string);
		return $string;
	}
	function getAveId() { return $this->ave_id; }
	function getVideoUrl() { return $this->video_url; }
	function getFail() { return $this->fail; }
	function getNexts() { return $this->nexts; }
	function getTime() { return $this->time; }
	function getXP() { return $this->xp; }
	function getGold() { return $this->gold; }	
	function getEquip() { return $this->equip; }	
	function showStep()
	{
		global $session, $config;
		$html = "";
		if (file_exists($config['root_dir']."/steps/step_".$this->id.".jpg"))
		{
			$html .= "<img src='".$config['url']."steps/step_".$this->id.".jpg' style='width: 100%;'><br/><br/>";
		}	
		$html .= "<ul><li>".$this->getRenderedText($session['charid'])."</li></ul>";
		return $html;
	}
	function showNexts() 
	{
		global $session, $config, $player_classes;
		$nexts = $this->getNexts();
		$nextsteps = array();
		if (count($nexts) > 0)
		{
			
			$char = getChar($session['charid']);
			$temp_label = $char['charclass'];
			$charattack = $player_classes[$temp_label]['charattack'];
			//print_pre ($char);
			foreach ($nexts as $next)
			{
				if ($next['fail'] == "")
				{

					$next['text'] = eregi_replace ("\[charname\]", $char['charname'], $next['text']);
					$next['text'] = eregi_replace ("\[charrace\]", $char['charrace'], $next['text']);
					$next['text'] = eregi_replace ("\[charattack\]", $charattack, $next['text']);					
					$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text'], "type" =>  $next['type']);
				}
				else
				{
					$temp_fail = split (";", $next['fail']);
					
					if (count ($temp_fail)  == 1)
					{
						$fail = split ("\|", $temp_fail[0]);
						if ($fail[1] == 'gold' && $fail[0] > 0 && $char['gold'] >= $fail[0]) {
							$next['text'] = eregi_replace ("\[charname\]", $char['charname'], $next['text']);
							$next['text'] = eregi_replace ("\[charrace\]", $char['charrace'], $next['text']);
							$next['text'] = eregi_replace ("\[charattack\]", $charattack, $next['text']);							
							$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text'], "type" =>  $next['type']);
						} else if (hasCharExtra ($fail[1], $fail[0], $session)) {
							$next['text'] = eregi_replace ("\[charname\]", $char['charname'], $next['text']);
							$next['text'] = eregi_replace ("\[charrace\]", $char['charrace'], $next['text']);
							$next['text'] = eregi_replace ("\[charattack\]", $charattack, $next['text']);							
							$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text'], "type" =>  $next['type']);			
						}
					}
					else if (count ($temp_fail)  == 2)
					{
						$fail = split ("\|", $temp_fail[0]);
						if (hasCharExtra ($fail[1], $fail[0], $session) || ( $fail[1] == "x" && $fail[0] == 'x'))
						{
							$fail = split ("\|", $temp_fail[1]);
							if (!hasCharExtra ($fail[1], $fail[0], $session))
							{
								$next['text'] = eregi_replace ("\[charname\]", $char['charname'], $next['text']);
								$next['text'] = eregi_replace ("\[charrace\]", $char['charrace'], $next['text']);
								$next['text'] = eregi_replace ("\[charattack\]", $charattack, $next['text']);								
								$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text'], "type" =>  $next['type']);
							}		
						}
					} 
				}
			}
		}
		return $nextsteps;
	}
	
	function isEnd() {
		$nexts = $this->getNexts();
		if (count($nexts) == 0) return true;
		else return false;
	}
} # class steps

function checkFail($checkfail, $session) {
	global $player_classes;
	$temp_fail = split ("\|", $checkfail);
	$temp_chance = split(",", $temp_fail[0]);
	$chance = (isset($temp_chance[0])) ? $temp_chance[0] : "";
	$hab = (isset($temp_chance[1])) ? $temp_chance[1] : "";
	
	$char = getChar($session['charid']);
	
	if ($hab == 'ata') {
		$temp_label = $char['charclass'];
		$hab = $player_classes[$temp_label]['ata'];
	}
	
	$redirect = (isset($temp_fail[1])) ? $temp_fail[1] : "";
	$label = (isset($temp_fail[2])) ? $temp_fail[2] : "";
	$value = (isset($temp_fail[3])) ? $temp_fail[3] : "";
	$return = array("id" => 0, "text" => "");
	if ($checkfail != '') {
		$char = getChar($session['charid']);
		
		$lvlbonus = getLvlBonus ($char['xp']);
		$dice = rand (1,20);
		if ($hab == 'dmg' && $chance > 0) {
			$equip_bonus = getEquipBonus('con', $char['equip']);
			$bonus = (isset($char['con'])) ? getHabBonus ($char[$hab]): "";
			$html = $dice . " (D20) + " . $bonus ." (".$char['con']." con) + ".$lvlbonus['bonus']." (Nivel  ".$lvlbonus['level'].") + ".$equip_bonus['bonus']." ( Equipo ".$equip_bonus['items'].") ";
			$dice = $dice + $bonus + $equip_bonus['bonus'] + $lvlbonus['bonus'];
			$html .= " = ".$dice." contra DIF ". $chance.". ";
			$return['text'] = $html;
		} else if ($chance > 0) {
			$equip_bonus = getEquipBonus($hab, $char['equip']);
			$bonus = (isset($char[$hab])) ? getHabBonus ($char[$hab]): "";
			$html = $dice . " (D20) + " . $bonus ." (".$char[$hab]." ". $hab .") + ".$lvlbonus['bonus']." (Nivel  ".$lvlbonus['level'].") + ".$equip_bonus['bonus']." ( Equipo ".$equip_bonus['items'].") ";
			$dice = $dice + $bonus + $equip_bonus['bonus'] + $lvlbonus['bonus'];
			$html .= " = ".$dice." contra DIF ". $chance.". ";
			$return['text'] = $html;
		}
		
		if ($hab == 'dmg' && $dice < $chance) {
			if (hasCharExtra ('status', 'magullado', $session)) {
				deleteCharExtra('status', 'magullado', $session);
				updateCharExtra('status', 'herido', $session);
				$return['text'] = "<img src=\"/objects/step_damage.jpg\"> Estas herido.<br/><br/>";
				return $return;
			} else if (hasCharExtra ('status', 'herido', $session)) {
				deleteCharExtra('status', 'herido', $session);
				updateCharExtra('status', 'insconciente', $session);
				$return['id'] = $redirect;
				return $return;
			} else {
				updateCharExtra('status', 'magullado', $session);
				$return['text'] = "<img src=\"/objects/step_damage.jpg\"> Estas magullado.<br/><br/>";
				return $return;
			}
		} else if ($dice < $chance) {
			$return['id'] = $redirect;
			return $return;
		} else if ($label != '' && $value != '' && hasCharExtra ($label, $value, $session)) {
			$return['id'] = $redirect;
			return $return;
		} else if ($label != '' && $value != '') {
			updateCharExtra($label, $value, $session);
		}
	}
	return 0;
}

function getEquipBonus($hab, $equip) {
	$bonus_equip = array("bonus" => 0, "items" => "");
	if (count($equip) > 0) {
		foreach ($equip as $nombre=>$bonus) {
			$temp_bonus = split("\|", $bonus);
			if ($temp_bonus[1] == $hab) {
				$bonus_equip['bonus'] = $bonus_equip['bonus'] + $temp_bonus[0];
				$bonus_equip['items'] .= " - ". $nombre;
			}
		}	
	}
	return $bonus_equip;
}

function getAllAdventures () {
	$sql = "SELECT * FROM AVE_aventura ORDER BY id";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
		$datas[] = $row;
	}
	return $datas;
}

function getAdventure ($ave_id) {
	$sql = "SELECT * FROM AVE_aventura WHERE id = $ave_id";
	$res = mysql_query ($sql);
	$row = mysql_fetch_array($res, MYSQL_ASSOC);
	return $row;
}

function getStep($id) {
	$sql = "SELECT * FROM AVE_step WHERE id = $id";
	$res = mysql_query ($sql);
	$row = mysql_fetch_array($res, MYSQL_ASSOC);
	return $row;
}

function getNextSteps ($id) {
	$datas = array();
	$sql = "SELECT * FROM AVE_next_step WHERE from_id = $id ORDER BY type DESC";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
		$datas[] = $row;
	}
	return $datas;
}

function generateVideoEmbed ($url_video, $thumb = false) {
	if (ereg ("youtube", $url_video)) {
		$temp_url = split ("v=", $url_video);
		$video_code = $temp_url[1];
		if ($thumb) {
			//$html = "<object type=\"application/x-shockwave-flash\" style=\"width:425px;height:355px\" data=\"http://www.youtube.com/v/1RtWkywPJ5I&hl=en\"><param name=\"movie\" value=\"http://www.youtube.com/v/1RtWkywPJ5I&hl=en\" /></object>";

		} else {
			$html = "<fb:swf swfbgcolor=\"000000\" imgstyle=\"border-width:3px; border-color:white;\" swfsrc='http://www.youtube.com/v/".$video_code."' imgsrc='http://img.youtube.com/vi/".$video_code."/2.jpg' width='340' height='270' />";
		}
	}
	return $html;
}

function getChars ($profile_id) {
	$sql = "SELECT * FROM AVE_chars WHERE profile_id = $profile_id";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
		$datas[] = $row;
	}
	return $datas;
}

function getChar($charid) {
	if ($charid > 0) {
		$sql = "SELECT * FROM AVE_chars WHERE id = $charid";
		$res = mysql_query ($sql);
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
		$row['equip'] = json_decode($row['equip']);
		return $row;
	}
}

function createChar ($charname, $charclass, $charrace, $profile_id, $fue, $des, $con, $int, $sab, $car, $gold = 0, $equip, $god) {
	$sql = "INSERT INTO `AVE_chars` (`id`,`charname`,`charclass`,`charrace`,`profile_id`,`fue`,`des`,`con`,`int`,`sab`,`car`,`gold`,`equip`,`god` ) VALUES ('', '".$charname."', '".$charclass."',  '".$charrace."','".$profile_id."', '".$fue."', '".$des."', '".$con."', '".$int."', '".$sab."', '".$car."', '".$gold."', '".$equip."', '".$god."')";
	$res = mysql_query($sql);
	return mysql_insert_id();
}

function addXP ($charid, $value) {
	if ($value > 0) $sql = " UPDATE `AVE_chars` SET xp = xp + $value WHERE id = $charid";
	else  $sql = " UPDATE `AVE_chars` SET xp = xp $value WHERE id = $charid";
	$res = mysql_query ($sql);
	return sprintf (gettext("Has obtenido %s puntos de experiencia. "), $value);
} 

function addGold ($charid, $value) {
	$sql = " UPDATE `AVE_chars` SET gold = gold + $value WHERE id = $charid";
	$res = mysql_query ($sql);
	if ($value > 0) return sprintf (gettext("<img src=\"/objects/step_gold.jpg\"> Has ganado %s monedas de oro.<br/><br/>"), $value);
	else if ($value < 0) return sprintf (gettext("<img src=\"/objects/step_gold.jpg\"> Has perdido %s monedas de oro.<br/><br/>"), abs ($value));
} 


function getHabBonus ($value) {
	$value = $value -10;
	$bonus = $value/2;
	return intval($bonus);
}

function getLvlBonus ($value) {
	$end = 0;
	$counter = 0;
	$level = 0;
	while ($end <= $value) {
		$counter++;
		$end = $end + ($level*1000); 
		if ($end <= $value) $level = $counter;
	}
	$lvlbonus['level'] = floor($level) +1;
	$lvlbonus['bonus'] = floor ($lvlbonus['level']/2);
	return $lvlbonus;
}

function getSession($profile_id) {
	$sql = "SELECT * FROM AVE_session WHERE profile_id = $profile_id";
	$res = mysql_query ($sql);
	$num = mysql_num_rows ($res);
	if ($num > 0) {
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
	} else {
		$sql = "INSERT INTO `AVE_session` (`profile_id`, `charid`) VALUES ('$profile_id', '')";
		$res = mysql_query ($sql);
		$row = array ("profile_id" => $profile_id);
	}
	return $row;
}

function updateSession($profile_id, $label, $value) {
	$sql = "UPDATE `AVE_session` SET $label = '$value' WHERE profile_id = $profile_id";
	$res = mysql_query ($sql);
}

function updateCharExtra($label, $value, $session) {
	$step = new steps ($session['step']);
	$sql = "INSERT INTO `AVE_chars_extra` (`id`, `charid`, `label`, `value`, `ave_id`) VALUES (NULL, '".$session['charid']."', '$label', '$value', '".$step->getAveId()."' )";
	$res = mysql_query ($sql);	
}

function deleteCharExtra($label, $value, $session) {
	$sql = "DELETE FROM `AVE_chars_extra` WHERE charid = '".$session['charid']."' AND label ='$label' AND value = '$value'";
	$res = mysql_query ($sql);	
}

function hasCharExtra ($label, $value, $session) {
	$sql = "SELECT COUNT(id) AS total FROM `AVE_chars_extra` WHERE charid = '".$session['charid']."' AND label ='$label' AND value = '$value'";
	$res = mysql_query ($sql);
	$row = mysql_fetch_array ($res);
	if ($row['total'] > 0) return true;
	else return false;
}

function getCharExtra ($charid, $label) {
	$datas = array();
	$sql = "SELECT * FROM `AVE_chars_extra` WHERE charid = '".$charid."' AND label ='$label'";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array ($res, MYSQL_ASSOC)) {
		$datas[] = $row;
	}
	return $datas;
}

function deleteAllCharExtraByAveId ($charid, $ave_id) {
	$sql = "DELETE FROM AVE_chars_extra WHERE charid = $charid AND ave_id = $ave_id";
	$res = mysql_query ($sql);
}

function getRanking () {
	$chars = array();
	$sql = "SELECT  `charname`, `charclass`, `charrace`, `xp` FROM  `AVE_chars` ORDER BY `AVE_chars`.`xp` DESC LIMIT 0, 50";
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
		$chars[] = $row;
	}
	return $chars;
}

//Funciones varias --------------------------------------------------------------
//-------------------------------------------------------------------------------

function t_ ($string) { echo gettext($string); }
function print_pre ($text) { echo "<pre>"; print_r ($text); echo  "</pre>"; }

?>
