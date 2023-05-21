const tableBody = document.getElementById('tableBody');
const selectLineas = document.getElementById('linea_id');
const selectLineasDisponibles = document.getElementById('lineasDisponibles');
let productos = [];
let lineas = [];

const btnAgregar = document.getElementById('btnAgregar');
const btnAgregarProducto = document.getElementById('btnAgregarProducto');
const btnModificarProducto = document.getElementById('btnModificarProducto');
const busquedaProducto = document.getElementById('busquedaProducto');
const btnRestaurar = document.getElementById('btnRestaurar');

// Inputs
const inputProductoId = document.getElementById('productoId');
const inputDescripcion = document.getElementById('descripcion');
const inputPrecio = document.getElementById('precio');
const inputCosto = document.getElementById('costo');
const inputStock = document.getElementById('stock');

// codigo nuevo
inputProductoId.addEventListener('keyup', (e) => {
    const termino = e.target.value;

    const productoClave = productos.find( p => p['id'] === termino);

    if (productoClave) {
        console.log('EXISTE');
        document.getElementById('productoIdAlertExiste').classList.remove('d-none');
    } else {
        console.log('no EXISTE');
        document.getElementById('productoIdAlertExiste').classList.add('d-none');
    }

});
// end codigo nuevo

const writeLineas = ( data ) => {
    selectLineasDisponibles.innerHTML = '';
    const optionDefault = document.createElement('option');
    optionDefault.innerHTML = `Filtrar por linea`;
    optionDefault.value = '';
    selectLineasDisponibles.appendChild(optionDefault);
    data.forEach( (row) => {
        const newOption = document.createElement('option');
        newOption.innerHTML = `${row.nombre}`;
        newOption.value = row.id;
        selectLineasDisponibles.appendChild(newOption);
    });
}

