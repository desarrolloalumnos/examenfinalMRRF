import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import Datatable from "datatables.net-bs5";
import { lenguaje  } from "../lenguaje";
import { validarFormulario, Toast, confirmacion } from "../funciones";

const formulario = document.querySelector('form')
const btnBuscar = document.getElementById('btnBuscar');
const btnModificar = document.getElementById('btnModificar');
const btnGuardar = document.getElementById('btnGuardar');
const btnCancelar = document.getElementById('btnCancelar');
//const divTabla = document.getElementById('divTabla');

btnModificar.disabled = true
btnModificar.parentElement.style.display = 'none'
btnCancelar.disabled = true
btnCancelar.parentElement.style.display = 'none'


let contador = 1;
const datatable = new Datatable('#tablaHabitaciones', {
    language : lenguaje,
    data : null,
    columns: [
        {
            title : 'NO',
            render : () => contador ++
            
        },
        {
            title : 'NUMERO',
            data: 'habitacion_numero'
        },
        {
            title : 'TIPO',
            data: 'habitacion_tipo'
        },
        {
            title : 'DESCRIPCION',
            data: 'habitacion_descripcion'
        },
        {
            title: 'DISPONIBILIDAD',
            data: 'habitacion_disponibilidad',
            render: function (data) {
                const estados = {
                    1: "Disponible",
                    2: "NO disponible",
                    3: "Reservado",
                };
                return estados[data] || "Privado";
            }
        },
        {
            title : 'TARIFA',
            data: 'habitacion_tarifa',
            
            render : (data) => 'Q. ' + data
        },
        // {
        //     title : 'MODIFICAR',
        //     data: 'habitacion_id',
        //     searchable : false,
        //     orderable : false,
        //     render : (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-numero='${row["habitacion_numero"]}' data-tipo='${row["habitacion_tipo"]}' data-descripcion='${row["habitacion_descripcion"]}' data-tarifa='${row["habitacion_tarifa"]}' data-disponibilidad='${row["habitacion_disponibilidad"]}'>Modificar</button>`
        // },
        // {
        //     title : 'ELIMINAR',
        //     data: 'habitacion_id',
        //     searchable : false,
        //     orderable : false,
        //     render : (data, type, row, meta) => `<button class="btn btn-danger" data-id='${data}' >Eliminar</button>`
        // },
        
    ]
})

