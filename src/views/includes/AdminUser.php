<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold mb-4">Liste utilisateurs</h2>
    <script>
        $(document).ready(function () {
            new DataTable('#example');
        });

    </script>
    <table id="example" class="display" style="width:100%">
        <button>+</button>
        <thead>
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Prénom</th>
                <th class="px-4 py-2">Adresse email</th>
                <th class="px-4 py-2">Rôle</th>
                <th class="px-4 py-2">Ecole</th>
                <th class="px-4 py-2">Rôle</th>
                <th class="px-4 py-2"></th>
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
                echo '
                <tr>
                    <td class="border px-4 py-2">
                        ' . $row['nom'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['prenom'] . '
                    </td>
                     <td class="border px-4 py-2">
                        ' . $row['email'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['nom_role'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['nom_ecole'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['nom_promotion'] . '
                    </td>
                    <td class="border px-4 py-2">
                        <a href="process_editUser?id_user=' . $row["id_utilisateur"] . '" name="editUser" id="editUser" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>
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