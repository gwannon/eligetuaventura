Eligetuaventura
===============

Eligetuaventura es un script en PHP para crear historias tipo "Elige tu propia aventura" con unos toques de RPG.  En principio esta montado para aventuras en un mundo mediaval fantástico, pero facilmente puede adaptarse a otros ambientaciónes (espaciales, cyberpunk, góticas, ...) cambiando el diseño, los iconos y los textos. Puedes ver un ejemplo de uso en http://heroesdenomariarka.com/. 

Se usa Facebook para que los usuarios se logeen dentro de la aplicación así que es necesario haber creado previamente una aplicación en Facebook. De todas formas es muy facil preparar el script para que tenga su propio sistema de registro y logeo.

INSTALACIÓN
-----------

- Copia /httpdocs/config.php.dist a /httpdocs/config.php y configura adecuadamente los datos de conexión a la base de datos y los datos de conexión a Facebook. 
- Crea y da permisos de escritura al directorio /httpdocs/skins/default/templates/templates_c. 
- En el fichero /httpdocs/skins/default/datas.php puedes modificar diferentes aspectos de las aventuras, como clases de personajes, razas u objeto mágicos que podrán comprar tus jugadores.

LICENCIA
--------

Esta aplicación web ha sido desarrollada con el Framework LungoJS http://lungo.tapquo.com/ y el sistema de plantillas de Smarty http://www.smarty.net/. En cumplimiento de la Licencia de LungoJS se puede obtener todo el código usado en la aplicación web de Eligetuaventura en https://github.com/gwannon/eligetuaventura/.

Esta aplicación esta distribuida bajo licencia GNU GPL, sientete libre de hacer las alteraciones y cambios necesarias. Sientete libre de coger este código y modificarlo a tu gusto (respetando la licencía sobre la que esta desarrollado) y si necesitas ayuda no dudes en preguntar. También te agradecemos por adelantado cualquier tipo de sugerencia o error que detectes.

Los iconos básicos usados son propiedad de:
- Blue-Galewind http://browse.deviantart.com/art/Icon-Set-C-Blue-Galewind-V-303578710
- Aills http://ails.deviantart.com/art/420-Pixel-Art-Icons-for-RPG-129892453

CREACIÓN DE AVENTURAS
---------------------
En /eligetuaventura.sql hay instaladas 4 aventuras básicas que te serviran de guía para tus propias aventuras.
