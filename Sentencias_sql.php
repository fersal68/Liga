
<?php
session_start();
$user = $_SESSION ['participante'];


$url = $_SERVER['HTTP_REFERER']; 
// con esto tomo la url de donde vien Salida: /pagina/index.php?user=pepito
require './Conex/database.php';
//include_once "function.php";
//include("./conex/conexion.php");
// esto es para seleccionar ol botom que dio clik colocamos el mame=
if(isset($_POST['insertasolicitante'])){
    ///////////// Informacion enviada por el formulario /////////////
    $dni=$_POST['dni'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $usuario=$_POST['usuario'];
    $mail=$_POST['mail'];    
    $bloqueo=$_POST['bloqueo'];
    $puesto=$_POST['puesto'];
    $ncompleto= $_POST['apellido'].' '.$_POST['nombre'];
    $falta = date('Y-m-d');
    /////////////  /////////////
    $conex = new Database();
    $pdo = $conex->conectar();
    $sql = "select * from  usuarios where dni = ? ";
    $consulta=$pdo->prepare($sql);
    $consulta->execute(array("$dni"));
    $resultado= $consulta->fetchall(PDO::FETCH_ASSOC);
    //return $resultado;
    //$resultado = $pdo->query($sql);
    //$user = $resultado->fetch();
   if(isset($resultado) && !empty($resultado) && sizeof($resultado)>0) {
    ////////////// Insertar a la tabla la informacion generada /////////
    echo "<script> window.location='$url&e=2';</script>";
   }
   else{
    ///////// Fin informacion enviada por el formulario /// 
    $conex = new Database();
    $pdo = $conex->conectar();
    ////////////// Insertar a la tabla la informacion generada /////////
    $sql="insert into usuarios (DNI,USUARIO,PASS,NOMBRE,APELLIDO,NOMCOMPLETO,MAIL,FECHA_ALTA,BLOQUEO,PUESTO) 
    values(:dni,:usuario,:pass,:nombre,:apellido,:ncompleto,:mail,:falta,:bloqueo,:puesto)";
    $sql = $pdo->prepare($sql);
    $sql->bindParam(':dni',$dni);        
    $sql->bindParam(':nombre',$nombre);
    $sql->bindParam(':apellido',$apellido);
    $sql->bindParam(':bloqueo',$bloqueo);   
    $sql->bindParam(':usuario',$usuario);
    $sql->bindParam(':pass',$usuario);
    $sql->bindParam(':mail',$mail);
    $sql->bindParam(':ncompleto',$ncompleto);
    $sql->bindParam(':falta',$falta);
    $sql->bindParam(':puesto',$puesto);
/*    $sql->bindParam(':dni',$dni,PDO::PARAM_STR);      */
    $sql->execute();
    //le paso por $_GER e=1 el error para el alerta, en este caso es el agregado del solicitante
    echo "<script> window.location='$url&e=1';</script>";
}
    }// Cierra envio de guardado
/* 
   
*/
if(isset($_POST['Editasolicitante'])){
    $dni=$_POST['dni'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $puesto=$_POST['puesto'];
    $mail=$_POST['mail'];    
    $bloqueo=$_POST['bloqueo'];
    $ncompleto= $_POST['apellido'].' '.$_POST['nombre'];

    $conex = new Database();
    $pdo = $conex->conectar();
    $data = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'ncompleto' => $apellido.' '.$nombre,
        'mail' => $mail,
        'bloqueo' => $bloqueo,
        'dni' => $dni,
        'puesto' => $puesto,
    ];
    $sql = "update  usuarios set NOMBRE=:nombre,APELLIDO=:apellido,NOMCOMPLETO=:ncompleto,Mail=:mail,BLOQUEO=:bloqueo, PUESTO=:puesto where dni=:dni ";
    $update=$pdo->prepare($sql);
    $update->execute($data);
    echo "<script> window.location='$url&e=3';</script>";
}



if(isset($_POST['edit_fecha'])){
    $id=$_POST['fechaj'];
    $conex = new Database();
    $pdo = $conex->conectar();
    $data = [

        'id' => $id,
    ];
// con esto desmarco la seleccionada 
    $sql2 = "update  ligasetup set equivalencia=' ' ";
    $update2=$pdo->prepare($sql2);
    $update2->execute();

// con esto marco la fecha nueva
    $sql = "update  ligasetup set equivalencia='X' where id=:id ";
    $update=$pdo->prepare($sql);
    $update->execute($data);
    echo "<script> window.location='$url&e=4';</script>";
}

if(isset($_POST['altafecha'])){
    $id=$_POST['fechaj'];
    $conex = new Database();
    $pdo = $conex->conectar();
    $data = [

        'id' => $id,
    ];
// con esto desmarco la seleccionada 

// con esto marco la fecha nueva
    $sql = "update  ligasetup set equivalencia='X' where id=:id ";
    $update=$pdo->prepare($sql);
    $update->execute($data);
    echo "<script> window.location='$url&e=4';</script>";
}










if(isset($_POST['altaParticipante'])){
    $observacion=$_POST['fechajug'];
    $usuario=$_POST['usuario'];
/*
    echo "<script>
                alert('$observacion   ');
                alert('$usuario   ');
    </script>";  para validar que variables vienen */
    
    $conex = new Database();
    $pdo = $conex->conectar();
    $data = [
        'usuario' => $usuario,
        'observacion' => $observacion,
    ];
// con esto desmarco la seleccionada 

// con esto marco la fecha nueva
    $sql = "update  usuarios set fechahab=:observacion where usuario=trim(:usuario) ";
    $update=$pdo->prepare($sql);
    $update->execute($data);
    $data2 = [
        'usuario' => $usuario,
        'observacion' => $observacion,
    ];
    
    
    // aca ejecutamos la funsion y traemos los datos
    //$arrDatos=Consulta_SQL ($observacion);


    $pdo = $conex->conectar();
    $sql = "select nfecha,npartido,local, vicitante,fecha, hora from ligapartido where nfecha =  ? ";
    $consulta=$pdo->prepare($sql);
    $consulta->execute(array("$observacion"));
    ///$arrDatos= $consulta->fetchall(PDO::FETCH_ASSOC);


    while($muestra= $consulta->fetch()){
       
       $RESLOCAL = '0';
       $RESVICITANTE = '0';
       $npartido =  $muestra['npartido'];
       $JFECHA =  $muestra['fecha'];
        $pdo = $conex->conectar();
        ////////////// Insertar a la tabla la informacion generada /////////
        $sql="insert into apuestaliga (nfecha,npartido,RESLOCAL,RESVICITANTE,IDPARTICIPANTE,JFECHA) 
        VALUES ( :nfecha, :npartido ,:RESLOCAL,:RESVICITANTE, :IDPARTICIPANTE, :JFECHA)"; 
        $sql = $pdo->prepare($sql);
        $sql->bindParam(':IDPARTICIPANTE', $usuario);        //LO AGREGUE ULTIMO 30/05/2024
        $sql->bindParam(':nfecha',$observacion);
        $sql->bindParam(':RESLOCAL',$RESLOCAL);
        $sql->bindParam(':RESVICITANTE',$RESVICITANTE);   
        $sql->bindParam(':npartido',$npartido);
        $sql->bindParam(':JFECHA',$JFECHA);

    /*    $sql->bindParam(':dni',$dni,PDO::PARAM_STR);      */
        $sql->execute();
       

    }

    $idmp = '0';
    $fechamp = date('d/m/y');
    $importe =  '2000';
    $estado = 'manual';
    $descripcionmp = 'manual';

     $pdo = $conex->conectar();
     ////////////// Insertar a la tabla la informacion generada /////////
     $sql="insert into mercadopago (idmp ,fechamp,importemp,estado,descripcionmp,nfecha, idusuario,fecha) 
     VALUES ( :idmp, :fechamp ,:importemp,:estado, :descripcionmp, :nfecha, :idusuario, :fecha)"; 
     $sql = $pdo->prepare($sql);
     $sql->bindParam(':idmp', $idmp);  
     $sql->bindParam(':fechamp', $fechamp);  
     $sql->bindParam(':importemp', $importe); 
     $sql->bindParam(':estado', $estado);      
     $sql->bindParam(':descripcionmp', $descripcionmp);      
     $sql->bindParam(':nfecha',$observacion);
     $sql->bindParam(':idusuario', $usuario);        //LO AGREGUE ULTIMO 30/05/2024
     $sql->bindParam(':fecha', $fechamp);
 /*    $sql->bindParam(':dni',$dni,PDO::PARAM_STR);      */
     $sql->execute();


    echo "<script> window.location='$url&e=5';</script>";
}



if(isset($_POST['Alta_fecha'])){
    $Elocal=$_POST['Elocal'];
    $Evicitante=$_POST['Evicitante'];
    $fechajuego=$_POST['fechajuego'];
    $npartido=$_POST['npartido'];
    $fechajugada=$_POST['fechajugada'];

    $conex = new Database();
    $pdo = $conex->conectar();
    ////////////// Insertar a la tabla la informacion generada /////////
    $sql="insert into LigaPartido (NFECHA,NPARTIDO,LOCAL,RESL,VICITANTE,RESV,FECHA,HORA) 
    values(:fechajuego,:npartido,:Elocal,'0',:Evicitante,'0',:fechajugada,' ')";
    $sql = $pdo->prepare($sql);
    $sql->bindParam(':Elocal',$Elocal);        
    $sql->bindParam(':Evicitante',$Evicitante);
    $sql->bindParam(':fechajuego',$fechajuego);
    $sql->bindParam(':npartido',$npartido);   
    $sql->bindParam(':fechajugada',$fechajugada);
    $sql->execute();

    //$conex1 = new Database();
    //$pdo = $conex1->conectar();

    //$data = [
    //    'local' => $_POST['Elocal'],
    //    'vicitante' => $_POST['Evicitante'],
    //];
// con esto desmarco la seleccionada 

// con esto marco la fecha nueva
    //$sql2 = "update  equipos set NOMCORTO='X' where EQUIPO =:local ";
    //$update=$pdo->prepare($sql2);
    //$update->execute($data);
    //$sql3 = "update  equipos set NOMCORTO='X' where EQUIPO =:vicitante";
    //$update=$pdo->prepare($sql3);
    //$update->execute($data);

    echo "<script> window.location='$url&e=8';</script>";
}

if(isset($_POST['altajugadaporMP'])){
    $IDpago_MP = trim(($_POST['IDpago_MP']));
    $Status_MP =trim(($_POST['Status_MP']));
    $observacion=trim($_POST['observacion']);
    $dato=trim($_POST['dato']);
    $usuario = $_SESSION['participante'];
    //$usuario=strtoupper($_POST['usuario']);
    $Fecha_MP = ($_POST['Fecha_MP']);
    $Importe_MP = trim(($_POST['Importe_MP']));



/*
    echo "<script>
                alert('$observacion   ');
                alert('$usuario   ');
    </script>";  para validar que variables vienen */
    
    $conex = new Database();
    $pdo = $conex->conectar();
    $data = [
        'usuario' => $usuario,
        'observacion' => $observacion,
    ];
// con esto desmarco la seleccionada 

// con esto marco la fecha nueva
    $sql = "update  usuarios set fechahab=:observacion where usuario=trim(:usuario) ";
    $update=$pdo->prepare($sql);
    $update->execute($data);
    $data2 = [
        'usuario' => $usuario,
        'observacion' => $observacion,
    ];
    
    
    // aca ejecutamos la funsion y traemos los datos
    //$arrDatos=Consulta_SQL ($observacion);


    $pdo = $conex->conectar();
    $sql = "select nfecha,npartido,local, vicitante,fecha, hora from ligapartido where nfecha =  ? ";
    $consulta=$pdo->prepare($sql);
    $consulta->execute(array("$observacion"));
    ///$arrDatos= $consulta->fetchall(PDO::FETCH_ASSOC);


    while($muestra= $consulta->fetch()){
       
       $RESLOCAL = '0';
       $RESVICITANTE = '0';
       $npartido =  $muestra['npartido'];
       $JFECHA =  $muestra['fecha'];
        $pdo = $conex->conectar();
        ////////////// Insertar a la tabla la informacion generada /////////
        $sql="insert into apuestaliga (nfecha,npartido,RESLOCAL,RESVICITANTE,IDPARTICIPANTE,JFECHA) 
        VALUES ( :nfecha, :npartido ,:RESLOCAL,:RESVICITANTE, :IDPARTICIPANTE, :JFECHA)"; 
        $sql = $pdo->prepare($sql);
        $sql->bindParam(':IDPARTICIPANTE', $usuario);        //LO AGREGUE ULTIMO 30/05/2024
        $sql->bindParam(':nfecha',$observacion);
        $sql->bindParam(':RESLOCAL',$RESLOCAL);
        $sql->bindParam(':RESVICITANTE',$RESVICITANTE);   
        $sql->bindParam(':npartido',$npartido);
        $sql->bindParam(':JFECHA',$JFECHA);

    /*    $sql->bindParam(':dni',$dni,PDO::PARAM_STR);      */
        $sql->execute();
       

    }

  
    $fechamp = date('d/m/y');
    $estado = 'manual';
    $descripcionmp = 'manual';


     $pdo = $conex->conectar();
     ////////////// Insertar a la tabla la informacion generada /////////
     $sql="insert into mercadopago (idmp ,fechamp,importemp,estado,descripcionmp,nfecha, idusuario,fecha) 
     VALUES ( :idmp, :fechamp ,:importemp,:estado, :descripcionmp, :nfecha, :idusuario, :fecha)"; 
     $sql = $pdo->prepare($sql);
     $sql->bindParam(':idmp', $IDpago_MP);  
     $sql->bindParam(':fechamp', $Fecha_MP);  
     $sql->bindParam(':importemp', $Importe_MP); 
     $sql->bindParam(':estado', $Status_MP);      
     $sql->bindParam(':descripcionmp', $descripcionmp);      
     $sql->bindParam(':nfecha',$observacion);
     $sql->bindParam(':idusuario', $usuario);        //LO AGREGUE ULTIMO 30/05/2024
     $sql->bindParam(':fecha', $fechamp);
 /*    $sql->bindParam(':dni',$dni,PDO::PARAM_STR);      */
     $sql->execute();

    echo "<script> window.location='$url&e=10';</script>";
}

?>