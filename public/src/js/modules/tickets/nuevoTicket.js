import { request } from '../../core/http.js';
import { mostrarMensaje,initModal,abrirModalConfirm } from "../../core/modal.js";
let empleadosGlobal = [];
let departamentosGlobal = [];


document.addEventListener("DOMContentLoaded", function () {
    const tablaFechasTicket = document.querySelector('#formulario-ticket-nuevo');

    const departamentoSelect = document.getElementById("departamentoSelect");
    const departamentoSolSelect = document.getElementById("departamentoSolSelect");
    const empleadoSolSelect = document.getElementById("empleadoSolSelect");

    departamentoSelect.addEventListener("change", function () {

        const valorDepto = this.value;
        if (valorDepto == departamentoSolSelect.value) {

            //   habilitar selects
            departamentoSolSelect.disabled = false;
            empleadoSolSelect.disabled = false;

            //   volver a llenar departamentos
            llenarSelect(
                "departamentoSolSelect",
                departamentosGlobal,
                "id_departamento",
                "descripcion"
            );

            //   filtrar empleados por departamento seleccionado
            const empleadosFiltrados = empleadosGlobal.filter(emp =>
                emp.id_departamento == valorDepto
            );

            llenarSelect(
                "empleadoSolSelect",
                empleadosFiltrados,
                "id_empleado",
                "descripcion"
            );
        }


    });

    //filtro para empleados al eleccionar departamento
    document.getElementById("departamentoSelect")
        .addEventListener("change", function () {

            const idDepartamento = this.value;
            console.log(idDepartamento);
            filtrarEmpleados(idDepartamento);

        });
    //filtro para departamento al seleccionar empleado
    document.getElementById("empleadoSelect")
        .addEventListener("change", function () {

            const idEmpleado = this.value;

            if (!idEmpleado) return;

            autoSeleccionarDepartamento(idEmpleado);
        });
    //filtro para empleados al eleccionar departamento
    document.getElementById("departamentoSolSelect")
        .addEventListener("change", function () {

            const idDepartamentoSol = this.value;
            console.log(idDepartamentoSol);
            filtrarEmpleadosSol(idDepartamentoSol);

        });
    //filtro para departamento al seleccionar empleado
    document.getElementById("empleadoSolSelect")
        .addEventListener("change", function () {

            const idEmpleadoSol = this.value;

            if (!idEmpleadoSol) return;

            autoSeleccionarDepartamentoSol(idEmpleadoSol);
        });
    //para crear un ticket nuevo
    const btnCrearTicket = document.getElementById("btn-formulario-ticket-nuevo").addEventListener('click', () => {

        const selects = document.querySelectorAll('select');
        const titulo = document.querySelector('#tituloArea');
        let valido = true;

        selects.forEach(select => {
            //   excluir selects por id
            if (select.id === 'empleadoSelect') {
                return;
            }
            if (select.value === "" || select.value === null) {
                valido = false;
                select.classList.add('border-red-500'); // opcional visual
            } else {
                select.classList.remove('border-red-500');
            }
        });
        if (titulo.value === "" || titulo.value === null) {
            valido = false;
        }

        if (!valido) {
            mostrarMensaje({
                titulo: "Atención",
                mensaje: "El titulo y los campos de opcion multiple son obligatorios",
                tipo: "error"
            });

            return;
        }

        //   Si pasa validación, ahora sí envías
        crearTicket();
    });
    valoresFormulario();
    eventos();


});
const eventos = () => {

    document.getElementById('cancel-create').addEventListener('click', () => {
        abrirModalConfirm({
            titulo: "Cancelar registro",
            mensaje: `¿Seguro que deseas cancelar el registro?, Ningún cambio será guardado.`,
            
            onConfirm: async () => {
                window.location.href = "/prueba/distribuidora-esqueleto/tickets";
            }
        });
        

    });
    //botones del modal
    initModal();
}

