<div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="titleModalAgregar">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>

            <div class="form-group w-50">
                <label for="productoId" class="col-form-label">Clave:</label>
                <input type="text" class="form-control" id="productoId">
                <small id="productoIdAlertExiste" class="form-text badge badge-danger d-none">Esta clave ya existe</small>
            </div>

          <div class="form-group">
            <label for="descripcion" class="col-form-label">Descripción:</label>
            <input type="text" class="form-control" id="descripcion">
          </div>

          <div class="row">
            <div class="col">
              <label for="precio" class="col-form-label">Precio publico:</label>
              <input class="form-control" id="precio">
            </div>
            <div class="col">
              <label for="costo" class="col-form-label">Costo:</label>
              <input class="form-control" id="costo">
            </div>
          </div>

          <div class="row">
            <div class="col">
              <label for="stock" class="col-form-label">Existencias:</label>
              <input class="form-control" id="stock">
            </div>
            <div class="col">
              <label for="linea_id" class="col-form-label">Linea:</label>
              <select id="linea_id" class="form-control">
                <option value="null">Sin linea</option>
              </select>
            </div>
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" id="btnAgregarProducto">
          <i class="fas fa-check-circle"></i> Agregar
        </button>
        <button type="button" class="btn btn-primary" id="btnModificarProducto">
          <i class="fas fa-save"></i> Guardar
        </button>
      </div>
    </div>
  </div>
</div>