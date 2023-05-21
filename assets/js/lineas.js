const btnAgregar = document.getElementById('agregarLinea');
const btnAgregarLinea = document.getElementById('btnAgregarLinea');
const btnModificarLinea = document.getElementById('btnModificarLinea');
let lineas = [];
const inputLineaId = document.getElementById('lineaId');
const inputLineaDescripcion = document.getElementById('lineaDescripcion');

btnAgregar.addEventListener('click', () => {
    btnModificarLinea.classList.add('d-none');
    $('#titleModalAgregar').text('Agregar Linea');
    $('#lineaId').prop('readonly', false);
});

btnAgregarLinea.addEventListener('click',() => {

    const [id, descripcion] = [ inputLineaId.value, inputLineaDescripcion.value];

    if(id.length === 0 || descripcion.length === 0) {
        activateAlert('info', 'Faltan datos', 'No se insertaron todos los datos');
        return;
    }
    const data = new URLSearchParams();
    data.append('id', id);
    data.append('descripcion', descripcion);
    axios.post('http://localhost/tienda/administrador/agregarLinea', data)
    .then((response) => {
        
        (response.data.success) ? 
        activateAlert('success','Linea agregada', 'Linea agregada con éxito') : 
        activateAlert('error', 'Algo ha salido mal', 'Verifica que el ID no sea repetido.');

        getLineas();
        setTimeout(() => {
            inputLineaId.value = '';
            inputLineaDescripcion.value = '';
        }, 1000);
    });
});
btnModificarLinea.addEventListener('click', () => {

    const id = $('#lineaId').val();
    const nombre = $('#lineaDescripcion').val();

    const data = new URLSearchParams();
    data.append('id', id);
    data.append('nombre', nombre);
    axios.post('http://localhost/tienda/administrador/modificarLinea', data)
    .then((response) => {
        const success = response.data.success;
        if(success) {
            activateAlert('success', 'Linea modificada', 'La linea ha sido modificada con éxito');
        } else {
            activateAlert('error', 'Linea no modificada', 'Ha ocurrido un error y la linea no se modificó, intente nuevamente');
        }
        getLineas();
    });

});

const activateAlert = (icon, title, text) => {
    Swal.fire(
        title,
        text,
        icon
    );
}

const getLineas = () => {
    axios.post('http://localhost/tienda/administrador/getLineas')
    .then( response => {
        if (response.data.success) {
            lineas = [...response.data.lineas];
        } else {
            lineas = [];
        }
        writeTable(lineas);
    });
}

const writeTable = (data) => {
    tableBody.innerHTML = '';

    if(data.length === 0) return;

    data.forEach( (row) => {
        const newRow = document.createElement('tr');
        // Columnas estaticas
        newRow.innerHTML = `
            <th scope="row">${row['id']}</th>
            <td>${row['nombre']}</td>
        `;
        // crear opcion para los botones
        const btnAction = document.createElement('td');
        btnAction.classList.add('btn-action');
        // crear Boton Update
        const btnUpdate = document.createElement('button');
        btnUpdate.classList.add(...['btn', 'btn-primary', 'update', 'mr-1']);  
        btnUpdate.innerHTML = `<i class="fas fa-pen"></i>`;
        btnUpdate.addEventListener('click', () => updateLinea(row['id']));
        // crear Boton Delete
        const btnDelete = document.createElement('button');
        btnDelete.classList.add(...['btn', 'btn-danger', 'delete']);
        btnDelete.innerHTML = `<i class="fas fa-trash"></i>`;
        btnDelete.addEventListener('click', () => deleteLinea(row['id']))
        // agregar update y delete a las acciones
        btnAction.appendChild(btnUpdate);
        btnAction.appendChild(btnDelete);
        // agregar las acciones al tr
        newRow.appendChild(btnAction);

        tableBody.appendChild(newRow);
    });
}

const updateLinea = (id) => {
    btnAgregarLinea.classList.add('d-none');
    const lineaModificar = lineas.find( (linea) => linea.id === id);
    $('#titleModalAgregar').text('Modificar Linea');
    $('#lineaId').prop('readonly', true);
    $('#lineaId').val(lineaModificar.id);
    $('#lineaDescripcion').val(lineaModificar.nombre);
    $('#modalNuevaLinea').modal('show');
}
const deleteLinea = (id) => {

    Swal.fire({
        title: 'Eliminar Linea',
        text: "La linea será eliminada permanentemente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar',
        cancelButtonText: 'No, Conservar'
        
      }).then((result) => {
        if (result.isConfirmed) {

            const data = new URLSearchParams();
            data.append('id', id);
            
            axios.post('http://localhost/tienda/administrador/eliminarLinea', data)
            .then((response) =>{
                if(response.data.success) {
                    activateAlert('success','Linea eliminada', 'La linea ha sido eliminada con éxito');
                } else {
                    activateAlert('error','Acción no realizada', 'Algo ha salido mal, intentalo más tarde');
                }
                getLineas();
            });
        }
    });

}

(function(){
    getLineas();
}());

$('#modalNuevaLinea').on('hidden.bs.modal', function (e) {
    btnModificarLinea.classList.remove('d-none');
    btnAgregarLinea.classList.remove('d-none');
    inputLineaId.value = '';
    inputLineaDescripcion.value = '';
});