import { request } from '../../core/http.js'


document.querySelector('#chat-enviar')
.addEventListener('click', async ()=>{

    const input = document.querySelector('#chat-input');

    if(!input.value.trim()) return;

    await request('/api/mensaje','POST',{
        id_ticket: ticket.id_ticket,
        mensaje: input.value
    });

    input.value='';

});
const renderMensajes = (mensajes, ticket)=>{

    const chat = document.querySelector('#chat-mensajes');
    chat.innerHTML = '';

    mensajes.forEach(m => {

        const esAsignado = m.id_empleado == ticket.empleado_asignado;

        const html = `
        <div class="flex ${esAsignado ? 'justify-end' : 'justify-start'}">

            <div class="flex items-end gap-2 max-w-[70%]">

                ${!esAsignado ? `
                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-xs">
                    👤
                </div>` : ''}

                <div class="flex flex-col">

                    <div class="
                        px-4 py-2 rounded-xl
                        ${esAsignado 
                            ? 'bg-blue-600 text-white rounded-br-sm'
                            : 'bg-white border rounded-bl-sm'}
                    ">
                        ${m.mensaje}
                    </div>

                    <span class="text-[11px] text-gray-400 mt-1">
                        ${m.fecha}
                    </span>

                </div>

                ${esAsignado ? `
                <div class="w-8 h-8 rounded-full bg-blue-200 flex items-center justify-center text-xs">
                    🛠
                </div>` : ''}

            </div>

        </div>
        `;

        chat.insertAdjacentHTML('beforeend', html);

    });

    chat.scrollTop = chat.scrollHeight;
}