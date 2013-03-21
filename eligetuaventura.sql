-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2013 at 12:00 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eligetuaventura`
--

-- --------------------------------------------------------

--
-- Table structure for table `AVE_aventura`
--

CREATE TABLE IF NOT EXISTS `AVE_aventura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `first` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `AVE_aventura`
--

INSERT INTO `AVE_aventura` (`id`, `title`, `text`, `first`) VALUES
(2, 'La mazmorra del Goblin', 'Entra en la mazmorra del Goblin y rescata a la hija del posadero', 20),
(3, 'Peligro en Torre Oscura [EN DESARROLLO]', 'Aventura en desarrollo.', 100),
(4, 'Camino al Este', 'Aventurate en las tierras del Este en busca de fama y fortuna.', 200);

-- --------------------------------------------------------

--
-- Table structure for table `AVE_chars`
--

CREATE TABLE IF NOT EXISTS `AVE_chars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charname` text NOT NULL,
  `charclass` text NOT NULL,
  `charrace` text NOT NULL,
  `profile_id` double NOT NULL,
  `fue` int(11) NOT NULL,
  `des` int(11) NOT NULL,
  `con` int(11) NOT NULL,
  `int` int(11) NOT NULL,
  `sab` int(11) NOT NULL,
  `car` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  `equip` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profile_id` (`profile_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `AVE_chars_extra`
--

