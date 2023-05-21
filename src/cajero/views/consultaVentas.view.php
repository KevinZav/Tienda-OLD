
<div class="contenido">

<?php  require_once './src/includes/aside.cajero.php';?>

    <div class="work-space pt-1 pl-3 pr-3">

        <div class="header-action mt-4">
            <h1>
                <i class="fas fa-wallet mr-2"></i></i>
                Consultas de ventas
            </h1>
            <span style="display: flex;">
                <input type="date" value="29/01/2021" id="fechaConsulta"  class="form-control">
            </span>
        </div>

        <div class="container-table">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>



    </div>
</div>
<script src="<?=Router::getScriptRoute('axios.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('jquery.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('bootstrap.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('consultaVenta.js')?>"></script>
