<?php  require_once './src/administrador/views/nuevaLinea.modal.php';?>

<div class="contenido">
    <?php  require_once './src/includes/aside.php';?>
    <div class="work-space pt-1 pl-3 pr-3">
        <div class="header-action mt-4">
                <h1>
                <i class="fas fa-code-branch"></i>
                Lineas
            </h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevaLinea" id="agregarLinea">
                <i class="fas fa-plus mr-1"></i>Agregar
            </button>
        </div>
        <div class="container-table w-100">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?=Router::getScriptRoute('axios.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('jquery.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('bootstrap.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('swal.js')?>"></script>
<script src="<?=Router::getScriptRoute('lineas.js')?>"></script>
