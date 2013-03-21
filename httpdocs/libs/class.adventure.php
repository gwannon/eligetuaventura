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
		$html .= "<strong>".$this->getRenderedText($session['charid'])."</strong>";
		return $html;
	}
	function showNexts() 
	{
		global $session, $config;
		$nexts = $this->getNexts();
		$nextsteps = array();
		if (count($nexts) > 0)
		{
			
			$char = getChar($session['charid']);
			foreach ($nexts as $next)
			{
				if ($next['fail'] == "")
				{

					$next['text'] = eregi_replace ("\[charname\]", $char['charname'], $next['text']);
					$next['text'] = eregi_replace ("\[charrace\]", $char['charrace'], $next['text']);
					$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text']);
				}
				else
				{
					$temp_fail = split (";", $next['fail']);

					if (count ($temp_fail)  == 1)
					{
						$fail = split ("\|", $temp_fail[0]);
						if (hasCharExtra ($fail[1], $fail[0], $session))
						{
							$next['text'] = eregi_replace ("\[charname\]", $char['charname'], $next['text']);
							$next['text'] = eregi_replace ("\[charrace\]", $char['charrace'], $next['text']);
							$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text']);			
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
								$nextsteps[] = array("id" => $next['to_id'], "text" => $next['text']);
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

function checkFail($checkfail, $session)
{
	//echo "<li>$checkfail";
	$temp_fail = split ("\|", $checkfail);
	//print_r ($temp_fail);
	$temp_chance = split(",", $temp_fail[0]);
	$chance = (isset($temp_chance[0])) ? $temp_chance[0] : "";
	$hab = (isset($temp_chance[1])) ? $temp_chance[1] : "";
	$redirect = (isset($temp_fail[1])) ? $temp_fail[1] : "";
	$label = (isset($temp_fail[2])) ? $temp_fail[2] : "";
	$value = (isset($temp_fail[3])) ? $temp_fail[3] : "";
	//print_r ($session);
	$return = array("id" => 0, "text" => "");
	if ($checkfail != '')
	{
		$char = getChar($session['charid']);
		$bonus = (isset($char[$hab])) ? getHabBonus ($char[$hab]): "";
		$equip_bonus = getEquipBonus($hab, $char['equip']);
		$lvlbonus = getLvlBonus ($char['xp']);
		$dice = rand (1,20);
		if ($chance > 0) 
		{
			$html = $dice . " (D20) + " . $bonus ." (".$char[$hab]." ". $hab .") + ".$lvlbonus['bonus']." (Nivel  ".$lvlbonus['level'].") + ".$equip_bonus['bonus']." ( Equipo ".$equip_bonus['items'].") ";
			$dice = $dice + $bonus + $equip_bonus['bonus'] + $lvlbonus['bonus'];
			$html .= " = ".$dice." contra DIF ". $chance.". ";
			$return['text'] = $html;
		}
		//echo "label: $label";
		
		if (hasCharExtra ($label, $value, $session))
		{
			//echo "<li>1";
			$return['id'] = $redirect;
			return $return;
		}	
		else if ($dice < $chance) 
		{
			//echo "<li>2";
			$return['id'] = $redirect;
			return $return;
		}	
		else if ($label != '' && $value != '')
		{
			//echo "<li>3";
			updateCharExtra($label, $value, $session);
		}
	}
	return 0;
}

function getEquipBonus($hab, $equip)
{
	$bonus_equip = array("bonus" => 0, "items" => "");
	//print_pre($equip);
	//$equip = json_decode ($equip);
	if (count($equip) > 0) {
		foreach ($equip as $nombre=>$bonus)
		{
			$temp_bonus = split("\|", $bonus);
			if ($temp_bonus[1] == $hab)
			{
				$bonus_equip['bonus'] = $bonus_equip['bonus'] + $temp_bonus[0];
				$bonus_equip['items'] .= " - ". $nombre;
			}
		}	
	}
	return $bonus_equip;
}

function getAllAdventures ()
{
	$sql = "SELECT * FROM AVE_aventura";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC))
	{
		$datas[] = $row;
	}

	return $datas;
}

function getAdventure ($ave_id)
{
	$sql = "SELECT * FROM AVE_aventura WHERE id = $ave_id";
	//echo $sql;
	$res = mysql_query ($sql);
	$row = mysql_fetch_array($res, MYSQL_ASSOC);
	return $row;
}


function getStep($id)
{
	$sql = "SELECT * FROM AVE_step WHERE id = $id";
	$res = mysql_query ($sql);
	$row = mysql_fetch_array($res, MYSQL_ASSOC);
	return $row;
}

function getNextSteps ($id)
{
	$datas = array();
	$sql = "SELECT * FROM AVE_next_step WHERE from_id = $id";
	//echo "<li>".$sql;
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC))
	{
		$datas[] = $row;
	}
	return $datas;
}

function generateVideoEmbed ($url_video, $thumb = false)
{
	if (ereg ("youtube", $url_video)) //VIDEO DE YOUTUBE
	{
		$temp_url = split ("v=", $url_video);
		$video_code = $temp_url[1];
		if ($thumb) 
		{
			//$html = "<object type=\"application/x-shockwave-flash\" style=\"width:425px;height:355px\" data=\"http://www.youtube.com/v/1RtWkywPJ5I&hl=en\"><param name=\"movie\" value=\"http://www.youtube.com/v/1RtWkywPJ5I&hl=en\" /></object>";

		}
		else 
		{
			$html = "<fb:swf swfbgcolor=\"000000\" imgstyle=\"border-width:3px; border-color:white;\" swfsrc='http://www.youtube.com/v/".$video_code."' imgsrc='http://img.youtube.com/vi/".$video_code."/2.jpg' width='340' height='270' />";

		}
	}
	return $html;
}

function getChars ($profile_id)
{
	$sql = "SELECT * FROM AVE_chars WHERE profile_id = $profile_id";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array($res, MYSQL_ASSOC))
	{
		$datas[] = $row;
	}
	return $datas;
}

function getChar($charid)
{
	if ($charid > 0)
	{
		$sql = "SELECT * FROM AVE_chars WHERE id = $charid";
		$res = mysql_query ($sql);
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
		$row['equip'] = json_decode($row['equip']);
		//print_pre ($row);
		return $row;
	}
}

function createChar ($charname, $charclass, $charrace, $profile_id, $fue, $des, $con, $int, $sab, $car)
{
	$sql = "INSERT INTO `AVE_chars` (`id`,`charname`,`charclass`,`charrace`,`profile_id`,`fue`,`des`,`con`,`int`,`sab`,`car`) VALUES ('', '".$charname."', '".$charclass."',  '".$charrace."','".$profile_id."', '".$fue."', '".$des."', '".$con."', '".$int."', '".$sab."', '".$car."')";
	//echo $sql;
	$res = mysql_query($sql);
	return mysql_insert_id();
}

function addXP ($charid, $value)
{

	if ($value > 0) $sql = " UPDATE `AVE_chars` SET xp = xp + $value WHERE id = $charid";
	else  $sql = " UPDATE `AVE_chars` SET xp = xp $value WHERE id = $charid";
	//echo "<li>$sql";
	$res = mysql_query ($sql);
	return sprintf (gettext("Has obtenido %s puntos de experiencia. "), $value);
} 

function addGold ($charid, $value)
{
	$sql = " UPDATE `AVE_chars` SET gold = gold + $value WHERE id = $charid";
	//echo "<li>$sql";
	$res = mysql_query ($sql);
	return sprintf (gettext("Has ganado %s monedas de oro. "), $value);
} 


function getHabBonus ($value)
{
	$value = $value -10;
	$bonus = $value/2;
	return intval($bonus);
}

function getLvlBonus ($value)
{
	$end = 0;
	$counter = 0;
	$level = 0;
	while ($end <= $value) 
	{
		$counter++;
		$end = $end + ($level*1000); 
		if ($end <= $value) $level = $counter;
	}
	$lvlbonus['level'] = floor($level) +1;
	$lvlbonus['bonus'] = floor ($lvlbonus['level']/2);
	return $lvlbonus;
}

function getSession($profile_id)
{
	$sql = "SELECT * FROM AVE_session WHERE profile_id = $profile_id";
	//echo "<li>".$sql;
	$res = mysql_query ($sql);
	$num = mysql_num_rows ($res);
	if ($num > 0)
	{
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
	}
	else
	{
		$sql = "INSERT INTO `AVE_session` (`profile_id`, `charid`) VALUES ('$profile_id', '')";
		$res = mysql_query ($sql);
		$row = array ("profile_id" => $profile_id);
	}
	return $row;
}

function updateSession($profile_id, $label, $value)
{
	$sql = "UPDATE `AVE_session` SET $label = '$value' WHERE profile_id = $profile_id";
	$res = mysql_query ($sql);
}

function updateCharExtra($label, $value, $session)
{
	$step = new steps ($session['step']);
	$sql = "INSERT INTO `AVE_chars_extra` (`id`, `charid`, `label`, `value`, `ave_id`) VALUES (NULL, '".$session['charid']."', '$label', '$value', '".$step->getAveId()."' )";
	//echo $sql;
	$res = mysql_query ($sql);	
}

function hasCharExtra ($label, $value, $session)
{
	$sql = "SELECT COUNT(id) AS total FROM `AVE_chars_extra` WHERE charid = '".$session['charid']."' AND label ='$label' AND value = '$value'";
	//echo "<li>$sql";
	$res = mysql_query ($sql);
	$row = mysql_fetch_array ($res);
	if ($row['total'] > 0) return true;
	else return false;
}

function getCharExtra ($charid, $label)
{
	$datas = array();
	$sql = "SELECT * FROM `AVE_chars_extra` WHERE charid = '".$charid."' AND label ='$label'";
	$res = mysql_query ($sql);
	while ($row = mysql_fetch_array ($res, MYSQL_ASSOC))
	{
		$datas[] = $row;
	}
	return $datas;
}

function deleteAllCharExtraByAveId ($charid, $ave_id)
{
	$sql = "DELETE FROM AVE_chars_extra WHERE charid = $charid AND ave_id = $ave_id";
	$res = mysql_query ($sql);
}

//Funciones varias --------------------------------------------------------------
//-------------------------------------------------------------------------------

function t_ ($string) { echo gettext($string); }
function print_pre ($text) { echo "<pre>"; print_r ($text); echo  "</pre>"; }

?>