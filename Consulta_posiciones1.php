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
    <link rel='stylesheet' href='./fonts/remixicon.css'>
    <title>Consulta Puntos Por Fechas</title>
    <link rel="stylesheet" href="./classes/style_table_posicion1.css">
</head>
<body>
    <div class="container-table">
        <div class="table_title">Posicion De Participantes</div>
        <div class="table_header">Fecha</div>
        <div class="table_header">Participantes</div>
        <div class="table_header">Puntos</div>
        <div class="table_header"></div>

        <?php
        $sql = "
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

        $posicion = 1;
        while ($arrDatos = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $class = '';  // Esto se usa para cambiar el estilo de los tres primeros en la tabla
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
            <div class="table_item_c <?php echo $class; ?>"><?php echo $arrDatos['TOTAL_PUNTOS'] ?></div>  
            <div class="table_item_d">
                <button class="btnbuscar" 
                    onclick="window.location.href='MenuLigaArg.php?sec=Consulta_posiciones_vs&?nrofechas=<?php echo $arrDatos['NFECHA']; ?>&njugador=<?php echo $arrDatos['IDPARTICIPANTE']; ?>'">
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



