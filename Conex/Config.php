<?php

//Ruta de la app
define('RUTA_APP', dirname(dirname(__FILE__)))  ;

//Ruta de la url

define('RUTA_URL', '__URL__');

define('NOMBRESITIO', '_NOMBRE_SITIO');

//Ruta donde esta la base de datos
define('APP_DATALA', 'C:\xampp\htdocs\Partidos\App_Data\DB_tickets.mdb');
// title
define('TITLE_L', 'ingreso');

//valor de la jugada
define('VALORJUGADA', '4000');


//Ruta donde estan los mensajes de alerta
define('ALERTA', './Alertas/sweetalert.js');


define('CSS', './Consulta_Tabla/js/fresh-table.js');

define('SERVIDOR', 'http://192.1.2.20:81/Pesajeweb/');
define('RUTA_CSS', SERVIDOR.'/public/css/');
define('RUTA_FONTS', SERVIDOR.'/public/css/');
define('RUTA_JS', SERVIDOR.'/public/js');
define('RUTA_IMG', SERVIDOR.'/public/img');
define('RUTA_ADMLTE', SERVIDOR.'/public/');
define('RUTA_HIGHCHARTS', SERVIDOR.'/public/graficos/');
define('RUTA_INICIO', SERVIDOR.'app/views/usuarios/usuario_login.php');





?>