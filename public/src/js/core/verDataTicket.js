import { request } from '../core/http.js'


export async function abrirModalVerTicket(id) {

    try {
        const responseTicket = await request('/api/get-ticket', 'POST', {
            id_ticket: id
        });

        const responseAnalisis = await request('/api/get-analisis', 'POST', {
            id_ticket: id
        });

        
        const ticketData = responseTicket.body.resultado;
        

        if (responseTicket.status === 200) {

            llenarModalVer(ticketData,responseAnalisis);

            document.getElementById('modal-ver-ticket')
                .classList.remove('hidden');


        } else {
            console.error(responseTicket.body.mensaje);
        }

    } catch (error) {
        console.error(error);
    }
}
function llenarModalVer(ticket,analisis) {


    document.getElementById('ver-tiempo-estimado').textContent = analisis.tiempo_est || 'Sin registro';
    document.getElementById('ver-tiempo-real').textContent = analisis.tiempo_real || 'Sin registro';
    document.getElementById('ver-resolucion').textContent = analisis.resolucion || 'Sin resolucion';
    document.getElementById('ver-causa').textContent = analisis.causa || 'No se menciono la causa';
    document.getElementById('ver-solucion').textContent = analisis.solucion || 'No se mencionó la solución';
    document.getElementById('ver-comentarios-analisis').textContent = analisis.comentarios || 'Sin comentarios respecto al análisis técnico';

    // checkbox  
    document.getElementById('en-tiempo-ticket').textContent = ticket.se_creo_en_tiempo == 1 ? 'SI' : 'NO';
    document.getElementById('ver-id').textContent = ticket.id_ticket || 'Sin especificar';
    document.getElementById('ver-tipo').textContent = ticket.tipo_ticket || 'Sin especificar';
    document.getElementById('ver-titulo').textContent = ticket.titulo || 'Sin especificar';
    document.getElementById('ver-descripcion').textContent = ticket.descripcion || 'Sin descripción';
    document.getElementById('ver-comentarios').textContent = ticket.comentarios || 'Sin comentarios';
    document.getElementById('ver-departamento-solicitante').textContent = ticket.departamento_solicitante || 'Sin especificar';
    document.getElementById('ver-empleado-solicitante').textContent = ticket.empleado_solicitante || 'Sin especificar';
    document.getElementById('ver-categoria').textContent = ticket.categoria || 'Sin especificar';
    document.getElementById('ver-estacion').textContent = ticket.estacion || 'Sin especificar';
    document.getElementById('ver-area-afectada').textContent = ticket.area_afectada || 'Sin especificar';
    document.getElementById('ver-nivel-afectacion').textContent = ticket.nivel_afectacion || 'Sin especificar';
    document.getElementById('ver-prioridad').textContent = ticket.prioridad || 'Sin especificar';
    document.getElementById('ver-estatus').textContent = ticket.estatus || 'Sin especificar';
    document.getElementById('ver-departamento-asignado').textContent = ticket.departamento_asignado || 'Sin especificar';
    document.getElementById('ver-empleado-asignado').textContent = ticket.empleado_asignado || 'Sin asignar';


}