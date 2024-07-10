<?php

include("./Conex/conexion.php");

class consultas {
    private $ctg;
    public $db;
    private $result;
    private $stmt;
    
   // public function __construct() {
   //     $this->db= new conexionoracle;
   // }

public function  Consulta_login($nombre,$pass) {
    $conex = conectar(); 
    $sql = "select usuario,puesto from usuarios WHERE usuario = ".$nombre." and pass=".$pass;
    $resultado = $conex->query($sql);
    return  $resultado;

}



public function  Consulta_solicitante() {
        try {
            $sql="select ID,DNI,USUARIO,NOMBRE,APELLIDO,NOMCOMPLETO,MAIL,BLOQUEO,PUESTO from usuarios ORDER BY ID ASC";
            $conex = conectar();
            $stmt = $conex -> query($sql);
           /*Almacenamos el resultado de fetchAll en una variable*/
            $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if( $this->stmt === TRUE) {
                $conex = cierraconn();
                return 0;
            }
             //aca colocamos la cabecera
            echo '    
            <thead>
            <th data-field="id">ID</th>
            <th data-field="DNI" data-sortable="true">Documento</th>
            <th data-field="USUARIO" data-sortable="true">Usuario</th>
            <th data-field="NOMBRE" data-sortable="true">Nombre</th>
            <th data-field="APELLIDO" data-sortable="true">Apellido</th>
            <th data-field="NOMCOMPLETO" data-sortable="true">Nombre_Completo</th>
            <th data-field="MAIL">Email</th>
            <th data-field="BLOQUEO">Pass</th>
            <th data-field="PUESTO">Puesto</th>
            <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
            </thead>
            <tfoot>
            <tr>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
            </tr>
        </tfoot>
            <tbody>';
            //esto es para el detalle
            foreach ($arrDatos as $muestra) {
            echo '<tr>
                 <td>'.$muestra['ID'].'</td>
                 <td>'.$muestra['DNI'].'</td>
                 <td>'.strtoupper($muestra['USUARIO']).'</td>
                 <td>'.$muestra['NOMBRE'].'</td>
                 <td>'.$muestra['APELLIDO'].'</td>
                 <td>'.$muestra['NOMCOMPLETO'].'</td>
                 <td>'.$muestra['MAIL'].'</td>
                 <td>'.$muestra['BLOQUEO'].'</td>
                 <td>'.$muestra['PUESTO'].'</td>
                 <td>  <button id="button" name="edit" class="btn btn-info" onclick="inmodal();">
                 <i class="ri-edit-fill"></i>  Editar</button>'.' </td>      
                  </tr>';
            }
            echo '</tbody>';
       // $this->db->cierraconn ();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }    
    }


    public function  Consulta_Hab_Jugada() {
        try {
            $sql="select ID,USUARIO,NOMCOMPLETO,FECHAHAB,BLOQUEO  from usuarios ORDER BY ID ASC";
            $conex = conectar();
            $stmt = $conex -> query($sql);
           /*Almacenamos el resultado de fetchAll en una variable*/
            $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if( $this->stmt === TRUE) {
                $conex = cierraconn();
                return 0;
            }
             //aca colocamos la cabecera
            echo '    
            <thead>
            <th data-field="id">ID</th>
            <th data-field="USUARIO" data-sortable="true">Usuario</th>
            <th data-field="NOMCOMPLETO" data-sortable="true">Nombre_Completo</th>
            <th data-field="FECHAHAB">Fecha_Habilitado</th>
            <th data-field="BLOQUEO">Bloqueo</th>
            <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
            </thead>
            <tfoot>
            <tr>

                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
            </tr>
        </tfoot>
            <tbody>';
            //esto es para el detalle
            foreach ($arrDatos as $muestra) {
            echo '<tr>
                 <td>'.$muestra['ID'].'</td>
                 <td>'.strtoupper($muestra['USUARIO']).'</td>
                 <td>'.$muestra['NOMCOMPLETO'].'</td>
                 <td>'.$muestra['FECHAHAB'].'</td>
                 <td>'.$muestra['BLOQUEO'].'</td>
                 <td>  <button id="button" name="edit" class="btn btn-info" onclick="inmodal();">
                 <i class="ri-edit-fill"></i>  Editar</button>'.' </td>      
                  </tr>';
            }
            echo '</tbody>';
       // $this->db->cierraconn ();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }    
    }

    public function  Consulta_jugadores() {
        try {
            $sql="select ID,DNI,USUARIO,NOMBRE,APELLIDO,NOMCOMPLETO,MAIL,BLOQUEO from usuarios";
            $conex = conectar();
            $stmt = $conex -> query($sql);
           /*Almacenamos el resultado de fetchAll en una variable*/
            $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if( $this->stmt === TRUE) {
                $conex = cierraconn();
                return 0;
            }
             //aca colocamos la cabecera
            echo '    
            <thead>
              <th data-field="id">ID</th>
              <th data-field="DNI" data-sortable="true">Documento</th>
              <th data-field="USUARIO" data-sortable="true">Usuario</th>
              <th data-field="NOMBRE"  data-sortable="true">Nombre</th>
              <th data-field="APELLIDO" data-sortable="true">Apellido</th>
              <th data-field="NOMCOMPLETO" data-sortable="true">Nombre Completo</th>
              <th data-field="MAIL">Email</th>
              <th data-field="BLOQUEO">Bloqueo</th>
              <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
            </thead>

            
            <tfoot>
            <tr>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
            </tr>
        </tfoot>
            <tbody>';

            //esto es para el detalle
            foreach ($arrDatos as $muestra) {
            echo '<tr>
                 <td>'.$muestra['ID'].'  </td>
                 <td>'.$muestra['DNI'].'  </td>
                 <td>'.$muestra['USUARIO'].'  </td>
                 <td>'.$muestra['NOMBRE'].'   </td>
                 <td>'.$muestra['APELLIDO'].'   </td>
                 <td>'.$muestra['NOMCOMPLETO'].'  </td>
                 <td>'.$muestra['MAIL'].'   </td>
                 <td>'.$muestra['BLOQUEO'].'   </td>
                 <td> '.$opcion= '
                 <button id="button" name="edit" class="btn btn-dark" onclick="inmodal();">
                 <i class="ri-edit-fill"></i>  Editar</button>'.' </td>   
                  </tr>';
            }
            echo '</tbody>
                ';
       // $this->db->cierraconn ();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }    
    }


    public function  Consulta_Filtros() {
        try {
        $sql="select id, DESCRIPCION from filtros where filtro = 'ESTADO'";
        $conex = conectar();
        $stmt = $conex -> query($sql);
       /*Almacenamos el resultado de fetchAll en una variable*/
        $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if( $this->stmt === TRUE) {
            $conex = cierraconn();
            return 0;
        }
        foreach ($arrDatos as $muestra) {
           /*  $w = $muestra['id'];
            echo "<script> alert('Usuario registrado con exito:$w '); </script>";*/
            echo '<option value="'.$muestra['id'].'">'.$muestra['DESCRIPCION'].'</option>';

            
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }    



        
    }




    public function  Consulta_Filtros_fecha() {
            $conex=conectar();
            $sql = "select id, dato ,observacion, equivalencia from ligasetup where  modulo ='FECHA' order by id";
            $resultado = $conex->query($sql);
            
            while($muestra = $resultado->fetch()){
                if( $muestra['equivalencia']=="X"){
                    echo '<option selected="selected" value="'.$muestra['observacion'].'">'.$muestra['dato'].'</option>';  
                    } else{
                    echo '<option value="'.$muestra['observacion'].'">'.$muestra['dato'].'</option>';

            }
    }
}

public function  Consulta_Filtros_fechas() {
    $conex=conectar();
    $sql = "select id, dato , equivalencia from ligasetup where  modulo ='FECHA' order by id";
    $resultado = $conex->query($sql);
    
    while($muestra = $resultado->fetch()){
        if( $muestra['equivalencia']=="X"){
            echo '<option selected="selected" value="'.$muestra['dato'].'">'.$muestra['dato'].'</option>';  
            } else{
            echo '<option value="'.$muestra['dato'].'">'.$muestra['dato'].'</option>';

    }
}
}

public function  Consulta_Filtros_equipos() {
    $conex=conectar();
    $sql = "select id, equipo from equipos ";
    $resultado = $conex->query($sql);
    
    while($muestra = $resultado->fetch()){

            echo '<option selected="selected" value="'.$muestra['equipo'].'">'.$muestra['equipo'].'</option>';  


    }
}


public function  Consulta_Filtros_npartidos() {
    $conex=conectar();
    $sql = "select id, dato , equivalencia from ligasetup where  modulo ='PARTIDO' order by id";
    $resultado = $conex->query($sql);
    
    while($muestra = $resultado->fetch()){

            echo '<option selected="selected" value="'.$muestra['dato'].'">'.$muestra['dato'].'</option>';  


    }
}

public function  Consulta_Filtros_fecha2() {
    $conex=conectar();
    $sql = "select observacion,id, dato , equivalencia from ligasetup where  modulo ='FECHA' order by id";
    $resultado = $conex->query($sql);
    
    while($muestra = $resultado->fetch()){
        if( $muestra['equivalencia']=="X"){
            echo '<option selected="selected" value="'.$muestra['observacion'].'">'.$muestra['dato'].'</option>';  
            } else{
            echo '<option value="'.$muestra['observacion'].'">'.$muestra['dato'].'</option>';

    }
}
}



    public function  Consulta_Filtros_fecha1() {
        try {
        $sql="select id, dato , equivalencia from ligasetup where  modulo ='FECHA' order by id";
        $conex = conectar();
        $stmt = $conex -> query($sql);
       /*Almacenamos el resultado de fetchAll en una variable*/
        $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if( $this->stmt === TRUE) {
            $conex = cierraconn();
            return 0;
        }
        foreach ($arrDatos as $muestra) {
            if( $muestra['equivalencia']=="X"){
            echo '<option selected="selected" value="'.$muestra['id'].'">'.$muestra['dato'].'</option>';  
            } else{
            echo '<option value="'.$muestra['id'].'">'.$muestra['dato'].'</option>';
            }
            
        }
    } catch (Exception $ex) {
        die($ex->getMessage());
    }    
        
    }




    public function  Consulta_PartidoLiga() {
        try {
            $sql="select ID,NFECHA,LOCAL,VICITANTE, FECHA from LIGAPARTIDO";
            $conex = conectar();
            $stmt = $conex -> query($sql);
           /*Almacenamos el resultado de fetchAll en una variable*/
            $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if( $this->stmt === TRUE) {
                $conex = cierraconn();
                return 0;
            }
             //aca colocamos la cabecera
            echo '    
            <thead>
            <th data-field="id">ID</th>
            <th data-field="LOCAL" data-sortable="true">EQUIPO</th>
            <th data-field="elocal" data-sortable="true"></th>
            <th data-field="Rlocal" data-sortable="true"></th>
            <th data-field="Rvicitante" data-sortable="true"></th>
            <th data-field="evicitante" data-sortable="true"></th>
            <th data-field="VICITANTE" data-sortable="true">EQUIPO</th>
            <th data-field="FECHA" data-sortable="true">FECHA</th>
            <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
            </thead>
    
            <tbody>';
            //esto es para el detalle
            foreach ($arrDatos as $muestra) {
            echo '<tr>
                 <td>'.$muestra['ID'].'</td>
                 <td>'.$muestra['LOCAL'].'</td>
                 <td> <img class="escudo" src=/liga/images/'.$muestra['LOCAL'].'.jpg'.'></td>
                 <td> <input class="resultado" type="text" name="local" id="local" >'.'</td>
                 <td> <input class="resultado" type="text" name="vicitante" id="vicitante" >'.'</td>
                 <td> <img class="escudo" src=/liga/images/'.$muestra['VICITANTE'].'.jpg'.'></td>
                 <td>'.$muestra['VICITANTE'].'</td>
                 <td>'.$muestra['FECHA'].'</td>
                 <td>  <button id="button" name="edit" class="btn btn-success" onclick="inmodal();">
                 <i class="ri-edit-fill"></i>  Editar</button>'.' </td>      
                  </tr>';
            }
            echo '</tbody>';
       // $this->db->cierraconn ();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }    
    }





// no esta andando bien
    public function  Consulta_dos_tablas() {
        try { 
            $sql="select  
            APUESTALIGA.IDPARTICIPANTE,
            LIGAPARTIDO.Npartido,
            LIGAPARTIDO.Nfecha,
            LIGAPARTIDO.LOCAL,
            APUESTALIGA.RESLOCAL,
            LIGAPARTIDO.RESL,
            LIGAPARTIDO.VICITANTE,
            APUESTALIGA.RESVICITANTE,
            LIGAPARTIDO.RESV
             FROM LIGAPARTIDO,APUESTALIGA,LIGASETUP
             WHERE trim(LIGAPARTIDO.NPARTIDO) = trim(APUESTALIGA.NPARTIDO) AND trim(LIGAPARTIDO.NFECHA) = trim(APUESTALIGA.NFECHA) 
             AND LIGASETUP.DATO = LIGAPARTIDO.NFECHA AND LIGASETUP.EQUIVALENCIA= 'X' AND LIGAPARTIDO.Npartido='1'
             order by APUESTALIGA.IDPARTICIPANTE, LIGAPARTIDO.Npartido
              ";
            $conex = conectar();
            $stmt = $conex -> query($sql);
           /*Almacenamos el resultado de fetchAll en una variable*/
            $arrDatos=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if( $this->stmt === TRUE) {
                $conex = cierraconn();
                return 0;
            }


             //aca colocamos la cabecera
            echo '    
            <thead>
            <th data-field="1" data-sortable="true">1</th>
            <th data-field="2" data-sortable="true">2</th>
            <th data-field="3" data-sortable="true">3</th>
            <th data-field="4" data-sortable="true">4</th>
            <th data-field="5" data-sortable="true">5</th>
            <th data-field="6" data-sortable="true">6</th>
            <th data-field="7" data-sortable="true">7</th>
            <th data-field="8" data-sortable="true">8</th>
            <th data-field="9" data-sortable="true">9</th>
            <th data-field="10" data-sortable="true">10</th>
            <th data-field="11" data-sortable="true">11</th>
            <th data-field="actions" data-formatter="operateFormatter" data-events="operateEvents">Actions</th>
            </thead>
            <tfoot>
            <tr>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
                <th>Filter..</th>
            </tr>
        </tfoot>
            <tbody>';
            //esto es para el detalle
            foreach ($arrDatos as $muestra) {
                
                if($muestra['RESL']>$muestra['RESV']){
                    $Rapuesta = 'L';
                }elseif($muestra['RESL']=$muestra['RESV']){
                    $Rapuesta = 'E';
                }elseif($muestra['RESL']<$muestra['RESV']){
                    $Rapuesta = 'V';
                }; 
        if($muestra['RESLOCAL']>$muestra['RESVICITANTE']){
                $aapuesta = 'L';
        }elseif($muestra['RESLOCAL']=$muestra['RESVICITANTE']){
                $aapuesta = 'E';
        }elseif($muestra['RESLOCAL']<$muestra['RESVICITANTE']){
                $aapuesta = 'V';
        }; 


if($muestra['RESL']=$muestra['RESLOCAL']&&$muestra['RESVICITANTE']=$muestra['RESV']){
    $suma = 2;
} else{
    $suma = 0;
};

if($aapuesta = $Rapuesta){
    $calculo = 1;
}else{
    $calculo = 0;
}

$total = $calculo  + $suma;



            echo '<tr>
                 <td>'.$muestra['IDPARTICIPANTE'].'</td>
                 <td>'.$muestra['Npartido'].'</td>
                 <td>'.$muestra['Nfecha'].'</td>
                 <td>'.$muestra['LOCAL'].'</td>
                 <td>'.$muestra['RESLOCAL'].'</td>
                 <td>'.$muestra['RESL'].'</td>
                 <td>'.$muestra['VICITANTE'].'</td>
                 <td>'.$muestra['RESVICITANTE'].'</td>
                 <td>'.$muestra['RESV'].'</td>

                 <td>'.$total.'</td>
                 <td>  <button id="button" name="edit" class="btn btn-default" onclick="inmodal();">
                 <i class="ri-edit-fill"></i>  Editar</button>'.' </td>      
                  </tr>';
            }
            echo '</tbody>';
       // $this->db->cierraconn ();
        } catch (Exception $ex) {
            die($ex->getMessage());
        }    
    
    }



























}    





























?>