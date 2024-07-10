
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
    document.getElementById("editar").style.display ='block';
    document.getElementById("ingreso").style.display ='none';
    /* oculto titulos y botones*/
    var btnEdit = document.getElementById("btn_edit");
    var btnAdd = document.getElementById("btn_ing");
    var btnClose = document.getElementById("close");
    btnEdit.disabled = false;
    btnAdd.disabled = true;
    btnClose.disabled = false;
    /* desactivo los imput para que no puedan modificar */
    var inputdni = document.getElementById("dni");
    var inputusuario = document.getElementById("usuario");
    //inputdni.disabled = true;
    inputdni.readonly = true;
    inputusuario.disabled = true;
    $('.modal').fadeIn();
}
/*abriir modal - lo abre y limpio los datos que puede tener */ 
function inmodal_add() {
      /* oculto titulos  */
    document.getElementById("ingreso").style.display ='block';
    document.getElementById("editar").style.display ='none';
      /* habilito o no botones */
    var btnEdit = document.getElementById("btn_edit");
    var btnAdd = document.getElementById("btn_ing");
    var btnClose = document.getElementById("close");
    btnEdit.disabled = true;
    btnAdd.disabled = false;
    btnClose.disabled = false;
    /* desactivo los imput para que puedan modificar */
    var inputdni = document.getElementById("dni");
    var inputusuario = document.getElementById("usuario");
    inputdni.disabled = false;
    //inputdni.readonly = true;
    inputusuario.disabled = false;
  
    /* coloco el ID del formulario para limpiarlo*/
    document.getElementById("Form_add_solicit").reset();

    //window.location.href = window.location.href + "?w1=" + 'Guardar' ; esto hace que coloque variable GET
    $('.modal').fadeIn();
}
</script>
<!-- onsubmit="event.preventDefalt(); ---esta funciioon se carga una ves
enva dats solo con otra funcion -->

<div class="modal">
<div class="bodyModal">
    
<form action="Sentencias_sql.php" method="POST" name="Form_add_solicit"  id="Form_add_solicit"  class="ModalForm"
onsubmit="event.preventDefalt()"

> <!--enctype="multipart/form-data" target="Objetivo_Subida"  enctype="multipart/form-data" target="Objetivo_Subida"  esto hace que no pase a otra pagina-->

<div id="ingreso">
<h1 >Ingreso de Jugador</h1></div>
<div id="editar">
<h1 >Edita Jugador</h1></div>

<!-- onkeyup="javascript:this.value=this.value.toUpperCase();" esto se coloca para que todo lo que ingrese sea
en mayuscula -->
<input class="control" type="text" name="dni" id="dni" placeholder="Documento" required><br>
<input class="control" type="text" name="usuario" id="usuario" placeholder=" Usuario" required><br>
<input class="control" type="text" name="nombre" id="nombre" placeholder=" Nombre" onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
<input class="control" type="text" name="apellido" id="apellido" placeholder=" Apellido"onkeyup="javascript:this.value=this.value.toUpperCase();"><br>
<input class="control" type="text" name="mail" id="mail" placeholder="Mail"><br>
<!--<input class="control" type="text" name="bloqueo" id="bloqueo" placeholder="Bloqueo"> -->
<select class="form-select control" name="bloqueo" id="bloqueo">
    <option value="0">0 - Pide Contraseña</option>
    <option value="1">1 - Con Contraseña</option>
</select><br>
<select class="form-select control" name="puesto" id="puesto">
    <option value="jugador">0 - Jugador</option>
    <option value="admin">1 - Administrador</option>
</select><br>
<button type="submit" name="insertasolicitante" class="btn btn-success" id="btn_ing">Guardar</button>   
<button type="submit" name="Editasolicitante"  class="btn btn-success" id="btn_edit">Edita</button>   
<button type="button" class="btn btn-danger" id="close" onclick="closemodal();"> Cerrar </button>
<!-- iframe  esto hace que no pase a otra pagina-->
<!--<iframe id="Objetivo_Subida" name="Objetivo_Subida" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
 iframe  esto hace que no pase a otra pagina-->

</form>
</div>
</div>

