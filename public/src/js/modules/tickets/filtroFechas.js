import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'


document.addEventListener("DOMContentLoaded", function () {

    const tablaFechasTicket = document.querySelector('#formulario-ticket-fecha');
    const btn = document.querySelector('#btn-fecha');

    if(!btn) return;

    btn.addEventListener('click', () => {
        
        filtrarPorFecha();
        
    });

});

const filtrarPorFecha = async () => {
    const fInicio = document.getElementById('fch-inicio').value;
    const fFinal = document.getElementById('fch-fin').value;
    const fechas = {
        'fchInicio': fInicio,
        'fchFinal': fFinal
    };
    console.log(fechas);
    const columnas = [
        { data: 'id_ticket', title: 'ID' },
        { data: 'titulo', title: 'Titulo' },
        { data: 'descripcion', title: 'Descripcion' },
        {
            data: 'id_estatus', title: 'Estatus',
            render: (data, type, row) =>
                `<span class="${row.estatus_class}">${data}</span>`
        },
        {
            data: 'id_prioridad', title: 'Prioridad',
            render: (data, type, row) =>
                `<span class="${row.prioridad_class}">${data}</span>`
        },
        { data: 'create_date', title: 'Fecha de creación' },

    ];
    const extras = ['Acciones'];
    
    const dataSource = await request('/api/ticket-fecha', 'POST', fechas);
    console.log(dataSource);
    
    
    
    const dt = tabla('#tabla-fechas-tickets', columnas, dataSource, extras);
    


}
