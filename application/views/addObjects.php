
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
              Insertion
            </h2>

            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
              <form action="<?= site_url("takalo/insertObject") ?>" method="post">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Nom de l'objet</span>
                    <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder=""
                    name="name"
                    />
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Titre</span>
                    <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder=""
                    name="title"
                    />
                </label>
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                    Categories
                    </span>
                    <select
                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                        name="category"              
                    >
                    <?php for ($i=0; $i < count($category); $i++) { ?>
                        <option value="<?= $category[$i]['id_category']?>"><?= $category[$i]['libelle']?></option>
                    <?php } ?>
                    </select>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Description</span>
                    <textarea
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder=""
                        type="text"
                        name="description"
                    ></textarea>
                </label>
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Prix estimatif</span>
                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder=""
                        type="number"
                        name="price"
                    />
                </label>
                <div class="flex justify-center mt-4">
                    <button
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    type="submit"
                    >
                    Modifier
                    </button>
                </div>
              </form>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
  <?php include "components/footer.php" ?>
</html>
