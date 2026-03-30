    <?php

    use App\Core\Config; ?>

    <div class="bg-white dark:bg-gray-700 rounded-2xl pt-2">
      <?php
      $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'index';
      ?>

      <div role="tablist" class="tabs tabs-bordered flex justify-around">
        <button data-tab="index" class="tab tab-btn tab-active" hidden>Tickets</button>

        <button data-tab="nuevo" class="tab tab-btn" hidden>Nuevo ticket</button>
        <button data-tab="editar" class="tab tab-btn" hidden>Editar Ticket</button>
      </div>
      <div
        class="m-4 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800">
        <div class=" gap-2  px-5 py-4 sm:px-6 sm:py-5">

          <!-- Application nav menu button -->

          <div id="tab-content ">

            <!-- TAB 1 -->
            <div id="index" class="tab-pane">
              <?php include_once 'componentes/tickets.php' ?>
            </div>
            <!-- TAB 2 -->

            <div id="editar" class="tab-pane hidden">
              <?php //include_once 'componentes/nuevo-ticket.php' 
              ?>
            </div>
            <div id="nuevo" class="tab-pane hidden">
              <?php // include_once 'componentes/editar-ticket.php' 
              ?>
            </div>


          </div>

          <!--  <div id="tab-content" class="max-w-full overflow-x-auto">
       
          </div> -->


        </div>


      </div>
    </div>
    <!-- cargado de pantalla -->
    <div id="loader-overlay" class="fixed inset-0 bg-gray-950 flex items-center justify-center z-999999 ">
      <div class="bg-white p-6 rounded-2xl shadow-theme-md flex flex-col items-center gap-3">
        <div class="w-10 h-10 border-4 border-solid border-brand-500 border-t-transparent rounded-full animate-spin"></div>
        <p class="text-sm text-gray-700">Cargando, por favor espera...</p>
      </div>
    </div>




    <script>
      const BASE_URL = "<?php echo Config::get('app.base_url'); ?>";
    </script>

    <script src="src/js/lib/DataTables/datatables.js"></script>
    <script src="src/js/lib/DataTables/datatables-min.js"></script>
    <script>
      window.$ = window.jQuery = require('jquery');
    </script>
    <script>
      window.id_empleado = <?php echo $_SESSION['id_empleado']; ?>;
      window.usuario_nombre = "<?php echo $_SESSION['username']; ?>";
    </script>
    <!-- <script type="module" src="src/js/modules/tickets/editar-ticket.js"></script> -->
    <script type="module" src="src/js/modules/tickets/ticket.js"></script>