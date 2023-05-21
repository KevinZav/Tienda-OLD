<?php  require_once './src/administrador/views/nuevoProducto.modal.php';?>

<div class="contenido">
    
    <?php  require_once './src/includes/aside.php';?>

    <div class="work-space pt-1 pl-3 pr-3">

        <div class="header-action mt-4">
                <h1>
                <i class="fas fa-server"></i>
                Lista de productos
            </h1>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoProducto" id="btnAgregar">
                <i class="fas fa-plus mr-1"></i>Agregar
            </button>
        </div>
        <div class="form-busqueda">
            <input class="mr-1" type="text" id="busquedaProducto" placeholder="Buscar producto">

            <select id="lineasDisponibles" class="mr-1">
                <option value="" id="lineaDefault">Filtrar por Linea</option>
            </select>
            <button class="btn-primary" id="btnRestaurar">
                <i class="fas fa-reply mr-1"></i>Restaurar
            </button>
        </div>
        <div class="container-table">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio publico</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Linea</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    
    </div>
</div>
<script src="<?=Router::getScriptRoute('cleave.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('swal.js')?>"></script>
<script src="<?=Router::getScriptRoute('axios.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('jquery.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('bootstrap.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('inventario.js')?>"></script>
