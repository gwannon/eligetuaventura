<?php

$initial_gold = 200;


//Objetos -------------------------------------------------------------------------
$items = array ();
$items[1] = array ("id" => 1, "name" => "Guanteletes de Fuerza", "bonus" => "+2|fue", "gold" => 200);
$items[2] = array ("id" => 2, "name" => "Sandalias de Ladr&oacute;n", "bonus" => "+2|des", "gold" => 250);
$items[3] = array ("id" => 3, "name" => "Capa de Esplendor", "bonus" => "+2|car", "gold" => 250);
$items[4] = array ("id" => 4, "name" => "Gorro del Saber", "bonus" => "+2|sab", "gold" => 250);
$items[5] = array ("id" => 5, "name" => "Cintur&oacute;n de Resistencia", "bonus" => "+2|con", "gold" => 250);
$items[6] = array ("id" => 6, "name" => "Anillo &Eacute;lfico", "bonus" => "+2|int", "gold" => 250);
$items[7] = array ("id" => 7, "name" => "Faja de Superfuerza", "bonus" => "+4|fue", "gold" => 600);
$items[8] = array ("id" => 8, "name" => "Guantes de Ladr&oacute;n", "bonus" => "+4|des", "gold" => 600);	

$player_classes = array();
$player_classes['B&aacute;rbaro'] = array("fue" => 20, "des" => 16, "con" => 20, "int" => 14, "sab" => 16, "car" => 14, "ata" => "fue", "charattack" => "golpea con su espada a dos manos");
$player_classes['Cl&eacute;rigo'] = array("fue" => 14, "des" => 14, "con" => 16, "int" => 20, "sab" => 20, "car" => 16, "ata" => "sab", "charattack" => "golpea con su maza");
$player_classes['Guerrero'] = array("fue" => 20, "des" => 20, "con" => 16, "int" => 14, "sab" => 16, "car" => 14, "ata" => "fue", "charattack" => "golpea con su espada");
$player_classes['Mago'] = array("fue" => 14, "des" => 16, "con" => 14, "int" => 20, "sab" => 20, "car" => 16, "ata" => "int", "charattack" => "lanza un proyectil m&aacute;gico");
$player_classes['P&iacute;caro'] = array("fue" => 16, "des" => 20, "con" => 16, "int" => 14, "sab" => 14, "car" => 20, "ata" => "des", "charattack" => "golpea con su espada corta");
//Caballero
//Bardo

$player_races = array();
$player_races['Humano'] = array();
$player_races['Enano'] = array();
$player_races['Elfo'] = array();
$player_races['Gnomo'] = array();
$player_races['Halfling'] = array();

/*

AJAX.PHP

	if ($charrace == "Humano") {  }
	else if ($charrace == "Enano") { $con = $con + 2; $car = $car - 2;  }
	else if ($charrace == "Elfo") { $des = $des +2; $con = $con - 2; }
	else if ($charrace == "Gnomo") { $car = $car + 2; $fue = $fue - 2; }
	else if ($charrace == "Halfling") { $des = $des +2; $fue = $fue - 2; }

*/


?>