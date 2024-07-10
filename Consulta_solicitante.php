
<?php
    //require_once './consultaus.php'; 
    require_once 'consultas.php'; 
    //require_once 'ModalJugadores.php'; 
    //include 'ModalJugadores.php'; 
?>

<script type="text/javascript" class="init">
	   $(document).ready(function () {
    $('#example').DataTable({     
    });
/*   esto hacer que al apretar el boton editar, la informacion de la linea seleccionada la envie 
a la pantalla modal
btn-info     -> esto es sobre el boton 
*/ 

    $(".btn-info").on("click", function() {
  var column1 = $(this).closest('tr').children()[0].textContent;
  var column2 = $(this).closest('tr').children()[1].textContent;
  var column3 = $(this).closest('tr').children()[2].textContent;
  var column4 = $(this).closest('tr').children()[3].textContent;
  var column5 = $(this).closest('tr').children()[4].textContent;
  var column6 = $(this).closest('tr').children()[5].textContent;
  var column7 = $(this).closest('tr').children()[6].textContent;
  //var column8 = $(this).closest('tr').children()[7].textContent;
  var column8 = $(this).closest('tr').children()[7].textContent.trim();
  var column9 = $(this).closest('tr').children()[8].textContent.trim();

 // $("id").val(column1); // id ver de colocar una label para mostrarlo o in imput inhabilitado 
  $("#dni").val(column2);
  $("#usuario").val(column3);
  $("#nombre").val(column4);
  $("#apellido").val(column5);
  $("#nomcompleto").val(column6);
  $("#mail").val(column7);
 // $("#bloqueo").val(column8);

   // Actualiza el valor del select basándose en el valor de column8
   if (column8 === "1") {
            $("#bloqueo").val("1");
        } else {
            $("#bloqueo").val("0");
        }
   if (column9 === "admin") {
            $("#puesto").val("admin");
        } else {
            $("#puesto").val("jugador");
        }


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
<button id="button" name="add" class="btn btn-success"onclick="inmodal_add(); "><i class="ri-user-add-fill"></i>  Agregar Participante</button>
</div>
    <table class="records_list table table-striped table-bordered table-hover " id="mydatatable">
    <!-- esto es la tabla  -->
    <?php 
    $check= new consultas();
    $varresultado= $check->Consulta_solicitante();
    ?>

       
    </table>
</div>
</div>
    






