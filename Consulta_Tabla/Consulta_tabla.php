
<?php
    require_once './consultaus.php';    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Hello DefaultController!</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Required meta tags 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        -->
      
        <script src="./js/3.3.1.jquery.min.js"></script>
        <!-- Bootstrap CSS  -->
        <script src="./bootstrap/bootstrap.min.js"></script>
        <script src="./bootstrap/popper.min.js"></script>
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <!-- Datatables -->
        <link rel="stylesheet" href="./css/datatables.min.css">
        <script src="./js/datatables.min.js"></script>
   
    </head>
    
    
    <body class="container-fluid p-5">
    <div class="table-responsive" id="mydatatable-container">
    
  <style>
#mydatatable tfoot input{
    width: 100% !important;
}
#mydatatable tfoot {
    display: table-header-group !important;
}
</style>  
    
    <table class="records_list table table-striped table-bordered table-hover " id="mydatatable">
    
    
    
    <!-- esto es la tabla  -->
    <?php 
    $check= new Sistemaingreso_consultas();
    $varresultado= $check->Consulta_tickets();
    ?>
/*          
Etcétera.. Aquí añade todas las filas de la tabla que quieras.
*/
       
    </table>
</div>
    





<!-- esto es el fintro de la tabla  -->
<script type="text/javascript" src="./js/document.js"> </script>
<script  src="./js/fresh-table.js"></script>


</body>
</html>