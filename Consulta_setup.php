<?php
    require_once 'consultas.php'; 
?>




    <link rel="stylesheet" href="./Classes/style_setup.css" />

    <form action="Sentencias_sql.php" method="post">
    <div class="menu_setup">
        <div class="menu_setup_cont">
            <p class="Menu_titulo">Fecha a Jugar</p>
            <select class="form-select" name="fechaj" id="setup">
                <?php 
                    $check = new consultas();
                    $varresultado = $check->Consulta_Filtros_fecha();
                ?>
            </select>
            <button id="button" name="edit_fecha" class="btn" onclick="inmodal();">Guardar</button>
            <button type="button" class="btn" onclick="window.location.href='another_page.php'">Otro Botón</button>
        </div>
    </div>
</form>

