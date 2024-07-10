<?php
include("./conex/conexion.php");

//$nrofechas = $_GET['nrofechas'];
$njugador = $_GET['njugador'];





$sql="select  
APUESTALIGA.IDPARTICIPANTE,
LIGAPARTIDO.Npartido,
LIGAPARTIDO.NFECHA,
LIGAPARTIDO.LOCAL,
APUESTALIGA.RESLOCAL,
APUESTALIGA.ORIGINALL,
LIGAPARTIDO.VICITANTE,
APUESTALIGA.RESVICITANTE,
APUESTALIGA.ORIGINALV,
APUESTALIGA.ACIERTOSLV,
APUESTALIGA.ACIERTOS,
APUESTALIGA.PUNTOS,
TRim(FORMAT(APUESTALIGA.JFECHA, 'dd/mm')) AS JFECHA,
LIGAPARTIDO.JUGADO
 FROM LIGAPARTIDO,APUESTALIGA
 WHERE trim(LIGAPARTIDO.NPARTIDO) = trim(APUESTALIGA.NPARTIDO) AND trim(LIGAPARTIDO.NFECHA) = trim(APUESTALIGA.NFECHA) 
 AND  APUESTALIGA.IDPARTICIPANTE = '$njugador'
 order by APUESTALIGA.JFECHA,APUESTALIGA.IDPARTICIPANTE, LIGAPARTIDO.Npartido
  ";


/*$sql = "SELECT * FROM APUESTALIGA WHERE NFECHA = ? AND IDPARTICIPANTE = ?";*/


?>
</style>
    <script>  // esto es al apretar el boton vuelva a pa anterior pagina
        function volver() {
            history.back();
        }
    </script>

<style>
       .btn-custom-red {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
        }
        .btn-custom-red:hover {
            background-color: #c82333;
            color: white;
        }
    </style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="./classes/style_table_pos_glob_vs.css">
    <link rel='stylesheet' href='./fonts/remixicon.css'>
    
</head>
<body>
<div class="container-table">
    <div class="table_title">Resumen del Participante : <?= htmlspecialchars(strtoupper($njugador), ENT_QUOTES, 'UTF-8'); ?> </div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header">(Resul / </div>
    <div class="table_header">Partido)</div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header">L o V</div>
    <div class="table_header">Asierto</div>
    <div class="table_header">Puntos</div>
        <!-- Añade más encabezados según necesites -->
        
        <?php 
        $conex = conectar();
        $stmt = $conex -> query($sql);
        
        while (  $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC)) { 
            $rowClass = '';
            $originallClass = '';
            $originalvClass = '';
            $tooltip = '';
    
            if ($arrDatos['JUGADO'] == 'P') {
                $rowClass = 'jugado-p';
                $originallClass = 'highlight-originall-p';
                $originalvClass = 'highlight-originalv-p';
                $tooltip = 'Partido jugado';
            } elseif ($arrDatos['JUGADO'] == 'X') {
                $rowClass = 'jugado-x';
                $originallClass = 'highlight-originall-x';
                $originalvClass = 'highlight-originalv-x';
                $tooltip = 'Partido no calculado';
            } else {
                $rowClass = 'no-jugado';
                $tooltip = 'Sin jugar';
            }
            
            
            ?>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['JFECHA'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['LOCAL'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['RESLOCAL'] ?></div>
        <div class="table_item_c <?= $originallClass ?> <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['ORIGINALL'] ?></div>
        <div class="table_item_c <?= $originalvClass ?> <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['ORIGINALV'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['RESVICITANTE'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['VICITANTE'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['ACIERTOSLV'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['ACIERTOS'] ?></div>
        <div class="table_item_c <?= $rowClass ?>" title="<?= $tooltip ?>"><?php echo $arrDatos['PUNTOS'] ?></div>
        <?php } 
        ?>
    </div>
    <div class="text-center mt-2">
    <button class="btn btn-custom-red btn-md" onclick="volver()">Volver</button>
    </div>
</body>

</html>