
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >

    <?php include "components/sidebar.php" ?>

      <div class="flex flex-col flex-1 w-full">
        <?php include "components/navbar.php" ?>
        <main class="h-full overflow-y-auto">
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard
            </h2>

            <!-- New Table -->
            <div class="w-full p-4 overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
  <?php include "components/footer.php" ?>
</html>
