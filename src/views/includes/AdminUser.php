<div class="relative overflow-x-auto shadow-md m-5">
    <div
        class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white dark:bg-gray-900">
        <div>
            <a id="action-user-button" data-dropdown-toggle="dropdownAction"
                class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                type="button">
                <span class="sr-only">Action button</span>
                Gestion
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </a>
            <!-- Dropdown menu -->
            <div id="menu-action-user"
                class="transition ease-out duration-100 opacity-0 absolute scale-95 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                    <li>
                        <a href="/add_user"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ajouter
                            un utilisateur</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Ajouter
                            un rôle</a>
                    </li>
                </ul>
            </div>
        </div>
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="text" id="table-search-users"
                class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search for users">
        </div>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">
                </th>
                <th scope="col" class="px-6 py-3">
                    utilisateur
                </th>
                <th scope="col" class="px-6 py-3">
                    Rôle
                </th>
                <th scope="col" class="px-6 py-3">
                    Ecole
                </th>
                <th scope="col" class="px-6 py-3">
                </th>
            </tr>
        </thead>

        <tbody>
            <?php
            global $pdo;

            $getAllUsers_query = "SELECT * FROM utilisateur INNER JOIN role ON utilisateur.id_role = role.id_role
            INNER JOIN ecole ON utilisateur.id_ecole = ecole.id_ecole
            INNER JOIN promotion ON utilisateur.id_promotion = promotion.id_promotion 
            ORDER BY utilisateur.nom ASC";
            $getAllUsers_query_run = $pdo->prepare($getAllUsers_query);
            $getAllUsers_query_run->execute();
            $data = $getAllUsers_query_run->fetchAll();

            foreach ($data as $row) {
                echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="w-4 p-4">
                </td>
                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <img class="w-10 h-10 rounded-full" src="/img/logouser.jpg" alt="Jese image">
                    <div class="ps-3">
                        <div class="text-base font-semibold">' . $row['nom'] . ' ' . $row['prenom'] . '</div>
                        <div class="font-normal text-gray-500">' . $row['email'] . '</div>
                    </div>
                </th>
                <td class="px-6 py-4">
                    ' . $row['nom_role'] . '
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        ' . $row['nom_ecole'] . ' ' . $row['nom_promotion'] . '
                    </div> 
                </td>
                <td class="px-6 py-4">
                    <a href="process_editUser?id_user=' . $row["id_utilisateur"] . '" name="editUser" id="editUser" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
                </td>
            </tr>';
            }
            ?>
        </tbody>
    </table>

    <nav aria-label="Page navigation example">
        <ul class="inline-flex -space-x-px text-sm">
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
            </li>
            <li>
                <a href="#" aria-current="page"
                    class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
            </li>
        </ul>
    </nav>

    <script>
        const profileMenu = document.getElementById("menu-action-user")
        document.getElementById("action-user-button").addEventListener("click", function () {
            //opacité
            profileMenu.classList.toggle("opacity-0")
            profileMenu.classList.toggle("opacity-100")
            //taille
            profileMenu.classList.toggle("scale-95")
            profileMenu.classList.toggle("scale-100")
            //effet d'animation
            //--- ouvrir
            profileMenu.classList.toggle("duration-100")
            profileMenu.classList.toggle("ease-out")
            //--- fermer
            profileMenu.classList.toggle("duration-75")
            profileMenu.classList.toggle("ease-in")
        })
    </script>

    <?php
    if ($validAdd === 1) {
        echo '<script>
    Swal.fire({
        title: "Succès",
        text: "Utilisateur ajouté avec succès",
        icon: "success"
    });
</script>';
    } elseif ($validAdd === 2) {
        echo '<script>
    Swal.fire({
        title: "Oops...",
        text: "Utilisateur non ajouté",
        icon: "error"
    });
</script>';
    }
    ?>