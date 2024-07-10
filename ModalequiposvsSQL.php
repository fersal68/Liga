<?php   
    require './Conex/database.php';
session_start();
$participante = $_SESSION ['participante'];
$url = $_SERVER['HTTP_REFERER']; 
$npartido = $_POST['npartido']; 
$Nfecha = $_POST['nrofecha'];
$resL = $_POST['amount1'];
$resV = $_POST['amountv1'];

$fechaActual = date('d/m/y');
$Hora=date('H:i:s ');
$Horasola=date('H');

 
//if($resL>$resV ){
//    $Rapuesta = 'L';
//}elseif($resL=$resV ){
//    $Rapuesta = 'E';
//}elseif($resL<$resV ){
//    $Rapuesta = 'V';
//}; 

$concgol = ($resL.$resV);
    //$contrasena  = $_POST['contrasena'];
    //echo "tu usuario es: ".$npartido.'<br>'; 
    //echo "contraseña es: ".$contrasena;
    $conex = new Database();
    $pdo = $conex->conectar();
    $data = [
        'participante' => $participante,
        'npartido' => $npartido,
        'Nfecha' => $Nfecha,
        //resultado
        'resL' => $resL,
        'resV' => $resV,
        //'res' => $Rapuesta,
        //'concgol' => $concgol,
      
    ];
    $sql = "update  apuestaliga set RESLOCAL=:resL,RESVICITANTE=:resV  where IDPARTICIPANTE=:participante and NPARTIDO=:npartido and NFECHA=:Nfecha ";
    $update=$pdo->prepare($sql);
    $update->execute($data);
    echo "<script> window.location='$url&e=6';</script>";
/* 
    echo "<script>
    alert('$npartido');
    alert('$user');
    alert('$url');

    alert('$Nfecha');
    alert('$resL');
    alert('$resV');

    alert('$fechaActual');
    alert('$Hora');
    alert('$Horasola');
</script>";*/
?>