<?php
//include("./Conex/conexion.php");
require './Conex/database.php';


function Consulta_SQL ($observacion){


    $conex1 = new Database();
    $pdo = $conex1->conectar();
    $sql = "select nfecha,npartido,local, vicitante,fecha, hora from ligapartido where nfecha =  ? ";
    $consulta=$pdo->prepare($sql);
    $consulta->execute(array("$observacion"));
    $arrDatos= $consulta->fetchall(PDO::FETCH_ASSOC);

   /* $sql="select nfecha,npartido,local, vicitante,fecha, hora from ligapartido where nfecha = $observacion";
    $conex = conectar();
    $stmt = $conex -> query($sql);
   Almacenamos el resultado de fetchAll en una variable
    $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);*/

    return $arrDatos;
// aca guardamos los datos
}
 













?>
