
          <div class="space-y-5 sm:space-y-6">
            <div
              class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
              <div class="px-5 py-4 sm:px-6 sm:py-5">
                <h3
                  class="text-base font-medium text-gray-800 dark:text-white/90">
                  Tickets
                </h3>
              </div>
              <div
                class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                <!-- ====== Table Six Start -->
                <div
                  class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                  <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                      <!-- table header start -->
                      <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Fue eliminado
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Titulo
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Solicitante
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Dept. solicitante
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Estatus
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Priordad
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Empleado asignado
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                Acciones
                              </p>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <!-- table header end -->
                      <!-- table body start -->
                      <tbody class="divide-y divide-gray-100 dark:divide-gray-800">

                        <?php foreach ($listaTickets as $index => $elemento) {
                        ?>
                          <tr>

                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $elemento['is_delete'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $elemento['titulo'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $elemento['empleado_solicitante'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                  <?php echo $elemento['departamento_solicitante'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p class=" <?php echo $elemento['estatus_class'] ?>">
                                  <?php echo $elemento['estatus'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="<?php echo $elemento['prioridad_class'] ?>">
                                  <?php echo $elemento['prioridad'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <p
                                  class="btn-light-light-mini">
                                  <?php echo $elemento['empleado_asignado'] ?>
                                </p>
                              </div>
                            </td>
                            <td class="px-5 py-4 sm:px-6">
                              <div class="flex items-center">
                                <div class="flex items-center flex-row gap-1">
                                  <form action="/cerrar" method="POST">
                                    <button
                                      type="submit"
                                      class=" relative group w-max">
                                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#15803e">
                                        <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                      </svg>

                                      <span class="pop-text bg-success-500">Cerrar</span>
                                    </button>
                                  </form>
                                  <form action="/ver-mas" method="POST">
                                    <button
                                      type="submit"
                                      class=" relative group w-max">
                                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#d97706">
                                        <path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                      </svg>
                                      <span class="pop-text bg-warning-500">Ver mas</span>
                                    </button>
                                  </form>

                                  <button
                                    
                                    class=" relative group w-max btn-cancel"
                                    data-id="<?= $elemento['id_ticket']; ?>"
                                    data-message="¿Seguro que deseas cancelar este ticket?">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#c20e1a">
                                      <path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                    </svg>

                                    <span class="pop-text bg-brand-500">Eliminar</span>
                                  </button>

                                </div>
                              </div>
                            </td>
                          </tr>
                        <?php
                        }

                        ?>


                      </tbody>

                    </table>
                  </div>
                </div>
                <!-- ====== Table Six End -->
              </div>
            </div>
          </div>