function filtrarEmpleados(idDepartamento) {

    //si no hay departamento → mostrar TODOS
    if (!idDepartamento) {
        llenarSelect("empleadoSelect", empleadosGlobal, "id_empleado", "descripcion");
        return;
    }

    const empleadosFiltrados = empleadosGlobal.filter(emp =>
        emp.id_departamento == idDepartamento
    );

    llenarSelect("empleadoSelect", empleadosFiltrados, "id_empleado", "descripcion");
}
function autoSeleccionarDepartamento(idEmpleado) {

    const empleado = empleadosGlobal.find(emp =>
        emp.id_empleado == idEmpleado
    );

    if (!empleado) return;

    const departamentoSelect = document.getElementById("departamentoSelect");

    //asignar departamento
    departamentoSelect.value = empleado.id_departamento;

}
function filtrarEmpleadosSol(idDepartamentoSol) {

    //si no hay departamento → mostrar TODOS
    if (!idDepartamentoSol) {
        llenarSelect("empleadoSolSelect", empleadosGlobal, "id_empleado", "descripcion");
        return;
    }

    const empleadosSolFiltrados = empleadosGlobal.filter(emp =>
        emp.id_departamento == idDepartamentoSol
    );

    llenarSelect("empleadoSolSelect", empleadosSolFiltrados, "id_empleado", "descripcion");
}
function autoSeleccionarDepartamentoSol(idEmpleado) {

    const empleado = empleadosGlobal.find(emp =>
        emp.id_empleado == idEmpleado
    );

    if (!empleado) return;

    const departamentoSolSelect = document.getElementById("departamentoSolSelect");

    //asignar departamento
    departamentoSolSelect.value = empleado.id_departamento;

}
const valoresFormulario = async () => {
    //se piden los datos para el formulario desde la base de datos
    const dataForms = await request('/api/get-form-data', 'GET');
    console.log(dataForms);


    const r = dataForms;
    empleadosGlobal = r.empleado;
    departamentosGlobal = r.departamento;
    llenarSelect("departamentoSolSelect", r.departamento_sol, "id_departamento", "descripcion");
    llenarSelect("empleadoSolSelect", r.empleado_sol, "id_empleado", "descripcion");
    llenarSelect("estacionSelect", r.estacion, "id_estacion", "descripcion");

    llenarSelect("areaSelect", r.area_afectada, "id_area_afectada", "descripcion");
    llenarSelect("canalSelect", r.canal_contacto, "id_canal_contacto", "descripcion");
    llenarSelect("categoriaSelect", r.categoria, "id_categoria", "descripcion");
    llenarSelect("departamentoSelect", r.departamento, "id_departamento", "descripcion");
    llenarSelect("empleadoSelect", r.empleado, "id_empleado", "descripcion");

    //llenarSelect("estatusSelect", r.estatus, "id_estatus", "descripcion");
    llenarSelect("nivelSelect", r.lvl_afectacion, "id_lvl_afectacion", "descripcion");
    llenarSelect("prioridadSelect", r.prioridad, "id_prioridad", "descripcion");
    llenarSelect("tipoSelect", r.tipo, "id_tipo", "descripcion");

}
function llenarSelect(selectId, datos, idCampo, textoCampo) {

    const select = document.getElementById(selectId);

    select.innerHTML = '<option value=""></option>';

    if (!datos || (Array.isArray(datos) && datos.length === 0)) {
        console.warn("Datos vacíos:", selectId);
        return;
    }

    //   si viene como objeto único → convertirlo a array
    if (!Array.isArray(datos)) {
        datos = [datos];
    }

    datos.forEach(item => {

        const option = document.createElement("option");

        option.value = item[idCampo];
        option.textContent = item[textoCampo];

        select.appendChild(option);

    });

    //   SI SOLO HAY UNO → seleccionarlo y bloquear
    if (datos.length === 1) {
        select.value = datos[0][idCampo];
        select.disabled = true;
    } else {
        select.disabled = false;
    }
    select.classList.toggle("select-disable", select.disabled);
}


//se manda toda la data del formulario para crear un ticket en la base de datos
const crearTicket = async () => {

    const id_departamento_sol = document.getElementById("departamentoSolSelect").value;
    const id_empleado_sol = document.getElementById("empleadoSolSelect").value;
    const titulo = document.getElementById('tituloArea').value;
    //const adjunto_form = document.getElementById("demo-upload").value;
    const id_departamento_asi = document.getElementById("departamentoSelect").value;
    const id_estacion = document.getElementById("estacionSelect").value;
    const id_tipo = document.getElementById("tipoSelect").value;
    const id_area_afectada = document.getElementById("areaSelect").value;
    const id_prioridad = document.getElementById("prioridadSelect").value;
    const id_lvl_afectacion = document.getElementById("nivelSelect").value;
    const id_empleado_asi = document.getElementById("empleadoSelect").value;
    //const id_estatus = document.getElementById("estatusSelect").value;
    const id_categoria = document.getElementById("categoriaSelect").value;
    const id_canal_contacto = document.getElementById("canalSelect").value;
    const se_creo_en_tiempo = document.getElementById("enTiempo").checked;
    const descripcion = document.getElementById('descripcionArea').value;
    const comentarios = document.getElementById("comentariosArea").value;

    const data = {
        id_departamento_sol,
        id_empleado_sol,
        titulo,
        //adjunto_form,
        id_departamento_asi,
        id_estacion,
        id_tipo,
        id_area_afectada,
        id_prioridad,
        id_lvl_afectacion,
        id_empleado_asi,
        //id_estatus,
        id_categoria,
        id_canal_contacto,
        se_creo_en_tiempo,
        descripcion,
        comentarios
    };



    const response = await request('/api/new-ticket', 'POST', data);
    console.log(response);


    if (response.status == 200) {
        mostrarMensaje({
            titulo: "Confirmacion",
            mensaje: "El ticket se creo correctamente",
            tipo: "success"
        });

    } else {
        mostrarMensaje({
            titulo: "Error",
            mensaje: response.body.mensaje || "No se pudo crear el ticket",
            tipo: "error"
        });
        return;
    }

    // ✅ éxito
    setTimeout(() => {
        window.location.href = "/prueba/distribuidora-esqueleto/tickets";
    }, 2000);

    
}

