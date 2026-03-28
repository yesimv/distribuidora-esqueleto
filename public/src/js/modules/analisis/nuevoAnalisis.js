import { request } from '../../core/http.js'
let idTicket = null;

export function abrirAnalisis(id) {
    const modal = document.getElementById('modal-crear-analisis');
    modal.classList.remove('hidden');

    modal.dataset.id = id; // 🔥 aquí guardas el id
}
document.addEventListener("DOMContentLoaded", function () {

    const btnCrearAnalisis = document.getElementById("btn-formulario-analisis-nuevo");
    //para crear un Analisis nuevo
    btnCrearAnalisis.addEventListener('click', () => {
        //se crea una constante para detectar si se escogio una opcion de resolucion
        const modal = document.getElementById('modal-crear-analisis');
        const id = modal.dataset.id; // 🔥 aquí lo recuperas
        const select = document.getElementById('resolucionSelect');
        let valido = true;
        if (select.value === "" || select.value === null) {
            valido = false;
            select.classList.add('border-red-500'); // opcional visual
        } else {
            select.classList.remove('border-red-500');
        }
        if (!valido) {
            mostrarMensaje({
                titulo: "Atención",
                mensaje: "La resolucion es obligatoria",
                tipo: "error"
            });
            return;
        }
        crearAnalisis(id);

    });
    //se pinta mientras cargan las opciones
    document.getElementById("resolucionSelect").innerHTML = '<option disabled selected>Cargando...</option>'
    valorFormulario();
});


const valorFormulario = async () => {
    //se pide el dato del formulario
    const dataForm = await request('/api/get-resolucion', 'GET');
    const r = dataForm;

    llenarSelect("resolucionSelect", r.resolucion, "id_resolucion", "titulo");

}
function llenarSelect(selectId, datos, idCampo, tectoCampo) {
    const select = document.getElementById(selectId);
    select.innerHTML = '<option value=""></option>';
    if (!datos) {
        console.warn("Datos vacíos: ", selectId);
        return;
    }
    //convierte objetos en array (en cao de requerirlo)
    if (!Array.isArray(datos)) {
        datos = Object.values(datos);
    }

    datos.forEach(item => {
        const option = document.createElement("option");
        option.value = item[idCampo];
        option.textContent = item[tectoCampo];

        select.appendChild(option);
    })
}


//se manda toda la data del formulario para crear un analisis en la base de datos
const crearAnalisis = async (id) => {

    const id_resolucion = document.getElementById("resolucionSelect").value;
    const causa = document.getElementById('causaAnalisis').value;
    const solucion = document.getElementById("comentariosAnalisis").value;
    const comentarios = document.getElementById('solucionAnalisis').value;
    
    const data = {
        id,
        id_resolucion,
        causa,
        solucion,
        comentarios
    };

console.log(data);
    return;

    const response = await request('/api/new-analisis', 'POST', data);
    

    if (response.status == 200) {
        mostrarMensaje({
            titulo: "Confirmacion",
            mensaje: "El Analisis se creo correctamente",
            tipo: "success"
        });

    } else {
        mostrarMensaje({
            titulo: "Error",
            mensaje: response.body.mensaje || "No se pudo crear el analisis",
            tipo: "error"
        });
        return;
    }

    // ✅ éxito
    /* setTimeout(() => {
        window.location.href = "/prueba/distribuidora-esqueleto/tickets";
    }, 2000); */
}