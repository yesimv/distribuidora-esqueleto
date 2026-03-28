
  <!-- ===== Preloader Start ===== -->
  <div
    x-show="loaded"
    x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
    class=" z-999999 fixed left-0 top-0z-9 flex h-screen w-screen items-center justify-center bg-white dark:bg-gray-900">
    <div
      class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
  </div>

  <!-- ===== Preloader End ===== -->