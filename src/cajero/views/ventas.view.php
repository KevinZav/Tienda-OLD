<?php  require_once './src/cajero/views/tablaProductos.modal.php';?>

<div class="contenido">

<?php  require_once './src/includes/aside.cajero.php';?>

    <div class="work-space pt-1 pl-3 pr-3">

        <div class="header-action mt-4">
            <h1>
                <i class="fas fa-money-bill-wave-alt mr-2"></i>
                Nota de venta
            </h1>
            <span style="display: flex;">
                <h2 id="totalVenta" style="color:#0077c8;">Total: $0.00</h2>
                <button class="btn btn-success ml-3" id="btnPagarVenta">
                    <i class="fas fa-donate mr-2"></i>
                    Pagar
                </button>
            </span>
        </div>

        <div class="container-table">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Clave</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td style="width:10%;">
                            <input type="text"
                            class="form-control w-100"
                            style="padding:.2rem;font-size:.9rem;"
                            id="inputCantidad"
                            value="1"
                            >
                        </td>
                        <td style="width:15%;">
                            <input type="text"
                                class="form-control w-100"
                                style="padding:.2rem;font-size:.9rem;"
                                id="inputProducto"
                            >
                        </td>
                        <td style="width:40%"></td>
                        <td style="width:12%;"></td>
                        <td style="width:12%;"></td>
                        <td style="width:11%;">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTablaProductos">
                                <i class="fas fa-search mr-1"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="<?=Router::getScriptRoute('cleave.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('swal.js')?>"></script>
<script src="<?=Router::getScriptRoute('axios.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('jquery.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('bootstrap.min.js')?>"></script>
<script src="<?=Router::getScriptRoute('venta.js')?>"></script>
