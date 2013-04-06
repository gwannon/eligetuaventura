<?php

$initial_gold = 200;


//Objetos -------------------------------------------------------------------------
$items = array ();
//ARMA
$items[18] = array ("id" => 18, "name" => "Bast&oacute;n de mago", "bonus" => "+1|int", "gold" => 50, "slot" => "Arma");
$items[19] = array ("id" => 19, "name" => "Espada corta", "bonus" => "+1|des", "gold" => 50, "slot" => "Arma");
$items[17] = array ("id" => 17, "name" => "Espada y escudo", "bonus" => "+1|fue", "gold" => 50, "slot" => "Arma");
$items[21] = array ("id" => 21, "name" => "Hacha a dos manos", "bonus" => "+1|fue", "gold" => 50, "slot" => "Arma");
$items[20] = array ("id" => 20, "name" => "Mandoble", "bonus" => "+1|fue", "gold" => 50, "slot" => "Arma");
$items[16] = array ("id" => 16, "name" => "Maza bendecida", "bonus" => "+1|sab", "gold" => 50, "slot" => "Arma");
//ARMADURA
$items[22] = array ("id" => 22, "name" => "Armadura de cuero", "bonus" => "+1|con", "gold" => 250, "slot" => "Armadura");
$items[23] = array ("id" => 23, "name" => "Camisote de mallas", "bonus" => "+2|con", "gold" => 600, "slot" => "Armadura");
$items[24] = array ("id" => 24, "name" => "Coraza", "bonus" => "+3|con", "gold" => 800, "slot" => "Armadura");
//CABEZA
$items[4] = array ("id" => 4, "name" => "Gorro del Saber", "bonus" => "+1|sab", "gold" => 250, "slot" => "Cabeza");
$items[10] = array ("id" => 10, "name" => "Yelmo de protecci&oacute;n", "bonus" => "+1|con", "gold" => 250, "slot" => "Cabeza");
//CUELLO
$items[12] = array ("id" => 12, "name" => "Colgante Sagrado", "bonus" => "+1|sab", "gold" => 250, "slot" => "Cuello");
$items[11] = array ("id" => 11, "name" => "Talism&aacute;n de protecci&oacute;n", "bonus" => "+1|con", "gold" => 250, "slot" => "Cuello");
//ESPALDA
$items[15] = array ("id" => 15, "name" => "Capa &eacute;lfica", "bonus" => "+1|des", "gold" => 250, "slot" => "Espalda");
$items[3] = array ("id" => 3, "name" => "Capa de Esplendor", "bonus" => "+1|car", "gold" => 250, "slot" => "Espalda");
$items[13] = array ("id" => 13, "name" => "Capa de protecci&oacute;n", "bonus" => "+2|con", "gold" => 600, "slot" => "Espalda");
//MANOS
$items[6] = array ("id" => 6, "name" => "Anillo &eacute;lfico", "bonus" => "+1|int", "gold" => 250, "slot" => "Manos");
$items[14] = array ("id" => 14, "name" => "Anillo de protecci&oacute;n", "bonus" => "+2|con", "gold" => 600, "slot" => "Manos");
$items[1] = array ("id" => 1, "name" => "Guanteletes de Fuerza", "bonus" => "+1|fue", "gold" => 250, "slot" => "Manos");
$items[8] = array ("id" => 8, "name" => "Guantes de Ladr&oacute;n", "bonus" => "+2|des", "gold" => 600, "slot" => "Manos");	
//CINTURA
$items[5] = array ("id" => 5, "name" => "Cintur&oacute;n de Resistencia", "bonus" => "+1|con", "gold" => 250, "slot" => "Cintura");
$items[7] = array ("id" => 7, "name" => "Faja de Superfuerza", "bonus" => "+2|fue", "gold" => 600, "slot" => "Cintura");
//PIERNAS
$items[9] = array ("id" => 9, "name" => "Botas de Enano", "bonus" => "+1|fue", "gold" => 250, "slot" => "Piernas");
$items[2] = array ("id" => 2, "name" => "Sandalias de Ladr&oacute;n", "bonus" => "+1|des", "gold" => 250, "slot" => "Piernas");

