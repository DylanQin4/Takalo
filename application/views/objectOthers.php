
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
              Echange <?=var_dump($enAttente)?>
            </h2>

            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              
            </h4>
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                  <thead>
                    <tr
                      class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                    >
                      <th class="px-4 py-3">Objet</th>
                      <th class="px-4 py-3">Proprietaire</th>
                      <th class="px-4 py-3">Categorie</th>
                      <th class="px-4 py-3">Description</th>
                      <th class="px-4 py-3">Prix</th>
                      <th class="px-4 py-3">Mes Objets</th>
                      <th class="px-4 py-3">Action</th>
                    </tr>
                  </thead>
                  <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                  >
                  <?php for($i=0;$i<count($objectOthers);$i++){ 
                    if(!in_array($objectOthers[$i]['id_object'], $enAttente)) {?>
                    <tr class="text-gray-700 dark:text-gray-400">
                      <form action="<?php echo site_url("takalo/exchange") ?>" method="post">
                        <input type="hidden" name="id_object1" value="<?=$objectOthers[$i]['id_object']?>">
                        <input type="hidden" name="sender" value="<?=$_SESSION['id_client']?>">
                        <input type="hidden" name="receiver" value="<?=$objectOthers[$i]['id_client']?>">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                            <!-- Avatar with inset shadow -->
                            <div
                                class="relative hidden w-8 h-8 mr-3 md:block"
                            >
                                <img
                                class="object-cover w-full h-full rounded"
                                src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                alt=""
                                loading="lazy"
                                />
                                <div
                                class="absolute inset-0 rounded-full shadow-inner"
                                aria-hidden="true"
                                ></div>
                            </div>
                            <div>
                                <p class="font-semibold"><?= $objectOthers[$i]['name_object']?></p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                <?= $objectOthers[$i]['title']?>
                                </p>
                            </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                        <?= $objectOthers[$i]['name_client']." ".$objectOthers[$i]['first_name']?>
                        </td>
                        <td class="px-4 py-3 text-sm">
                        <?= $objectOthers[$i]['libelle']?>
                        </td>
                        <td class="px-4 py-3 text-sm">
                        <?= $objectOthers[$i]['description']?>
                        </td>
                        <td class="px-4 py-3 text-sm">
                        <?= $objectOthers[$i]['estimated_price']?>
                        </td>
                        <td class="px-4 py-3 text-sm">
                        <select
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                name="id_object2"              
                            >
                            <?php for ($j=0; $j < count($myObjects); $j++) { ?>
                                <option value="<?= $myObjects[$j]['id_object']?>"><?= $myObjects[$j]['name_object']?></option>
                            <?php } ?>
                        </select>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <button
                                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                    name="details"
                                    type="submit"
                                >
                                    Echanger
                                </button>
                            </div>
                        </td>
                      </form>
                    </tr>
                    <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </body>
  <?php include "components/footer.php" ?>
</html>
