import { request } from '../../core/http.js'


document.addEventListener("DOMContentLoaded", function () {
    const tablaFechasTicket = document.querySelector('#formulario-ticket-nuevo');
    const btnCrearTicket = document.getElementById("btn-formulatio-ticket-nuevo");

    btnCrearTicket.addEventListener("click", crearTicket);
    document.getElementById("areaSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("canalSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("categoriaSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("departamentoSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("empleadoSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("estacionSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("estatusSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("nivelSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("prioridadSelect").innerHTML = '<option>Cargando...</option>';
    document.getElementById("tipoSelect").innerHTML = '<option>Cargando...</option>';
    valoresFormulario();
    btn.addEventListener('click', () => {

        crearTicket();

    });
});
const valoresFormulario = async () => {
    const dataForms = await request('/api/get-form-data', 'GET');


    console.log(dataForms.body.resultado);
    const r = dataForms.body.resultado;
    llenarSelect("areaSelect", r.area_afectada, "id_area_afectada", "descripcion");
    llenarSelect("canalSelect", r.canal_contacto, "id_canal_contacto", "descripcion");
    llenarSelect("categoriaSelect", r.categoria, "id_categoria", "descripcion");
    llenarSelect("departamentoSelect", r.departamento, "id_departamento", "descripcion");
    llenarSelect("empleadoSelect", r.empleado, "id_empleado", "descripcion");
    llenarSelect("estacionSelect", r.estacion, "id_estacion", "descripcion");
    llenarSelect("estatusSelect", r.estatus, "id_estatus", "descripcion");
    llenarSelect("nivelSelect", r.lvl_afectacion, "id_lvl_afectacion", "descripcion");
    llenarSelect("prioridadSelect", r.prioridad, "id_prioridad", "descripcion");
    llenarSelect("tipoSelect", r.tipo, "id_tipo", "descripcion");



}
function llenarSelect(selectId, datos, idCampo, textoCampo) {

    const select = document.getElementById(selectId);

    select.innerHTML = '<option value="">Seleccione...</option>';

    if (!datos) {
        console.warn("Datos vacíos:", selectId);
        return;
    }

    // convertir objeto a array
    if (!Array.isArray(datos)) {
        datos = Object.values(datos);
    }

    datos.forEach(item => {

        const option = document.createElement("option");

        option.value = item[idCampo];
        option.textContent = item[textoCampo];

        select.appendChild(option);

    });

}

const crearTicket = async () =>{

    const titulo = document.querySelector('input[type="text"]').value;
    const adjunto_form = document.getElementById("adjunto-form").value;
    const comentarios = document.getElementById("comentariosInput").value;
    const en_tiempo = document.getElementById("enTiempo").value;

    const id_departamento = document.getElementById("departamentoSelect").value;
    const id_estacion = document.getElementById("estacionSelect").value;
    const id_tipo = document.getElementById("tipoSelect").value;
    const id_prioridad = document.getElementById("prioridadSelect").value;
    const id_categoria = document.getElementById("categoriaSelect").value;
    const descripcion = document.querySelector('textarea').value;

    const data = {
        titulo,
        id_departamento,
        id_estacion,
        id_tipo,
        id_prioridad,
        id_categoria,
        descripcion
    };

    console.log(data);

    const response = await request('/api/tickets-create', 'POST', data);

    console.log(response);

}

/* 
Dropzone.autoDiscover = false;

const uploader = new Dropzone("#adjunto-form", {

    url: "/upload",

    previewContainer: "#preview-container",

    previewsContainer: "#preview-container",

    addRemoveLinks: true,

    acceptedFiles: "image/*",

    dictRemoveFile: "Eliminar",

    previewTemplate: `
    <div class="relative group border rounded-lg overflow-hidden">

        <img data-dz-thumbnail class="w-full h-28 object-cover"/>

        <button data-dz-remove
            class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100">
            ✕
        </button>

        <div class="p-1 text-xs truncate" data-dz-name></div>

    </div>
    `
});

uploader.on("thumbnail", function (file) {
    file.previewElement.addEventListener("click", () => {

        const modal = document.createElement("div");

        modal.className =
            "fixed inset-0 bg-black/70 flex items-center justify-center z-50";

        modal.innerHTML =
            `<img src="${file.dataURL}" class="max-h-[90%] rounded">`;

        modal.onclick = () => modal.remove();

        document.body.appendChild(modal);

    });
}); */