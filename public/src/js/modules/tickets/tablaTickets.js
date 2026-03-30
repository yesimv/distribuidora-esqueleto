
import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'





const tabs = document.querySelectorAll('.tab-btn');



export function cargarTablaSiExiste() {

  const tablaTickets = document.querySelector('#tabla-tickets');


  if (!tablaTickets) return;
  tablaTickets();


}
const tablaTickets = async () => {

  const columnas = [
    { data: 'id_ticket', title: 'ID' },
    { data: 'titulo', title: 'Titulo' },
    { data: 'empleado_solicitante', title: 'Solicitante' },
    { data: 'departamento_solicitante', title: 'Dept. solicitante' },
    {
      data: 'estatus', title: 'Estatus',
      render: (data, type, row) =>
        `<span class="${row.estatus_class}">${data}</span>`
    },
    { data: 'tiempo_estimado', title: 'Tiempo estimado' },
    {
      data: 'prioridad', title: 'Prioridad',
      render: (data, type, row) =>
        `<span class="${row.prioridad_class}">${data}</span>`
    },
    
    { data: 'create_date', title: 'Fecha creación' },
  ];

  const extras = ['AccionesTicket'];

  const dataSource = await request('/api/tickets', 'GET');
  
  const dt = tabla('#tabla-tickets', columnas, dataSource, extras);



}


