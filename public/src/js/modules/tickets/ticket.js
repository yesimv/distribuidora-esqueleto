import { buttonPop } from "../../core/buttonPop.js";
import { cargarTablaSiExiste } from "./tablaTickets.js";




document.addEventListener("DOMContentLoaded", function () {

  cargarTablaSiExiste();
 
  btnPop();
  const tablaFechasTicket = document.querySelector('#formulario-ticket-fecha');
    const btn = document.querySelector('#btn-filtro-fecha');

    if(!btn) return;

    btn.addEventListener('click', () => {
        
        filtrarPorFecha();
        
    });

});

const btnPop = () => {

  buttonPop();

};

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
    
    const dataSource = await request('/api/filtro-ticket-fecha', 'POST', fechas);
    console.log(dataSource);
    
    
    
    const dt = tabla('#tabla-tickets', columnas, dataSource, extras);
    


}
