<?php 


$funcion =$_GET["accion"];
if($funcion=="mostrar"  ){

    echo "<script> ok();</script>";
    echo $funcion;

}
// $url = $_SERVER['HTTP_REFERER']; 

//echo "<script> window.location='$url?e=1';error();</script>";

?>