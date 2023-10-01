import Datatable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje"
import { validarFormulario, Toast } from "../funciones"
import Swal from "sweetalert2";

const formulario = document.querySelector('form');
const btnModificar = document.getElementById('btnModificar');
const btnCancelar = document.getElementById('btnCancelar');
// const btnModificarPassword = document.getElementById('btnModificarPassword');
const tablaUsuariosContainer = document.getElementById('tablaUsuariosContainer');
const show_password = document.getElementById('show_password');


//!Ocultar el formulario al inicio
formulario.style.display = 'none';
tablaUsuariosContainer.style.display = 'block'; 


let contenedor = 1;

const datatable = new Datatable('#tablaUsuarios', {
    language : lenguaje,
    data : null,
    columns : [
        {
            title : 'NO',
            render: () => contenedor++ 
            
        },
        {
            title : 'USUARIO',
            data: 'usu_nombre'
        },
        {
            title : 'DPI',
            data: 'usu_dpi',
        },
        {
            title : 'EMAIL',
            data: 'usu_email',
        },
        {
            title : 'TELEFONO',
            data: 'usu_telefono',
        },
        {
            title : 'PASSWORD',
            data: 'usu_password',
            visible: false,
        },
        {
            title: 'ROL',
            data: 'rol_nombre',
        },
        {
            title : 'MODIFICAR DATOS',
            data: 'usu_id',
            searchable: false,
            orderable: false,
            render : (data, type, row, meta) => `<button class="btn btn-warning" data-id='${data}' data-nombre='${row["usu_nombre"]}' data-dpi='${row["usu_dpi"]}' data-email='${row["usu_email"]}' data-telefono='${row["usu_telefono"]}' data-password='${row["usu_password"]}' data-rol='${row["rol_nombre"]}'>Modificar Datos del Usuario</button>`
        },
        {
            title : 'ELIMINAR',
            data: 'usu_id',
            searchable: false,
            orderable: false,
            render : (data, type, row, meta) => `<button class="btn btn-danger" data-id='${data}'>Eliminar Usuario</button>`
        }
    ]
})



//!Aca esta la funcion para buscar
const buscar = async () => {
    contenedor = 1;

    const url = `/examenfinalMRRF/API/lista/buscar`;
    const config = {
        method: 'GET'
    }

    try {
        const respuesta = await fetch(url, config)
        const data = await respuesta.json();

        console.log(data);
        datatable.clear().draw()
        if (data) {
            datatable.rows.add(data).draw();
        } else {
            Toast.fire({
                title: 'No se encontraron registros',
                icon: 'info'
            })
        }

    } catch (error) {
        console.log(error);
    }
}


//!Aca esta la funcion de Desacticar un Usuario
const desactivar = async e => {
    const result = await Swal.fire({
        icon: 'question',
        title: 'Desactivar Usuario',
        text: '¿Desea Desactivar a este Usuario?',
        showCancelButton: true,
        confirmButtonText: 'Desactivar',
        cancelButtonText: 'Cancelar'
    });

    const button = e.target;
    const id = button.dataset.id
    // alert(id);
    
    if (result.isConfirmed) {
        const body = new FormData();
        body.append('usu_id', id);

        const url = `/examenfinalMRRF/API/lista/desactivar`;
        const config = {
            method: 'POST',
            body,
        };

        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);
            const { codigo, mensaje, detalle } = data;

            let icon='info'
            switch (codigo) {
                case 1:
                    buscar();
                    Swal.fire({
                        icon: 'success',
                        title: 'Desactivado Exitosamente',
                        text: mensaje,
                        confirmButtonText: 'OK'
                    });
                    break;
                case 0:
                    console.log(detalle);
                    break;
                default:
                    break;
            }

        } catch (error) {
            console.log(error);
        }
    }
};



// //!Funcion Eliminar
const eliminar = async e => {
    const result = await Swal.fire({
        icon: 'question',
        title: 'Eliminar Usuario',
        text: '¿Desea eliminar este Usuario?',
        showCancelButton: true,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    });
    
    const button = e.target;
    const id = button.dataset.id
    // alert(id);
    
    if (result.isConfirmed) {
        const body = new FormData();
        body.append('usu_id', id);
        
        const url = `/examenfinalMRRF/API/lista/eliminar`;
        const config = {
            method: 'POST',
            body,
        };
        
        try {
            const respuesta = await fetch(url, config);
            const data = await respuesta.json();
            console.log(data);
            const { codigo, mensaje, detalle } = data;

            let icon='info'
            switch (codigo) {
                case 1:
                    buscar();
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado Exitosamente',
                        text: mensaje,
                        confirmButtonText: 'OK'
                    });
                    break;
                    case 0:
                        console.log(detalle);
                        break;
                default:
                    break;
            }

        } catch (error) {
            console.log(error);
        }
    }
};

