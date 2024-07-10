<!-- Modal de añadir equipo -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeAddModal()">&times;</span>
        <form id="addForm" class="modal-form">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Equipo</h5>
            </div>
            <div class="modal-body"> <!-- Eliminamos 'text-center' para permitir la alineación personalizada -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombreEquipoAdd">Nombre Equipo:</label>
                            <input type="text" id="nombreEquipoAdd" name="nombreEquipoAdd" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombreLigaAdd">Nombre Liga:</label>
                            <input type="text" id="nombreLigaAdd" name="nombreLigaAdd" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="imagenEquipoAdd">Subir Imagen:</label>
                            <input type="file" id="imagenEquipoAdd" name="imagenEquipoAdd" accept="image/*" class="form-control-file" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img id="previewAdd" src="#" alt="Imagen Equipo" class="modal-image escudosmodalequipo">
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center"> <!-- Añadimos la clase 'text-center' para centrar los botones -->
                <button type="button" class="btn btn-success" onclick="addTeam()">Añadir</button>
                <button type="button" class="btn btn-danger" onclick="closeAddModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de editar equipo -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <form id="editForm" class="modal-form">
            <div class="modal-header">
                <h5 class="modal-title">Editar Equipo</h5>
            </div>
            <div class="modal-body"> <!-- Eliminamos 'text-center' para permitir la alineación personalizada -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="hidden" id="idEquipoEdit" name="idEquipoEdit">
                            <label for="nombreEquipoEdit">Nombre Equipo:</label>
                            <input type="text" id="nombreEquipoEdit" name="nombreEquipoEdit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nombreLigaEdit">Nombre Liga:</label>
                            <input type="text" id="nombreLigaEdit" name="nombreLigaEdit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="imagenEquipoEdit">Subir Imagen:</label>
                            <input type="file" id="imagenEquipoEdit" name="imagenEquipoEdit" accept="image/*" class="form-control-file">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img id="previewEdit" src="#" alt="Imagen Equipo" class="modal-image escudosmodalequipo">
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center"> <!-- Añadimos la clase 'text-center' para centrar los botones -->
                <button type="button"  class="btn btn-success" onclick="editTeam()">Guardar Cambios</button>
                <button type="button"  class="btn btn-danger"onclick="closeEditModal()">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('addModal').style.display = 'block';
        document.getElementById('previewAdd').src = '/path/to/default/image.png';
    }

    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }

    function openEditModal(id, nombreEquipo, nombreLiga) {
        document.getElementById('idEquipoEdit').value = id;
        document.getElementById('nombreEquipoEdit').value = nombreEquipo;
        document.getElementById('nombreLigaEdit').value = nombreLiga;
        document.getElementById('previewEdit').src = `/partidos/images/${nombreEquipo}.png`;
        document.getElementById('editModal').style.display = 'block';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function addTeam() {
        document.getElementById('addForm').submit();
    }

    function editTeam() {
        document.getElementById('editForm').submit();
    }

    // Previsualizar imagen en el modal de añadir
    document.getElementById('imagenEquipoAdd').onchange = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            document.getElementById('previewAdd').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    // Previsualizar imagen en el modal de editar
    document.getElementById('imagenEquipoEdit').onchange = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            document.getElementById('previewEdit').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    window.onclick = function(event) {
        if (event.target == document.getElementById('addModal')) {
            closeAddModal();
        }
        if (event.target == document.getElementById('editModal')) {
            closeEditModal();
        }
    }
</script>


   <style>
        /* Estilos para los modales */
        .modal {
            color: white;
            display: none; 
            position: fixed; 
            z-index: 1; 
            padding-top: 60px; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
         /* background-color: #fefefe;*/
            background-color: rgba(0, 0, 0, 0.548);
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            display: flex;
            justify-content:center;
            /*justify-content: space-between;*/

        }

        .modal-left, .modal-right {
            flex: 1;
        }

        .modal-image {
            max-width: 100%;
            height: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .escudosmodalequipo{
             width: 170px;
             height: 120px;
             justify-content: center;
             align-items: center;
             display: flex;
    }
    </style>
</style>
