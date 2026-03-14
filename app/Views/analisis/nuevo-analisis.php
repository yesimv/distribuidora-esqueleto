<!-- Analisis tecnico -->
<div
    class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
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


                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                    @change="isOptionSelected = true">
                    <option
                        value=""
                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Resuelto
                    </option>
                    <option
                        value=""
                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        No resuelto
                    </option>
                    <option
                        value=""
                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Declinado
                    </option>
                    <option
                        value=""
                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                        Duplicado
                    </option>


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
            class="  grid p-5 sm:p-6 grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 items-center ">

            <!-- Causa -->

            <div class="         ">
                <label
                    class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                    Causa
                </label>
                <textarea
                    placeholder="..."
                    type="text"
                    rows="6"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
            </div>

            <!-- Solucion -->

            <div class="         ">
                <label
                    class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                    Solucion
                </label>
                <textarea
                    placeholder="Solucion aplicada..."
                    type="text"
                    rows="6"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
            </div>

            <!-- Comentarios -->

            <div class="         ">
                <label
                    class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                    Comentarios
                </label>
                <textarea
                    placeholder="Comentarios adicionales..."
                    type="text"
                    rows="6"
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
            </div>


        </div>

    </div>
    <!-- Resolucion -->
    <div class=" border-y  border-gray-100 p-5    dark:border-gray-800       ">

        <button

            class=" btn-light">
            Cancelar
        </button>
        <button

            class="  btn-primary">
            Cerrar ticket
        </button>
    </div>

</div>
