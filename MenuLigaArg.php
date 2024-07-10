<?php
session_start();
$puesto = $_SESSION['puesto'];
///////////No-cache headers: Evita que el navegador almacene en caché las páginas protegidas

//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Pragma: no-cache"); // HTTP/1.0
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
//////////

// Establecer el límite de tiempo en segundos (15 minutos)
$limiteTiempo = 15 * 60;   // 15 minutos

if (!isset($_SESSION['participante'])) {
    // Usuario no autenticado, redirigir a la página de login
    header("Location: loginliga.php");
    exit();
}
// Verificar si hay actividad previa
if (isset($_SESSION['ultimoAcceso'])) {
    $tiempoInactivo = time() - $_SESSION['ultimoAcceso'];

    if ($tiempoInactivo > $limiteTiempo) {
        // Tiempo de inactividad excedido, redirigir al usuario a la página de login
        session_unset(); // Limpia todas las variables de sesión
        session_destroy(); // Destruye la sesión
        echo "
            <script>
                // Añadir un parámetro de error a la URL
                window.location.href = 'loginliga.php?a=2';
                // Retrasar la redirección 2 segundos (2000 milisegundos) para permitir que el parámetro sea visible
                setTimeout(function() {
                    window.location.href = 'loginliga.php';}, 2000);
            </script>
        ";
        exit();
    }
}
// Actualizar el tiempo de la última actividad
$_SESSION['ultimoAcceso'] = time();
//$user = $_SESSION['participante'];

  // echo $user;
?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Menu Liga</title>


</head>
<body>  
<link rel="stylesheet" href="./Classes/style_menu.css">
<link rel="stylesheet" href="./classes/tabla.css">
<!-- partial:index.partial.html -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<!-- ------------- tablas------------------- 
<link rel="stylesheet" href="./Consulta_Tabla/css/datatables.min.css">-->
<script src="./Consulta_Tabla/js/datatables.min.js"></script>
<!-- ------------- esto es para los mensajes de error español------------------- -->
<script type="text/javascript" src="./alertify/lib/alertify.js"></script>
<link rel="stylesheet" href="./alertify/themes/alertify.core.css" />
<link rel="stylesheet" href="./alertify/themes/alertify.default.css" />
<script src="./alertify/Alerta.js"></script>
<!-- ------------- esto es para los mensajes de error español------------------- -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                <img src="./images/logo-copa-america-2024.png" alt="Logo" style="max-height: 35px; margin-top: -5px;">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="?sec=Publicidad">Home</a></li>
                    <!-- Level 1 -->
                    <?php    if   ($puesto =='admin'){    ?> <!-- aca preguntamos si es administrador, para habilitar el menu -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setup <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="?sec=Consulta_solicitante">Usuarios</a></li>   
                            <li><a href="?sec=Consulta_equipos">Equipos</a></li>  
                            <li><a href="?sec=Consulta_setup">Fecha a Jugar</a></li>     
                            <li><a href="?sec=Consulta_Alta_vs">Alta Partidos</a></li> 
                            <li><a href="?sec=Consulta_Hab_Jugada">Habilita Jugada</a></li>   
                            <li><a href="?sec=Consulta_Calculo1">Calcular Fecha</a></li>
                            <li><a href="?sec=Consulta_MercadoPago">Ingresos en Mercado Pago</a></li>  
                        
                            <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Partidos</a>
                                <!-- Level 2 -->
                                <ul class="dropdown-menu">
                                    <li><a href="?sec=Consulta_y_Cargaresultado">Carga Resultado</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>  
                    <?php    }  ?>  <!-- aca preguntamos si es administrador, para habilitar el menu -->
 
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Fixture <b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                        <li><a href="?sec=Consulta_Partidos">Fixture</a></li>
                        <li><a href="?sec=Consulta_Hab_Jugada_MP">Jugar Fecha</a></li>      
                        </ul>
                    </li>   
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Puntos<b class="caret"></b></a>
                        <ul class="dropdown-menu multi-level">
                         <!-- 
                        <li><a href="?sec=Consulta_puntos">Consulta Puntos</a></li>
                        <li><a href="?sec=Consulta_posiciones">Consulta Posicion por Fecha</a></li> --> 
                        <li><a href="?sec=Consulta_posiciones1">Posicion por Fecha</a></li>       
                        <li><a href="?sec=Consulta_posicion_global">Posicion Global</a></li>                                             

                        </ul>
                    </li> 
                    <li class="active"><a href="?cerr=logout">Cerrar Sesión</a>

                </li>             
                </ul>        
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
        
    </nav>
    <div class="container">
    <div>
<!--   aca debe ir el contenido de los menues-->
<?php
//   Cerrar Sesión
if (isset($_GET['cerr']) && $_GET['cerr'] == 'logout') {
    session_unset(); // Limpia todas las variables de sesión
    session_destroy(); // Destruye la sesión
    echo "<script> window.location='loginliga.php?a=3' </script>";
    //header("Location: loginliga.php");
    exit();
}
//   cerrado de session
?>
<div class="container transparente">
    <!-- Contenido de las páginas secundarias -->
<?php
if($_GET){
    $sec = $_GET["sec"];
    if(file_exists($sec.".php"))
    include($sec.".php");
    elseif(file_exists($sec.".html"))
    include($sec.".html");
    else
    echo 'Perdón pero la página solicitada no existe'; 
}
else
{
include("./Publicidad.php"); 
//include("./blank.php"); 
}
?>
</div>
<!--   aca debe ir el contenido de los menues-->
</div>
</div>
</body>
<!-- partial -->
</body>
<script>
  /* Seteos de los posibles errores, cuando cualquier pagina coloca en get 
  la variable, nuestro cual es el error*/
<?php
if($_GET){
  $error =$_GET["e"];
 /* Errores detalle
   1 - alta correcta del solicitante
   2 - error ya esta ingresado el DNi en la tabla
   */
  switch ($error) 
  {
  case 1:?>
      alertify.success("Se dio de alta el jugador");<?php 
      break;
  case 2:?>
      alertify.error("ya esta ingresado el D.N.I.");<?php
      break;
  case 3:?>
      alertify.success("Se pudo editar Jugador") ;<?php
      break;
  case 4:?>
      alertify.success("Se Cambio la Fecha Correctamente") ;<?php
      break;
  case 5:?>
      alertify.success("Se genero la fecha al usuario");<?php
      break;    
  case 6:?>
      alertify.success("Se modifico Correctamente la jugada");<?php
      break;        
  case 7:?>
      alertify.success("Se modifico Resultado");<?php
      break;
  case 8:?>
      alertify.success("Se agrego Partido");<?php
      break;      
  case 9:?>
      alertify.success("Se Actualizo la Contraseña");<?php
      break; 
  case 10:?>
      alertify.success("Se genero la fecha desde Mercado Pago");<?php
      break;
  case 11:?>
      alertify.success("Se calculo los Puntos de la Fecha");<?php
      break;
  case 12:?>
      alertify.error("Falla al calcular los Puntos");<?php
      break;     
  case 13:?>
      echo "i es igual a 2";<?php
      break;                            
  
      default:
      $_GET["e"]='0';
  }
}
?>
</script>
<script  src="./Consulta_Tabla/js/fresh-table.js"></script>
<script type="text/javascript" src="./Consulta_Tabla/js/document.js"> </script>


</html>
