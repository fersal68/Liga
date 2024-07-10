<?php
session_start();
include("./conex/conexion.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$nombre = strtoupper($_POST["usuario"]);
$pass   = $_POST["pass"];
//Login
if(isset($_POST["btningresar"]))
{
    $conex=conectar();
    $sql = "select usuario,puesto,bloqueo from usuarios WHERE usuario = '$nombre' AND pass='$pass'";
	$resultado = $conex->query($sql);
    $user = $resultado->fetch(PDO::FETCH_ASSOC);
   if($user==true)
{  $_SESSION['participante'] = $nombre;
   $_SESSION['puesto'] = $user['puesto'] ;
   $_SESSION['usuario'] = $user['usuario'] ;
if ($user['bloqueo']== 0){ // va a cambiar la contraseña
    echo "<script> window.location='loginliga.php?login=1&usuario=".urlencode($nombre)."'</script>"; //urlencode() para asegurarte de que la URL se genere correctamente
}
    echo "<script> window.location='MenuLigaArg.php' </script>";
}
else{
    echo "<script> window.location='loginliga.php?a=1' </script>";
} 
}
if (isset($_POST["btnActualizar"])) {
       // try {
        $conex = conectar();
        // Utilizar una consulta preparada para evitar inyecciones SQL
        $sql = "update  usuarios set pass = :pass , bloqueo = 1 WHERE usuario = :nombre ";
        $stmt = $conex->prepare($sql);
        $stmt->bindParam(':pass', $pass);
        $stmt->bindParam(':nombre', $nombre);
        // Ejecutar la consulta
        $resultado = $stmt->execute();
        // Verificar si la actualización fue exitosa
        if ($resultado) {
            echo "<script> window.location='MenuLigaArg.php' </script>";
        } else {
            echo "<script> window.location='loginliga.php?a=4'; </script>";
        }
        //} catch (PDOException $e) {
        // Manejar errores
        // echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='loginliga.php?a=1'; </script>";
        //}
}




?>