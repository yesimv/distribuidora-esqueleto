
import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'





const tabs = document.querySelectorAll('.tab-btn');

/* tabs.forEach(tab => {

  tab.addEventListener('click', () => {

    const target = tab.dataset.tab;

    if (target === 'index' && !tablaTicketsCargada) {
      cargarTablaTicketsSiExiste();
      tablaTicketsCargada = true;
    }

  });

}); */


export function cargarTablaSiExiste() {

  const tablaTicket = document.querySelector('#tabla-tickets');


  if (!tablaTicket) return;
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
    { data: 'empleado_asignado', title: 'Empleado asignado' },
    { data: 'create_date', title: 'Fecha creación' },
  ];

  const extras = ['Acciones'];

  const dataSource = await request('/api/tickets', 'GET');
  
  const dt = tabla('#tabla-tickets', columnas, dataSource, extras);



}

/* try {

   const tabla = document.querySelector('#tabla');
   tabla.addEventListener('click', (e) => {
     const celda = e.target.closest('td');
     console.log('Celda:', celda);

     const btnClose = e.target.closest('.btn-close');
     const btnView = e.target.closest('.btn-view');
     const btnCancel = e.target.closest('.btn-cancel');

     if (btnClose) {
       const id = btnClose.dataset.id;
       console.log("Cerrar ticket", id);
     }

     if (btnView) {
       const id = btnView.dataset.id;
       console.log("Ver ticket", id);
     }

     if (btnCancel) {
       const id = btnCancel.dataset.id;
       console.log("Cancelar ticket", id);
     }


   });

   const dataSource = await request('/api/tickets', 'GET');

   new DataTable('#tabla', {

     lengthMenu: [5, 10, 25, -1],
     buttons: [
       {
         extend: 'copy',
         className: 'btn-primary-light-mini'
       },
       {
         extend: 'excel',
         className: 'btn-primary-light-mini'
       },
       {
         extend: 'pdf',
         className: 'btn-primary-light-mini'
       }
     ],
     layout: {
       topStart: 'buttons'
     },
     language: {
       searchPlaceholder: "Ingrese un valor...",
       search: "Buscar:",
       info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
       infoEmpty: "Mostrando 0 a 0 de 0 Registros",
       infoFiltered: "(filtrado de _MAX_ registros totales)",
       emptyTable: "No hay información disponible para mostrar"
     },

     columns: [

       { data: 'id_ticket', title: 'ID' },
       { data: 'titulo', title: 'Titulo' },
       { data: 'empleado_solicitante', title: 'Solicitante' },
       { data: 'departamento_solicitante', title: 'Dept. solicitante' },
       {
         data: 'estatus', title: 'Estatus',
         render: (data, type, row) =>
           `<span class="${row.estatus_class}">${data}</span>`
       },
       {
         data: 'prioridad', title: 'Prioridad',
         render: (data, type, row) =>
           `<span class="${row.prioridad_class}">${data}</span>`
       },
       { data: 'empleado_asignado', title: 'Empleado asignado' },

       {
         title: 'Acciones',
         data: null,
         orderable: false,
         render: function (data, type, row) {

           return `
       <div class="flex gap-2">

         <button class="btn-close group action-btn" data-tooltip="Cerrar Ticket" data-id="${row.id_ticket}">
                   
           <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#15803e">
             <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Z"/>
           </svg>

         </button>
         

         <button class="btn-view group action-btn" data-tooltip="Ver más" data-id="${row.id_ticket}">
         
           <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#d97706">
             <path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Z"/>
           </svg>
         </button>
         

         <button class="btn-cancel group action-btn" data-tooltip="Borrar ticket"
           data-id="${row.id_ticket}"
           data-message="¿Seguro que deseas cancelar este ticket?">
           
           <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#c20e1a">
             <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56Z"/>
           </svg>
         </button>
         

       </div>
     `;
         }
       },

     ],
     data: dataSource



   });
   document.querySelectorAll('.dt-column-header')
     .forEach(el => el.classList.add('table-head2'));

   document.querySelectorAll('.dt-input')
     .forEach(el => el.classList.add('input-datatable'));
   console.log(dataSource);



 } catch (error) {
   console.error('Error detectado', error)
 } */