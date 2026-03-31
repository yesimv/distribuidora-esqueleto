import { buttonPop } from "../../core/buttonPop.js";
import { abrirModalConfirm, initModal, mostrarMensaje } from "../../core/modal.js";
//import { filtrarPorFecha } from './filtroFechas.js';
//import { cargarTicket } from './editarTicket.js';
import { tabla } from '../../core/tabla.js'
import { request } from '../../core/http.js'
import { abrirAnalisis } from '../analisis/nuevoAnalisis.js'
import { abrirModalVerTicket } from "../../core/verDataTicket.js";


const fp = window.flatpickr;
// se define la variable de la tabla para actualizarla
const app = {
    dt: null
};


let editarCargado = false;
/* dar formato a el input fecha */
const configFecha = {
    locale: fp.l10ns.es,
    altInput: true,
    altFormat: "d/m/Y",
    dateFormat: "Y-m-d"
};

document.addEventListener("DOMContentLoaded", async function () {
    if (document.querySelector('#tabla-tickets')) {
        await tablaTickets();
    }
    fp('#fch-fin-ticket', configFecha);
    fp('#fch-inicio-ticket', configFecha);
    eventos();
    buttonPop();
});

const eventos = () => {

    if (!document.querySelector('#tabla-tickets')) {
        return;
    }
    const tabla = document.querySelector('#tabla-tickets');
    const btn = document.querySelector('#btn-filtro-fecha');
    const btnClose = document.querySelector('#msg-info-ticket-close');

    /*Para accionar los botones de ver y cancelar ticket*/
    tabla.addEventListener('click', async (e) => {

        const btnView = e.target.closest('.btn-view');
        const btnBorrar = e.target.closest('.btn-borrar');
        const btnAsignarme = e.target.closest('.btn-asignarme');

        // 🔽 Abrir/cerrar dropdown
        const btnAsignar = e.target.closest(".select-asignado-btn");
        const btnEstatus = e.target.closest(".select-estatus-btn");
        //modal


        //editar
        if (btnView) {
            //validar si se podra editar
            const btn = e.target;
            // obtener la fila
            const fila = btn.closest('tr');
            // obtener el td del estatus (la clase se agrego en el service)
            const estatus = fila.querySelector('.td-estatus')?.textContent.trim();
            const id = btnView.dataset.id;
            // validar
            if (estatus === 'Cancelado' || estatus === 'Cerrado' || estatus === 'Reasignado') {
                abrirModalVerTicket(id);
                return; // NO continuar
            }



            abrirEditarTab(id);


        }
        // 🗑 Eliminar
        if (btnBorrar) {
            const id = btnBorrar.dataset.id;
            abrirModalConfirm({
                titulo: "Eliminar",
                mensaje: "¿Seguro que desea eliminar este ticket?",
                onConfirm: async () => {
                    await borrarTicket(id);
                }
            });
        }
        // 🙋‍♂️ Asignarme
        if (btnAsignarme) {
            const id = btnAsignarme.dataset.id;
            abrirModalConfirm({
                titulo: "Asignar",
                mensaje: "¿Deseas asignarte a ti el ticket?",
                onConfirm: async () => {
                    await asignarTicket({
                        id_ticket: id,
                        auto: true
                    }, btnAsignarme);
                }
            });

        }
        //abre el select personalizado para escoger a quien asignar || solo para coordinadores o superadmins
        if (btnAsignar) {
            const container = btnAsignar.closest(".custom-select");
            // si ya está asignado → no hacer nada
            if (container.classList.contains('asignado-select') && container.classList.contains('asignado')) return;
            const options = container.querySelector(".select-options");

            // cerrar otros abiertos
            document.querySelectorAll(".select-options").forEach(el => {
                if (el !== options) el.classList.add("hidden");
            });

            options.classList.toggle("hidden");
            return;
        }
        if (btnEstatus) {
            const container = btnEstatus.closest(".custom-select");
            // si ya está asignado → no hacer nada
            if (container.classList.contains('estatus-select') && container.classList.contains('asignado')) return;
            const options = container.querySelector(".select-options");

            // cerrar otros abiertos
            document.querySelectorAll(".select-options").forEach(el => {
                if (el !== options) el.classList.add("hidden");
            });

            options.classList.toggle("hidden");
            //detectar si hubo seleccion de un estatus diferente al default para activar abrirModalConfirm y cambiar o no el estatus
            return;

        }

        // ✅ Seleccionar opción
        const option = e.target.closest(".option");
        if (!option) return;

        const container = option.closest('.custom-select');

        const esEstatus = container.classList.contains('estatus-select');
        const esAsignacion = container.classList.contains('asignado-select');

        const idTicket = container.dataset.id;
        const idEmpleado = option.dataset.value;



        if (esEstatus) {
            //   mostrar texto seleccionado (visual)
            const selectedText = container.querySelector('.selected-estatus');
            const textoAnterior = selectedText.textContent;

            //   cerrar dropdown
            container.querySelector('.select-options').classList.add('hidden');

            selectedText.textContent = option.textContent;
            const estatus = option.dataset.value;

            if (estatus == 3 || estatus == 4 || estatus == 5) {
                abrirAnalisis(idTicket, estatus, container);
            } else if (estatus == 2) {
                //   confirmación
                abrirModalConfirm({
                    titulo: "Cambiar estatus",
                    mensaje: `¿Deseas cambiar el estatus a "${option.textContent}"?`,
                    container: container,
                    previousValue: textoAnterior,
                    textSelector: '.selected-estatus',
                    onConfirm: async () => {
                        await actualizarEstatus({
                            id_ticket: idTicket,
                            estatus: option.dataset.value
                        }, container);
                    }
                });
            }



        }

        if (idEmpleado) {
            //   actualiza visualmente el texto

            const selectedText = container.querySelector('.selected-asignado');
            const textoAnterior = selectedText.textContent;
            selectedText.textContent = option.textContent;
            selectedText.classList.remove('text-gray-500');


            //   cierra el dropdown
            container.querySelector('.select-options').classList.add('hidden');

            //   abre el modal de confirmacion para asignar el ticket
            abrirModalConfirm({
                titulo: "Asignar ticket",
                mensaje: `¿Asignar ticket a ${option.textContent}?`,
                container: container,
                previousValue: textoAnterior,
                textSelector: '.selected-asignado',
                onConfirm: async () => {
                    await asignarTicket({
                        id_ticket: idTicket,
                        id_empleado: idEmpleado
                    }, container);
                }
            });
        }



    });


    btnClose.addEventListener('click', () => {
        document.getElementById('modal-ver-ticket')
            .classList.add('hidden');

    })
    if (!btn) return;

    btn.addEventListener('click', () => {
        filtrarPorFecha();
    });
    initModal()

}


