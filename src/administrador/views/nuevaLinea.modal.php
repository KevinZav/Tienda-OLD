<div class="modal fade" id="modalNuevaLinea" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="titleModalAgregar">Agregar Linea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

            <div class="form-group w-50">
                <label for="productoId" class="col-form-label">Clave:</label>
                <input type="text" class="form-control" id="lineaId">
            </div>

          <div class="form-group">
            <label for="descripcion" class="col-form-label">Descripción:</label>
            <input type="text" class="form-control" id="lineaDescripcion">
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnAgregarLinea">
          <i class="fas fa-check-circle"></i> Agregar
        </button>
        <button type="button" class="btn btn-primary" id="btnModificarLinea">
          <i class="fas fa-save"></i> Guardar
        </button>
      </div>
    </div>
  </div>
</div>