const writeLineasModal = ( data, select = null ) => {

    selectLineas.innerHTML = '';

    const optionDefault = document.createElement('option');
    optionDefault.innerHTML = `Seleccionar linea`;
    optionDefault.value = '';
    selectLineas.appendChild(optionDefault);

    data.forEach( (row) => {
        const newOption = document.createElement('option');
        newOption.innerHTML = `${row.nombre}`;
        newOption.value = row.id;
        (select === row.id) ? newOption.selected = true : newOption.selected = false;
        selectLineas.appendChild(newOption);
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
            <td>${row['descripcion']}</td>
            <td>${row['precio']}</td>
            <td>${row['costo']}</td>
            <td>${row['stock']}</td>
            <td>${(row['linea_id']) ?? 'Sin linea'}</td>
        `;
        // crear opcion para los botones
        const btnAction = document.createElement('td');
        btnAction.classList.add('btn-action');
        // crear Boton Update
        const btnUpdate = document.createElement('button');
        btnUpdate.classList.add(...['btn', 'btn-primary', 'update', 'mr-1']);  
        btnUpdate.innerHTML = `<i class="fas fa-pen"></i>`;
        btnUpdate.addEventListener('click', () => updateProducto(row['id']));
        // crear Boton Delete
        const btnDelete = document.createElement('button');
        btnDelete.classList.add(...['btn', 'btn-danger', 'delete']);
        btnDelete.innerHTML = `<i class="fas fa-trash"></i>`;
        btnDelete.addEventListener('click', () => deleteProducto(row['id']))
        // agregar update y delete a las acciones
        btnAction.appendChild(btnUpdate);
        btnAction.appendChild(btnDelete);
        // agregar las acciones al tr
        newRow.appendChild(btnAction);

        tableBody.appendChild(newRow);
    });
}

const getLineas = () => {
    axios.post('http://localhost/tienda/administrador/getLineas')
    .then( response => {
        if (response.data.success) {
            lineas = [...response.data.lineas];
        } else {
            lineas = [];
        }
        writeLineas( lineas );
        writeLineasModal( lineas );
    });
}

btnAgregar.addEventListener('click', () => {
    btnModificarProducto.classList.add('d-none');
    $('#titleModalAgregar').text('Agregar Producto');
    $('#productoId').prop('readonly', false);
    fillForm({});
});

btnAgregarProducto.addEventListener('click', () => {
    const {id,descripcion,precio, costo, stock, linea_id, invalid} = readForm();
    
    if (invalid) {
        activateAlert('info', 'Faltan datos', 'Falta llenar algunos datos para poder agregar el producto');
        return;
    }

    const data = new URLSearchParams();
    data.append('id', id);
    data.append('descripcion', descripcion);
    data.append('precio', precio);
    data.append('costo', costo);
    data.append('stock', stock);
    data.append('linea_id', linea_id);

    axios.post('http://localhost/tienda/administrador/agregarProducto', data)
    .then(( response )=> {

        const { success  } = response.data;

        if (success) {
            activateAlert('success', 'Producto Agregado', 'El producto se ha agregado correctamente');
            fillForm({});
            getProductos();

        } else {
            activateAlert('error', 'Algo falló', 'Ha ocurrido un error, podría ser que la clave ya esté siendo usada por otro producto')
        }
    });

});

btnModificarProducto.addEventListener('click', () => {
    
    
    const {id,descripcion,precio, costo, stock, linea_id, invalid} = readForm();
    
    if (invalid) {
        activateAlert('info', 'Faltan datos', 'Falta llenar algunos datos para poder modificar el producto');
        return;
    }

    const data = new URLSearchParams();
    data.append('id', id);
    data.append('descripcion', descripcion);
    data.append('precio', precio);
    data.append('costo', costo);
    data.append('stock', stock);
    data.append('linea_id', linea_id);

    axios.post('http://localhost/tienda/administrador/modificarProducto', data)
    .then(( response )=> {

        const { success  } = response.data;

        if (success) {
            activateAlert('success', 'Producto modificado', 'El producto se ha modificado correctamente');
            getProductos();
        } else {
            activateAlert('error', 'Algo falló', 'Ha ocurrido un error, verifique sus datos')
        }
    });

});


busquedaProducto.addEventListener('keyup', (e) => {
    const termino = `${e.target.value}`.toLowerCase().trim();

    const productosFiltrados = productos.filter( (producto) => {
        return ( `${producto.id}`.toLowerCase().indexOf(termino) > -1 ) || ( `${producto.descripcion}`.toLowerCase().indexOf(termino) > -1 );
    });
    writeTable(productosFiltrados);
});

selectLineasDisponibles.addEventListener('change', (e) => {
    const lineaSeleccionada = e.target.value;
    if(lineaSeleccionada === ''){
        writeTable(productos);
    } else {
        const productosDeLinea = productos.filter( (producto) => producto.linea_id === lineaSeleccionada );
        writeTable(productosDeLinea);
    }

});

btnRestaurar.addEventListener( 'click', () => {
    writeLineas(lineas);
    writeTable(productos);
    busquedaProducto.value = '';
});

const updateProducto = (id) => {
    btnAgregarProducto.classList.add('d-none');
    $('#productoId').prop('readonly', true);
    fillForm(productos.find( p => p.id === id));
    $('#modalNuevoProducto').modal('show');
}
const deleteProducto = (id) => {
    console.log('Eliminar:', id);
    Swal.fire({
        title: 'Eliminar Producto',
        text: "El producto será eliminado permanentemente",
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
            
            axios.post('http://localhost/tienda/administrador/eliminarProducto', data)
            .then((response) =>{
                if(response.data.success) {
                    activateAlert('success','Producto eliminado', 'El producto ha sido eliminado con éxito');
                } else {
                    activateAlert('error','Acción no realizada', 'Algo ha salido mal, intentalo más tarde');
                }
                getProductos();
            });
        }
    });
}

const getProductos = () => {
    axios.post('http://localhost/tienda/administrador/getProductos')
    .then( response => {
        productos = [...response.data.productos];
        writeTable(productos);
    });
}


const formatInputs = () => {

    const precio = new Cleave('#precio', {
        numeral: true,
        delimiter: ''
    });
    const stock = new Cleave('#stock', {
        numeral: true,
        delimiter: ''

    });
    const costo = new Cleave('#costo', {
        numeral: true,
        delimiter: ''
    });

}

const fillForm = ( { id = '', descripcion = '', precio = '', costo = '', stock = '', linea_id = '' } ) => {

    inputProductoId.value = id;
    inputDescripcion.value = descripcion;
    inputPrecio.value = precio;
    inputCosto.value = costo;
    inputStock.value = stock;

    writeLineasModal(lineas, linea_id);

}

const readForm = () => {

    const formValues = {

        id:inputProductoId.value,
        descripcion: inputDescripcion.value,
        precio: inputPrecio.value,
        costo: inputCosto.value,
        stock: inputStock.value,
        linea_id: selectLineas.value

    };



    formValues.invalid = (
        formValues.id === '' ||
        formValues.descripcion === '' || 
        formValues.precio === '' ||
        formValues.costo === '' ||
        formValues.stock === ''
    );

    return formValues;

}

const activateAlert = (icon, title, text) => {
    Swal.fire(
        title,
        text,
        icon
    );
}

(function(){
    getProductos();
    getLineas();
    formatInputs();
}());


$('#modalNuevoProducto').on('hidden.bs.modal', function (e) {
    btnModificarProducto.classList.remove('d-none');
    btnAgregarProducto.classList.remove('d-none');
    document.getElementById('productoIdAlertExiste').classList.add('d-none');
});