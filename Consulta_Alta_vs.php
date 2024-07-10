<?php
    require_once 'consultas.php'; 
?>
    <link rel="stylesheet" href="./Classes/style_Consulta_Alta_vs.css" />


<form action="Sentencias_sql.php" method="post">
    <div class="menu_setup">
        <div class="menu_setup_cont">
            <p class="Menu_titulo">Alta de Partidos</p>
            <select class="form-select" name="Elocal" id="setup">
                <?php 
                    $check= new consultas();
                    $varresultado= $check->Consulta_Filtros_equipos();
                ?>
            </select>
            <select class="form-select" name="Evicitante" id="setup">
                <?php 
                    $check= new consultas();
                    $varresultado= $check->Consulta_Filtros_equipos();
                ?>
            </select>
            <select class="form-select" name="fechajuego" id="setup">
                <?php 
                    $check= new consultas();
                    $varresultado= $check->Consulta_Filtros_fechas();
                ?>
            </select>
            <select class="form-select" name="npartido" id="setup">
                <?php 
                    $check= new consultas();
                    $varresultado= $check->Consulta_Filtros_npartidos();
                ?>
            </select>
            <input type="date" name="fechajugada" id="fechaj">
            <button id="button" name="Alta_fecha" class="btn btn-success">Guardar</button>
        </div>
    </div>
</form>