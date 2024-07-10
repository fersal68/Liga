
<?php
// Definir los parámetros de la petición
$url = 'https://api.mercadopago.com/v1/payments/search'; // URL de la API
$data = array('offset' => '30','limit' => '500','sort' => 'date_created',  'begin_date' => 'NOW-120DAYS', 'end_date' => 'NOW'); // Datos de la petición
$url_con_parametros = $url . '?' . http_build_query($data); // URL con los parámetros codificados en formato URL
$token = 'APP_USR-7210448084079082-050214-4e76d7e7a626261e22799364788cc390-95876608'; // Token de autorización

//   'criteria' => 'desc', -----lo quite para que no muestre lo ultimo, solo muestra 30 registros
// 'APP_USR-6524726407238020-051816-bd0eab8c7f1938c7a5edd2faff3f4fda-1221872746'  //molino
// 'APP_USR-7210448084079082-050214-4e76d7e7a626261e22799364788cc390-95876608' // mio personal


// Crear una instancia de cURL y configurar las opciones
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => true, // Devolver el resultado en lugar de imprimirlo
    CURLOPT_FOLLOWLOCATION => true, // Seguir redirecciones
    CURLOPT_URL => $url_con_parametros, // URL de la petición con los parámetros
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token // Encabezado de autorización
    )
));
// Ejecutar la petición y obtener el resultado
$resultado = curl_exec($curl);
// Manejar errores en caso de que existan
if (curl_errno($curl)) {
    $error_msg = curl_error($curl);
    echo "Error al enviar la petición: $error_msg";
}
// Cerrar la instancia de cURL
curl_close($curl);
// Imprimir el resultado de la petición
//echo $resultado;
$objeto_resultado = json_decode($resultado);

?>

<script type="text/javascript" class="init">
	   $(document).ready(function () {
    $('#example').DataTable({     
    });
/*   esto hacer que al apretar el boton editar, la informacion de la linea seleccionada la envie 
a la pantalla modal
btn-default -> esto es sobre el boton 
*/ 

    $(".btn-default").on("click", function() {
  var column1 = $(this).closest('tr').children()[0].textContent;
  var column2 = $(this).closest('tr').children()[1].textContent;
  var column3 = $(this).closest('tr').children()[2].textContent;
  var column4 = $(this).closest('tr').children()[3].textContent;
  var column5 = $(this).closest('tr').children()[4].textContent;
  var column6 = $(this).closest('tr').children()[5].textContent;
  var column7 = $(this).closest('tr').children()[6].textContent;
  var column8 = $(this).closest('tr').children()[7].textContent;
  
 // $("id").val(column1); // id ver de colocar una label para mostrarlo o in imput inhabilitado 
  $("#dni").val(column2);
  $("#usuario").val(column3);
  $("#nombre").val(column4);
  $("#apellido").val(column5);
  $("#nomcompleto").val(column6);
  $("#mail").val(column7);
  $("#bloqueo").val(column8);
  
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

    <table class="records_list table table-striped table-bordered table-hover " id="mydatatable">
    <!-- esto es la tabla  -->

            <thead>
            <th>ID Mercado Pago</th>
            <th>Fecha Aprobada</th>
            <th>Código de referencia</th>
            <th>Observacion</th>
            <th>Valor del producto</th>
            <th>Monto recibido</th>
            <th>Número de caja</th>
            <th>Estado</th>
            <th>Tipo de t</th>
            <th>Descripción de la operación</th>
            <th>Accion</th>
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
            </tr>
        </tfoot>
            <tbody>';
            <?php 

 //esto es para el detalle
                 $counter = 0;
                 foreach ($objeto_resultado->results as $results) {
                 if ($counter >= 10) break;
                 echo "<tr>";
                 echo "<td>{$results->id}</td>";
                 echo "<td>{$results->date_approved}</td>";
                 echo "<td>{$results->external_reference}</td>";
                 echo "<td>{$results->statement_descriptor}</td>";
                 echo "<td>{$results->transaction_amount}</td>";
                 echo "<td>{$results->transaction_details->net_received_amount}</td>";
                 echo "<td>{$results->pos_id}</td>";
                 echo "<td>{$results->status}</td>";
                 echo "<td>{$results->payment_type_id}</td>";
                 echo "<td>{$results->description}</td>";
                 echo '<td><button class="btn btn-secondary" onclick="inmodal();">Editar</button></td>';
                 echo "</tr>";
                 $counter++;
                             }
   echo '</tbody>';
       ?>
    </table>
</div>
</div>
    