//Clases -------------------------------------------------------------------------
$player_classes = array();
$player_classes['Bárbaro'] = array(
	"fue" => 20, "des" => 16, "con" => 20, "int" => 14, "sab" => 16, "car" => 14, 
	"ata" => "fue", "weapon" => "Hacha a dos manos", "charattack" => "golpea con su hacha a dos manos");
$player_classes['Clérigo'] = array(
	"fue" => 14, "des" => 14, "con" => 16, "int" => 20, "sab" => 20, "car" => 16, 
	"ata" => "sab", "weapon" => "Maza bendecida", "charattack" => "golpea con su maza bendecida");
$player_classes['Guerrero'] = array(
	"fue" => 20, "des" => 20, "con" => 16, "int" => 14, "sab" => 16, "car" => 14, 
	"ata" => "fue", "weapon" => "Espada y escudo", "charattack" => "golpea con su espada");
$player_classes['Mago'] = array(
	"fue" => 14, "des" => 16, "con" => 14, "int" => 20, "sab" => 20, "car" => 16, 
	"ata" => "int", "weapon" => "Bast&oacute;n de mago", "charattack" => "lanza un proyectil m&aacute;gico");
$player_classes['Pícaro'] = array(
	"fue" => 16, "des" => 20, "con" => 16, "int" => 14, "sab" => 14, "car" => 20, 
	"ata" => "des", "weapon" => "Espada corta", "charattack" => "golpea con su espada corta");
$player_classes['Caballero'] = array(
	"fue" => 20, "des" => 14, "con" => 16, "int" => 14, "sab" => 20, "car" => 16, 
	"ata" => "fue", "weapon" => "Mandoble", "charattack" => "golpea con su mandoble");
$player_classes['Bardo'] = array(
	"fue" => 14, "des" => 20, "con" => 14, "int" => 16, "sab" => 16, "car" => 20, 
	"ata" => "des", "weapon" => "Espada corta", "charattack" => "golpea con su espada corta");

//Razas -------------------------------------------------------------------------
$player_races = array();
$player_races['Humano'] = array("fue" => 0, "des" => 0, "con" => 0, "int" => 0, "sab" => 0, "car" => 0);
$player_races['Enano'] = array("fue" => 0, "des" => 0, "con" => 2, "int" => 0, "sab" => 0, "car" => -2);
$player_races['Elfo'] = array("fue" => 0, "des" => 2, "con" => -2, "int" => 0, "sab" => 0, "car" => 0);
$player_races['Gnomo'] = array("fue" => -2, "des" => 0, "con" => 0, "int" => 0, "sab" => 0, "car" => 2);
$player_races['Halfling'] = array("fue" => -2, "des" => 2, "con" => 0, "int" => 0, "sab" => 0, "car" => 0);
$player_races['Semiorco'] = array("fue" => 2, "des" => 2, "con" => 0, "int" => -2, "sab" => 0, "car" => -2);
$player_races['Semielfo'] = array("fue" => 0, "des" => 2, "con" => 0, "int" => 0, "sab" => 0, "car" => -2);

//Dioses -------------------------------------------------------------------------
$player_gods = array();
$player_gods['Rurick'] = array("fue" => 2, "des" => 0, "con" => 0, "int" => 0, "sab" => 0, "car" => 0, "desc" => "Guerra y ley");
$player_gods['Caern'] = array("fue" => 0, "des" => 2, "con" => 0, "int" => 0, "sab" => 0, "car" => 0, "desc" => "Libertad y naturaleza");
$player_gods['Eorn Taoras'] = array("fue" => 0, "des" => 0, "con" => 2, "int" => 0, "sab" => 0, "car" => 0, "desc" => "Ley y protección");
$player_gods['Amyrl'] = array("fue" => 0, "des" => 0, "con" => 0, "int" => 2, "sab" => 0, "car" => 0, "desc" => "Magia y conocimiento");
$player_gods['Mizoba'] = array("fue" => 0, "des" => 0, "con" => 0, "int" => 0, "sab" => 2, "car" => 0, "desc" => "Curación y protección");
$player_gods['Collin'] = array("fue" => 0, "des" => 0, "con" => 0, "int" => 0, "sab" => 0, "car" => 2, "desc" => "Suerte, trucos y encanto");

?>
