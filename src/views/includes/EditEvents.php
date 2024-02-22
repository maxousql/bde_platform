<section class="min-h-screen-custom flex items-center justify-center">
    <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-custom p-5 items-center justify-center m-10">
        <div class="px-8 md:px-16">
            <h2 class="font-bold text-2xl text-[#002D74] max-w-custom-form">Modifier l'utilisateur</h2>
            <form method="POST" action="/processUpdateUser" class="flex flex-col mt-2">
                <?php
                global $pdo;
                $data = $pdo->query("SELECT id_ecole, nom_ecole FROM ecole")->fetchAll();
                $data2 = $pdo->query("SELECT id_promotion, nom_promotion FROM promotion")->fetchAll();
                $data3 = $pdo->query("SELECT id_role, nom_role FROM role")->fetchAll();
                ?>

                <label>Rôle</label>
                <select class=" p-2 mb-4 rounded-xl border w-full" name="role">
                    <option value="<?= $userData['id_role'] ?>" selected>
                        <?= $userData['nom_role'] ?>
                    </option>
                    <?php foreach ($data3 as $row) : ?>
                        <option value="<?= $row['id_role'] ?>">
                            <?= $row['nom_role'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>ID Utilisateur</label>
                <input class="p-2 mb-4 rounded-xl border" type="text" name="id_user" placeholder="ID Utilisateur" readonly value="<?= $userData['id_utilisateur'] ?>">
                <label>Nom</label>
                <input class="p-2 mb-4 rounded-xl border" type="text" name="name" placeholder="Nom" value="<?= $userData['nom'] ?>">
                <label for="name">Prénom</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="text" name="firstname" placeholder="Prénom" value="<?= $userData['prenom'] ?>">
                <label>Ecole</label>
                <select class=" p-2 mb-4 rounded-xl border w-full" name="school">
                    <option value="<?= $userData['id_ecole'] ?>" selected>
                        <?= $userData['nom_ecole'] ?>
                    </option>
                    <?php foreach ($data as $row) : ?>
                        <option value="<?= $row['id_ecole'] ?>">
                            <?= $row['nom_ecole'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Promotion</label>
                <select class="p-2 mb-4 rounded-xl border w-full" name="promotion">
                    <option value="<?= $userData['id_promotion'] ?>" selected>
                        <?= $userData['nom_promotion'] ?>
                        <?php foreach ($data2 as $row) : ?>
                    <option value="<?= $row['id_promotion'] ?>">
                        <?= $row['nom_promotion'] ?>
                    </option>
                <?php endforeach; ?>
                </option>
                </select>
                <label>Adresse email</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="email" name="email" placeholder="Adresse email" value="<?= $userData['email'] ?>">
                <div class=" relative">
                </div>
                <label>Mot de passe</label>
                <input class="p-2 mb-4 rounded-xl border w-full" type="password" name="password" placeholder="Mot de passe">
                <div class=" relative">
                </div>
                <button class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300 confirmUpdate" type="submit">Valider</button>
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