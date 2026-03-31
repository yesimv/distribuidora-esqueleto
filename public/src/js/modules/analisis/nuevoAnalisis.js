import { request } from '../../core/http.js'
import { abrirModalConfirm, initModal, mostrarMensaje } from "../../core/modal.js";
import { tablaTickets } from '../tickets/ticket.js';

let idTicket = null;

export function abrirAnalisis(idTicket, estatus, container) {
    //se pinta mientras cargan las opciones
    document.getElementById("resolucionSelect").innerHTML = '<option disabled selected>Cargando...</option>'
    valoresResolucion();

    const modal = document.getElementById('modal-crear-analisis');
    modal.classList.remove('hidden');

    //toma el estatus anterios
    const estatusOriginal = container.dataset.actual;



    const span = container.querySelector(".selected-estatus");

    const btnCrearAnalisis = document.getElementById("btn-formulario-analisis-nuevo");
    //para crear un Analisis nuevo

    const btnCloseAnalisis = document.getElementById('cancel-analisis');
    btnCloseAnalisis.addEventListener('click', () => {
        document.getElementById("resolucionSelect").value = "";
        document.getElementById("causaAnalisis").value = "";
        document.getElementById("comentariosAnalisis").value = "";
        document.getElementById("solucionAnalisis").value = "";
        modal.classList.add('hidden');
        //recoloca el estatus anterior al hacer click en cancelar
        span.textContent = estatusOriginal;
    })


    btnCrearAnalisis.addEventListener('click', () => {
        //se crea una constante para detectar si se escogio una opcion de resolucion
        const modal = document.getElementById('modal-crear-analisis');


        const select = document.getElementById('resolucionSelect');
        const causa = document.querySelector('#causaAnalisis');
        const solucion = document.querySelector('#solucionAnalisis');

        let valido = true;
        if (select.value === "" || select.value === null || solucion.value === "" || solucion.value === null || causa.value === "" || causa.value === null) {
            valido = false;
            select.classList.add('border-red-500'); // opcional visual
        } else {
            select.classList.remove('border-red-500');
        }
        if (!valido) {
            mostrarMensaje({
                titulo: "Atención",
                mensaje: "La resolucion, causa y solucion son obligatorias",
                tipo: "error"
            });
            return;
        }

        crearAnalisis(idTicket, estatus, container);

    });
}

//traer los valores de resoluciones
const valoresResolucion = async () => {
    //se pide el dato del formulario
    const dataForm = await request('/api/get-resolucion', 'GET');
    const r = dataForm;

    llenarSelect("resolucionSelect", r.resolucion, "id_resolucion", "titulo");

}

//llena las opciones del select de resoluciones
function llenarSelect(selectId, datos, idCampo, tectoCampo) {
    const select = document.getElementById(selectId);
    select.innerHTML = '<option value=""></option>';
    if (!datos) {
        console.warn("Datos vacíos: ", selectId);
        return;
    }
    //convierte objetos en array (en cao de requerirlo)
    if (!Array.isArray(datos)) {
        datos = Object.values(datos);
    }

    datos.forEach(item => {
        const option = document.createElement("option");
        option.value = item[idCampo];
        option.textContent = item[tectoCampo];

        select.appendChild(option);
    })
}


//se manda toda la data del formulario para crear un analisis en la base de datos
const crearAnalisis = async (idTicket, idEstatus, container) => {

    const idResolucion = document.getElementById("resolucionSelect").value;
    const causa = document.getElementById('causaAnalisis').value;
    const solucion = document.getElementById("solucionAnalisis").value;
    const comentarios = document.getElementById('comentariosAnalisis').value;


    const data = {
        id_ticket: idTicket,
        id_estatus: idEstatus,
        id_resolucion: idResolucion,
        causa: causa,
        solucion: solucion,
        comentarios: comentarios
    };



    //   confirmación
    abrirModalConfirm({
        titulo: "Cerrar ticket y crear analisis técnico",
        mensaje: `¿Deseas cerrar este ticket? Ya no se podra editar`,
        onConfirm: async () => {
            await cerrarAnalisis({
                data: data,
                container: container
            });
        }
    });
}
const cerrarAnalisis = async (data, container) => {

    document.getElementById('loader-overlay').classList.add('hidden');
    const response = await request('/api/new-analisis', 'POST', data);
    


    if (response.status == 200) {
        mostrarMensaje({
            titulo: "Confirmacion",
            mensaje: "El Analisis se creo correctamente",
            tipo: "success"
        }, container);


    } else {
        mostrarMensaje({
            titulo: "Error",
            mensaje: response.mensaje || "No se pudo crear el analisis",
            tipo: "error"
        }, container);
        return;
    }
    //se limpia el modal para crear analisis tecnicos y se oculta nuevamente
    const modal = document.getElementById('modal-crear-analisis');
    document.getElementById("resolucionSelect").value = "";
    document.getElementById("causaAnalisis").value = "";
    document.getElementById("comentariosAnalisis").value = "";
    document.getElementById("solucionAnalisis").value = "";
    modal.classList.add('hidden');

    //   recargar tabla
    if (document.querySelector('#tabla-tickets')) {
        await tablaTickets();
    }
}