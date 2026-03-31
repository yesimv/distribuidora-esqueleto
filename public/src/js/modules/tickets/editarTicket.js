import { request } from '../../core/http.js';
import { mostrarMensaje, abrirModalConfirm, initModal } from "../../core/modal.js";
let idTicket = null;
let empleadosGlobal = [];
let id = null;
document.addEventListener("DOMContentLoaded", async function () {
    //decodifica el link mandado para obtenero el id
    const params = new URLSearchParams(window.location.search);
    const encoded = params.get('data');
    if (encoded) {
        const data = atob(encoded);
        id = data.replace('tk_', '').replace('_secure', '');
    }


    



    const tablaFechasTicket = document.querySelector('#formulario-ticket-editar');
    await valoresFormulario(); //   PRIMERO llenar selects

    if (id) {
        await cargarTicket(id); //   DESPUÉS llenar datos
    }

    //filtro para empleados al eleccionar departamento
    document.getElementById("departamentoSelect")
        .addEventListener("change", function () {

            const idDepartamento = this.value;

            filtrarEmpleados(idDepartamento);

        });
    //filtro para departamento al seleccionar empleado
    document.getElementById("empleadoSelect")
        .addEventListener("change", function () {

            const idEmpleado = this.value;

            if (!idEmpleado) return;

            autoSeleccionarDepartamento(idEmpleado);
        });
    //para editar un ticket 
    const btnEditTicket = document.getElementById("btn-formulario-ticket-editar").addEventListener('click', () => {
        abrirModalConfirm({
            titulo: "Confirmación",
            mensaje: `¿Seguro que deseas guardar los cambios?`,

            onConfirm: async () => {
                const selects = document.querySelectorAll('select');
                const titulo = document.querySelector('#tituloAreaEdit');
                let valido = true;

                selects.forEach(select => {
                    //   excluir selects por id
                    if (select.id === 'empleadoSelect' || select.id === 'resolucionSelect') {

                        return;
                    }
                    if (select.value === "" || select.value === null) {

                        valido = false;
                        select.classList.add('border-red-500'); // opcional visual
                    } else {

                        select.classList.remove('border-red-500');
                    }
                });
                if (titulo.value === "" || titulo.value === null) {

                    valido = false;
                }

                if (!valido) {
                    mostrarMensaje({
                        titulo: "Atención",
                        mensaje: "El titulo y los campos de opcion multiple son obligatorios",
                        tipo: "error"
                    });

                    return;
                }

                //   Si pasa validación, ahora sí envías
                editarTicket();
            }
        });


    });
    eventos();



});

const eventos = () => {
    document.getElementById('cancel-edit').addEventListener('click', () => {
        abrirModalConfirm({
            titulo: "Cancelar registro",
            mensaje: `¿Seguro que deseas cancelar la edición?, Ningún cambio será guardado.`,

            onConfirm: async () => {
                window.location.href = "/prueba/distribuidora-esqueleto/tickets";
            }
        });


    });
    //botones del modal
    initModal();

}

function filtrarEmpleados(idDepartamento) {

    //si no hay departamento → mostrar TODOS
    if (!idDepartamento) {
        llenarSelect("empleadoSelect", empleadosGlobal, "id_empleado", "descripcion");
        return;
    }

    const empleadosFiltrados = empleadosGlobal.filter(emp =>
        emp.id_departamento == idDepartamento
    );

    llenarSelect("empleadoSelect", empleadosFiltrados, "id_empleado", "descripcion");
}
function autoSeleccionarDepartamento(idEmpleado) {

    const empleado = empleadosGlobal.find(emp =>
        emp.id_empleado == idEmpleado
    );

    if (!empleado) return;

    const departamentoSelect = document.getElementById("departamentoSelect");

    //asignar departamento
    departamentoSelect.value = empleado.id_departamento;

}
//optiene los option de los select
const valoresFormulario = async () => {
    //se piden los datos para el formulario desde la base de datos
    const dataForms = await request('/api/get-form-data', 'GET');


    const r = dataForms;
    empleadosGlobal = r.empleado;


    llenarSelect("areaSelect", r.area_afectada, "id_area_afectada", "descripcion");
    llenarSelect("canalSelect", r.canal_contacto, "id_canal_contacto", "descripcion");
    llenarSelect("categoriaSelect", r.categoria, "id_categoria", "descripcion");
    llenarSelect("departamentoSelect", r.departamento, "id_departamento", "descripcion");
    llenarSelect("empleadoSelect", empleadosGlobal, "id_empleado", "descripcion");
    llenarSelect("estacionSelect", r.estacion, "id_estacion", "descripcion");
    //llenarSelect("estatusSelect", r.estatus, "id_estatus", "descripcion");
    llenarSelect("nivelSelect", r.lvl_afectacion, "id_lvl_afectacion", "descripcion");
    llenarSelect("prioridadSelect", r.prioridad, "id_prioridad", "descripcion");
    llenarSelect("tipoSelect", r.tipo, "id_tipo", "descripcion");


}
function llenarSelect(selectId, datos, idCampo, textoCampo) {

    const select = document.getElementById(selectId);

    select.innerHTML = '<option value=""></option>';

    if (!datos || (Array.isArray(datos) && datos.length === 0)) {
        console.warn("Datos vacíos:", selectId);
        return;
    }

    //   si viene como objeto único → convertirlo a array
    if (!Array.isArray(datos)) {
        datos = [datos];
    }

    datos.forEach(item => {

        const option = document.createElement("option");

        option.value = item[idCampo];
        option.textContent = item[textoCampo];

        select.appendChild(option);

    });

    //   SI SOLO HAY UNO → seleccionarlo y bloquear
    if (datos.length === 1) {
        select.value = datos[0][idCampo];
        select.disabled = true;
    } else {
        select.disabled = false;
    }
    select.classList.toggle("select-disable", select.disabled);
}

