
<?php
   
    //require_once './consultaus.php'; 
    //require_once 'consultas.php'; 
    include("./conex/conexion.php");
    //require_once 'ModalJugadores.php'; 
    //require_once 'ModalPosiciones.php'; 
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



<title>Consulta Puntos Por Fechas</title>
</head>
<body>
    <link rel="stylesheet" href="./classes/style_table_posicion_g.css">

<div class="container-table">
    <div class="table_title">Posicion Global</div>
    <div class="table_header">Participantes</div>
    <div class="table_header">Puntos</div>
    <div class="table_header"></div>

    <?php
 
 $sql="
 select * from (
 select  
  APUESTALIGA.IDPARTICIPANTE,
  sum(APUESTALIGA.PUNTOS) AS TOTAL_PUNTOS
  FROM APUESTALIGA,LIGASETUP
  WHERE  LIGASETUP.DATO = APUESTALIGA.NFECHA  
    group by APUESTALIGA.IDPARTICIPANTE) order by TOTAL_PUNTOS DESC    
   ";
        $conex = conectar();
        $stmt = $conex -> query($sql);
       /*Almacenamos el resultado de fetchAll en una variable*/
      
      // $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC);
       //print_r($arrDatos);

       $posicion = 1;
       while (  $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC)) {
 
        
        $reslocal =0;
        $class = '';  // esto se coloco para que le cambie la letra a los 3 de la tabla
        $imageSrc = '';  // Esto se usa para definir la ruta de la imagen
        if ($posicion == 1) {
            $class = 'first';
            $imageSrc = './images/1primero.png'; // Reemplaza con la ruta a tu imagen de primer lugar
        } elseif ($posicion == 2) {
            $class = 'second';
            $imageSrc = './images/2segundo.png'; // Reemplaza con la ruta a tu imagen de segundo lugar
        } elseif ($posicion == 3) {
            $class = 'third';
            $imageSrc = './images/medalla3.png'; // Reemplaza con la ruta a tu imagen de tercer lugar
        }

        // Si necesitas una imagen por defecto para el resto de las posiciones
        if ($imageSrc == '') {
            $imageSrc = './images/consuelo.png'; // Reemplaza con la ruta a tu imagen por defecto
        }
?> 
    <div class="table_item_c <?php echo $class; ?>"><?php echo $arrDatos['IDPARTICIPANTE'] ?></div>  
    <!--<div class="table_item_c"><?php echo $arrDatos['Expr1002'] ?></div> -->
    <div class="table_item_c <?php echo $class; ?>">
    <?php echo $arrDatos['TOTAL_PUNTOS'] ?>
    <img src="<?php echo $imageSrc; ?>" alt="icon"></div>  
 
    <div class="table_item_d">
    <button class="btnbuscar" 
                    onclick="window.location.href='MenuLigaArg.php?sec=Consulta_posicion_global_vs&?nrofechas=<?php echo $arrDatos['IDPARTICIPANTE']; ?>&njugador=<?php echo $arrDatos['IDPARTICIPANTE']; ?>'">
                <i class="ri-search-2-line"></i>
            </button>
        
   
</div>
<?php
      $posicion++;
       }


    ?>

</div>
</body>
</html>




