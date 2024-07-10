
<?php
   
    //require_once './consultaus.php'; 
    //require_once 'consultas.php'; 
    include("./conex/conexion.php");
    //require_once 'ModalJugadores.php'; 
    require_once 'ModalEquipo.php'; 
    //include 'ModalEquipo.php'; 
    //session_start();
   // $jugador = $_SESSION['participante'];
   //echo $_SESSION['participante'];
    $url = $_SERVER['HTTP_REFERER']; 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- esto es fuentes para los iconos del menu y botones -->
<link rel='stylesheet' href='./fonts/remixicon.css'>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
-->
<title>Consulta Equipos</title>
</head>
<body>
    <link rel="stylesheet" href="./classes/style_table_equipos.css">

<div class="container-table">
    <div class="table_title">Todos los Equipos</div>
    <div class="table_header">ID</div>
    <div class="table_header">Equipos</div>
    <div class="table_header">Escudo</div>
    <div class="table_header"></div>
<?php
 
 $sql="select ID,NOMCORTO,EQUIPO FROM EQUIPOS order by ID DESC";
        $conex = conectar();
        $stmt = $conex -> query($sql);
       /*Almacenamos el resultado de fetchAll en una variable*/
      // $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC);
       //print_r($arrDatos);
       while (  $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC)) {
?> 
    <div class="table_item_c <?php echo $class; ?>"><?php echo $arrDatos['ID'] ?></div>  
    <div class="table_item_c <?php echo $class; ?>"><?php echo $arrDatos['EQUIPO'] ?></div>  
    <div class="table_item_c"><img alt="icon" class="escudos" src=/partidos/images/<?php echo $arrDatos['EQUIPO'] ?>.png></div>
    <div class="table_item_d">
    <!-- Botón de edición -->
    <button class="btneditar"
            onclick="openEditModal('<?php echo $arrDatos['ID'] ?>', '<?php echo $arrDatos['EQUIPO'] ?>', '<?php echo $arrDatos['NOMCORTO'] ?>')">
        <i class="ri-edit-2-line"></i> <!-- Cambia el ícono a uno de edición, por ejemplo, 'ri-edit-2-line' -->
    </button>

    <!-- Botón de añadir equipo -->
    <button class="btnanadir" 
            onclick="openAddModal()">
        <i class="ri-add-circle-line"></i> <!-- Ícono para añadir, por ejemplo, 'ri-add-circle-line' -->
        
    </button>
</div>
<?php
       }
    ?>

</div>
</body>
</html>




