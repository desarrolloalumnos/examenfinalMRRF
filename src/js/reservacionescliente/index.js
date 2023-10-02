import Swal from "sweetalert2";
import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.getElementById('formularioClientes');
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
const divTabla = document.getElementById('tablaClientes'); 

btnModificar.disabled = true;
btnModificar.parentElement.style.display = 'none';
btnBuscar.disabled = true;
btnBuscar.parentElement.style.display = 'none';
btnCancelar.disabled = true;
btnCancelar.parentElement.style.display = 'none';

let contador = 1;
const datatable = new Datatable('#tablaClientes', {
    language: lenguaje,
    data: null,
    columns: [
        {
            title: 'NO',
            render: () => contador++
        },
        {
            title: 'CLIENTE',
            data: 'reserva_cliente_id'
        },
        {
            title: 'HABITACION',
            data: 'reserva_habitacion_id'
        },
        {
            title: 'ENTRADA',
            data: 'reserva_fecha_inicio'
        },
        {
            title: 'SALIDA',
            data: 'reserva_fecha_fin'
        },
        // {
        //     title: 'MODIFICAR',
        //     data: 'reserva_id',
        //     searchable: false,
        //     orderable: false,
        //     render: (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-cliente='${row["reserva_cliente_id"]}' data-habitacion='${row["reserva_habitacion_id"]}' data-entrada='${row["reserva_fecha_inicio"]}' data-salida='${row["reserva_fecha_fin"]}'>Modificar</button>`
        // },
        // {
        //     title: 'ELIMINAR',
        //     data: 'reserva_id',
        //     searchable: false,
        //     orderable: false,
        //     render: (data) => `<button class="btn btn-danger" data-id='${data}'>Eliminar</button>`
        // },
    ]
});

const buscar = async () => {
    const url = `/examenfinalMRRF/API/reservaciones/buscar`;
    const config = {
        method: 'GET'
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        datatable.clear().draw();
        if (data) {
            contador = 1;
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            });
        }
    } catch (error) {
        console.log(error);
    }
};

const guardar = async (evento) => {
    evento.preventDefault();
    const reserva_cliente_id = document.getElementById('reserva_cliente_id').value;
    const reserva_habitacion_id = document.getElementById('reserva_habitacion_id').value;
    const reserva_fecha_inicio = document.getElementById('reserva_fecha_inicio').value;
    const reserva_fecha_fin = document.getElementById('reserva_fecha_fin').value;

    if (!reserva_cliente_id || !reserva_habitacion_id || !reserva_fecha_inicio || !reserva_fecha_fin) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los campos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/examenfinalMRRF/API/reservaciones/guardar';
    const config = {
        method: 'POST',
        body
    };

    try {
        evento.preventDefault();
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data)
        // return
        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }
        Toast.fire({
            icon,
            text: mensaje
        });
    } catch (error) {
        console.log(error);
    }
};

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;

    if (await confirmacion('warning', '¿Desea eliminar este registro?')) {
        const body = new FormData();
        body.append('reserva_id', id); 
        const url = '/examenfinalMRRF/API/reservaciones/eliminar'; 
        const config = {
            method: 'POST',
            body
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();

            const { codigo, mensaje, detalle } = data;
            let icon = 'info';
            switch (codigo) {
                case 1:
                    icon = 'success';
                    location.reload();
                    break;

                case 0:
                    icon = 'error';
                    console.log(detalle);
                    break;

                default:
                    break;
            }
            Toast.fire({
                icon,
                text: mensaje
            });
        } catch (error) {
            console.log(error);
        }
    }
};


const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    divTabla.style.display = ''
    formulario.reset();

};

const traeDatos = async (e) => {
    const button = e.target;
    const cliente = button.dataset.cliente;
    const id = button.dataset.id;
    const habitacion = button.dataset.habitacion;
    const entrada = button.dataset.entrada;
    const salida = button.dataset.salida;

    const dataset = {
       
        cliente,
        habitacion,
        entrada,
        id,
        salida
    };
    // console.log(dataset)
    // return
    colocarDatos(dataset);
    const body = new FormData(formulario);
    body.append('reserva_id', id);
    body.append('reserva_cliente_id', cliente);
    body.append('reserva_habitacion_id', habitacion);
    body.append('reserva_fecha_inicio', entrada);
    body.append('reserva_fecha_fin', salida);
};


const colocarDatos = (dataset) => {
    const clienteSelect = formulario.querySelector('#reserva_cliente_id');
    const habitacionSelect = formulario.querySelector('#reserva_habitacion_id');

  
    clienteSelect.value = dataset.cliente;

    habitacionSelect.value = dataset.habitacion;

    formulario.reserva_id.value = dataset.id
    formulario.reserva_fecha_inicio.value = dataset.entrada;
    formulario.reserva_fecha_fin.value = dataset.salida;
  

    btnGuardar.disabled = true;
    btnGuardar.parentElement.style.display = 'none';
    btnBuscar.disabled = true;
    btnBuscar.parentElement.style.display = 'none';
    btnModificar.disabled = false;
    btnModificar.parentElement.style.display = '';
    btnCancelar.disabled = false;
    btnCancelar.parentElement.style.display = '';
    divTabla.style.display = 'none';
};





const modificar = async (evento) => {
   
    evento.preventDefault();
    const reserva_cliente_id = document.getElementById('reserva_cliente_id').value;
    const reserva_habitacion_id = document.getElementById('reserva_habitacion_id').value;
    const reserva_fecha_inicio = document.getElementById('reserva_fecha_inicio').value;
    const reserva_fecha_fin = document.getElementById('reserva_fecha_fin').value;

    if (!reserva_cliente_id || !reserva_habitacion_id || !reserva_fecha_inicio || !reserva_fecha_fin) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los campos'
        });
        return;
    }

    const body = new FormData(formulario);
    const url = '/examenfinalMRRF/API/reservaciones/modificar';
    const config = {
        method: 'POST',
        body
    };

    try {
        evento.preventDefault();
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        // console.log(data)
        // return

        const { codigo, mensaje, detalle } = data;
        let icon = 'info';
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                break;

            case 0:
                icon = 'error';
                console.log(detalle);
                break;

            default:
                break;
        }
        Toast.fire({
            icon,
            text: mensaje
        });
    } catch (error) {
        console.log(error);
    }
}

buscar();

btnGuardar.addEventListener('click', guardar);
btnBuscar.addEventListener('click', buscar);
datatable.on('click', '.btn-warning', traeDatos);
datatable.on('click', '.btn-danger', eliminar);
btnModificar.addEventListener('click', modificar)
btnCancelar.addEventListener('click', cancelarAccion)
