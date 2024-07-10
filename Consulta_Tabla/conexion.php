<?php
//cinexion a access
//+++++++++++++++++ esto es para los errores+++++++++++++

error_reporting(E_ALL);
ini_set('display_errors', 1);

//require_once '../Config/Config.php';
require_once './Config/Config.php';

 function conectar () {
try {
//$database_path='C:\xampp\htdocs\Consulta_tabla\DB_tickets.mdb';
$database_path=APP_DATA;
$conex = new PDO( 'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)}; Dbq=' . $database_path . '; Uid=; Pwd=;' );
    if ($conex){
        return $conex;
    }
} catch (Exception $ex) {
    echo 'Error '.$ex;
}
}

function cierraconn (){
    $conn = null; 
}


?> 

<!--
 Crear un login y una página para registrar a un nuevo usuario con los siguientes datos:
 usuario y contraseña.
 
 
 (index.html) Login 	  -> Si el usuario existe 	 -> principal.html
 (index.html) Login    -> Si el usuario no existe -> (index.html) Login
  registrar.html       -> Nuevo usuario           -> (index.html) Login
 
 El login tendrá la opción para registrar.
 Usar "estilos.css" en el ejercicio.
 
 -->