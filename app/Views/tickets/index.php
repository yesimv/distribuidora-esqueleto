    <?php

    use App\Core\Config; ?>
    <div class="bg-white dark:bg-gray-700 rounded-2xl pt-2">
      <?php
      $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'index';
      ?>

      <div role="tablist" class="tabs tabs-bordered flex justify-around">
        <button data-tab="index" class="tab tab-btn tab-active" hidden>Tickets</button>
        <button data-tab="fecha" class="tab tab-btn " >Filtro por fecha</button>
        <button data-tab="nuevo" class="tab tab-btn" hidden>Nuevo ticket</button>
        <button data-tab="editar" class="tab tab-btn" hidden>Editar Ticket</button>
      </div>
      <div
        class="m-4 rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-700">
        <div class=" gap-2  px-5 py-4 sm:px-6 sm:py-5">

          <!-- Application nav menu button -->

          <div id="tab-content ">

          <!-- TAB 1 -->
            <div id="index" class="tab-pane">
              <?php include_once 'componentes/tickets.php' ?>
            </div>
           <!-- TAB 2 -->
            <div id="fecha" class="tab-pane  hidden">
              <?php include_once 'componentes/fecha-ticket.php' ?>
            </div>
            <div id="editar" class="tab-pane hidden">
              <?php include_once 'componentes/tabla-cancelados.php' ?>
            </div>
            <div id="nuevo" class="tab-pane hidden">
              <?php include_once 'componentes/nuevo-ticket.php' ?>
            </div>


          </div>

          <!--  <div id="tab-content" class="max-w-full overflow-x-auto">
       
      </div> -->


        </div>

      </div>
    </div>




    <script>
      const BASE_URL = "<?php echo Config::get('app.base_url'); ?>";
    </script>

    
    <script type="module" src="src/js/modules/tickets/ticket.js"></script>
     <script type="module" src="src/js/modules/tickets/filtroFechas.js"></script>