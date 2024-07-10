
<?php
  
    include("./conex/conexion.php");
    require_once 'Modalequiposvs.php'; 
    //session_start();
   $jugador = $_SESSION['participante'];
   $area = $_SESSION['puesto'];
   //echo $_SESSION['participante'];
   $fechaActual = date('dmY');// Obtiene la fecha actual en formato ddmmyyyy
   $fechaActualDateTime=date('Y-m-d H:i:s'); // este es el formato de fecha que viene de access

//echo "Fecha actual: " . (INT)$fechaActual . " sin formato y con hora " . (string)$fechaActualDateTime;
//echo $jugador;
//echo $area;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icono editar -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- esto es fuentes para los iconos del menu y botones -->
<link rel='stylesheet' href='./fonts/remixicon.css'>
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
-->
<style>
        .print-button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .table_message {
            text-align: center;
            color: red; /* Cambia a naranja si lo prefieres */
            font-weight: bold;
            font-size: 22px; /* Cambia el tamaño del texto según tus necesidades */
            margin-top: 20px;
            grid-column: span 9; /* Para que ocupe todo el ancho de la tabla */
        }
    </style>

<script type="text/javascript" class="init">
// esto es para tomar la variable dentro del boton class ="editVs" de abajo
$(document).ready(function () {
     $(".editVs").on("click", function() {
  var column1 = $(this).data("partido");
  var column2 = $(this).data("partidol");
  var column3 = $(this).data("partidov");

  var column6 = $(this).data("partidorl");
  var column7 = $(this).data("partidorv");
  

  var column4 = $(this).data("npartido");
  var column5 = $(this).data("nrofecha");

  var column9 = $(this).data("fecha");
  

 // var column8 = $(this).data("user");
 // $("id").val(column1); // id ver de colocar una label para mostrarlo o in imput inhabilitado 
  $("#partido").val(column1);
  $("#partidol").val(column2);
  $("#partidov").val(column3);


  document.getElementById('amount').innerHTML = column6;
  document.getElementById('amountv').innerHTML = column7;

  $("#L").attr("src","/partidos/images/"+column2+".png");
  $("#V").attr("src","/partidos/images/"+column3+".png");

  $("#npartido").val(column4);
  $("#nrofecha").val(column5);
 // $("#user").val(column8);
  $("#fecha").val(column9);

});
    
});
</script>


<title>Partidos</title>
</head>
<body>
    <link rel="stylesheet" href="./classes/style_table.css">

<div class="container-table">
    <div class="table_title">Partidos</div>

    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <div class="table_header"></div>
    <?php
 
    $sql="select 
LIGAPARTIDO.ID,
APUESTALIGA.IDPARTICIPANTE,
LIGAPARTIDO.NFECHA,
LIGAPARTIDO.NPARTIDO,
LIGAPARTIDO.LOCAL,
LIGAPARTIDO.VICITANTE ,
APUESTALIGA.RESLOCAL,
APUESTALIGA.RESVICITANTE,
TRim(FORMAT(LIGAPARTIDO.FECHA, 'dd/mm')) AS FECHA,
LIGAPARTIDO.FECHA AS FECHASF
FROM LIGAPARTIDO, APUESTALIGA ,LIGASETUP WHERE 
trim(LIGAPARTIDO.NPARTIDO) = trim(APUESTALIGA.NPARTIDO)
AND trim(LIGAPARTIDO.NFECHA) = trim(APUESTALIGA.NFECHA) 
AND LIGASETUP.DATO = LIGAPARTIDO.NFECHA AND LIGASETUP.EQUIVALENCIA= 'X'  and APUESTALIGA.IDPARTICIPANTE = trim('$jugador')
ORDER BY LIGAPARTIDO.FECHA"
;
        $conex = conectar();
        $stmt = $conex -> query($sql);
      //  if (  count($stmt) > 0) {
       /*Almacenamos el resultado de fetchAll en una variable*/
       while (  $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC))   {
            // Comparar la fecha de la base de datos con la fecha actual
            $fechaPartido = $arrDatos['FECHASF'];
           // $botonHabilitado = (int)$fechaPartido < (int)$fechaActual ? '' : 'disabled';
           $botonHabilitado = $fechaActualDateTime < $fechaPartido  ? '' : 'disabled';
?> 
    <!--<div class="table_item_i"><?php echo $arrDatos['NPARTIDO'] ?></div>  --> 
    <div class="table_item_i"><?php echo $arrDatos['FECHA'] ?></div>  
    <div class="table_item_c"><?php echo $arrDatos['NFECHA'] ?></div>  
    <div class="table_item_c local"><?php echo $arrDatos['LOCAL'] ?></div>
    <div class="table_item_c"><img class="escudos" src=/partidos/images/<?php echo $arrDatos['LOCAL'] ?>.png></div>
    <div class="table_item_c resultado"><?php echo $arrDatos['RESLOCAL'] ?></div>
    <div class="table_item_c resultado"><?php echo $arrDatos['RESVICITANTE'] ?></div>
    <div class="table_item_c"><img class="escudos" src=/partidos/images/<?php echo $arrDatos['VICITANTE'] ?>.png></div>
    <div class="table_item_c visitante"><?php echo $arrDatos['VICITANTE'] ?></div>
    <!-- con "data-partido paso una variable, la tomo y muevo a un campo ver en el escrip arriba "  -->
    <div class="table_item_d"><button class ="editVs" id="button" name="edit"  
    data-nrofecha = <?php echo $arrDatos['NFECHA'] ?>
    data-npartido = <?php echo $arrDatos['NPARTIDO'] ?>
    data-partidol = <?php echo $arrDatos['LOCAL'] ?>
    data-partidorl = <?php echo $arrDatos['RESLOCAL'] ?>
    data-partidorv = <?php echo $arrDatos['RESVICITANTE'] ?>
    data-partidov = <?php echo $arrDatos['VICITANTE'] ?>
    data-fecha = <?php echo $arrDatos['FECHA'] ?>
    onclick="inmodal();"
    
    <?php echo $botonHabilitado; ?>
    >  
    
    <!-- botonHabilitado le coloca si puede cambiar el resultado o no"  
                 <i class="ri-edit-fill"></i>  -->
                 <i class="fas fa-pencil-alt"></i>                
                </button></div>

   
<?php
  // }} 
    // else {
        //echo "<h3 >No está habilitado para jugar, para hacerlo debe ingresar en ......</h3>";
      //     echo "<div class='table_message'>No está habilitado para jugar, para hacerlo debe ingresar en ......</div>";
          }


    ?>
 <!-- data-partido=<?php echo $arrDatos['ID'] ?>  -->
</div>
<!-- Botón de imprimir -->
<div class="print-button-container">
        <button id="printButton" class="btn btn-primary mt-3">Imprimir</button>
</div>
<script>
        document.getElementById('printButton').addEventListener('click', function () {
            window.print();
        });
</script>
</body>
</html>




