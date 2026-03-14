import {request} from '../../core/http.js'

document.addEventListener("DOMContentLoaded", function () {
    eventos();
});

const eventos =()=>{
    const formulario = document.querySelector('#formulario-login');

    formulario.addEventListener('submit', (e) => {
        e.preventDefault(); // 🚫 Evita que se recargue la página
        login();
    });
    
}

const login =async()=>{
    const email = document.getElementById('email').value;
    const pass =document.getElementById('password').value;
    const data = {
        'email':email,
        'pwd':pass
    };
    
    const resp = await request('/api/login','POST',data);
    
    if(!resp['success']){
        console.error(resp['message']);
        return;
    }
    
    
    window.location.href = "/prueba/distribuidora-esqueleto/";    

}