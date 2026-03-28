import {loader} from './loader.js';
/**
 * Realiza una petición HTTP usando fetch
 * @param {string} url - Ruta a la que se enviará la petición
 * @param {string} method - Método HTTP (GET, POST, PUT, DELETE)
 * @param {Object|null} data - Datos a enviar (si aplica)
 * @returns {Promise<Object>} - Devuelve respuesta JSON
 */
export async function request(url, method = "GET", data = null) {
    const options = {
        method: method,
        headers: {
            "Content-Type": "application/json"
        }
    };
    if (data && method !== "GET") {
        options.body = JSON.stringify(data);
    }
    try {
        loader.show(); // muestra la ventana de carga
        // Construir URL correctamente: Asegurar que haya barra entre BASE_URL y url
        // let finalUrl = CONFIG['BASE_URL'];
        // if (finalUrl && !finalUrl.endsWith('/')) {
        //     finalUrl += '/';
        // }
        // Remover barra inicial de url si existe
        url = url.startsWith('/') ? url.substring(1) : url;
        
        //finalUrl += url;
        const response = await fetch(url, options);
        // Intentamos parsear JSON
        const result = await response.json();
        // Si el status HTTP no es 200-299
        // if (!response.ok) {
        //     throw new Error(result.message || "Error en la solicitud");
        // }
        return result;
    } catch (error) {
        console.error("HTTP Error:", error);
        throw error;
    }finally{
         loader.hide();
    }
}