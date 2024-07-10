
<?php
    include("./conex/conexion.php");
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
    <link rel="stylesheet" href="./classes/style_table_posicion.css">

<div class="container-table">
    <div class="table_title">Posicion De Participantes</div>
    <div class="table_header">Fecha</div>
    <div class="table_header">Participantes</div>
    <div class="table_header">Puntos</div>
    <div class="table_header"></div>

    <?php
 
 $sql="
 select * from (
 select  
 APUESTALIGA.NFECHA,
 APUESTALIGA.IDPARTICIPANTE,
  sum(APUESTALIGA.PUNTOS) AS TOTAL_PUNTOS
  FROM APUESTALIGA,LIGASETUP
  WHERE  LIGASETUP.DATO = APUESTALIGA.NFECHA AND LIGASETUP.EQUIVALENCIA= 'X' 
    group by APUESTALIGA.NFECHA,APUESTALIGA.IDPARTICIPANTE) order by TOTAL_PUNTOS DESC    
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
        if ($posicion == 1) {
            $class = 'first';
        } elseif ($posicion == 2) {
            $class = 'second';
        } elseif ($posicion == 3) {
            $class = 'third';
        }

?> 
    <div class="table_item_i"><?php echo $arrDatos['NFECHA'] ?></div>  
    <div class="table_item_c <?php echo $class; ?>"><?php echo $arrDatos['IDPARTICIPANTE'] ?></div>  
    <!--<div class="table_item_c"><?php echo $arrDatos['Expr1002'] ?></div> -->
    <div class="table_item_c <?php echo $class; ?>"><?php echo $arrDatos['TOTAL_PUNTOS'] ?></div>  
 
    <div class="table_item_d">
    <button class="btnbuscar" 
                    onclick="window.location.href='MenuLigaArg.php?sec=Consulta_posiciones_vs&?nrofechas=<?php echo $arrDatos['NFECHA']; ?>&njugador=<?php echo $arrDatos['IDPARTICIPANTE']; ?>'">
                <i class="ri-search-2-line"></i>
            </button>
        
    <!--<button class ="btnbuscar" id="button" name="edit"  
    data-nrofechas = <?php echo $arrDatos['NFECHA'] ?>  
    data-njugador = <?php echo $arrDatos['IDPARTICIPANTE']?>
    onclick="inmodal();">
    <i class="ri-search-2-line"></i>  </button>-->

</div>
<?php
      $posicion++;
       }


    ?>

</div>
</body>
</html>