async function abrirEditarTab(id) {

    const tab = document.getElementById('editar');

    //codifica el link para mandar seguro el id
    const encoded = btoa(`tk_${id}_secure`);
    window.location.href = `${BASE_URL}/ticket-editar?data=${encoded}`;
    return;

}
const configTable = () => {
    return [
        { data: 'id_ticket', title: 'ID' },
        { data: 'titulo', title: 'Titulo' },
        { data: 'empleado_solicitante', title: 'Solicitante' },
        { data: 'departamento_solicitante', title: 'Dept. solicitante' },
        { data: 'tiempo_estimado', title: 'Tiempo estimado' },
        {
            data: 'prioridad', title: 'Prioridad',
            render: (data, type, row) =>
                `<span class="${row.prioridad_class}">${data}</span>`
        },

        {
            data: 'create_date',
            title: 'Fecha creación',
            render: function (data) {
                if (!data) return '';

                const fecha = new Date(data);

                const dia = String(fecha.getDate()).padStart(2, '0');
                const mes = String(fecha.getMonth() + 1).padStart(2, '0');
                const anio = fecha.getFullYear();

                return `${dia}/${mes}/${anio}`;
            }
        }
    ];
}

export const tablaTickets = async (fechas = null) => {
    const config = configTable();
    const extras = ['AccionesTicket'];

    let dataSource = null;
    document.getElementById('loader-overlay').classList.remove('hidden');
    if (fechas) {
        dataSource = await request('/api/ticket-fecha', 'POST', fechas);
    } else {
        dataSource = await request('/api/tickets', 'GET');
    }



    app.dt = await tabla('#tabla-tickets', config, dataSource, extras);
}

