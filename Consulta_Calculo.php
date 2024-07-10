<?php
    //require_once './consultaus.php'; 
    require_once 'consultas.php'; 
   // include("./conex/conexion.php");
    //require_once 'ModalJugadores.php'; 
    

   //echo $_SESSION['participante'];


?>



<style>
.menu_setup{
    width: 100%;
    height: 70vh;
    display: flex;
    justify-content: center;
    /*background: grey;*/


}

.menu_setup_cont{

    width: 50%;
    height: 40%;
    background: #D7FFE4;

    align-items: center;
    justify-content: center;  

    display:grid;
    grid-template-columns: 30% 30%;
    grid-row: auto;
    /*place-items: center;*/
    align-self: center;
    justify-self: center;
    

}
.Menu_titulo{
    font-family: monospace;
grid-column-start: 1 ;
grid-column-end: 3;

background: rgb(121, 121, 216);
color: white;
display: flex;
justify-content: center;
align-items: center;
font-weight: bold;
font-size: 1.9em;
}

</style>




<form action="Resultado_sql.php" method="post">
<div  class="menu_setup">

<div class="menu_setup_cont">
<p class="Menu_titulo">Calcular Fecha</p>

<select class="form-select" name="fechaj" id="setup">

<?php 
    $check= new consultas();
    $varresultado= $check->Consulta_Filtros_fecha();
    ?>




</select>
<button id="button" name="calculojugada" class="btn btn-success" >Calcular Fecha</button>

</div>



</div>
</form>

