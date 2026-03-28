    <?php

    use App\Core\Config; ?>
    <!doctype html>
    <html lang="es">

    <?php include 'head.php'; ?>

    <body
        x-data="{ page: '', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
        x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
        :class="{'dark bg-gray-900': darkMode === true}">

        <!-- ventana de carga -->

        <!-- ventana de carga -->
        <?php // include 'loader.php'; 
        ?>

        <!-- ===== Page Wrapper Start ===== -->
        <div class="flex h-screen overflow-hidden">
            <!-- ===== Sidebar Start ===== -->
            <?php include 'sidebar.php' ?>
            <!-- ===== Sidebar End ===== -->

            <!-- ===== Content Area Start ===== -->
            <div
                class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">

                <!-- Small Device Overlay Start -->
                <div
                    @click="sidebarToggle = false"
                    :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                    class="fixed w-full h-screen bg-gray-950"></div>
                <!-- Small Device Overlay End -->

                <!-- ===== Header Start ===== -->
                <?php include 'header.php' ?>
                <!-- ===== Header End ===== -->

                <!-- ===== Main Content Start ===== -->
                <main>
                    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                        <!-- Breadcrumb Start -->
                        <div x-data="{ pageName: '<?= $pageName ?? "Dashboard" ?>' }">
                            <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
                                <h2
                                    class="text-xl font-semibold text-gray-800 dark:text-white/90"
                                    x-text="pageName"></h2>

                                <nav>
                                    <ol class="flex items-center gap-1.5">
                                        <li>
                                            <a
                                                class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400"
                                                href=<?php echo Config::get('app.base_url') . "/" ?>>
                                                Inicio
                                                <svg
                                                    class="stroke-current"
                                                    width="17"
                                                    height="16"
                                                    viewBox="0 0 17 16"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366"
                                                        stroke=""
                                                        stroke-width="1.2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </a>
                                        </li>
                                        <li
                                            class="text-sm text-gray-800 dark:text-white/90"
                                            x-text="pageName"></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <!-- Breadcrumb End -->
                        <div id="loader-overlay" class="fixed inset-0 bg-gray-950 flex items-center justify-center z-999999 ">

                            <div class="bg-white p-6 rounded-2xl shadow-theme-md flex flex-col items-center gap-3">

                                <!-- spinner -->
                                <div class="w-10 h-10 border-4 border-solid border-brand-500 border-t-transparent rounded-full animate-spin"></div>

                                <p class="text-sm text-gray-700">Cargando, por favor espera...</p>

                            </div>

                        </div>
                        <?php echo $content; ?>

                    </div>
                </main>
                <!-- ===== Main Content End ===== -->

            </div>
            <!-- ===== Content Area End ===== -->

        </div>
        <!-- ===== modal de confirmacion ===== -->
        <div id="modal-confirm" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-999999 ">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl  w-[90%] max-w-[400px] min-w-[300px] mx-auto translate-y-10 shadow-theme-md">

                <h2 id="modal-title" class="text-lg font-semibold mb-4">Confirmar</h2>

                <p id="modal-message" class="text-sm text-gray-600 dark:text-gray-200 mb-6">
                    ¿Estás seguro?
                </p>

                <div class="flex justify-end gap-3">
                    <button id="cancelar" class="px-4 py-2 bg-gray-300 dark:bg-gray-800 rounded-lg">Cancelar</button>
                    <button id="confirmar" class="px-4 py-2 bg-brand-500 text-white rounded-lg ">Aceptar</button>
                </div>

            </div>
        </div>
        <!-- ===== modal informativo ===== -->
        <div id="modal-msg" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-999999">

            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl w-[90%] max-w-[400px] min-w-[300px] shadow-theme-md">

                <h2 id="msg-title" class="text-lg font-semibold mb-4"></h2>

                <p id="msg-text" class="text-sm text-gray-600 dark:text-gray-200 mb-6"></p>

                <div class="flex justify-end">
                    <button id="msg-close" class="px-4 py-2 bg-brand-500 text-white rounded-lg">
                        Cerrar
                    </button>
                </div>

            </div>
        </div>
        <!-- ===== modal datos ticket ===== -->

        <div id="modal-ver-ticket" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 px-4 ">

            <div class="  w-[90%] max-w-[400px] min-w-[300px] mx-auto rounded-2xl overflow-hidden modal-info-ticket">

                <!-- HEADER -->
                <div class="flex justify-between items-center px-6 py-4 border-b dark:border-gray-700 ">
                    <h2 class="text-lg font-semibold">Detalle del Ticket</h2>
                    <button id="msg-info-ticket-close" class="text-gray-500 hover:text-red-500 text-xl">
                        ✕
                    </button>
                </div>

                <!-- BODY -->
                <div class="p-6 space-y-6 max-h-[80vh] overflow-y-auto">

                    <!-- INFO GENERAL -->
                    <div class="grid-info-general">

                        <div class="flex flex-col w-40">
                            <label class="text-xs text-gray-500">ID</label>
                            <div id="ver-id" class="font-medium"></div>
                        </div>
                        <div class="flex flex-col w-40">

                        </div>


                        <div class="flex flex-col w-48">
                            <label class="text-xs text-gray-500">Tiempo estimado</label>
                            <div id="ver-tiempo-estimado"></div>
                        </div>

                        <div class="flex flex-col w-48">
                            <label class="text-xs text-gray-500">Tiempo real</label>
                            <div id="ver-tiempo-real"></div>
                        </div>

                    </div>
                    <!-- SOLICITANTE -->
                    <div class="grid-info-empleado">
                        <div class="flex flex-col w-60">
                            <label class="text-xs text-gray-500">Departamento solicitante</label>
                            <div id="ver-departamento-solicitante"></div>
                        </div>

                        <div class="flex flex-col w-60">
                            <label class="text-xs text-gray-500">Empleado solicitante</label>
                            <div id="ver-empleado-solicitante"></div>
                        </div>
                    </div>

                    <!-- ESTACION -->
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-500">Estación</label>
                        <div id="ver-estacion"></div>
                    </div>
                    <!-- TITULO -->
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-500">Título</label>
                        <div id="ver-titulo" class="font-medium"></div>
                    </div>


                    <!-- DESCRIPCIÓN -->
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-500">Descripción</label>
                        <div id="ver-descripcion" class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg"></div>
                    </div>

                    <!-- COMENTARIOS -->
                    <div class="flex flex-col">
                        <label class="text-xs text-gray-500">Comentarios</label>
                        <div id="ver-comentarios" class="bg-gray-50 dark:bg-gray-800 p-3 rounded-lg"></div>
                    </div>



                    <!-- DETALLES TECNICOS -->
                    <div class="grid-info-detalles">

                        <div class="flex flex-col">
                            <label class="text-xs text-gray-500">Área afectada</label>
                            <div id="ver-area-afectada"></div>
                        </div>
                        <div class="flex flex-col">
                            <label class="text-xs text-gray-500">Categoría</label>
                            <div id="ver-categoria"></div>
                        </div>


                        <div class="flex flex-col w-40">
                            <label class="text-xs text-gray-500">Tipo</label>
                            <div id="ver-tipo"></div>
                        </div>




                        <div class="flex flex-col ">
                            <label class="text-xs text-gray-500">Nivel de afectación</label>
                            <div id="ver-nivel-afectacion"></div>
                        </div>

                        <div class="flex flex-col">
                            <label class="text-xs text-gray-500">Prioridad</label>
                            <div id="ver-prioridad"></div>
                        </div>

                        <div class="flex flex-col ">
                            <label class="text-xs text-gray-500">Estatus</label>
                            <div id="ver-estatus"></div>
                        </div>
                    </div>

                    <!-- ASIGNACIÓN -->
                    <div class="grid-info-empleado">
                        <div class="flex flex-col w-60">
                            <label class="text-xs text-gray-500">Departamento asignado</label>
                            <div id="ver-departamento-asignado"></div>
                        </div>

                        <div class="flex flex-col w-60">
                            <label class="text-xs text-gray-500">Empleado asignado</label>
                            <div id="ver-empleado-asignado"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- modal Analisis tecnico -->
        <div id="modal-crear-analisis" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center z-50 px-4 ">
            <div  class="  w-[90%] max-w-[400px] min-w-[300px] mx-auto rounded-2xl overflow-hidden modal-info-ticket">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                    <h3
                        class="text-base font-medium text-gray-800 dark:text-white/90  ">
                        Analisis técnico
                    </h3>
                </div>

                <div class="">
                    <!-- Resolucion -->
                    <div class=" border-y  border-gray-100 p-5    dark:border-gray-800       ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Resolución
                        </label>
                        <div
                            x-data="{ isOptionSelected: false }"
                            class="relative z-20 bg-transparent">
                            <select
                                id="resolucionSelect"

                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                @change="isOptionSelected = true">


                            </select>
                            <span
                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg
                                    class="stroke-current"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396"
                                        stroke=""
                                        stroke-width="1.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div
                        class="  grid p-5 sm:p-6 grid-cols-1  gap-4 items-center ">

                        <!-- Causa -->

                        <div class=" flex flex-col">
                            <label
                                class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                                Causa
                            </label>
                            <textarea
                                id="causaAnalisis"
                                placeholder="..."
                                type="text"
                                rows="2"
                                class=" dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                        </div>

                        <!-- Solucion -->

                        <div class="flex flex-col">
                            <label
                                class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                                Solucion
                            </label>
                            <textarea
                                id="solucionAnalisis"
                                placeholder="Solucion aplicada..."
                                type="text"
                                rows="2"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                        </div>

                        <!-- Comentarios -->

                        <div class="flex flex-col">
                            <label

                                class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                                Comentarios
                            </label>
                            <textarea
                                id="comentariosAnalisis"
                                placeholder="Comentarios adicionales..."
                                type="text"
                                rows="2"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                        </div>


                    </div>

                </div>
                <!-- Resolucion -->
                <div class=" border-y  border-gray-100 p-5    dark:border-gray-800  flex justify-between     ">

                    <button
                        id='cancel-analisis'
                        class=" btn-light">
                        Cancelar
                    </button>
                    <button
                        id='btn-formulario-analisis-nuevo'
                        class="  btn-primary">
                        Crear Analisis
                    </button>
                </div>

            </div>
        </div>


        <!-- ===== Texto informativo que sigue al cursor ===== -->
        <div id="tooltip" class="pop-text"></div>
        <!-- ===== Page Wrapper End ===== -->
        <?php

        include 'scripts.php';

        ?>

    </body>

    </html>