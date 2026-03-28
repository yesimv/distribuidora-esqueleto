    <?php use App\Core\Config; ?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
      404 Error Page | TailAdmin - Tailwind CSS Admin Dashboard Template
    </title>
  <link rel="icon" href="./../public/assets/img/favicon.ico"><link href="assets/css/style.css" rel="stylesheet"></head>
  <body
    x-data="{ page: 'page404', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
  >
    <!-- ===== Preloader Start ===== -->
    <div
  x-show="loaded"
  x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
  class="fixed left-0 top-0z-9 flex h-screen w-screen items-center justify-center bg-white dark:bg-black"
>
  <div
    class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"
  ></div>
</div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div
      class="relative z-1 flex min-h-screen flex-col items-center justify-center overflow-hidden p-6"
    >
      <!-- ===== Common Grid Shape Start ===== -->
      <div class="absolute right-0 top-0 -z-1 w-full max-w-[250px] xl:max-w-[450px]">
  <img src="assets/img/shape/grid-01.svg" alt="grid" />
</div>
<div
  class="absolute bottom-0 left-0 -z-1 w-full max-w-[250px] rotate-180 xl:max-w-[450px]"
>
  <img src="assets/img/shape/grid-01.svg" alt="grid" />
</div>

      <!-- ===== Common Grid Shape End ===== -->

      <!-- Centered Content -->
      <div class="mx-auto w-full max-w-[242px] text-center sm:max-w-[472px]">
        <h1
          class="mb-8 text-title-md font-bold text-gray-800 dark:text-white/90 xl:text-title-2xl"
        >
          ERROR
        </h1>

        <img src="assets/img/error/404.svg" alt="404" class="dark:hidden" />
        <img
          src="assets/img/error/404-dark.svg"
          alt="404"
          class="hidden dark:block"
        />

        <p
          class="mb-6 mt-10 text-base text-gray-700 dark:text-gray-400 sm:text-lg"
        >
          No podemos encontrar la página que estas buscando
        </p>

        <a
          href=<?php echo Config::get('app.base_url') . "/" ?>
          class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3.5 text-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200"
        >
          Volver a la página de inicio
        </a>
      </div>
      <!-- Footer -->
      <p
        class="absolute bottom-6 left-1/2 -translate-x-1/2 text-center text-sm text-gray-500 dark:text-gray-400"
      >
        &copy; <span id="year"></span> - Masterfuel
      </p>
    </div>

    <!-- ===== Page Wrapper End ===== -->
  <script defer src="assets/js/bundle.js"></script>
<script src="src/js/modules/auth/error.js"></script>
</body>
</html>
