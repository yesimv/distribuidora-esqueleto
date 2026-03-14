<!-- ====== Form Elements Section Start -->
<div class="grid grid-cols-1 gap-4  ">
    <div class="space-y-6 ">
        <!-- Creacion de ticket -->
        <div
            class="rounded-2xl  ">


            <div class="">
                <div
                    class="   grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 ">
                    <!-- Titulo -->
                    <div class="         ">
                        <label
                            class="mb-1.5  text-sm font-medium text-gray-700 dark:text-gray-400">
                            Titulo
                        </label>
                        <input
                            type="text"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>
                    <!-- Departamento a contactar -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Departamento a contactar
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
                                    Sistemas
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Mantenimiento
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
                    <!-- Estacion -->
                    <div class="         ">
                        <label
                            class="mb-1.5  text-sm font-medium text-gray-700 dark:text-gray-400">
                            Estacion
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
                                    Morelos
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Encinas
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Oriente
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Santa Clara
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    LLanito
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Pueblitos
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Parque industrial
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Salida Nogales
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Miguel Aleman
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Palo verde
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    El capitan
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Vado del rio
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Sacramento
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Corporativo
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Gaservicio distribuciones y transportes
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
                    <!-- Tipo de solicitud -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Tipo de solicitud
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
                                    Pregunta
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Incidencia
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Solicitud
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

                    <!-- Prioridad -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Prioridad
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
                                    Baja
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Media
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Alta
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Urgente
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

                    <!-- Nivel de afectacion -->
                    <div class="         ">
                        <label
                            class="mb-1.5  text-sm font-medium text-gray-700 dark:text-gray-400">
                            Nivel de afectacion
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
                                    Individual
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Departamento
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Estacion
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Empresa
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



                </div>
                <div
                    class="    grid grid-cols-1 sm:grid-cols-2 pt-5 gap-4 items-center ">
                    <!-- Descripcion -->

                    <div class="         ">
                        <h3
                            class="text-sm font-medium text-gray-800 dark:text-white/90 ">
                            Descripcion
                        </h3>
                        <textarea
                            placeholder="Introduce una descripcion..."
                            type="text"
                            rows="6"
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                    </div>
                    <!-- Comentarios -->
                    <div class="">
                        <div class="         ">
                            <h3
                                class="text-sm font-medium text-gray-800 dark:text-white/90 ">
                                Comentarios
                            </h3>
                            <textarea
                                placeholder="Comentarios adicionales..."
                                type="text"
                                rows="6"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                        </div>
                    </div>
                </div>

            </div>


            <div class="">
                <div
                    class="    grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4 items-center ">
                    <!-- Empleado asignado -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Empleado asignado
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
                                    Erick
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Luisa
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Yesenia
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
                    <!-- Estatus -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Estatus
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
                                    Nuevo
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    En proceso
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Cerrado
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Cancelado
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Reasignado
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
                    <!-- Categoria -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Categoria
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
                                    Error del sistema
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Nueva funcion
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Mejora
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Pruebas
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Seguridad
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Base de datos
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
                    <!-- Canal de contacto -->
                    <div class="         ">
                        <label
                            class="mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-400">
                            Canal de contacto
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
                                    Correo
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    WhatsApp
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Llamada
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Portal
                                </option>
                                <option
                                    value=""
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Otro
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


                    <!-- Creado en tiempo -->
                    <div x-data="{ switcherToggle: true }">
                        <label
                            for="enTiempo"
                            class="flex cursor-pointer items-center gap-3 text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                            <div class="relative">
                                <input
                                    type="checkbox"
                                    id="enTiempo"
                                    class="sr-only"
                                    @change="switcherToggle = !switcherToggle" />
                                <div
                                    class="block h-6 w-11 rounded-full"
                                    :class="switcherToggle ? 'bg-brand-500 dark:bg-brand-500' : 'bg-gray-200 dark:bg-white/10'"></div>
                                <div
                                    :class="switcherToggle ? 'translate-x-full': 'translate-x-0'"
                                    class="shadow-theme-sm absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white duration-300 ease-linear"></div>
                            </div>

                            Se creo en tiempo
                        </label>
                    </div>



                </div>

            </div>
            <!-- Subida de archivos -->
            
                <div class=" pt-5">
                    <h3
                        class="text-sm font-medium text-gray-800 dark:text-white/90">
                        Imagenes adjuntas
                    </h3>
                </div>
                <div
                    class="space-y-6  border-gray-100 dark:border-gray-800">
                    <form
                        class="dropzone hover:border-brand-500! dark:hover:border-brand-500! rounded-xl border border-dashed! border-gray-300! bg-gray-50 p-7 lg:p-10 dark:border-gray-700! dark:bg-gray-900"
                        id="demo-upload"
                        action="/upload">
                        <div class="dz-message m-0!">
                            <div class="mb-[22px] flex justify-center">
                                <div
                                    class="flex h-[68px] w-[68px] items-center justify-center rounded-full bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    <svg
                                        class="fill-current"
                                        width="29"
                                        height="28"
                                        viewBox="0 0 29 28"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M14.5019 3.91699C14.2852 3.91699 14.0899 4.00891 13.953 4.15589L8.57363 9.53186C8.28065 9.82466 8.2805 10.2995 8.5733 10.5925C8.8661 10.8855 9.34097 10.8857 9.63396 10.5929L13.7519 6.47752V18.667C13.7519 19.0812 14.0877 19.417 14.5019 19.417C14.9161 19.417 15.2519 19.0812 15.2519 18.667V6.48234L19.3653 10.5929C19.6583 10.8857 20.1332 10.8855 20.426 10.5925C20.7188 10.2995 20.7186 9.82463 20.4256 9.53184L15.0838 4.19378C14.9463 4.02488 14.7367 3.91699 14.5019 3.91699ZM5.91626 18.667C5.91626 18.2528 5.58047 17.917 5.16626 17.917C4.75205 17.917 4.41626 18.2528 4.41626 18.667V21.8337C4.41626 23.0763 5.42362 24.0837 6.66626 24.0837H22.3339C23.5766 24.0837 24.5839 23.0763 24.5839 21.8337V18.667C24.5839 18.2528 24.2482 17.917 23.8339 17.917C23.4197 17.917 23.0839 18.2528 23.0839 18.667V21.8337C23.0839 22.2479 22.7482 22.5837 22.3339 22.5837H6.66626C6.25205 22.5837 5.91626 22.2479 5.91626 21.8337V18.667Z"
                                            fill="" />
                                    </svg>
                                </div>
                            </div>

                            <h4
                                class="text-theme-xl mb-3 font-semibold text-gray-800 dark:text-white/90">
                                Arrastra tu archivo aqui
                            </h4>
                            <span
                                class="mx-auto mb-5  w-full max-w-[290px] text-sm text-gray-700 dark:text-gray-400">
                                Arrastra y suelta tu PNG, JPG, WebP, SVG aqui o haz clic aqui
                            </span>

                            <span
                                class="text-theme-sm text-brand-500 font-medium underline">
                                Buscar Archivo
                            </span>
                        </div>
                    </form>
                </div>
                
            
        </div>