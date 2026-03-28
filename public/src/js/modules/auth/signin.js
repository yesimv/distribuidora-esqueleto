import { request } from '../../core/http.js';

document.addEventListener("DOMContentLoaded", function () {
    eventos();
});

const eventos = () => {
    const formulario = document.querySelector('#formulario-login');

    document.getElementById('email').addEventListener('input', function () {
        limpiarError(this);
    });

    document.getElementById('password').addEventListener('input', function () {
        limpiarError(this);
    });
    formulario.addEventListener('submit', (e) => {
        e.preventDefault();
        login();
    });
};

//   helpers reutilizables
function mostrarError(input, mensaje) {
    const error = document.getElementById(`error-${input.id}`);
    error.textContent = mensaje;
    error.classList.remove('hidden');
    input.classList.add('border-red-500');
}

function limpiarError(input) {
    const error = document.getElementById(`error-${input.id}`);
    error.textContent = '';
    error.classList.add('hidden');
    input.classList.remove('border-red-500');
}

const login = async () => {

    const emailInput = document.getElementById('email');
    const passInput = document.getElementById('password');

    const email = emailInput.value.trim();
    const pass = passInput.value.trim();

    let valido = true;

    // 🔹 VALIDACIÓN FRONT
    if (!email) {
        mostrarError(emailInput, 'El correo es obligatorio');
        valido = false;
    } else if (!email.includes('@')) {
        mostrarError(emailInput, 'Ingresa un correo válido');
        valido = false;
    } else {
        limpiarError(emailInput);
    }

    if (!pass) {
        mostrarError(passInput, 'La contraseña es obligatoria');
        valido = false;
    } else {
        limpiarError(passInput);
    }

    if (!valido) return; // ⛔ no hace request

    // 🔹 REQUEST
    const data = {
        email: email,
        pwd: pass
    };

    const resp = await request('/api/login', 'POST', data);

    //   ERROR BACKEND (credenciales incorrectas, etc.)
    if (!resp['success']) {

        // puedes decidir dónde mostrarlo
        mostrarError(passInput, resp['message'] || 'Credenciales incorrectas');
        return;
    }

    // ✅ éxito
    window.location.href = "/prueba/distribuidora-esqueleto/";
};