CREATE TABLE IF NOT EXISTS `AVE_chars_extra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charid` int(11) NOT NULL,
  `label` enum('object','person','status') NOT NULL,
  `value` text NOT NULL,
  `ave_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `AVE_next_step`
--

CREATE TABLE IF NOT EXISTS `AVE_next_step` (
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `fail` text NOT NULL,
  PRIMARY KEY (`from_id`,`to_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AVE_next_step`
--

INSERT INTO `AVE_next_step` (`from_id`, `to_id`, `text`, `fail`) VALUES
(21, 22, '[charname] avanza hacia la siguiente habitaci&oacute;n', ''),
(22, 27, '[charname] va por el pasillo de la derecha', ''),
(22, 25, '[charname] va por el pasillo de la izquierda', ''),
(25, 26, '[charname] sigue andando por el pasillo de la izquierda', ''),
(22, 31, '[charname] sigue por el pasillo hacia adelante', ''),
(31, 24, '[charname] entra en la habitaci&oacute;n de la izquierda', ''),
(31, 23, '[charname] usa la llave y avanza hacia adelante', 'llave|object;joven|person'),
(27, 32, '[charname] avanza por el pasillo hacia la derecha', ''),
(32, 29, '[charname] entra en las letrinas', ''),
(32, 30, '[charname] avanza hacia adelante', ''),
(32, 28, '[charname] avanza hacia la habitaci&oacute;n de la derecha', 'x|x;goblin muerto|status'),
(22, 21, '[charname] vuelve a la entrada de la mazmorra', ''),
(27, 22, '[charname] vuelve a la estancia principal', ''),
(25, 22, '[charname] vuelve a la estancia principal', ''),
(26, 25, '[charname] sale de la habitaci&oacute;n', ''),
(31, 22, '[charname] avanza hacia la estancia principal', ''),
(24, 31, '[charname] sale de sala de los guard&iacute;as', ''),
(23, 31, '[charname] sale de la habitaci&oacute;n', ''),
(32, 27, '[charname] vuelve al almacen', ''),
(29, 32, '[charname] sale de las letrinas', ''),
(30, 32, '[charname] sale de las cocinas', ''),
(28, 32, '[charname] sale de la habitaci&oacute;n del goblin', 'goblin muerto|status'),
(26, 33, '[charname] busca dentro de la habitaci&oacute;n', ''),
(34, 33, '[charname] busca de nuevo', ''),
(33, 25, '[charname] sale de la habitaci&oacute;n', ''),
(34, 25, '[charname] sale de la habitaci&oacute;n', ''),
(23, 35, '[charname] despierta a la joven', ''),
(35, 31, '[charname] sale de la celda', ''),
(28, 36, '[charname] ataca al goblin', ''),
(36, 32, '[charname] sale de la estancia', ''),
(37, 36, '[charname] ataca de nuevo al goblin', ''),
(20, 46, '[charname] busca la entrada de la mazmorra', ''),
(21, 38, '[charname] sale de la mazmorra con la joven', 'joven|person'),
(31, 39, '[charname] usa la llave y avanza hacia adelante', 'joven|person'),
(39, 31, '[charname] sale de la habitaci&oacute;n', ''),
(40, 32, '[charname] sale de la sala', ''),
(32, 40, '[charname] avanza a la derecha', 'goblin muerto|status'),
(24, 41, '[charname] busca dentro de la habitaci&oacute;n', ''),
(41, 31, '[charname] sale de la sala de los guardias', ''),
(42, 41, '[charname] sigue buscando', ''),
(42, 31, '[charname] sale de la habitaci&oacute;n', ''),
(35, 43, '[charname] trata de convercerla que para le siga', ''),
(44, 43, '[charname] trata de convercer a la joven para que le siga', ''),
(44, 31, '[charname] sale de la habitaci&oacute;n', ''),
(43, 31, '[charname] sale de la habitaci&oacute;n', ''),
(45, 46, '[charname] trata de encontrar la entrada a la mazmorra', ''),
(46, 21, '[charname] baja las escaleras de la mazmorra del goblin', ''),
(100, 101, '[charname] se acerca a mirar el cartel', ''),
(100, 102, '[charname] sigue bebiendo cerveza', ''),
(101, 103, '[charname] sale de la posada', ''),
(101, 102, '[charname] sigue bebiendo cerveza', ''),
(102, 103, '[charname] sale de la posada', ''),
(200, 203, '[charname] va a ayudarla', ''),
(200, 202, '[charname] no va a ayudarla', ''),
(202, 203, '[charname] va a ayudarla', ''),
(202, 206, '[charname] no va a ayudarla', ''),
(206, 203, '[charname] decide ayudarla', ''),
(206, 201, '[charname] cree que es un farol a la desesperada y se marcha', ''),
(206, 205, '[charname] ataca a la mujer', ''),
(201, 203, '[charname] al final se apiada de la mujer y la ayuda', ''),
(203, 204, '[charname] examina el mapa con m&aacute;s detenimiento', ''),
(205, 203, '[charname] no le queda m&aacute;s remedio de que ayudarla si quiere vivir', ''),
(205, 201, '[charname] cree que se esta marcando un farol y se va de la granja', ''),
(210, 226, '[charname] decide vadear contracorriente hasta el punto bajo la torre', ''),
(207, 222, '[charname] toma el camino que lleva a la torre', ''),
(207, 215, '[charname] decide ir a trav&eacute;s del bosque', ''),
(207, 224, '[charname] decide ir por el rio', ''),
(204, 215, '[charname] decide ir a trav&eacute;s del bosque', ''),
(204, 222, '[charname] toma el camino que lleva a la torre', ''),
(204, 224, '[charname] decide ir por el rio', ''),
(224, 210, '[charname] continua por la orilla del rio', ''),
(210, 234, '[charname] decide adentrarse en el bosque hacia la torre', ''),
(226, 233, '[charname] sigue intentando vadear el rio', ''),
(226, 234, '[charname] decide salir del r&iacute;o y adentrarse en el bosque hacia la torre', ''),
(234, 266, '[charname] se acerca m&aacute;s a la torre', ''),
(215, 223, '[charname] sigue avanzando por el bosque', ''),
(222, 232, '[charname] sigue avanzando por el camino', ''),
(232, 242, '[charname] va por el sendero hacia la torre', ''),
(232, 251, '[charname] se desliza por los arbustos, cerca del sendero', ''),
(213, 230, '[charname] intenta ponerse de pie y seguir vadeando el r&iacute;o', ''),
(230, 233, '[charname] avanza hasta la otra orilla', ''),
(228, 225, '[charname] intenta huir del jabal&iacute;', ''),
(225, 223, '[charname] intenta encontrar un camino', ''),
(223, 234, '[charname] sigue el arroyo', ''),
(228, 280, '[charname] ataca al jabali', ''),
(280, 282, '[charname] continua por la orilla del r&iacute;o', ''),
(281, 280, '[charname] vuelve a atacar al jabal&iacute;', ''),
(281, 225, '[charname] huye del jabal&iacute;', ''),
(282, 226, '[charname] decide vadear contracorriente hasta el punto bajo la torre', ''),
(282, 234, '[charname] decide adentrarse en el bosque hacia la torre', ''),
(209, 225, '[charname] huye del lobo', ''),
(209, 283, '[charname] ataca al lobo', ''),
(283, 287, '[charname] continua hacia la torre', ''),
(284, 283, '[charname] vuelve a atacar al lobo', ''),
(284, 225, '[charname] huye del lobo', ''),
(220, 218, '[charname] se acerca a la orilla medio ahogado', ''),
(218, 288, '[charname] se acerca a la granja', ''),
(211, 231, '[charname] se pone a hablar con el  comerciante pensando que igual le preste ayuda', ''),
(211, 286, '[charname] saluda al comerciante y pasa de largo', ''),
(211, 227, '[charname] ataca al comerciante', ''),
(231, 286, '[charname] sigue avanzando por el camino', ''),
(227, 216, '[charname] registra la carreta', ''),
(227, 286, '[charname] sigue avanzando por el camino', ''),
(216, 286, '[charname] sigue avanzando por el camino', ''),
(285, 132, '[charname] sigue avanzando por el camino', ''),
(286, 242, '[charname] va por el sendero hacia la torre', ''),
(286, 251, '[charname] se desliza por los arbustos, cerca del sendero', ''),
(287, 266, '[charname] se acerca m&aacute;s a la torre', ''),
(288, 215, '[charname] decide ir a trav&eacute;s del bosque', ''),
(288, 222, '[charname] toma el camino que lleva a la torre', ''),
(288, 224, '[charname] decide ir por el rio', ''),
(266, 261, '[charname] vigila torre', ''),
(245, 242, '[charname] sale al sendero y se acerca a la torre', ''),
(245, 264, '[charname] se desliza por los arbustos hasta la puerta', ''),
(201, 273, '[charname] se va definitivamente', ''),
(251, 289, '[charname] sigue avanzando hacia la torre', ''),
(257, 274, '[charname] huye', ''),
(257, 248, '[charname] corre hacia la puerta listo para luchar', ''),
(261, 236, '[charname] se desliza entre los arbustos hacia la puerta de la torre', ''),
(236, 258, '[charname] saca su arma y carga hacia el interior', ''),
(236, 246, '[charname] abre la puerta para asomarse', ''),
(233, 238, '[charname] examina el risco', 'entrada secreta|status'),
(233, 256, '[charname] empieza a escalar el risco', ''),
(238, 265, '[charname] examina en m&aacute;s profundidad el risco', ''),
(253, 256, '[charname] empieza a escalar el risco', ''),
(256, 240, '[charname] sigue subiendo por el risco', ''),
(244, 260, '[charname] intenta frenar su caida agarrandose a algo', ''),
(260, 256, '[charname] intenta escalar el risco', ''),
(240, 246, '[charname] pasa por el agujero', ''),
(265, 247, '[charname] examina la palanca', ''),
(247, 235, '[charname] tira de la palanca', ''),
(247, 267, '[charname] intenta desactivar la trampa ', ''),
(247, 256, '[charname] intenta escalar el risco', ''),
(263, 235, '[charname] tira de la palanca', ''),
(263, 256, '[charname] intenta escalar el risco', ''),
(235, 260, '[charname] trata de evitar la avalancha', ''),
(267, 250, '[charname] intenta tirar de la palanca', ''),
(250, 241, '[charname] sube por la escalera de caracol', ''),
(250, 256, '[charname] intenta escalar el risco', ''),
(241, 252, '[charname] el arma y carga dentro de la habitaci&oacute;n', ''),
(241, 262, '[charname] ataca silenciosamente al hombre por la espalda', ''),
(241, 255, '[charname] intenta deslizarse por la habitaci&oacute;n en silencio y rescatar a la chica sin luchar ', ''),
(255, 259, '[charname] avanza muy sigilosamente', ''),
(259, 275, '[charname] se echa la chica al hombro y sale silenciosamente', ''),
(258, 252, '[charname] saca su arma', ''),
(246, 258, '[charname] saca el arma y carga dentro de la habitaci&oacute;n', ''),
(246, 243, '[charname] intenta acercarse sigilosamente al hombre y atacarle por sospresa', ''),
(246, 255, '[charname] intenta deslizarse sigilosamente en la habitaci&oacute;n y rescatar a la chica ', ''),
(289, 261, '[charname] vigila torre', ''),
(248, 254, '[charname] desenvaina su arma', ''),
(249, 254, '[charname] desenvaina su arma', ''),
(252, 254, '[charname] desenvaina su arma', ''),
(262, 254, '[charname] desenvaina su arma', ''),
(242, 236, '[charname] continua su camino hacia la torre', ''),
(264, 236, '[charname] se mueve sigilosamente hacia la torre', ''),
(243, 262, '[charname] avanza sigilosamente', ''),
(254, 237, '[charname] ataca al hombre', ''),
(290, 237, '[charname] vuelve a atacar', ''),
(290, 274, '[charname] huye', ''),
(237, 291, '[charname] ataca de nuevo', ''),
(292, 291, '[charname] asesta otro golpe', ''),
(292, 274, '[charname] huye', '');

-- --------------------------------------------------------

--
-- Table structure for table `AVE_session`
--

CREATE TABLE IF NOT EXISTS `AVE_session` (
  `profile_id` double NOT NULL,
  `charid` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `AVE_step`
--

CREATE TABLE IF NOT EXISTS `AVE_step` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `ave_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `fail` text NOT NULL,
  `time` int(11) NOT NULL,
  `xp` int(11) NOT NULL,
  `gold` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=293 ;

