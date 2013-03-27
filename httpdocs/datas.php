<?php

$initial_gold = 200;


//Objetos -------------------------------------------------------------------------
$items = array ();
//CABEZA
$items[4] = array ("id" => 4, "name" => "Gorro del Saber", "bonus" => "+2|sab", "gold" => 250, "slot" => "Cabeza");
$items[10] = array ("id" => 10, "name" => "Yelmo de protecci&oacute;n", "bonus" => "+2|con", "gold" => 250, "slot" => "Cabeza");
//CUELLO
$items[11] = array ("id" => 11, "name" => "Talism&aacute;n de protecci&oacute;n", "bonus" => "+2|con", "gold" => 250, "slot" => "Cuello");
$items[12] = array ("id" => 12, "name" => "Colgante Sagrado", "bonus" => "+2|sab", "gold" => 250, "slot" => "Cuello");
//ESPALDA
$items[3] = array ("id" => 3, "name" => "Capa de Esplendor", "bonus" => "+2|car", "gold" => 250, "slot" => "Espalda");
$items[15] = array ("id" => 15, "name" => "Capa &Eacute;lfica", "bonus" => "+2|des", "gold" => 250, "slot" => "Espalda");
$items[13] = array ("id" => 13, "name" => "Capa de protecci&oacute;n", "bonus" => "+4|con", "gold" => 600, "slot" => "Espalda");
//MANOS
$items[1] = array ("id" => 1, "name" => "Guanteletes de Fuerza", "bonus" => "+2|fue", "gold" => 250, "slot" => "Manos");
$items[6] = array ("id" => 6, "name" => "Anillo &Eacute;lfico", "bonus" => "+2|int", "gold" => 250, "slot" => "Manos");
$items[8] = array ("id" => 8, "name" => "Guantes de Ladr&oacute;n", "bonus" => "+4|des", "gold" => 600, "slot" => "Manos");	
$items[14] = array ("id" => 14, "name" => "Anillo de protecci&oacute;n", "bonus" => "+4|con", "gold" => 600, "slot" => "Manos");
//CINTURA
$items[5] = array ("id" => 5, "name" => "Cintur&oacute;n de Resistencia", "bonus" => "+2|con", "gold" => 250, "slot" => "Cintura");
$items[7] = array ("id" => 7, "name" => "Faja de Superfuerza", "bonus" => "+4|fue", "gold" => 600, "slot" => "Cintura");
//PIERNAS
$items[2] = array ("id" => 2, "name" => "Sandalias de Ladr&oacute;n", "bonus" => "+2|des", "gold" => 250, "slot" => "Piernas");
$items[9] = array ("id" => 9, "name" => "Botas de Enano", "bonus" => "+2|fue", "gold" => 250, "slot" => "Piernas");

//Clases -------------------------------------------------------------------------
$player_classes = array();
$player_classes['B&aacute;rbaro'] = array(
	"fue" => 20, "des" => 16, "con" => 20, "int" => 14, "sab" => 16, "car" => 14, 
	"ata" => "fue", "charattack" => "golpea con su hacha a dos manos");
$player_classes['Cl&eacute;rigo'] = array(
	"fue" => 14, "des" => 14, "con" => 16, "int" => 20, "sab" => 20, "car" => 16, 
	"ata" => "sab", "charattack" => "golpea con su maza bendecida");
$player_classes['Guerrero'] = array(
	"fue" => 20, "des" => 20, "con" => 16, "int" => 14, "sab" => 16, "car" => 14, 
	"ata" => "fue", "charattack" => "golpea con su espada");
$player_classes['Mago'] = array(
	"fue" => 14, "des" => 16, "con" => 14, "int" => 20, "sab" => 20, "car" => 16, 
	"ata" => "int", "charattack" => "lanza un proyectil m&aacute;gico");
$player_classes['P&iacute;caro'] = array(
	"fue" => 16, "des" => 20, "con" => 16, "int" => 14, "sab" => 14, "car" => 20, 
	"ata" => "des", "charattack" => "golpea con su espada corta");
$player_classes['Caballero'] = array(
	"fue" => 20, "des" => 14, "con" => 16, "int" => 14, "sab" => 20, "car" => 16, 
	"ata" => "fue", "charattack" => "golpea con su mandoble");
$player_classes['Bardo'] = array(
	"fue" => 14, "des" => 20, "con" => 14, "int" => 16, "sab" => 16, "car" => 20, 
	"ata" => "car", "charattack" => "golpea con su espada corta");

//Razas -------------------------------------------------------------------------
$player_races = array();
$player_races['Humano'] = array("fue" => 0, "des" => 0, "con" => 0, "int" => 0, "sab" => 0, "car" => 0);
$player_races['Enano'] = array("fue" => 0, "des" => 0, "con" => 2, "int" => 0, "sab" => 0, "car" => -2);
$player_races['Elfo'] = array("fue" => 0, "des" => 2, "con" => -2, "int" => 0, "sab" => 0, "car" => 0);
$player_races['Gnomo'] = array("fue" => -2, "des" => 0, "con" => 0, "int" => 0, "sab" => 0, "car" => 2);
$player_races['Halfling'] = array("fue" => -2, "des" => 2, "con" => 0, "int" => 0, "sab" => 0, "car" => 0);
$player_races['Semiorco'] = array("fue" => 2, "des" => 2, "con" => 0, "int" => -2, "sab" => 0, "car" => -2);
$player_races['Semielfo'] = array("fue" => 0, "des" => 2, "con" => 0, "int" => 0, "sab" => 0, "car" => -2);

?>
