    <?php

    use App\Core\Config; ?>
<div class="bg-white pt-2">
  <?php
  $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'index';
  ?>

  <div role="tablist" class="tabs tabs-bordered flex justify-around">
    <button data-tab="index" class="tab tab-btn tab-active">Tickets</button>
    <button data-tab="nuevo" class="tab tab-btn">Nuevo Ticket</button>
    <button data-tab="mensajes" class="tab tab-btn">Mensajes</button>
  </div>
  <div
    class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class=" gap-2  px-5 py-4 sm:px-6 sm:py-5">

      <!-- Application nav menu button -->



      <div class="max-w-full overflow-x-auto">
        
          <table id="tabla-analisis" class=" display w-full">
          
      </div>

      
    </div>

  </div>
</div>




<script type="module" src="src/js/modules/analisis/tablaAnalisis.js"></script>