--
-- Dumping data for table `AVE_step`
--

INSERT INTO `AVE_step` (`id`, `text`, `ave_id`, `video_url`, `fail`, `time`, `xp`, `gold`) VALUES
(21, '[charname] encuentra la entrada de la mazmorra. Baja las escaleras y llega a una peque&ntilde;a estanc&iacute;a levemente iluminada.', 2, '', '0', 1, 0, 0),
(22, '[charname] esta en la estancia principal', 2, '', '0', 1, 0, 0),
(23, '[charname] encuentra a una muchacha insconciente encima de un monton de paja. ', 2, '', '0', 1, 0, 0),
(24, '[charname] entre en lo que parece ser una sala para guard&iacute;as', 2, '', '0', 1, 0, 0),
(25, '[charname] entra en una habitaci&oacute;n que parece ser unos dormitorios.', 2, '', '0', 1, 0, 0),
(26, 'Dormitorio del capit&aacute;n de los guard&iacute;as', 2, '', '0', 1, 0, 0),
(27, '[charname] llega a una sala que parece haber sido usada como almacen', 2, '', '0', 1, 0, 0),
(28, '[charname] entra en una gran sala algo m&aacute;s iluminada que las anteriores. En mitad de la sala hay un goblin armado con una maza que le dice:<br/>\r\n- Vas a morir, maldito [charrace] !!!!!!!!!!!\r\n', 2, '', '0', 1, 0, 0),
(29, '[charname] entra en las lerinas. La peste es horrible y [charname] dificilmente puede soportarlo.', 2, '', '0', 1, 0, 0),
(30, 'En esta habitaci&oacute;m [charname] encuentra restos de fogatas y varios mugrientos instrumentos de cocina.', 2, '', '0', 1, 0, 0),
(31, '[charname] encuentra en mitad del pasillo una puerta hacia la izquierda y otra hacia delante que parece cerrada con llave', 2, '', '0', 1, 0, 0),
(32, '[charname] se encuentra en mitad del pasillo. Tiene una habitaci&oacute;n a la izquierda (que por el olor parece unas letrinas), otra adelante y otra la derecha.', 2, '', '0', 1, 0, 0),
(41, '[charname] encuentra una bolsa de dinero', 2, '', '15,sab|42|object|bolsa de dinero', 5, 50, 10),
(34, '[charname] no encuentra nada en la habitaci&oacute;n', 2, '', '0', 5, 0, 0),
(39, '[charname] entra en la habitaci&oacute;n donde estaba la joven', 2, '', '0', 1, 0, 0),
(35, '[charname] despierta a la joven. Es la hija del posadero. Le pides que te acompa&ntilde;e, pero parece muy asustada.', 2, '', '', 1, 0, 0),
(36, '[charname] consigue acertarle un golpe mortal al goblin y este cae al suelo.', 2, '', '15,fue|37|status|goblin muerto', 1, 100, 0),
(37, '[charname] falla el golpe', 2, '', '0', 1, 0, 0),
(20, 'El posadero de Torre Oscura le ha pedido a [charname] que entre en la Mazmorra del Goblin a buscar a su hija. Tras salir del pueblo [charname] se dirige al Bosque Oscuro, donde est&aacute; la entrada de la Mazmorra del Goblin. Con un mapa en su mano y una espada en la otra [charname] se adentra en el bosque.', 2, '', '0', 1, 0, 0),
(38, '[charname] sale de la mazmorra acompa&ntilde;ado por la joven. Tras salir del bosque vuelve a Torre Oscura. El posadero esta muy contento de que [charname] haya rescatado a su hija.', 2, '', '0', 1, 0, 0),
(40, '[charname] entra en una gran sala algo m&aacute;s iluminada que las anteriores. En mitad de la sala esta el cadaver del goblin .', 2, '', '0', 1, 0, 0),
(33, '[charname] encuentra una llave', 2, '', '15,sab|34|object|llave', 5, 50, 0),
(42, '[charname] no encuentra nada en la habitaci&oacute;n', 2, '', '', 5, 0, 0),
(43, '[charname] consigue que la joven le siga', 2, '', '15,car|44|person|joven', 5, 50, 0),
(44, '"Huye, si no el goblin te matar&aacute;." dice la joven. No quiere seguir a [charname], tiene demasiado miedo al goblin.', 2, '', '', 1, 0, 0),
(45, '[charname] se pierde por el bosque y no encuentra la entrada de la mazmorra', 2, '', '', 4, 0, 0),
(46, '[charname] encuentra la bajada a la Mazmorra del Goblin', 0, '', '15,sab|45', 4, 50, 0),
(100, '[charname] est&aacute; en la posada de Torre Oscura disfrutando de una cerveza enana. De repente entra Worl, el alguacil, con un cartel en la mano, que clava a la puerta del local.  ', 3, '', '', 1, 0, 0),
(101, '[charname] se levanta y se acerca para ver el cartel. El magistrado de Torre Oscura ofrece 100 monedas de oro al que averigue porque no estan llegando caravanas desde el Norte.', 3, '', '', 1, 0, 0),
(102, '[charname] continua bebiendo cerveza, pero el alguacil se le acerca y le dice:<br/> - Hola [charname], he ido que la aventura es tu profesi&oacute;n. Te informo que el magistrado dar&aacute; 100 monedas de oro al que averigue porque no estan llegando caravanas desde el Norte.', 3, '', '', 2, 0, 0),
(103, '[charname] sale de la posada. Es una tarde fr&iacute;a y perfecta para coger su caballo e ir hac&iacute;a al Norte en busca de las caravanas perdidas.', 3, '', '', 1, 0, 0),
(200, 'Tr&aacute;s una breve estancia en Torre Oscura, [charname] decide explorar las tierras que se encuentran hacia Este. Pensaba que esas tierras podr&iacute;an dar aventuras y tesoros a quienes fueran valientes y listos.<br/>\r\nHac&iacute;a el mediod&iacute;a del tercer d&iacute;a de viaje, [charname] hace un alto en el camino en una peque&ntilde;a granja aislada a orillas de un rio. La mujer y el ni&ntilde;o que salieron a recibirle parec&iacute;an nerviosos, pero tambien my agradecidos por tener un huesped. La granjera le ofrece una rica comida, se niega a cobrarle y le cuenta que su marido habr&iacute;a sido recultado y que le estaba esperando.<br/>\r\nTras la comida, [charname] le dice a la granjera: "Muchas grac&iacute;as por esta magnifica comida, me gustar&iacute;a hacer algo para pagarla."<br/>\r\nTomandole la palabra, la granjera responde rapidamente: "Esparaba que pudiese ayudarme! Hace varios d&iacute;as, mi hija Tila estaba trabajando en el campo cuando dos hombres la cogieron y se la llevaron."<br/>\r\nVolviendose hacia su hijo, dice: "Barun lo vi todo y los siguio cuando se la llevaban. Dice que est&aacute;n acampados en la vieja torre en ruinas junto al rio, a un kilometro y medio al Norte. Oyo como dec&iacute;an que planeaban llevarsela al sur esta noche y venderla como esclava. Por favor, ayudenos! Supe en cuanto os vi que erais mi &uacute;nica esperanza." solloza la mujer mientras le agarra la mano a [charname].', 4, '', '', 0, 0, 0),
(202, '[charname] dice: "Lo siento, pero no es asunto mio. Creo que debo marcharme." El chico exclama: "Pero si tienen tesoros! Vi joyas, gemas, espadas m&aacute;gicas y muchas cosaas mas! Tiene que ayudarnos a salvar a Tila!"', 4, '', '', 6, 0, 0),
(203, '<p>[charname] dice: "Le ayudare se&ntilde;ora. Debemos darnos prisa!"</p>\r\n<p>La mujer dibuja un tosco mapa de la zona. Explica: "La torre en ruinas est&aacute; en un risco que da al r&iacute;o; se ha derrumbado en parte y solo tiene habitaci&oacute;n en el primer piso. El segundo piso esta completamente en ruinas y al descubierto"</p>\r\n<p>Se&ntilde;alando al mapa, dice. "Puedes ir hacia el norte por el camino y seguir luego el sendero, puedes ir a traves del bosque, o puedes llegar hasta la base del pe&ntilde;asco por el rio y desde ah&iacute; trepar a la torre."</p>', 4, '', '', 6, 0, 0),
(206, 'Cuando [charname] se levanta para marchar, la mujer dice con dura voz: "Sientate, est&uacute;pido! Crees que iba a dejar pasar la &uacute;nica esperanza de salvar a m&iacute, hija? He puesto hierbas venenosas en tu bebida. Si no tomas el ant&iacute;doto antes de un d&iacute;a, moriras. Rescata a mi hija y te salvar&eacute;."', 4, '', '', 1, 0, 0),
(201, '[charname] piensa que la mujer se est&aacute; marcando un farol para salvar a su hija. Cuando abandonas la granja, oyes que la mujer grita a tus espaldas: "Morir&aacute;s con gran sufrimiento y se arrastrar&aacute;s como una alma en pena por toda la eternidad."', 4, '', '', 3, 0, 0),
(205, '[charname] saca su arma y se abalanza sobre la mujer, pero ella se resiste. [charname] ordena a ella y a su hijo que se queden junto a la mesa, mientras registra fren&eacute;ticamente la granja, pero no encuentra nada que parezca un antidoto. Amenaza a la mujer y a su hijo, pero ella se rie y dice: "Solo mi hija sabe donde crece el antidoto, ella es la que sabe de hierbas en la familia."', 4, '', '', 4, 0, 0),
(204, '<p>[charname] se da cuenta de que el ni&ntilde;o sigue la conversaci&oacute;n y parece que tiene algo que decir, pero que no se atreve. Cuando le dice que hable, suelta de golpe: "Papa me dijo una vez que hay una peque&ntilde;a entrada secreta en la base del risco. Me dijo que no me acercara porque la construccion es muy a antigua y endeble."</p><p>Desgraciadamente, aunque hace m&aacute;s preguntas, no obtiene m&aacute;s informacion.<br>\r\n[charname] sale fuera y ya en los lindes de la granja y se da cuenta de que el tiempo es crucial.</p>', 4, '', '15,sab|207|status|entrada secreta', 1, 50, 0),
(207, '[charname] no ve nada de inter&eacute;s en el mapa. Sale de la choza y cuando est&aacute; en los lindes de la granja y se da cuenta de que el tiempo es crucial.', 4, '', '', 0, 0, 0),
(224, '[charname] avanza hasta la orilla del r&iacute;o y luego continua por la ribera.', 4, '', '', 7, 0, 0),
(282, '[charname] va por la orilla del r&iacute;o hasta que llega al punto donde el risco comienza a alzarse; puede ver la torre en la cima. Desgraciadamente, el r&iacute;o parece m&aacute;s crecido de lo normal y el agua llega junto a la base del risco. No hay demasiada profundidad, pero la corriente es bastante fuerte. De todas formas, [charname] cree que podr&aacute; vadear contracorriente.', 4, '', '', 8, 0, 0),
(228, 'Cuando [charname] est&aacute; recorriendo la orilla, un jabali salta desde unos matojos y le ataca.', 4, '', '', 1, 0, 0),
(226, 'Lentamente [charname] se mete en el agua y comienza a avanzar contracorreinte. La corriente es realmente fuerte y le cuesta mucho avanzar.', 4, '', '', 2, 0, 0),
(233, 'Por f&iacute;n [charname] llega a la base del risco, justo debajo de la torre que se encuentra a unos 15 metros por encima suyo. Descubre un saliente en el risco lo bastante plano para andar sobre &eacute;l. La cara del risco parece estable, ya que est&aacute; llena de buenos asideros.', 4, '', '15,fue|213', 0, 0, 0),
(213, 'El pie de [charname] resbala en una roca sumergida y cae al agua. Intenta fren&eacute;ticamente volver a ponerse en pie.', 4, '', '', 2, 0, 0),
(234, 'Al cabo de un rato, [charname] divisa la torre, entre los &aacute;rboles, y cautelosamente avanza hacia ella.', 4, '', '15,sab|209', 4, 0, 0),
(222, 'Tras salir de la granja, [charname] anda r&aacute;pidamente durante media hora por el camino.', 4, '', '', 4, 0, 0),
(215, '[charname] se mueve lenta y sigilosamente a trav&eacute;s del bosque.', 4, '', '', 6, 0, 0),
(223, 'Mientras [charname] avanza por el bosque, llega a un arroyo siguiendo una senda de animales.', 4, '', '15,int|225', 1, 0, 0),
(225, '[charname] se ha perdido, pero sigue avanzando, esperando encontrar la granja o la torre.', 4, '', '', 6, 0, 0),
(232, 'Tras otra media hora avanzando por el camino [charname] llega al sendero que se dirige al Este, hacia el r&iacute;o y la otrre. Apenas puede discernir la silueta de la torre entre los arboles.', 4, '', '15,int|211', 4, 0, 0),
(211, '[charname] ve una peque&ntilde;a carreta, cargada de mercancias que  se dirige hacia &eacute;l. Parece que hay un comerciante conduciendo la carreta.', 4, '', '', 1, 0, 0),
(230, '[charname] consigue hacer pie y sigue avanzando contracorriente.', 4, '', '15,fue|220', 2, 0, 0),
(220, '[charname] continua devati&eacute;ndose y se ve arrastrado r&aacute;pidamente corriente abajo, hacia la granja.', 4, '', '', 4, 0, 0),
(280, '[charname] asesta un golpe mortal al jabal&iacute;. Est&eacute; huye desangrandose y perdiendose en el bosque.', 4, '', '15,fue|281', 1, 100, 0),
(281, 'El jabal&iacute; esquiva el golpe de [charname] y vuelve a la carga.', 4, '', '', 0, 0, 0),
(210, '[charname] va por la orilla del r&iacute;o hasta que llega al punto donde el risco comienza a alzarse; puede ver la torre en la cima. Desgraciadamente, el r&iacute;o parece m&aacute;s crecido de lo normal y el agua llega junto a la base del risco. No hay demasiada profundidad, pero la corriente es bastante fuerte. De todas formas, [charname] cree que podr&aacute; vadear contracorriente.', 4, '', '', 8, 0, 0),
(266, '[charname] llega hasta un punto a 15 metros de la torre, sin ser descubierto. Desde ah&iacute; puede ver toda la torre, es tal como la describi&oacute; la granjera.', 4, '', '', 1, 0, 0),
(209, 'Cuando [charname] est&aacute; cruzando el riachuelo, un lobo salta desde unos matojos y le ataca', 4, '', '', 4, 0, 0),
(283, '[charname] asesta un golpe mortal al lobo y esta cae muerto.', 4, '', '20,fue|284', 1, 200, 0),
(284, 'El lobo esquiva los golpes de [charname], gru&ntilde;e y vuelve al ataque.', 4, '', '', 1, 0, 0),
(218, '[charname] consigue llegar a la orilla cerca la granja.', 4, '', '15,fue|271', 0, 0, 0),
(231, 'El comerciante le dice a [charname] que no puede ayudarle, pero que si se encuentra con alguien le pedir&aacute; ayuda.', 4, '', '', 2, 0, 0),
(227, 'En cuanto [charname] se lanza al ataque, el comerciante salta de la carreta y sale corriendo hacia el bosque.', 4, '', '', 1, 0, 0),
(216, '[charname] registra la carreta y enuentra debajo del asiento una bolsa con 50 monedas de oro.', 4, '', '15,sab|285|object|bolsa de dinero', 2, 0, 50),
(285, '[charname] no encuentra nada en la carreta.', 4, '', '', 4, 0, 0),
(286, 'Tras otra media hora avanzando por el camino [charname] llega al sendero que se dirige al Este, hacia el r&iacute;o y la otrre. Apenas puede discernir la silueta de la torre entre los arboles.', 4, '', '', 4, 0, 0),
(242, '[charname] camina abiertamente por la senda hacia la torre.', 4, '', '', 2, 0, 0),
(251, '[charname] comienza a avanzar lenta y sigilosamente entre los arbustos hacia la torre.', 4, '', '', 4, 0, 0),
(287, 'Al cabo de un rato, [charname] divisa la torre, entre los &aacute;rboles, y cautelosamente avanza hacia ella.', 4, '', '', 4, 0, 0),
(288, '[charname] llega a los lindes de la granja.', 4, '', '', 0, 0, 0),
(261, '[charname] ve a &uacute;nico hombre asomado al borde del segundo piso de la torre. Parece estar dormitando, apoyado en uno de los muros en ruinas. [charname] se da cuenta de que seguramente es el &uacute;nico centinela.', 4, '', '15,sab|245', 1, 100, 0),
(236, '[charname] llega hasta la puerta de la torre sin alertar a tus enemigos. La puerta no parece cerrada, puesto que no tiene cerradura ni pestillo.', 4, '', '15,des|257', 1, 100, 0),
(245, 'No hay se&ntilde;ales de vida en la torre.', 4, '', '', 1, 0, 0),
(273, 'Tras pasar la tarde caminando en direcci&oacute;n sur, [charname] acampa para pasar la noche. A la ma&ntilde;ana siguiente [charname] se despierta sano y descansado. La granjera se estaba marcando un farol. Puedes seguir hacia el este.', 4, '', '15,cont|269', 100, 0, 0),
(269, 'Tras pasar toda la tarde caminando en direcci&oacute;n este [charname] acampa para pasar la noche. Sin embargo, se despierta a media noche con unos dolores incre&iacute;bles en el estomago, la mujer no ment&iacute;a. [charname] muere tras una hora de dolores inimaginables.', 4, '', '', 100, -100, 0),
(289, '[charname] llega hasta a un punto a 15 metros de la torre sin ser descubierto. Desde ah&iacute;, puede ver toda la torre. Es tal y como la describi&oacute; la granjera.', 4, '', '15,des|257', 1, 0, 0),
(257, 'Cuando [charname] est&aacute; a unos nueve metros de la puerta de la torre, oye un grito que sale de su piso superior. Mira y ve a un hombre que le est&aacute; mirando, blandiendo una espada. Ya no puede acercarse sin ser visto.', 4, '', '', 1, 0, 0),
(274, '[charname] corre hacia el camino y luego sigue hacia el este durante un rato, perdiendo a cualquier perseguidor. Sin embargo, cuando regresa a la torre los hombres han huido y se han llevado a la chica.', 4, '', '', 100, -100, 0),
(258, 'Al entrar de repente en la habitaci&oacute;n del primer piso de la torre, [charname] ve a una chica atada, amordazada y tirada en el suelo. Hay un hombre sentado en un silla al otro lado.', 4, '', '', 1, 0, 0),
(246, 'Al asomarse en el cuarto poco iluminado, [charname] ve a una chica amordazada, inconsciente y tumbada en el suelo. En el otro extremo de la habitaci&oacute;n hay un hombre sentado en una silla y con los pies apoyados en una mesa destartalada. Parece dormido.', 4, '', '', 1, 0, 0),
(238, '[charname] examina la base del risco, que es d duro granito, pero no encuentras nada special.', 4, '', '', 1, 0, 0),
(265, 'En una de las muchas grietas, [charname] ve lo que parece ser una palanca.', 4, '', '15,int|253', 4, 100, 0),
(253, 'Al no encontrar nada que llame su atenci&oacute;n, [charname] comienza a escalar el risco.', 4, '', '', 4, 0, 0),
(256, '[charname] comienza a escalar el risco, avanzando con cuidado de asidero en asidero.', 4, '', '', 1, 0, 0),
(240, '[charname] alcanza la cima del risco y la torre. La torre tiene un agujero en su muro de 2 metros e espesor que da al r&iacute;o.  [charname] llega hasta el agujero y mira al interior de la torre.', 4, '', '15,fue|244', 3, 100, 0),
(244, 'A media escalda, [charname] se asusta, resbala y cae.', 4, '', '', 1, 0, 0),
(260, '[charname] queda desmayado y se despierta al cabo de un rato. ', 4, '', '15,con|268', 12, 0, 0),
(250, 'El intento de [charname] de neutralizar la trampa paerece haber funcionado. Tira de la palanca y se abre una peque&ntilde;a puerta en la superficie del risco. [charname] ve una escalera de caracol que sube por el interior del risco.', 4, '', '15,sab|235', 1, 100, 0),
(268, '[charname] est&aacute; inconsciente. Cuando se despierta ha oscurecido. Sin embargo, cuando regresa a la torre los hombres han huido y se han llevado a la chica.', 4, '', '', 100, -100, 0),
(271, 'Las profundas aguas arrastran [charname] y se ahoga.', 4, '', '', 100, -100, 0),
(247, '[charname] se da cuenta de que la palanca est&aacute; conectada a una trampa. Piensa que quiz&aacute; la trampa provoque un alud de piedras.', 4, '', '15,int|263', 1, 100, 0),
(263, '[charname] no ve nada en la palanca.', 4, '', '', 1, 0, 0),
(235, '[charname] oye un chasquido seco en la roca y se da cuenta de que ha activado una trampa. Una parte del risco por encima de la palanca se suela y sepulta la secci&oacute;n de roca con la palanca, mientras [charname] se zambulle, intentando evitar la avalancha.', 4, '', '', 1, 0, 0),
(267, 'Con mucho cuidado [charname] coge el alambre conectado a la palanca y lo intenta atar a un trozo de cuerda que a su vez ata a una roca cercana. [charname] espera que ello mantenga tirante el alambre y la trampa inactiva.', 4, '', '', 3, 0, 0),
(290, '[charname] asesta un buen golpe pero el malvado hombre lo esquiva.', 4, '', '', 1, 0, 0),
(241, 'Al final de la escalera [charname] encuentra una peque&ntilde;a puerta secreta que se abre silenciosamente. Est&aacute; situada en el fondo de la chimenea, en una habitaci&oacute;n poco iluminada del primer piso de la torre. [charname] esta agazapado detr&aacute;s de un hombre, que est&aacute; sentado en una silla, con los pies sobre na mesa roa. Parece dormido. Al otro lado de la habitaci&oacute;n ves a una chica atada y amordazada.', 4, '', '', 1, 0, 0),
(252, 'El hombre se pone en pie de un salto, lanzando un aullido y sacando su arma. [charname] le ha cogido por sorpresa y ser&aacute; f&aacute;cil acabar con &eacute;l.', 4, '', '', 1, 0, 0),
(255, '[charname] comienza a avanzar sigilosamente hacia la chica.', 4, '', '', 1, 0, 0),
(262, '[charname] est&aacute; en una buena posici&oacute;n detr&aacute;s del hombre dormido.  ', 4, '', '', 1, 0, 0),
(259, '[charname] llega a la chica sin despertar al hombre, la chica esta inconsciente. Ahora viene lo m&aacute;s dif&iacute;cil, [charname] debe coger a la chica, echarsela sobre los hombros  salir.', 4, '', '15,des|249', 3, 100, 0),
(249, '[charname] ve que el hombre se pone en pie de un salto. Lanza un aullido y  saca su arma.', 4, '', '', 2, 0, 0),
(275, '[charname] consigue salir por la puerta y adentrase en el bosque. [charname] ha salvado a la chica y cumplido su misi&oacute;n. ', 4, '', '20,des|249', 4, 500, 0),
(237, '[charname] ha derrotado al primer enemigo, pero oye al segundo que baja desde el tejado. [charname] se prepara para un nuevo combate.', 4, '', '20,fue|290', 1, 100, 0),
(248, 'Al irrumpir en la habitaci&oacute;n del primer piso, [charname] ve a una chica peque&ntilde;a atada, amordazada y tumbada en el suelo. Tambi&eacute;n ve a un hombre que sonr&iacute;e maliciosamente y avanza hacia &eacute;l con su espada desenvainada.', 4, '', '', 1, 0, 0),
(264, '[charname] se da cuenta que esperar no servir&aacute; de nada, as&iacute; que comienza a deslizase hacia la puerta de la torre.', 4, '', '', 1, 0, 0),
(243, '[charname] comienza a moverse sigilosamente hacia el hombre dormido. ', 4, '', '', 1, 0, 0),
(254, '[charname] est&aacute; preprado para acabar con el malvado hombre. ', 4, '', '', 1, 0, 0),
(291, '[charname] lanza un golpe mortal que acaba con su enemigo. Registra los cadaveres y recoge 200 monedas de oro. Se gira hacia la chica, la recoge y sale de torre camino a la granja. ', 4, '', '20,fue|292', 1, 200, 200),
(292, 'Gudgar asesta un buen golpe pero el malvado hombre lo esquiva.', 4, '', '', 1, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
