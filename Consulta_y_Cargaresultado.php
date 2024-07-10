
<?php
   
    //require_once './consultaus.php'; 
    //require_once 'consultas.php'; 
    include("./conex/conexion.php");
    //require_once 'ModalJugadores.php'; 
    require_once 'Modalcargaresultado.php'; 
    //session_start();
    $jugador = $_SESSION['participante'];
   //echo $_SESSION['participante'];


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

 // var column8 = $(this).data("user");
 // $("id").val(column1); // id ver de colocar una label para mostrarlo o in imput inhabilitado 
  $("#partido").val(column1);
  $("#partidol").val(column2);
  $("#partidov").val(column3);


  document.getElementById('amount').innerHTML = column6;
  document.getElementById('amountv').innerHTML = column7;

  $("#L").attr("src","/Partidos/images/"+column2+".png");
  $("#V").attr("src","/Partidos/images/"+column3+".png");

  $("#npartido").val(column4);
  $("#nrofecha").val(column5);
 // $("#user").val(column8);

});
    
});
</script>


<title>Document</title>

</head>
<body>
    <link rel="stylesheet" href="./classes/style_table.css">

<div class="container-table">
    <div class="table_title">Carga Resultados</div>

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
LIGAPARTIDO.NFECHA,
LIGAPARTIDO.NPARTIDO,
LIGAPARTIDO.LOCAL,
LIGAPARTIDO.VICITANTE ,
LIGAPARTIDO.RESL,
LIGAPARTIDO.RESV
from LIGAPARTIDO, ligasetup where 
LIGAPARTIDO.NFECHA = ligasetup.dato
and ligasetup.EQUIVALENCIA = 'X' order by LIGAPARTIDO.FECHA "
;
        $conex = conectar();
        $stmt = $conex -> query($sql);
       /*Almacenamos el resultado de fetchAll en una variable*/

       while (  $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC))
      /*  if( $this->stmt === TRUE) {
            $conex = cierraconn();
            return 0;
        }*/
         {
?> 
    <div class="table_item_i"><?php echo $arrDatos['NPARTIDO'] ?></div>  
    <div class="table_item_c"><?php echo $arrDatos['NFECHA'] ?></div>  
    <div class="table_item_c local"><?php echo $arrDatos['LOCAL'] ?></div>
    <div class="table_item_c"><img class="escudos" src=/Partidos/images/<?php echo $arrDatos['LOCAL'] ?>.png></div>
    <div class="table_item_c resultado"><?php echo $arrDatos['RESL'] ?></div>
    <div class="table_item_c resultado"><?php echo $arrDatos['RESV'] ?></div>
    <div class="table_item_c"><img class="escudos" src=/Partidos/images/<?php echo $arrDatos['VICITANTE'] ?>.png></div>
    <div class="table_item_c vicitante"><?php echo $arrDatos['VICITANTE'] ?></div>
    <!-- con "data-partido paso una variable, la tomo y muevo a un campo ver en el escrip arriba "  -->
    <div class="table_item_d"><button class ="editVs" id="button" name="edit"  
    data-nrofecha = <?php echo $arrDatos['NFECHA'] ?>
    data-npartido = <?php echo $arrDatos['NPARTIDO'] ?>
    data-partidol = <?php echo $arrDatos['LOCAL'] ?>
    data-partidorl = <?php echo $arrDatos['RESL'] ?>
    data-partidorv = <?php echo $arrDatos['RESV'] ?>
    data-partidov = <?php echo $arrDatos['VICITANTE'] ?>
    onclick="inmodal();">
                 <i class="ri-edit-fill"></i>  </button></div>

    
<?php
}



    ?>
 <!-- data-partido=<?php echo $arrDatos['ID'] ?>  -->









</div>
</body>
</html>




