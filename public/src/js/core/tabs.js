

document.addEventListener("DOMContentLoaded", () => {

  const tabs = document.querySelectorAll('.tab-btn');
  const panes = document.querySelectorAll('.tab-pane');

  tabs.forEach(tab => {

    tab.addEventListener('click', () => {

      const target = tab.dataset.tab;

      // quitar activo
      tabs.forEach(t => t.classList.remove('tab-active'));

      // ocultar todos
      panes.forEach(p => p.classList.add('hidden'));

      // activar tab
      tab.classList.add('tab-active');

      // mostrar contenido
      document.getElementById(target).classList.remove('hidden');

    });

  });

});

