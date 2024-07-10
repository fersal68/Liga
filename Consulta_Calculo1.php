<?php
    require_once 'consultas.php'; 
?>

<link rel="stylesheet" href="./Classes/style_Consulta_Calculo.css" />

<form action="Resultado_sql.php" method="post">
    <div class="menu_setup">
        <div class="menu_setup_cont">
            <p class="Menu_titulo">Calcular Fecha</p>
            <select class="form-select" name="fechaj" id="setup">
                <?php 
                    $check = new consultas();
                    $varresultado = $check->Consulta_Filtros_fecha();
                ?>
            </select>
            <button id="button" name="calculojugada" class="btn btn-success">Calcular Fecha</button>
        </div>
    </div>
</form>