const buscar = async () => {

    let habitacion_numero = formulario.habitacion_numero.value;
    let habitacion_tipo = formulario.habitacion_tipo.value;
    const url = `/examenfinalMRRF/API/habitacionesadmin/buscar?habitacion_numero=${habitacion_numero}&habitacion_tipo=${habitacion_tipo}`;
    // const url = `/examenfinalMRRF/API/habitaciones/buscar`;
    
    const config = {
        method : 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        console.log(data);
        datatable.clear().draw()
        if(data){
            contador = 1;
            datatable.rows.add(data).draw();
            
        }else{
            Toast.fire({
                title : 'No se encontraron registros',
                icon : 'info'
            })
        }
       
    } catch (error) {
        console.log(error);
    }
}
const guardar = async (evento) => {
    evento.preventDefault();
    if (!validarFormulario(formulario, ['habitacion_id'])) {
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return;
    }

    const body = new FormData(formulario);
    body.delete('habitacion_id');
    const url = '/examenfinalMRRF/API/habitacionesadmin/guardar';
    const headers = new Headers();
    headers.append("X-Requested-With", "fetch");
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
                formulario.reset();
                icon = 'success', 
                        'mensaje';
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




const traeDatos = (e) => {
    const button = e.target;
    const id = button.dataset.id
    const numero = button.dataset.numero
    const tipo = button.dataset.tipo
    const descripcion = button.dataset.descripcion
    const tarifa = button.dataset.tarifa
    const disponibilidad = button.dataset.disponibilidad

    const dataset = {
        id, 
        numero, 
        tipo,
        descripcion,
        tarifa,
        disponibilidad
};

colocarDatos(dataset);

const body = new FormData(formulario);
body.append('habitacion_id', id );
body.append('habitacion_numero', numero);
body.append('habitacion_tipo', tipo);
body.append('habitacion_descripcion', descripcion);
body.append('habitacion_tarifa', tarifa);
body.append('habitacion_disponibilidad', disponibilidad);
};

const colocarDatos = (dataset) => {
    formulario.habitacion_numero.value = dataset.numero;
    formulario.habitacion_tipo.value = dataset.tipo;
    formulario.habitacion_descripcion.value = dataset.descripcion;
    formulario.habitacion_tarifa.value = dataset.tarifa;
    formulario.habitacion_disponibilidad.value = dataset.disponibilidad;
    formulario.habitacion_id.value = dataset.id;
    
    btnGuardar.disabled = true
    btnGuardar.parentElement.style.display = 'none'
    btnBuscar.disabled = true
    btnBuscar.parentElement.style.display = 'none'
    btnModificar.disabled = false
    btnModificar.parentElement.style.display = ''
    btnCancelar.disabled = false
    btnCancelar.parentElement.style.display = ''
    //divTabla.style.display = 'none'
    
    
}

const modificar = async () => {
    if(!validarFormulario(formulario)){
        Toast.fire({
            icon: 'info',
            text: 'Debe llenar todos los datos'
        });
        return 
    }

    const body = new FormData(formulario)
    const url = '/examenfinalMRRF/API/habitacionesadmin/modificar';
    const config = {
        method : 'POST',
        body
    }

    try {
        // fetch(url, config).then( (respuesta) => respuesta.json() ).then(d => data = d)
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();
        
        const {codigo, mensaje,detalle} = data;
        let icon = 'success'
        switch (codigo) {
            case 1:
                formulario.reset();
                icon = 'success';
                buscar();
                cancelarAccion();
                break;
        
            case 0:
                icon = 'error'
                console.log(detalle)
                break;
        
            default:
                break;
        }

        Toast.fire({
            icon,
            text: mensaje
        })

    } catch (error) {
        console.log(error);
    }
}

const eliminar = async (e) => {
    const button = e.target;
    const id = button.dataset.id;
    // console.log(id);
    if (await confirmacion('warning', 'Desea elminar este registro?')) {
        const body = new FormData()
        body.append('habitacion_id', id)
        const url = '/examenfinalMRRF/API/habitacionesadmin/eliminar';
        const headers = new Headers();
        headers.append("X-Requested-With","fetch");
        const config = {
            method: 'POST',
            body
        }
        try {
            const respuesta = await fetch(url, config)
            const data = await respuesta.json();
            // console.log(data);
            // return;


            const { codigo, mensaje, detalle } = data;
            let icon = 'info'
            switch (codigo) {
                case 1:
                    // formulario.reset();
                    icon = 'success'
                    buscar();
                    // cancelarAccion();
                    break;

                case 0:
                    icon = 'error'
                    console.log(detalle)
                    break;

                default:
                    break;
            }

            Toast.fire({
                icon,
                text: mensaje
            })




        } catch (error) {
            console.log(error);
        }
    }

}





const cancelarAccion = () => {
    btnGuardar.disabled = false
    btnGuardar.parentElement.style.display = ''
    btnBuscar.disabled = false
    btnBuscar.parentElement.style.display = ''
    btnModificar.disabled = true
    btnModificar.parentElement.style.display = 'none'
    btnCancelar.disabled = true
    btnCancelar.parentElement.style.display = 'none'
    //divTabla.style.display = ''
}


buscar();

formulario.addEventListener('submit', guardar)
btnBuscar.addEventListener('click', buscar)
btnCancelar.addEventListener('click', cancelarAccion)
btnModificar.addEventListener('click', modificar)
//datatable.on('click','.btn-warning', colocarDatos )
datatable.on('click','.btn-warning', traeDatos )
datatable.on('click','.btn-danger', eliminar )
