//limpia las celdas que no tienen empleado asignado
function limpiarExport(data) {


    const temp = document.createElement('div');
    temp.innerHTML = data;

    // 1. Caso: select personalizado (el importante)
    const selected = temp.querySelector('.selected-estatus');
    if (selected) {
        return selected.textContent.trim();
    }

    // 2. Caso: estatus normal
    const normal = temp.querySelector('.td-estatus');
    if (normal) {
        return normal.textContent.trim();
    }

    // 3. Fallback (por si algo raro pasa)
    let texto = temp.textContent.trim();

    if (
        texto.includes('Asignar') ||
        texto.includes('Asignármelo') ||
        texto === '' ||
        texto.includes('Sin')
    ) {
        return 'Sin asignar';
    }

    return texto;
}
export function tabla(nombreTabla, columnas, dataSource, extras = null) {
    if (DataTable.isDataTable(nombreTabla)) {
        new DataTable(nombreTabla).destroy();
    }

    try {
        const tablaElement = document.querySelector(nombreTabla);
        const cols = [...columnas];
        /*si se define el uso de los botones de accion*/
        if (extras && extras.includes('AccionesTicket')) {
            cols.push(
                {
                    data: 'estatus', title: 'Estatus',
                    render: function (data, type, row) {
                        let accionesEstatus = '';
                        const puedeVer = row.puede_ver_asignacion;
                        const esJefe = row.es_jefe_depto == true;
                        const estatus = row.estatus_list || [];

                        if (!puedeVer || row.id_estatus == 3 || row.id_estatus == 4 || row.id_estatus == 5) {

                            accionesEstatus = `<span  class="${row.estatus_class}">${row.estatus}</span>`;

                        } else if (row.id_estatus == 1 || row.id_estatus == 2) {

                            if (esJefe || row.id_empleado_asi == window.id_empleado) {
                                accionesEstatus = `
                                    <div 
                                    
                                    class="min-w-[120px] relative custom-select estatus-select"
                                    data-id="${row.id_ticket}"
                                    data-depto="${row.id_departamento_asi}"
                                     data-actual="${row.estatus}"
                                    >
                                    
                                    <!-- BOTÓN -->
                                    <button
                                        type="button"
                                        class=" select-estatus-btn  text-left flex justify-between items-center  ${row.estatus_class}"
                                    >
                                        <span class="selected-estatus">${row.estatus}</span>
                                        <span>▾</span>
                                    </button>

                                    <!-- OPCIONES -->
                                    <div class="select-options hidden absolute z-50 mt-1 w-full bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-xl shadow-lg max-h-60 overflow-auto">
                                        
                                        ${estatus.map(est => `
                                        <div 
                                            class="option px-3 py-2 cursor-pointer hover:bg-gray-100 color-gray dark:hover:bg-gray-850"
                                            data-value="${est.id_estatus}"
                                        >
                                            <p>${est.descripcion}</p>
                                        </div>
                                        `).join('')}

                                    </div>
                                    </div>
                            `;

                            } else {
                                accionesEstatus = `<span  class="${row.estatus_class}">${row.estatus}</span>`;
                            }
                        }
                        return `<div data-estatus="${row.estatus}">
                                    ${accionesEstatus}
                                </div>`;
                    }

                },
                // se agrega el campo de empleado asignado
                {
                    data: 'empleado_asignado', title: 'Empleado asignado',
                    render: function (data, type, row) {

                        let accionesAsignacion = '';

                        const puedeVer = row.puede_ver_asignacion;
                        const noAsignado = row.id_empleado_asi == null;
                        const esJefe = row.es_jefe_depto == true;
                        const empleados = row.empleados_departamento || [];

                        if (!puedeVer || row.id_estatus == 3 || row.id_estatus == 4 || row.id_estatus == 5) {

                            accionesAsignacion = `<span>${row.empleado_asignado || 'Sin asignar'}</span>`;

                        } else if (noAsignado) {

                            if (esJefe) {
                                accionesAsignacion = `
                                    <div 
                                    
                                    class="min-w-[120px] custom-select relative asignado-select"
                                    data-id="${row.id_ticket}"
                                    data-depto="${row.id_departamento_asi}"
                                    >
                                    
                                    <!-- BOTÓN -->
                                    <button
                                        type="button"
                                        class=" select-asignado-btn btn-light-light-mini text-left flex justify-between items-center"
                                    >
                                        <span class="selected-asignado text-gray-500">Asignar a...</span>
                                        <span>▾</span>
                                    </button>

                                    <!-- OPCIONES -->
                                    <div class="select-options hidden absolute z-50 mt-1 w-full bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-xl shadow-lg max-h-60 overflow-auto">
                                        
                                        ${empleados.map(emp => `
                                        <div 
                                            class="option px-3 py-2 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-850"
                                            data-value="${emp.id_empleado}"
                                        >
                                            ${emp.nombre}
                                        </div>
                                        `).join('')}

                                    </div>
                                    </div>
                            `;
                            } else {
                                accionesAsignacion = `
                              <button class="btn-success-light-mini btn-asignarme action-btn "
                                data-id="${row.id_ticket}"
                                >
                                Asignármelo
                              </button>
                            `;
                            }

                        } else {

                            accionesAsignacion = `<span>${row.empleado_asignado || 'Sin asignar'}</span>`;
                        }

                        return `<div data-empleado="${row.empleado_asignado || 'Sin asignar'}">
                                    ${accionesAsignacion}
                                </div>`;
                    }

                },
                //se agregan las Acciones de tickets
                {
                    title: 'Acciones',
                    data: null,
                    orderable: false,
                    className: 'no-export',
                    render: function (data, type, row) {
                        if (row.is_delete == 1) {
                            return `
                            <div>
                                <p>Ticket eliminado</p>
                            </div>`
                        } else if (row.id_estatus == 3 || row.id_estatus == 4 || row.id_estatus == 5) {
                            return `
                                <div class="">
                                    <button class="btn-view group action-btn" data-tooltip="Ver Ticket" data-id="${row.id_ticket}">
                                
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#d97706">
                                        <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 
                                        80v-170l528-528q12-12 27-18t31-6q16 0 31 
                                        6t27 18l57 57q12 12 18 27t6 31q0 16-6 
                                        31t-18 27L290-120H120Zm640-584-56-56 56 
                                        56ZM591-620l-28-28 57 57-29-29Z"/>
                                        </svg>
                                    </button>
                                    
                                </div>
                                `;
                        } else {
                            return `
                        <div class="flex gap-2">
                            <button class="btn-view group action-btn" data-tooltip="Ver Ticket" data-id="${row.id_ticket}">
                        
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#d97706">
                                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 
                                80v-170l528-528q12-12 27-18t31-6q16 0 31 
                                6t27 18l57 57q12 12 18 27t6 31q0 16-6 
                                31t-18 27L290-120H120Zm640-584-56-56 56 
                                56ZM591-620l-28-28 57 57-29-29Z"/>
                                </svg>
                            </button>
                            <button class="btn-borrar group action-btn" data-tooltip="Borrar Ticket"
                            data-id="${row.id_ticket}"
                            data-message="¿Seguro que deseas borrar este elemento?">
                            
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#c20e1a">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 
                                33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 
                                0h80v-360h-80v360Z"/>
                                </svg>
                            </button>
                        </div>
                    `;
                        }


                    }

                },);


        } else if (extras && extras.includes('AccionesAnalisis')) {
            cols.push(
                //se agregan las Acciones de Analisis
                // se agrega el campo de empleado asignado
                {
                    data: null, title: 'ID Ticket',

                    orderable: false,
                    className: 'no-export',
                    render: function (data, type, row) {

                        return `
                        <div class="flex gap-2">
                            <button class="flex btn-view group action-btn" data-tooltip="Ver Ticket" data-id="${row.id_ticket}">
                                <p>${row.id_ticket}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="#d97706">
                                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 
                                80v-170l528-528q12-12 27-18t31-6q16 0 31 
                                6t27 18l57 57q12 12 18 27t6 31q0 16-6 
                                31t-18 27L290-120H120Zm640-584-56-56 56 
                                56ZM591-620l-28-28 57 57-29-29Z"/>
                                </svg>
                            </button>
                            
                        </div>
                    `;


                    }

                }
            )
        };

        // 🔥 Detectar si hay algún jefe de depto para agregar esta columan extra
        const mostrarDeptoAsignado = dataSource.some(item => item.es_jefe_depto == 1);
        // 🔥 Agregar columna dinámicamente
        if (mostrarDeptoAsignado) {
            cols.splice(7, 0, { // posición donde la quieres
                data: 'departamento_asignado',
                title: 'Dept. asignado'
            });
        }

        const dt = new DataTable(nombreTabla, {


            order: [[0, 'desc']], // columna 0 en descendente
            lengthMenu: [10, 20, 30, -1],
            buttons: [
                {
                    extend: 'copy',
                    className: 'btn-primary-light-mini',
                    exportOptions: {
                        //elimina celdas de 'acciones' al exportar
                        columns: ':not(.no-export)',
                        //traer empleado asignado limpio
                        format: { body: limpiarExport }
                    }
                },
                {
                    extend: 'excel', className: 'btn-primary-light-mini',
                    exportOptions: {
                        columns: ':not(.no-export)',
                        format: { body: limpiarExport }
                    }
                },
                {
                    extend: 'pdf', className: 'btn-primary-light-mini',
                    exportOptions: {
                        columns: ':not(.no-export)',
                        format: { body: limpiarExport }
                    }
                }
            ],
            dom: '<"flex justify-between items-center mb-2"lBf>rt<"flex justify-between items-center "ip>',
            language: {
                searchPlaceholder: "Ingrese un valor...",
                search: "Buscar: ",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 Registros",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                emptyTable: "No hay información disponible para mostrar",
                lengthMenu: '_MENU_ Registros por página'
            },

            columns: cols,
            data: dataSource,


        });
        document.querySelectorAll('.dt-column-header')
            .forEach(el => el.classList.add('table-head2'));

        document.querySelectorAll('.dt-input')
            .forEach(el => el.classList.add('input-datatable'));


        return dt;
    } catch (error) {
        console.error('Error detectado', error)
    }
}

