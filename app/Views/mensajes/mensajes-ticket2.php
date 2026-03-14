<div id="chat-ticket" class="flex flex-col h-[520px] border rounded-xl bg-white">

    <!-- header -->
    <div class="flex items-center gap-3 border-b px-4 py-3">
        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
            🛠
        </div>

        <div>
            <p class="font-semibold">Soporte</p>
            <span class="text-xs text-gray-500">Ticket #15</span>
        </div>
    </div>

    <!-- mensajes -->
    <div id="chat-mensajes"
         class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50">

    </div>

    <!-- input -->
    <div class="border-t p-3 flex gap-2">

        <input
            id="chat-input"
            type="text"
            placeholder="Escribe un mensaje..."
            class="flex-1 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
        >

        <button id="chat-enviar"
                class="bg-blue-600 text-white px-4 rounded-lg hover:bg-blue-700">
            Enviar
        </button>

    </div>

</div>