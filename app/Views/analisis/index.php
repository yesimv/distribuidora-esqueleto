    <?php

    use App\Core\Config; ?>
    <div class="bg-white dark:bg-gray-800 pt-2">
      <?php
      $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'index';
      ?>

      <div role="tablist" class="tabs tabs-bordered flex justify-around">
        <button data-tab="index" class="tab tab-btn tab-active">Analisis</button>
        <button data-tab="nuevo" class="tab tab-btn">Nuevo Analisis</button>
      </div>
      <div
        class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-800">
        <div class=" gap-2  px-5 py-4 sm:px-6 sm:py-5">

          <!-- Application nav menu button -->



          <div class="max-w-full overflow-x-auto">
            <div class="   py-4 border-y dark:border-gray-700">
              <h3>Filtro por fechas</h3>
              <!-- Elements -->
              <div id="filtro-ticket-fecha" class=" grid items-end grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 w-fit gap-4 ">
                <div>
                  <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Fecha Inicio
                  </label>

                  <div class="relative">
                    <input
                      id='fch-inicio'
                      name='fch-inicio'
                      type="text"
                      placeholder="Seleccione fecha"
                      class="input-fecha dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      onclick="this.showPicker()" />
                    <span
                      class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                      <svg
                        class="fill-current"
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                          fill="" />
                      </svg>
                    </span>
                  </div>
                </div>

                <!-- Elements -->
                <div>
                  <label
                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Fecha Fin
                  </label>

                  <div class="relative">
                    <input
                      id='fch-fin'
                      name='fch-fin'
                      type="text"
                      placeholder="Seleccione fecha"
                      class="input-fecha  dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                      onclick="this.showPicker()" />
                    <span
                      class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                      <svg
                        class="fill-current"
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                          fill="" />
                      </svg>
                    </span>
                  </div>
                </div>
                <button

                  id="btn-filtro-fecha-analisis"
                  class=" btn btn-primary w-fit h-fit">
                  Buscar Coincidencias
                </button>
              </div>
            </div>
            <div class="overflow-x-auto pt-4">
              <table id="tabla-analisis" class=" display w-full"></table>
            </div>


          </div>


        </div>

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

    <script type="module" src="src/js/modules/analisis/tablaAnalisis.js"></script>