<?php
require_once './Config/Config.php';
//$title_l = TITLE_L;
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache"); // HTTP/1.0
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Fecha en el pasado
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
if (isset($_SESSION['participante'])) {
    // El usuario ya está autenticado, redirigir a la página de inicio o dashboard
   //header("Location: dashboard.php");
  exit();
}
session_start();

?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>ingreso</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poiret+One'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
<link rel="stylesheet" href="./login/style.css">
<!-- ------------- esto es para los mensajes de error español------------------- -->
<script type="text/javascript" src="./alertify/lib/alertify.js"></script>
<link rel="stylesheet" href="./alertify/themes/alertify.core.css" />
<link rel="stylesheet" href="./alertify/themes/alertify.default.css" />
<script src="./alertify/Alerta.js"></script>
<!-- ------------- esto es para los mensajes de error español------------------- -->

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container login-form">

	<div class="logo"><img class="logo" src=/partidos/images/logo-copa-america-2024.png></div>
	<div class="panel panel-default">
		<div class="panel-body">
			<form action="Control_login.php" method="post">
				
<?php	if (isset($_GET['login']) && $_GET['login'] == '1') {   // si viene con este valor entra por aca y pide que cambies la contraseña
	 // Obtener el valor del parámetro GET 'usuario'
	 $usuario = isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : '';
?> 
	            <div class="input-group login-userinput">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input id="txtusuario" type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>" readonly>
				</div>    
	            <div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input  id="txtPass" type="password" class="form-control" name="pass" placeholder="Actualiza Password" required>
					<span id="showPassword" class="input-group-btn">
            <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
          </span>  
				</div> <!-- este boton actualiza la contraseña -->
				<button class="btn btn-primary btn-block login-button" type="submit"  name="btnActualizar"><i class="fa fa-sign-in"></i> Actualizar</button>
<?php
    	} else {?>
		        <div class="input-group login-userinput">
					<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
					<input id="txtusuario" type="text" class="form-control" name="usuario" placeholder="Usuario" required>
				</div>
				<div class="input-group">
					<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
					<input  id="txtPass" type="password" class="form-control" name="pass" placeholder="Password" required>
					<span id="showPassword" class="input-group-btn">
            <button class="btn btn-default reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
          </span>  
				</div>
				<button class="btn btn-primary btn-block login-button" type="submit"  name="btningresar"><i class="fa fa-sign-in"></i> Ingresar</button>
				<?php
               } ?>
				<div class="checkbox login-options">
					<label><input type="checkbox"/> Recordar</label>
					<a href="#" class="login-forgot">Olvidaste tu Password?</a>
				</div>		
			</form>			
		</div>
	</div>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script  src="./login/script.js"></script>

</body>
<script type = "text/JavaScripts" src="JavaScripts/jquery-3.6.0.min.js"></script>
<!--  con esto recupero el control del usuario, si trae 1 significa 
que no la encontro al usuario y pass en la base de datos -->
<script>
<?php
if($_GET){
	$error =$_GET["a"];
   /* Errores detalle
	 1 - alta correcta del solicitante
	 2 - error ya esta ingresado el DNi en la tabla
	 */
	switch ($error) 
	{
	case 1:?>
		alertify.error("Usuario o Contraseña Incorrecta");<?php 
		break;
	case 2:?>
		alertify.error("La Sesión ah Caducado, Vuelva a Ingresar");<?php
		break;
	case 3:?>
        alertify.log("La Sesión se Cerró Satisfactoriamente", "", 0) // se cierra a
		//alertify.success("La Sesión se Cerró Satisfactoriamente");;<?php
		break;
	case 4:?>
		alertify.error("Error al actualizar los datos");<?php
		break;

	 default:
		$_GET["a"]='0';
	}
}
$_GET["a"]='0'
?>
</script>
<!-- --------------------------------------------------------------------------- -->
</html>
