
<?php
//require_once 'sql_insert.php';  

?>

<style>
.modal{
/*est es ara qe el fond sea transarente*/ 
position: fixed;
width: 100%;
height: 100wh;
background: rgba(0,0,0,0.81);
/*display: block;    se nuestre siempre   -- none deshabilita*/ 
display: none;
}
.bodyModal{
        /*est es ara qe el fond sea transarente*/ 
width: 100%;
height: 100%;
display: -webkit-inline-flex;
display: -moz-inline-flex;
display: -ms-inline-flex;
display: -o-inline-flex;
display: inline-flex;
justify-content: center;
align-items: center;
}
.control {
width: 85%;
padding: 10px;
border-radius: 5px;
margin-bottom: 10px;
margin-left: 20px;
}
.btn{
margin-left: 20px;
padding: 10px;
border-radius: 5px;
margin-bottom: 10px;

}
.ModalForm {
width: 35%;
padding: 5px;
border-radius: 4px;
margin-bottom: 12px;
background-color:#fff ;

}

</style>

<script>
/*cerrar*/ 
function closemodal() {
    $('.modal').fadeOut();
}
/*abriir modal*/ 
function inmodal() {
 
    /* oculto titulos y botones*/
   /* var btnEdit = document.getElementById("btn_edit");
    var btnAdd = document.getElementById("btn_ing");
    var btnClose = document.getElementById("close");
    btnEdit.disabled = false;
    btnAdd.disabled = true;
    btnClose.disabled = false;
     desactivo los imput para que no puedan modificar */
        /* coloco el ID del formulario para limpiarlo
    document.getElementById("Form_add_solicit").reset();*/
    $('.modal').fadeIn();
}
/*abriir modal - lo abre y limpio los datos que puede tener */ 

</script>
<!-- onsubmit="event.preventDefalt(); ---esta funciioon se carga una ves
enva dats solo con otra funcion -->

<div class="modal">
<div class="bodyModal">
    
<form action="Sentencias_sql.php" method="POST" name="Form_add_solicit"  id="Form_add_solicit"  class="ModalForm"
onsubmit="event.preventDefalt()"

> <!--enctype="multipart/form-data" target="Objetivo_Subida"  enctype="multipart/form-data" target="Objetivo_Subida"  esto hace que no pase a otra pagina-->


<h1 >Habilita a Jugar en Fecha</h1>

<!-- onkeyup="javascript:this.value=this.value.toUpperCase();" esto se coloca para que todo lo que ingrese sea
en mayuscula -->
<input class="control" type="text" name="id" id="id" placeholder="ID" required><br>
<input class="control" type="text" name="usuario" id="usuario" placeholder=" Usuario" required><br>
<input class="control" type="text" name="nomcompleto" id="nomcompleto" placeholder="Nombre Completo " onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
<!--   
<input class="control" type="text" name="fechahab" id="fechahab" placeholder=" Fecha Habilitada"onkeyup="javascript:this.value=this.value.toUpperCase();">-->
<select class="control" name="fechajug" id="setup">
<?php 
    $check= new consultas();
    $varresultado= $check->Consulta_Filtros_fecha2();
    ?>
</select><br>
<input class="control" type="text" name="bloqueo" id="bloqueo" placeholder="Bloqueo"><br>
<button type="submit" name="altaParticipante" class="btn btn-success" id="btn_ing">Participar</button>   
<!--<button type="submit" name="Editasolicitante"  class="btn btn-success" id="btn_edit">Edita</button>   -->
<button type="button" class="btn btn-danger" id="close" onclick="closemodal();"> Cerrar </button>
<!-- iframe  esto hace que no pase a otra pagina-->
<!--<iframe id="Objetivo_Subida" name="Objetivo_Subida" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
 iframe  esto hace que no pase a otra pagina-->

</form>
</div>
</div>

