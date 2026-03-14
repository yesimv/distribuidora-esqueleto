

import { buttonPop } from '../../core/buttonPop.js';
import { request } from '../../core/http.js'
import { tabla } from '../../core/tabla.js'

document.addEventListener("DOMContentLoaded", function () {


  tablaAnalisis();
  btnPop();

});

const btnPop = () => {

  buttonPop();

};


const tablaAnalisis = async () => {
 


    const columnas = [
      { data: 'id_ticket', title: 'ID Ticket' },
      { data: 'id_analisis_tecnico', title: 'ID Analisis' },
      { data: 'id_resolucion', title: 'ID resolucion'},
      { data: 'causa', title: 'Causa' },
      { data: 'solucion', title: 'Solución' },
      { data: 'comentarios', title: 'Comentarios' },
      { data: 'tiempo_est', title: 'Tiempo estimado'},
      { data: 'tiempo_real', title: 'Tiempo real'}
    ];
    
    
    const dataSource = await request('/api/analisis', 'GET');
    console.log(columnas);
    const dt = tabla('#tabla-analisis', columnas, dataSource);

 

}
