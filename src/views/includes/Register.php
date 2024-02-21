<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="register.css">
    <title>Inscription</title>
</head>

<?php
$DB_HOST = '127.0.0.1';
$DB_NAME = 'bde_plateform';
$DB_CHARSET = 'utf8mb4';
$DB_USER = 'root';
$DB_PASSWORD = '';
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";

$db = new PDO($dsn, $DB_USER, $DB_PASSWORD);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST["nom"];

    $id_ecole = $_POST['ecole'];

    $id_promotion = $_POST['promotion'];


    try {
        $stmt = $db->prepare("INSERT INTO utilisateur (nom, id_ecole, id_promotion) VALUES (:nom, :id_ecole, :id_promotion)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id_ecole', $id_ecole);
        $stmt->bindParam(':id_promotion', $id_promotion);

        // Exécuter la requête
        $stmt->execute();

        echo "Inscription réussie !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
$data = $db->query("SELECT id_ecole, nom_ecole FROM ecole")->fetchAll();
$data2 = $db->query("SELECT id_promotion, nom_promotion FROM promotion")->fetchAll();

?>

<body>
    <section class="bg-gray-50 min-h-screen-custom flex items-center justify-center">
        <!-- login container -->
        <div class="bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 items-center">
            <!-- form -->
            <div class="px-8 md:px-16">
                <h2 class="font-bold text-2xl text-[#002D74]">Inscrivez-vous</h2>
                <p class="text-xs mt-4 text-[#002D74]">Rejoigner les étudiants du BEEDE Lyon !</p>
                <form method="post" class="flex flex-col gap-4">
                    <input class="p-2 mt-8 rounded-xl border" type="text" name="nom" placeholder="Votre nom">
                    <input class="p-2 rounded-xl border w-full" type="text" name="prenom" placeholder="Votre prenom">
                    <select class="p-2 rounded-xl border w-full" name="ecole">
                        <option value="" disabled selected>Choisissez votre école</option>
                        <?php foreach ($data as $row) : ?>
                            <option value="<?= $row['id_ecole'] ?>"><?= $row['nom_ecole'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select class="p-2 rounded-xl border w-full" name="promotion">
                        <option value="" disabled selected>Choisissez votre niveau</option>
                        <?php foreach ($data2 as $row) : ?>
                            <option value="<?= $row['id_promotion'] ?>"><?= $row['nom_promotion'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input class="p-2 rounded-xl border w-full" type="email" name="email" placeholder="Adresse email">
                    <div class="relative">
                        <input class="p-2 rounded-xl border w-full" type="password" name="password" placeholder="Mot de passe">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </div>
                    <button type="submit" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">Connexion</button>
                </form>
            </div>

        </div>
    </section>
</body>

</html>