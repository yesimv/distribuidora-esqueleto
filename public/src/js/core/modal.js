

let accionConfirmada = null;
let containerActual = null;
let valorAnterior = null;
let selectorTexto = null;

export function abrirModalConfirm({
    titulo,
    mensaje,
    onConfirm,
    container = null,
    previousValue = null,
    textSelector = null
}) {
    document.getElementById('modal-title').textContent = titulo;
    document.getElementById('modal-message').textContent = mensaje;

    accionConfirmada = onConfirm;
    containerActual = container;
    valorAnterior = previousValue;
    selectorTexto = textSelector;

    document.getElementById('modal-confirm').classList.remove('hidden');
}

export function initModal() {
    document.getElementById('cancelar').addEventListener('click', cerrarModal);

    document.getElementById('confirmar').addEventListener('click', async () => {
        if (accionConfirmada) {
            await accionConfirmada();
        }
        // limpiar sin restaurar
        containerActual = null;
        cerrarModal();
    });
}

function cerrarModal() {
    document.getElementById('modal-confirm').classList.add('hidden');

    //   restaurar si cancela
    if (containerActual && valorAnterior && selectorTexto) {
        const selectedText = containerActual.querySelector(selectorTexto);
        if (selectedText) {
            selectedText.textContent = valorAnterior;
        }
    }

    accionConfirmada = null;
    containerActual = null;
    valorAnterior = null;
    selectorTexto = null;
}


export function mostrarMensaje({ titulo, mensaje, tipo = "success" }) {

    const modal = document.getElementById('modal-msg');
    const title = document.getElementById('msg-title');
    const text = document.getElementById('msg-text');

    title.textContent = titulo;
    text.textContent = mensaje;

    // 🎨 colores según tipo
    if (tipo === "error") {
        title.className = "text-lg font-semibold mb-4 text-red-500";
    } else {
        title.className = "text-lg font-semibold mb-4 text-green-500";
    }

    modal.classList.remove('hidden');

    document.getElementById('msg-close').onclick = () => {
        modal.classList.add('hidden');
    };
}

