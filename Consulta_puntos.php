
<?php
   
    //require_once './consultaus.php'; 
    //require_once 'consultas.php'; 
    include("./conex/conexion.php");
    //require_once 'ModalJugadores.php'; 
    //require_once 'Modalequiposvs.php'; 
    //session_start();
   // $jugador = $_SESSION['participante'];
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

  $("#L").attr("src","/partidos/images/"+column2+".png");
  $("#V").attr("src","/partidos/images/"+column3+".png");

  $("#npartido").val(column4);
  $("#nrofecha").val(column5);
 // $("#user").val(column8);

});
    
});
</script>


<title>Consulta Puntos Por Fechas</title>
</head>
<body>
    <link rel="stylesheet" href="./classes/style_table_puntos.css">

<div class="container-table">
    <div class="table_title">Partidos</div>

    <div class="table_header">1</div>
    <div class="table_header">2</div>
    <div class="table_header">3</div>
    <div class="table_header">4</div>
    <div class="table_header">5</div>
    <div class="table_header">6</div>
    <div class="table_header">7</div>
    <div class="table_header">8</div>
    <div class="table_header">9</div>
    <div class="table_header">10</div>
    <div class="table_header">11</div>
    <div class="table_header">12</div>
    <div class="table_header">13</div>
    <div class="table_header">14</div>
    <?php
 
 $sql="select  
 APUESTALIGA.IDPARTICIPANTE,
 LIGAPARTIDO.Npartido,
 LIGAPARTIDO.NFECHA,
 LIGAPARTIDO.LOCAL,
 APUESTALIGA.RESLOCAL,
 LIGAPARTIDO.RESL,
 LIGAPARTIDO.VICITANTE,
 APUESTALIGA.RESVICITANTE,
 LIGAPARTIDO.RESV
  FROM LIGAPARTIDO,APUESTALIGA,LIGASETUP
  WHERE trim(LIGAPARTIDO.NPARTIDO) = trim(APUESTALIGA.NPARTIDO) AND trim(LIGAPARTIDO.NFECHA) = trim(APUESTALIGA.NFECHA) 
  AND LIGASETUP.DATO = LIGAPARTIDO.NFECHA AND LIGASETUP.EQUIVALENCIA= 'X' and LIGAPARTIDO.JUGADO = 'X' 
  order by APUESTALIGA.IDPARTICIPANTE, LIGAPARTIDO.Npartido
   ";
        $conex = conectar();
        $stmt = $conex -> query($sql);
       /*Almacenamos el resultado de fetchAll en una variable*/

       while (  $arrDatos=$stmt->fetch(PDO::FETCH_ASSOC)) {
 
$reslocal = $arrDatos['RESLOCAL'].$arrDatos['RESVICITANTE'];
$resvicitante = $arrDatos['RESL'].$arrDatos['RESV'];
if($resvicitante==$reslocal){$acierto= 2;}
else{$acierto= 0;}       


if($arrDatos['RESLOCAL']>$arrDatos['RESVICITANTE'] && $arrDatos['RESL'] > $arrDatos['RESV']){
    $ptotal = 1;
} else {
    if($arrDatos['RESLOCAL']== $arrDatos['RESVICITANTE'] && $arrDatos['RESL'] == $arrDatos['RESV']){
        $ptotal = 1;
    } else {
        if($arrDatos['RESLOCAL']<$arrDatos['RESVICITANTE'] && $arrDatos['RESL'] < $arrDatos['RESV']){
            $ptotal = 1;
        } else {
            $ptotal = 0;
        }
    }
    
}
$puntos = ($ptotal+$acierto) ;
?> 
    <div class="table_item_i"><?php echo $arrDatos['IDPARTICIPANTE'] ?></div>  
    <div class="table_item_c"><?php echo $arrDatos['Npartido'] ?></div>  
    <div class="table_item_c"><?php echo $arrDatos['NFECHA'] ?></div> 
    <div class="table_item_c"><img class="escudos" src=/partidos/images/<?php echo $arrDatos['LOCAL'] ?>.png></div>
    <div class="table_item_c"><?php echo $arrDatos['RESLOCAL'] ?></div>
    <div class="table_item_c"><?php echo $arrDatos['RESL'] ?></div>
    <div class="table_item_c"><?php echo $arrDatos['RESV'] ?></div>
    <div class="table_item_c"><?php echo $arrDatos['RESVICITANTE'] ?></div>
    <div class="table_item_c"><img class="escudos" src=/partidos/images/<?php echo $arrDatos['VICITANTE'] ?>.png></div>
    <div class="table_item_c"><?php echo $reslocal ?></div>
    <div class="table_item_c"><?php echo $resvicitante ?></div>
    <div class="table_item_c"><?php echo $acierto ?></div>
    <div class="table_item_c"><?php echo  $ptotal  ?></div>
    <div class="table_item_c"><?php echo $puntos  ?></div>
<?php
       }


    ?>
 <!-- data-partido=<?php echo $arrDatos['ID'] ?>  -->









</div>
</body>
</html>




