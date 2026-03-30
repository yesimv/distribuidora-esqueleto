import { buttonPop } from '../../core/buttonPop.js';
import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'
import { abrirModalVerTicket } from "../../core/verDataTicket.js";
const fp = window.flatpickr;
let dataSource = null;


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
