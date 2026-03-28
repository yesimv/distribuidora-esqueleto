import { buttonPop } from '../../core/buttonPop.js';
import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'
import { abrirModalVerTicket } from "../../core/modal.js";
const fp = window.flatpickr;
let dataSource = null;
let tiemposReales = [];

/* dar formato a el input fecha */
const configFecha = {
    locale: fp.l10ns.es,
    altInput: true,
    altFormat: "d/m/Y",
    dateFormat: "Y-m-d"
};
document.addEventListener("DOMContentLoaded", function () {


    fp('#fch-fin', configFecha);
    fp('#fch-inicio', configFecha);
    cargarTablaSiExiste();

    btnPop();
    /*    const btn = document.querySelector('#btn-filtro-fecha-analisis');
       if (!btn) return;
   */


    eventos();

});
//crear el ver los detalles del ticket pendiente
const eventos = () => {
    const tabla = document.querySelector('#tabla-analisis');
    const btn = document.querySelector('#btn-filtro-fecha-analisis');
    const btnClose = document.querySelector('#msg-info-ticket-close');

    /*Para accionar el boton de ver ticket*/
    tabla.addEventListener('click', async (e) => {
        const btnView = e.target.closest('.btn-view');


        //ver ticket
        if (btnView) {
            const btn = e.target;
            // obtener la fila
            const fila = btn.closest('tr');
            const id = btnView.dataset.id;
            console.log(id);

            abrirModalVerTicket(id);
        }

    });
    btn.addEventListener('click', () => {
        filtrarPorFecha();
    });
    btnClose.addEventListener('click', () => {
        document.getElementById('modal-ver-ticket')
            .classList.add('hidden');
        console.log('entra el cerrar');
    })
}

const btnPop = () => {

    buttonPop();

};

function cargarTablaSiExiste() {
    const tablaAnalisi = document.querySelector('#tabla-analisis');
    if (!tablaAnalisi) return;
    tablaAnalisis();
}
const tablaAnalisis = async (fechas = null) => {



    const columnas = [

        { data: 'id_analisis_tecnico', title: 'ID Analisis' },
        {
            data: 'resolucion', title: 'Resolucion',
            render: (data, type, row) =>
                `<span class="${row.resolucion_class}">${data}</span>`
        },

        { data: 'causa', title: 'Causa' },
        { data: 'solucion', title: 'Solución' },
        { data: 'comentarios', title: 'Comentarios' },
        { data: 'tiempo_est', title: 'Tiempo estimado' },
        { data: 'tiempo_real', title: 'Tiempo real' },

    ];
    const extras = ['AccionesAnalisis'];

    if (fechas) {
        dataSource = await request('/api/analisis-fecha', 'POST', fechas);
    } else {
        dataSource = await request('/api/analisis', 'GET');
    }

    dataSource.forEach(item => {
        tiemposReales.push({
            id_ticket: item.id_ticket,
            tiempo_estimado: item.tiempo_est,
            tiempo_real: item.tiempo_real
        });
    });
    const dt = tabla('#tabla-analisis', columnas, dataSource, extras);



}
const filtrarPorFecha = async () => {
    const fInicio = document.getElementById('fch-inicio').value;
    const fFinal = document.getElementById('fch-fin').value;
    const fechas = {
        'fchInicio': fInicio,
        'fchFinal': fFinal
    };

    tablaAnalisis(fechas);
}

async function abrirModalVerTicket(id) {

    try {
        const response = await request('/api/get-ticket', 'POST', {
            id_ticket: id
        });


        if (response.status === 200) {

            llenarModalVer(response.body.resultado);

            document.getElementById('modal-ver-ticket')
                .classList.remove('hidden');


        } else {
            console.error(response.body.mensaje);
        }

    } catch (error) {
        console.error(error);
    }
}
function llenarModalVer(ticket) {
    const tiempo = tiemposReales.find(t => t.id_ticket == ticket.id_ticket);
    console.log(ticket);
    console.log(tiempo);
    console.log(tiemposReales);

    document.getElementById('ver-id').textContent = ticket.id_ticket || 'Sin especificar';
    document.getElementById('ver-tipo').textContent = ticket.tipo_ticket || 'Sin especificar';
    document.getElementById('ver-tiempo-estimado').textContent = tiempo ? tiempo.tiempo_estimado : 'Sin registro';
    document.getElementById('ver-tiempo-real').textContent = tiempo ? tiempo.tiempo_real : 'Sin registro';
    document.getElementById('ver-titulo').textContent = ticket.titulo || 'Sin especificar';
    document.getElementById('ver-descripcion').textContent = ticket.descripcion || 'Sin descripción';
    document.getElementById('ver-comentarios').textContent = ticket.comentarios || 'Sin comentarios';
    document.getElementById('ver-departamento-solicitante').textContent = ticket.departamento_solicitante || 'Sin especificar';
    document.getElementById('ver-empleado-solicitante').textContent = ticket.empleado_solicitante || 'Sin especificar';
    document.getElementById('ver-categoria').textContent = ticket.departamento_categoria || 'Sin especificar';
    document.getElementById('ver-estacion').textContent = ticket.estacion || 'Sin especificar';
    document.getElementById('ver-area-afectada').textContent = ticket.area_afectada || 'Sin especificar';
    document.getElementById('ver-nivel-afectacion').textContent = ticket.nivel_afectacion || 'Sin especificar';
    document.getElementById('ver-prioridad').textContent = ticket.prioridad || 'Sin especificar';
    document.getElementById('ver-estatus').textContent = ticket.estatus || 'Sin especificar';
    document.getElementById('ver-departamento-asignado').textContent = ticket.departamento_asignado || 'Sin especificar';
    document.getElementById('ver-empleado-asignado').textContent = ticket.empleado_asignado || 'Sin asignar';


}
