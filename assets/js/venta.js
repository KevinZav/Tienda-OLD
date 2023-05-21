let productosDisponibles = [];
let productosVendidos = [];
let totalVenta = 0;

const tablaVenta = document.getElementById('tableBody');
const tablaProductos = document.querySelector('#tableProductos');

const inputAgregar = document.getElementById('inputProducto');
const inputCantidad = document.getElementById('inputCantidad');
const inputModalBuscar = document.getElementById('inputModalBuscar');

const btnPagarVenta = document.getElementById('btnPagarVenta');

btnPagarVenta.addEventListener('click', async (e) => {

    if (totalVenta === 0) {
        activateAlert('info', 'Sin ventas', 'Debes realizar una venta antes de pagar');
        return;
    }
    const pagarNotaSwal = await Swal.fire({
        title: 'Pagar nota',
        text: "¿Realmente deseas pagar la nota?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Pagar',
        cancelButtonText: 'Cancelar'
    });

    
    if (!pagarNotaSwal.isConfirmed) {
        return;
    }

    const venta = productosVendidos.map( p => {
        return {
            cantidad: p['cantidadVendida'],
            id: p['id'],
            precio: p['precio'],
            subtotal: p['precio'] * p['cantidadVendida']
        }
    });
    const data = new URLSearchParams();
    data.append('venta', JSON.stringify(venta));
    data.append('totalVenta', totalVenta);
    
    axios.post('http://localhost/tienda/cajero/pagarNota', data)
    .then( response => {
        const {success, venta_id} = response.data;

        if (success) {
            imprimirNota( venta_id );
            reiniciarVenta();
        } else {
            activateAlert('error', 'Algo ha fallado', 'Verifique que su venta se haya realizado correctamente en consultas');
        }

    });

});

const reiniciarVenta = () => {

    productosVendidos.forEach( producto  => {
        tablaVenta.removeChild(producto['nodeHTML']);
    });

    productosVendidos = [];

    totalVenta = 0;
    $('#totalVenta').text(`Total: $${totalVenta}.00`);

    getProductos();
}


const imprimirNota = ( notaId ) => {
    Swal.fire({
        title: 'Imprimir nota',
        text: `¿Imprimir nota con ID: ${notaId}?`,
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Imprimir',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.open(
              `http://localhost/tienda/cajero/imprimirVenta&venta=${notaId}`,"",
              "width=800,height=500")
        }
    })
}

inputModalBuscar.addEventListener('keyup', (e) => {
    const termino = `${e.target.value}`.toLowerCase().trim();
    console.log(termino);
    const productosFiltrados = productosDisponibles.filter( (producto) => {
        return ( `${producto.id}`.toLowerCase().indexOf(termino) > -1 ) || ( `${producto.descripcion}`.toLowerCase().indexOf(termino) > -1 );
    });
    writeTableProductos(productosFiltrados);
});

inputAgregar.addEventListener('keyup', (e) => {
    const productoId = `${e.target.value}`;
    if (e.key === 'Enter') {
        const producto = productosDisponibles.find( p => p.id === productoId );
        let cantidad = Number(inputCantidad.value);
        

        if( producto !== undefined ) {

            const estaVendido = productosVendidos.find( p => p.id === productoId );

            if(estaVendido === undefined) {
                const newRow = writeRowVendido( cantidad, producto );
                tablaVenta.appendChild(newRow);

                producto['nodeHTML'] = newRow;
                producto['cantidadVendida'] = cantidad;
                productosVendidos.push(producto);

            } else {

                producto['cantidadVendida'] += cantidad;
                cantidad = producto['cantidadVendida'];

                const newRow = writeRowVendido(cantidad, producto);

                const oldRow = producto['nodeHTML'];

                producto['nodeHTML'] = newRow;
                tablaVenta.replaceChild(newRow, oldRow);

            }

            totalVenta = 0;
            productosVendidos.forEach( p => totalVenta += (p['cantidadVendida'] * p['precio']) );
            $('#totalVenta').text(`Total: $${totalVenta}.00`);
            inputAgregar.value = '';
            inputCantidad.value = '1';

        } else {
            activateAlert('error', 'Producto no encontrado', 'La clave que ingresó no pertenece a ningún producto')
        }

    }
})

const writeTableProductos = (data) => {

    tablaProductos.innerHTML = ``;

    if (data.length === 0) return;

    data.forEach((row) => {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <th scope="row">${row['id']}</th>
            <td>${row['descripcion']}</td>
            <td>${row['stock']}</td>
        `;
        const tdAction = document.createElement('td');
        const btnSeleccionar = document.createElement('button');
        btnSeleccionar.innerHTML = 'Seleccionar';
        btnSeleccionar.classList.add('btn','btn-primary');

        btnSeleccionar.addEventListener('click', (e) => {
            inputAgregar.value = row['id'];
            $('#modalTablaProductos').modal('hide');
            $('#inputAgregar').focus();
        });

        tdAction.appendChild(btnSeleccionar);

        newRow.appendChild(tdAction);
        tablaProductos.appendChild(newRow);
    });

}

const writeRowVendido = ( cantidad, producto ) => {

    const newRow = document.createElement('tr');

    newRow.innerHTML = `
        <td style="width:10%;">${cantidad}</td>
        <td style="width:10%;">${producto['id']}</td>
        <td style="width:15%;">${producto['descripcion']}</td>
        <td style="width:12%;">${producto['precio']/1}</td>
        <td style="width:12%;">${producto['precio'] * cantidad}</td>
    `;
    newRow.classList.add('rowProductoVendido');

    newTd = document.createElement('td');

    const btnEliminar = document.createElement('button');
    btnEliminar.classList.add('btn','btn-danger')
    btnEliminar.innerHTML = `<i class="fas fa-trash mr-1"></i>`;

    btnEliminar.addEventListener('click', (e) => {
        tablaVenta.removeChild(newRow);

        productosVendidos = productosVendidos.filter( p => p.id !== producto.id);
        
        totalVenta = 0;
        productosVendidos.forEach( p => totalVenta += (p['cantidadVendida'] * p['precio']) );
        $('#totalVenta').text(`Total: $${totalVenta}.00`);
        

    });

    newTd.appendChild(btnEliminar);
    newTd.style.width = '11%';
    newRow.appendChild(newTd);
    
    return newRow;

}

const getProductos = () => {
    axios.post('http://localhost/tienda/administrador/getProductos')
    .then( response => {
        productosDisponibles = [...response.data.productos];
        writeTableProductos(productosDisponibles);
    });
}

const activateAlert = (icon, title, text) => {
    Swal.fire(
        title,
        text,
        icon
    );
}

(function(){

    const inputCantidad = new Cleave('#inputCantidad', {
        numeral: true,
        delimiter: ''
    });

    getProductos();
}());

$('#modalTablaProductos').on('hidden.bs.modal', function (e) {

    writeTableProductos(productosDisponibles);
    inputModalBuscar.value = '';

});