async function cargarTicket(id) {
    try {
        document.getElementById('loader-overlay').classList.remove('hidden');
        const response = await request('/api/get-ticket', 'POST', {
            id_ticket: id
        });

        if (response.status == 200) {
            const ticket = response.body.resultado;
            document.getElementById('loader-overlay').classList.remove('hidden');
            llenarFormulario(ticket);

        } else {
            mostrarMensaje({
                titulo: "Error",
                mensaje: response.body.mensaje,
                tipo: "error"
            });
        }
    } catch (error) {
        console.error(error);
    }
}

function llenarFormulario(ticket) {

    idTicket = ticket.id_ticket;
    document.getElementById('departamentoSolInput').value = ticket.departamento_solicitante;
    document.getElementById('empleadoSolInput').value = ticket.empleado_solicitante;

    document.getElementById('estacionSelect').value = ticket.id_estacion;
    document.getElementById('tituloAreaEdit').value = ticket.titulo;
    document.getElementById('departamentoSelect').value = ticket.id_departamento_asi;
    document.getElementById('empleadoSelect').value = ticket.id_empleado_asi;
    document.getElementById('tipoSelect').value = ticket.id_tipo;
    document.getElementById('categoriaSelect').value = ticket.id_categoria;
    document.getElementById('areaSelect').value = ticket.id_area_afectada;
    document.getElementById('nivelSelect').value = ticket.id_lvl_afectacion;
    document.getElementById('prioridadSelect').value = ticket.id_prioridad;
    document.getElementById('canalSelect').value = ticket.id_canal_contacto;
    // checkbox  
    document.getElementById('enTiempo').checked = ticket.se_creo_en_tiempo == 1;
    document.getElementById('descripcionArea').value = ticket.descripcion;
    document.getElementById('comentariosArea').value = ticket.comentarios;
    document.getElementById('loader-overlay').classList.add('hidden');
}


//se manda toda la data del formulario para crear un ticket en la base de datos
const editarTicket = async () => {


    //const adjunto_form = document.getElementById("demo-upload").value;

    const id_estacion = document.getElementById("estacionSelect").value;
    const titulo = document.getElementById('tituloAreaEdit').value;
    //const id_estatus = document.getElementById("estatusSelect").value;
    const id_departamento_asi = document.getElementById("departamentoSelect").value;
    const id_empleado_asi = document.getElementById("empleadoSelect").value;
    const id_tipo = document.getElementById("tipoSelect").value;
    const id_categoria = document.getElementById("categoriaSelect").value;
    const id_area_afectada = document.getElementById("areaSelect").value;
    const id_lvl_afectacion = document.getElementById("nivelSelect").value;
    const id_prioridad = document.getElementById("prioridadSelect").value;
    const id_canal_contacto = document.getElementById("canalSelect").value;

    const se_creo_en_tiempo = document.getElementById("enTiempo").checked;
    const descripcion = document.getElementById('descripcionArea').value;
    const comentarios = document.getElementById("comentariosArea").value;
    const id_ticket = idTicket;

    const data = {
        id_ticket,
        titulo,
        //adjunto_form,
        id_departamento_asi,
        id_estacion,
        id_tipo,
        id_area_afectada,
        id_prioridad,
        id_lvl_afectacion,
        id_empleado_asi,
        //id_estatus,
        id_categoria,
        id_canal_contacto,
        se_creo_en_tiempo,
        descripcion,
        comentarios
    };



    document.getElementById('loader-overlay').classList.add('hidden');
    const response = await request('/api/edit-ticket', 'POST', data);



    if (response.status == 200) {
        mostrarMensaje({
            titulo: "Confirmacion",
            mensaje: "El ticket se edito correctamente",
            tipo: "success"
        });

    } else {
        mostrarMensaje({
            titulo: "Error",
            mensaje: response.body.mensaje || "No se pudo crear el ticket",
            tipo: "error"
        });
        return;
    }


    // manda a index tickets

    setTimeout(() => {
        window.location.href = "/prueba/distribuidora-esqueleto/tickets";
    }, 1000);
}
