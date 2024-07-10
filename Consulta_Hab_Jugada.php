
<?php
    //require_once './consultaus.php'; 
    require_once 'consultas.php'; 
    require_once 'ModalHabilitaJugada.php'; 
?>

<script type="text/javascript" class="init">
	   $(document).ready(function () {
    $('#example').DataTable({     
    });
/*   esto hacer que al apretar el boton editar, la informacion de la linea seleccionada la envie 
a la pantalla modal
btn-info -> esto es sobre el boton 
*/ 

    $(".btn-info").on("click", function() {
  var column1 = $(this).closest('tr').children()[0].textContent;
  var column2 = $(this).closest('tr').children()[1].textContent;
  var column3 = $(this).closest('tr').children()[2].textContent;
  var column4 = $(this).closest('tr').children()[3].textContent;
  var column5 = $(this).closest('tr').children()[4].textContent;
  

  
 // $("id").val(column1); // id ver de colocar una label para mostrarlo o in imput inhabilitado 
  $("#id").val(column1);
  $("#usuario").val(column2);
  $("#nomcompleto").val(column3);
  $("#fechahab").val(column4);
  $("#bloqueo").val(column5);
  
});
    
});
</script>


    <div class="table-responsive" id="mydatatable-container">
  <style>
#mydatatable tfoot input{
    width: 100% !important;
}
#mydatatable tfoot {
    display: table-header-group !important;
}
</style>  
<div id="contenedor">
<div id= "boton">

</div>
    <table class="records_list table table-striped table-bordered table-hover " id="mydatatable">
    <!-- esto es la tabla  -->
    <?php 
    $check= new consultas();
    $varresultado= $check->Consulta_Hab_Jugada();
    ?>

       
    </table>
</div>
</div>
    






