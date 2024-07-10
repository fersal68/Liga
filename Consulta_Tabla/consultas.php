<?php

include("conexion.php");

class Sistemaingreso_consultas {
    private $ctg;
    public $db;
    private $result;
    private $stmt;
    
   // public function __construct() {
   //     $this->db= new conexionoracle;
   // }


public function  Consulta_tickets() {
        try {
            $sql="select ID,SOLICITANTE,TSOLICITANTE,ESTADO,RESPONSABLE,PRIORIDAD,ASUNTO from tickets";
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
              <th data-field="SOLICITANTE" data-sortable="true">Solicitante</th>
              <th data-field="TSOLICITANTE" data-sortable="true">Tipo Solicitud</th>
              <th data-field="ESTADO" data-sortable="true">Estado</th>
              <th data-field="RESPONSABLE" data-sortable="true">Responsable</th>
              <th data-field="PRIORIDAD">Prioridad</th>
              <th data-field="ASUNTO">Asunto</th>
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
                 <td>'.$muestra['SOLICITANTE'].'  </td>
                 <td>'.$muestra['TSOLICITANTE'].'   </td>
                 <td>'.$muestra['ESTADO'].'   </td>
                 <td>'.$muestra['RESPONSABLE'].'  </td>
                 <td>'.$muestra['PRIORIDAD'].'   </td>
                 <td>'.$muestra['ASUNTO'].'   </td>
                 <td>  </td>    
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



}    

?>