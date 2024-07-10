
<?php
//session_start();
//require_once 'sql_insert.php';  
//$user = $_SESSION ['participante'];
//echo $_SESSION['participante'];
?>
    <link rel="stylesheet" href="./aumentar/style.css">
    <script src="./aumentar/script.js" defer ></script>
    <script src="./aumentar/script1.js" defer ></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
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
.btnVs{
padding: 10px 80px;
justify-content: center;
border-radius: 10px;
margin-bottom: 5px;
color: white;
text-align: center;
text-decoration: none;
display: inline-block;
font-size: 16px;
cursor: pointer;
}
.ModalFormVs {
width: 65%;
padding: 0px;
border-radius: 4px;
margin-bottom: 5px;

background: rgba(0,0,0,0.81);
/*background-color:#fff ;*/

}

.modalescudo {
  width: 40%;
  /*  height: 50px;*/
    border-radius:15px;
}
</style>

<script>
/*cerrar*/ 
function closemodal() {
 
    $('.modal').fadeOut();
    document.getElementById("amount").textContent = 0;
    document.getElementById("amountv").textContent = 0;
    
}
/*abriir modal*/ 
function inmodal() {

  
        $('.modal').fadeIn();
        document.getElementById("Form_add_vs").reset();

}
/*abriir modal - lo abre y limpio los datos que puede tener */ 
function inmodal_add() {
       /* coloco el ID del formulario para limpiarlo
    document.getElementById("Form_add_solicit").reset();*/

    //window.location.href = window.location.href + "?w1=" + 'Guardar' ; esto hace que coloque variable GET
    $('.modal').fadeIn();
}


function ajax() {
// aca muevo el resultado a un campo aculto, esto es para que el AJAX lo pase al siguiente formulario con metodo post
    document.getElementById("amount1").value = document.getElementById("amount").textContent ;
    document.getElementById("amountv1").value = document.getElementById("amountv").textContent;
   // con este ajax carla en siguiente php con metodo post
        var url = "./ModalequiposvsSQL.php";
        $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: $("#formulario").serialize(), 
           success: function(data)             
           {
            //aca ingresa la respiesta en el DIV del formulario que mandamos el POST
             $('#resp').html(data);               
           }
       });
 
 
}

</script>



<!-- onsubmit="event.preventDefalt(); ---esta funciioon se carga una ves
enva dats solo con otra funcion -->

<div class="modal">
<div class="bodyModal">
     <!-- "Sentencias_sql.php"
<form action="" method="POST" name="Form_add_solicit"  id="Form_add_solicit"  class="ModalForm"
enctype="multipart/form-data"

>  -->

<!-- <form action="Sentencias_sql.php"  method="POST" autocomplete="on" enctype="multipart/form-data" target="Objetivo_Subida" 
class="ModalFormVs" id="Form_add_vs"  >


onsubmit="event.preventDefalt()" -->


<form  method="POST" name="Form_add_solicit"  id="formulario" autocomplete="on" enctype="multipart/form-data" target="Objetivo_Subida" 
class="ModalFormVs"  
>
<!--onsubmit="event.preventDefalt()" enctype="multipart/form-data" target="Objetivo_Subida" 
 enctype="multipart/form-data" target="Objetivo_Subida"  esto hace que no pase a otra pagina-->
<div class="center">
    <!-- hidem oculta el campo para colocar datos y pasarlos por POST  -->
  <input type="hidden" name="user" id= "user">
  <input type="hidden" name="partido" id= "partido">
  <input type="hidden" name="npartido" id= "npartido">
  <input type="hidden" name="nrofecha" id= "nrofecha">
  <input type="hidden" name="partidol" id= "partidol">
  <input type="hidden" name="partidov" id= "partidov">
  <input type="hidden" name="fecha" id= "fecha">

    <div class="vs"><img id="L" class="modalescudo" src=""></div>
    <div class="vs"><img id="V" class="modalescudo" src=""></div>
  

        <div class="addNumber_cont">
            <button class="button" id="disabledBtn" onclick="addValueFunction(this)" value="decrease">
            <i class="ri-arrow-left-s-fill"></i>
            </button>

            <div class="value_cont">
                   <h1 name = "amount" id="amount" value="">0</h1>
                   <input type="hidden" name="amount1" id= "amount1" value="">
            </div>

            <button class="button" onclick="addValueFunction(this)" value="increase">
            <i class="ri-arrow-right-s-fill"></i>
            </button>

        </div>
        <div class="addNumber_cont">
            <button class="button" id="disabledBtnv" onclick="addValueFunctionv(this)" value="decrease">
            <i class="ri-arrow-left-s-fill"></i>
            </button>

            <div class="value_cont">
                <h1 name = "amountv" id="amountv" value="">0</h1>
                <input type="hidden" name="amountv1" id= "amountv1">
            </div>

            <button class="button" onclick="addValueFunctionv(this)" value="increase">
            <i class="ri-arrow-right-s-fill"></i>
            </button>

        </div>
        
        <div class="btnguardar">
      <button type="button" class="btnVs btn-success" id="btn-ingresar" onclick="ajax();">Guardar</button>
      <button type="button" class="btnVs btn-danger" id="close" onclick="closemodal();"> Cerrar </button>
      </div>



    </div>
    <div id="resp" ></div>
<!--  
-->
    <iframe id="Objetivo_Subida" name="Objetivo_Subida" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>

</form>
</div>
</div>