const filtrarPorFecha = async () => {
    //!!VALIDAR QUE FECHAS NO ESTEN VACIAS Y MOSTRAR ALERTA DE QUE SON OBLIGATORIAS!!!!
    const fInicio = document.getElementById('fch-inicio-ticket').value;
    const fFinal = document.getElementById('fch-fin-ticket').value;
    const fechas = {
        'fchInicio': fInicio,
        'fchFinal': fFinal
    };

    if (document.querySelector('#tabla-tickets')) {
        await tablaTickets();
    }
}

async function borrarTicket(id) {
    try {
        document.getElementById('loader-overlay').classList.add('hidden');
        const response = await request('/api/borrar-ticket', 'POST', {
            id_ticket: id
        });

        if (response.status == 200) {
            mostrarMensaje({
                titulo: "Eliminado",
                mensaje: "El ticket se eliminó correctamente",
                tipo: "success"
            });

            //   recargar tabla
            if (document.querySelector('#tabla-tickets')) {
                await tablaTickets();
            }

        } else {
            mostrarMensaje({
                titulo: "Error",
                mensaje: response.body.mensaje || "No se pudo eliminar",
                tipo: "error"
            });
        }

    } catch (error) {
        console.error(error);
        mostrarMensaje({
            titulo: "Error",
            mensaje: "Error inesperado",
            tipo: "error"
        });
    }
}

async function asignarTicket(data, rowElement) {
    try {

        document.getElementById('loader-overlay').classList.add('hidden');
        const response = await request('/api/asignar-ticket', 'POST', data);

        if (response.status == 200) {

            mostrarMensaje({
                titulo: "Asignado",
                mensaje: "El ticket fue asignado correctamente",
                tipo: "success"
            });

            //   VALIDAR que exista rowElement
            if (!rowElement) {
                console.warn("rowElement es undefined");
                return;
            }

            //   obtener fila de forma segura
            const tr = rowElement.closest('tr');
            if (!tr) {
                console.warn("No se encontró <tr>");
                return;
            }

            const row = app.dt.row(tr);
            const rowData = row.data();

            let nombre;
            let container = null;

            //   detectar tipo de elemento
            if (rowElement.tagName === 'SELECT') {

                nombre = rowElement.options[rowElement.selectedIndex].text;
                container = rowElement;

            } else if (rowElement.classList.contains('custom-select')) {

                container = rowElement;
                nombre = container.querySelector('.selected-asignado')?.textContent;

            } else {

                //   viene de botón "asignarme"
                nombre = window.usuario_nombre;
                container = rowElement.closest('.custom-select');
            }

            //   actualizar data
            rowData.id_empleado_asi = data.id_empleado || window.id_empleado;
            rowData.empleado_asignado = nombre;

            row.data(rowData).draw(false);

            //   esperar a que DataTable redibuje
            setTimeout(() => {

                const newRow = app.dt.row(row.index()).node();
                if (!newRow) return;

                const newContainer = newRow.querySelector('.custom-select');

                if (newContainer && newContainer.classList.contains('asignado-select')) {
                    newContainer.classList.add('asignado');
                    newContainer.style.background = 'inherit';

                    const flecha = newContainer.querySelector('.arrow')
                        || newContainer.querySelector('span:nth-child(2)');

                    if (flecha) flecha.classList.add('hidden');
                }

            }, 0);

        } else {
            mostrarMensaje({
                titulo: "Error",
                mensaje: "No se pudo asignar el ticket",
                tipo: "error"
            });
        }

    } catch (error) {
        console.error(error);
    }
}

async function actualizarEstatus(data, rowElement) {
    try {
        const response = await request('/api/actualizar-estatus', 'POST', data);

        if (response.status == 200) {

            mostrarMensaje({
                titulo: "Actualización",
                mensaje: "El estatus fue actualizado correctamente",
                tipo: "success"
            });
            //   recargar tabla
            if (document.querySelector('#tabla-tickets')) {
                await tablaTickets();
            }

        } else {
            mostrarMensaje({
                titulo: "Error",
                mensaje: "No se pudo asignar el ticket",
                tipo: "error"
            });
        }

    } catch (error) {
        console.error(error);
    }
}







