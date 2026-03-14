    <?php

    use App\Core\Config; ?>
<!doctype html>
<html lang="en">

<?php include 'head.php'; ?>

<body
    x-data="{ page: '', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">

    <?php include 'loader.php'; ?>

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
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
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

                  <?php echo $content; ?>  

                </div>
            </main>
            <!-- ===== Main Content End ===== -->

        </div>
        <!-- ===== Content Area End ===== -->

    </div>
    <!-- ===== Texto informativo que sigue al cursor ===== -->
    <div id="tooltip" class="pop-text"></div>
    <!-- ===== Page Wrapper End ===== -->
    <?php

    include 'scripts.php';

    ?>

</body>

</html>