const mostrarFormulario = () => {
    tablaUsuariosContainer.style.display = 'none';
    formulario.style.display = 'block';
};

const ocultarFormulario = () => {
    formulario.reset();
    formulario.style.display = 'none';
    tablaUsuariosContainer.style.display = 'block';
};


//!----------------------------------------------------------------------------------------------------
//!----------------------------------------------------------------------------------------------------
//!----------------------------------------------------------------------------------------------------
//!Para colocar los datos sobre el formulario
const traeDatos = (button) => {
    
    const id = button.dataset.id;
    const nombre = button.dataset.nombre;
    const dpi = button.dataset.dpi;
    const email = button.dataset.email;
    const telefono = button.dataset.telefono;
    const password = button.dataset.password;

    // Llenar el formulario con los datos obtenidos
    formulario.usu_id.value = id;
    formulario.usu_nombre.value = nombre;
    formulario.usu_dpi.value = dpi;
    formulario.usu_email.value = email;
    formulario.usu_telefono.value = telefono;
    formulario.usu_password.value = password;
};


//!Aca esta la funcino de cancelar la accion de modificar un registro.
const cancelarAccion = () => {
    formulario.reset();
    document.getElementById('tablaUsuariosContainer').style.display = 'block'; // Corrección aquí
};

//!Aca esta la funcion de modificar un registro
const modificar = async () => {
    const usu_id = formulario.usu_id.value;
    const body = new FormData(formulario);
    body.append('usu_id', usu_id);

    const url = `/examenfinalMRRF/API/lista/modificar`;
    const config = {
        method: 'POST',
        body,
    };

    try {
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();
        console.log(data);
        const { codigo, mensaje, detalle } = data;

        switch (codigo) {
            case 1:
                formulario.reset();
                cancelarAccion(); // Corrección aquí
                buscar();

                
                ocultarFormulario(); // Ocultar el formulario
                
                Toast.fire({
                    icon: 'success',
                    title: 'Actualizado',
                    text: mensaje,
                    confirmButtonText: 'OK'
                });
                break;
            case 0:
                Swal.fire({
                    icon: 'info',
                    title: 'Campo Vacio',
                    text: mensaje,
                    confirmButtonText: 'OK'
                });
                break;
            default:
                break;
        }

    } catch (error) {
        console.log(error);
    }
};


//!Funcion para mostrar la contraseña al usuario
function ver_password() {
    const passwordInput = document.getElementById("usu_password");
    const showPasswordCheckbox = document.getElementById("show_password");

    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}


const btnModificarPassword = document.getElementById('btnModificarPassword');
const btnRegresar = document.getElementById('btnRegresar');
const contrasenaContainer = document.getElementById('contrasena-container');
const elementosAOcultar = document.querySelectorAll('.elementos-a-ocultar');

const usu_password = document.getElementById('usu_password');

btnModificarPassword.addEventListener("click", function () {
    // Ocultar elementos a ocultar, excepto el botón "Modificar"
    elementosAOcultar.forEach(function (elemento) {
        if (elemento !== btnModificar) {
            elemento.style.display = "none";
        }
    });
    btnCancelar.style.display = "none";
    btnModificarPassword.style.display = "none";
    contrasenaContainer.style.display = "block";
    btnRegresar.style.display = "block";
    btnRegresar.style.marginLeft = "5px"; 

    usu_password.value = "";
});

btnRegresar.addEventListener("click", function () {
    elementosAOcultar.forEach(function (elemento) {
        elemento.style.display = "block";
    });
    btnCancelar.style.display = "block";
    btnModificarPassword.style.display = "block";
    contrasenaContainer.style.display = "none";
    btnRegresar.style.display = "none";
});


datatable.on('click', '.btn-warning', (event) => {
    const button = event.currentTarget;
    mostrarFormulario();
    traeDatos(button);
});
btnCancelar.addEventListener('click', ocultarFormulario);
btnModificar.addEventListener('click', modificar);
btnCancelar.addEventListener('click', cancelarAccion);
datatable.on('click','.btn-warning', traeDatos)
datatable.on('click','.btn-info', desactivar)
datatable.on('click','.btn-danger', eliminar)
show_password.addEventListener('click', ver_password);
buscar();





