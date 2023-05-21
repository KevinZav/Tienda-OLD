<div class="modal fade" id="modalTablaProductos" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="titleModalAgregar">Selecciona un producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" id="inputModalBuscar" class="form-control" placeholder="Buscar...">
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tableProductos">
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>