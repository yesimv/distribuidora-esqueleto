export function tabla(nombreTabla, columnas, dataSource, extras = null) {
    if (DataTable.isDataTable(nombreTabla)) {
        new DataTable(nombreTabla).destroy();
    }

    try {
        const tablaElement = document.querySelector(nombreTabla);





        const cols = [...columnas];
        /*si se define el uso de los botones de accion*/
        if (extras && extras.includes('Acciones')) {
            tablaElement.addEventListener('click', (e) => {
                /* const celda = e.target.closest('td');
                console.log('Celda:', celda); */


                const btnView = e.target.closest('.btn-view');
                const btnCancel = e.target.closest('.btn-cancel');

                if (btnView) {
                    const id = btnView.dataset.id;
                    console.log("Ver ticket", id);
                }

                if (btnCancel) {
                    const id = btnCancel.dataset.id;
                    console.log("Cancelar ticket", id);
                }
            });

            cols.push({
                title: 'Acciones',
                data: null,
                orderable: false,
                render: function (data, type, row) {

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
                        

                        <button class="btn-cancel group action-btn" data-tooltip="Borrar Ticket"
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

            },);

        };

        
        new DataTable(nombreTabla, {

            lengthMenu: [5, 10, 25, -1],
            buttons: [
                { extend: 'copy', className: 'btn-primary-light-mini' },
                { extend: 'excel', className: 'btn-primary-light-mini' },
                { extend: 'pdf', className: 'btn-primary-light-mini' }
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
            data: dataSource

        });
        document.querySelectorAll('.dt-column-header')
            .forEach(el => el.classList.add('table-head2'));

        document.querySelectorAll('.dt-input')
            .forEach(el => el.classList.add('input-datatable'));


    } catch (error) {
        console.error('Error detectado', error)
    }
}

