<?php

session_start();
$user = $_SESSION ['participante'];
$fechaActual = date('d/m/y');
$fechaj = $_POST["fechaj"];
$url = $_SERVER['HTTP_REFERER']; 
// con esto tomo la url de donde vien Salida: /pagina/index.php?user=pepito
require './Conex/database.php';


if(isset($_POST['calculojugada'])){

    $nfecha=trim($_POST['fechaj']);
    
    try{
    $conex = new Database();
    $pdo = $conex->conectar();
  
    $sql="select  
    APUESTALIGA.IDPARTICIPANTE,
    LIGAPARTIDO.NPARTIDO,
    LIGAPARTIDO.NFECHA,
    LIGAPARTIDO.LOCAL,
    APUESTALIGA.RESLOCAL,
    LIGAPARTIDO.RESL,
    LIGAPARTIDO.VICITANTE,
    APUESTALIGA.RESVICITANTE,
    LIGAPARTIDO.RESV
     FROM LIGAPARTIDO,APUESTALIGA,LIGASETUP
     WHERE trim(LIGAPARTIDO.NPARTIDO) = trim(APUESTALIGA.NPARTIDO) AND trim(LIGAPARTIDO.NFECHA) = trim(APUESTALIGA.NFECHA) 
     AND LIGASETUP.DATO = LIGAPARTIDO.NFECHA AND LIGASETUP.EQUIVALENCIA= 'X'  and LIGAPARTIDO.JUGADO = 'X'
     order by APUESTALIGA.IDPARTICIPANTE, LIGAPARTIDO.NPARTIDO
      ";
      
    $consulta=$pdo->query($sql);
    $muestra=$consulta->fetchAll(PDO::FETCH_ASSOC);
    ///$arrDatos= $consulta->fetchall(PDO::FETCH_ASSOC);

   foreach ( $muestra as $arrDatos ){

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
       

        $data = [
           'part' => $arrDatos['IDPARTICIPANTE'],
           'Npartido' => $arrDatos['NPARTIDO'],
           'Nfecha' => $arrDatos['NFECHA'],
           'RESV' => $arrDatos['RESV'],
           'RESL' => $arrDatos['RESL'],
           'acierto' => $acierto,
           'ptotal' => $ptotal,
           'puntos' => $puntos,
           ];

          $conex = new Database();
          $pdo = $conex->conectar();
          // con esto marco la fecha nueva
          $sql = "update  apuestaliga set 
          ORIGINALL = :RESL, 
          ORIGINALV= :RESV,
          ACIERTOSLV = :ptotal,
          ACIERTOS = :acierto,
          puntos = :puntos 
           where IDPARTICIPANTE=trim(:part) and NFECHA= :Nfecha and NPARTIDO=:Npartido ";
          $update=$pdo->prepare($sql);
          $update->execute($data);
   }

   //echo "La fecha seleccionada es: " . $fechaj;

   $data2 = [
    'Nfecha' => $fechaj,
    ];

   $conex = new Database();
   $pdo = $conex->conectar();
   // con esto marco la fecha nueva
   $sql1 = "update ligaPartido set jugado = 'P' where  jugado = 'X' and NFECHA= :Nfecha ";
   $update1=$pdo->prepare($sql1);
   $update1->execute($data2);

   echo "<script> window.location='$url&e=11';</script>";

    } catch (Exception $ex) {


    die($ex->getMessage());
    echo "<script> window.location='$url&e=12';</script>";
} 
}















 
?>

