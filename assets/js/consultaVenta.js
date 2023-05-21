const inputFecha = document.getElementById('fechaConsulta')
const tablaVentas = document.getElementById('tableBody');
let ventasDeDia = [];
const baseURL = "http://localhost/tienda/cajero/getVentas";

const formatDate = () => {

    const now = new Date();
    const anio = now.getFullYear();
    const mes = now.getMonth() + 1;
    const dia = now.getDate();

    const strDate = `${anio}-${(mes > 10 ? mes: '0' + mes ) }-${(dia > 10 ? dia: '0' + dia ) }`;
    return strDate;
}

const writeTable = (data) => {

    tablaVentas.innerHTML = '';

    data.forEach( row => {

        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <th scope="row">${row['id']}</th>
            <td>${row['usuarioID']}</td>
            <td>${row['fecha']}</td>
            <td>${row['total']}</td>
        `;

        const newTd = document.createElement('td');

        const bntAction = document.createElement('button');
        bntAction.innerHTML = '<i class="fas fa-print"></i>';
        bntAction.classList.add('btn','btn-primary');

        bntAction.addEventListener('click', () => {
            window.open(
                `http://localhost/tienda/cajero/imprimirVenta&venta=${row['id']}`,"",
                "width=800,height=500")
        });

        newTd.appendChild(bntAction);

        newRow.appendChild(newTd);

        tablaVentas.appendChild(newRow);

    });
    writeTableTotales(data);

}

inputFecha.addEventListener('change', (e) => {
    getVentas();
});

const getVentas = () => {

    const date = inputFecha.value;

    axios.get(`${baseURL}&date=${date}`)
    .then( response => {

        const dataVentas = response.data.ventas;

        ventasDeDia = dataVentas;
        writeTable(dataVentas);

    });    

}

// codigo nuevo

const writeTableTotales = (data) => {
    const tablaTotales = document.getElementById('tableTotales');
    tablaTotales.innerHTML = ``;

    const nombres = [];
    data.forEach( venta =>  {
        if (!nombres.includes(venta['usuarioID'])) nombres.push(venta['usuarioID']); 
    });

    nombres.forEach( nombre => {
        let totalVentaNombre = 0;
        const cuentas = data.filter( element => element['usuarioID'] === nombre );
        cuentas.forEach(cuenta => totalVentaNombre += Number(cuenta['total']));
        console.log(totalVentaNombre);
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>${nombre}</td>
            <td>${totalVentaNombre}</td>
        `;
        tablaTotales.appendChild(newRow);

    });

}

// fin codigo nuevo


inputFecha.value = formatDate();
getVentas();