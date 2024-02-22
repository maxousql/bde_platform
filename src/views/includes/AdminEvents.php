<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold mb-4">Liste des événements</h2>
    <script>
        $(document).ready(function() {
            new DataTable('#example');
        });
    </script>
    <a href="/addevent" class="bg-[#002D74] rounded-xl text-white py-2 p-2 mb-4 hover:scale-105 duration-300">Ajouter un événement</a>
    <h2 class="mb-4"></h2>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th class="px-4 py-2">Nom</th>
                <th class="px-4 py-2">Adresse</th>
                <th class="px-4 py-2">Catégorie</th>
                <th class="px-4 py-2">Prix</th>
                <th class="px-4 py-2">Date</th>
                <th class="px-4 py-2">Nombre de participants</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $pdo;

            $getAllEvents_query = "SELECT * FROM event 
            INNER JOIN categorie_event ON event.id_categorie = categorie_event.id_categorie
            ORDER BY event.nom_event ASC";
            $getAllEvents_query_run = $pdo->prepare($getAllEvents_query);
            $getAllEvents_query_run->execute();
            $data = $getAllEvents_query_run->fetchAll();

            foreach ($data as $row) {
                echo '
                <tr>
                    <td class="border px-4 py-2">
                        ' . $row['nom_event'] . '
                    </td>
                     <td class="border px-4 py-2">
                        ' . $row['adresse'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['nom_categorie'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['prix'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['date_event'] . '
                    </td>
                    <td class="border px-4 py-2">
                        ' . $row['nombre_de_participants'] . '
                    </td>
                    <td class="border px-4 py-2">
                        <a href="edit_event?id_event=' . $row["id_event"] . '" name="editEvent" id="editEvent" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

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