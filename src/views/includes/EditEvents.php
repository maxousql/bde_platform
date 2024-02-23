<section class="min-h-screen-custom flex items-center justify-center">
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-custom p-5 items-center justify-center m-10">
        <div class="px-8 md:px-16">
            <h2 class="font-bold text-2xl text-[#002D74] max-w-custom-form">Modifier l'événement</h2>
            <form method="POST" action="/processUpdateEvent" class="flex flex-col mt-2">
                <?php
                global $pdo;
                $data = $pdo->query("SELECT id_categorie, nom_categorie FROM categorie_event")->fetchAll();
                ?>

                <label>Nom</label>
                <input class="p-2 mb-4 rounded-xl border" type="text" name="nom" placeholder="Nom"
                    value="<?= $eventData['nom_event'] ?>">
                <label>Description</label>
                <input class="p-2 mb-4 rounded-xl border" type="text" name="description" placeholder="Description"
                    readonly value="<?= $eventData['description_event'] ?>">
                <label>Adresse</label>
                <input class="p-2 mb-4 rounded-xl border" type="text" name="adresse" placeholder="Adresse"
                    value="<?= $eventData['adresse'] ?>">
                <label for="name">Photo</label>
                <img src="<?php echo $eventData['photo_Event'] ?>" alt="image"
                    class="inset-0 w-full h-full object-cover rounded-lg" loading="lazy" />
                <label>Catégorie</label>
                <select class=" p-2 mb-4 rounded-xl border w-full" name="categorie">
                    <option value="<?= $eventData['id_categorie'] ?>" selected>
                        <?= $eventData['nom_categorie'] ?>
                    </option>
                    <?php foreach ($data as $row): ?>
                        <option value="<?= $row['id_categorie'] ?>">
                            <?= $row['nom_categorie'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Prix</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="text" name="prix" placeholder="Prix"
                    value="<?= $eventData['prix'] ?>">
                <div class=" relative">
                </div>
                <label>Date de l'événement :
                    <?= $eventData['date_event'] ?>
                </label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="date" name="date" placeholder="Date">
                <div class=" relative">
                    <div class=" relative">
                    </div>
                    <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300 confirmUpdate"
                        type="submit">Valider</button>
            </form>
        </div>
    </div>
</section>

<?php
if ($validUpdate === 1) {
    echo '<script>
    Swal.fire({
        title: "Succès",
        text: "Utilisateur modifié avec succès",
        icon: "success"
    });
</script>';
} elseif ($validUpdate === 2) {
    echo '<script>
    Swal.fire({
        title: "Oops...",
        text: "Utilisateur non modifié",
        icon: "error"
    });
</script>';
}
?>