import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'




export const filtrarPorFecha = async () => {
    const fInicio = document.getElementById('fch-inicio').value;
    const fFinal = document.getElementById('fch-fin').value;
    const fechas = {
        'fchInicio': fInicio,
        'fchFinal': fFinal
    };
   
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
    {
      data: 'empleado_asignado', title: 'Empleado asignado',
      render: function (data, type, row) {

        let accionesAsignacion = '';

        const noAsignado = row.id_empleado_asi === null;
        const esJefe = parseInt(row.es_jefe_depto) === 1;
        const empleados = row.empleados_departamento || [];

        if (noAsignado) {

          if (esJefe) {
            accionesAsignacion = `
              <select class="select-asignar" data-id="${row.id_ticket}">
                  <option value="">Asignar a...</option>
                  ${empleados.map(emp => `
                      <option value="${emp.id_empleado}">
                          ${emp.nombre}
                      </option>
                  `).join('')}
              </select>
            `;
          } else {
            accionesAsignacion = `
              <button class="btn-success-light-mini btn-asignarme action-btn"
                  data-id="${row.id_ticket}">
                  Asignármelo
              </button>
            `;
          }

        } else {
          accionesAsignacion = `<span>${row.empleado_asignado}</span>`;
        }

        return `
          <div class="flex gap-2 flex-wrap">
              ${accionesAsignacion}
          </div>
        `;
      }

    },
    { data: 'create_date', title: 'Fecha creación' },
  ];
    const extras = ['AccionesTicket'];
    
    const dataSource = await request('/api/ticket-fecha', 'POST', fechas);
   
    
    
    
    const dt = tabla('#tabla-tickets', columnas, dataSource, extras);
    


}
