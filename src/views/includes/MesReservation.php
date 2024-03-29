<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../event.css">
    <title>Document</title>
</head>

<body>

    <?php
    global $pdo;
    $user_id = $_SESSION['id_user'];

    $data = $pdo->query("SELECT * FROM event 
INNER JOIN categorie_event ON event.id_categorie = categorie_event.id_categorie
INNER JOIN billet ON event.id_event = billet.id_event
WHERE id_utilisateur=$user_id;")->fetchAll();

    foreach ($data as $row) {

        $imageData = base64_encode($row['photo_Event']);
        $src = 'data:image/jpeg;base64,' . $imageData;

        echo '<div class="ajustement_event">
            <div class="flex-none w-56 relative">
                <img src="' . $src . '" alt="image"
                    class="inset-0 w-full h-full object-cover rounded-lg" loading="lazy" />
            </div>
            <form class="flex-auto p-6" action="event.php" method="POST">
                <input type="hidden" name="id_billet" value="' . $row["id_event"] . '">
                <div class="flex flex-wrap">
                    <h1 class="flex-auto font-medium text-slate-900">' . $row["nom_event"] . '</h1>
                    <div class="w-full flex-none mt-2 order-1 text-3xl font-bold button_event_heart">' . number_format($row["prix"], 2) . '€</div>
                    <div class="text-sm font-medium text-slate-400">#' . $row["nom_categorie"] . '</div>
                </div>
                <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                    <div class="space-x-2 flex text-sm font-bold">
                        <p class="text-sm text-slate-500">' . $row["description_event"] . '</p>
                    </div>
                </div>
                <div class="flex items-baseline mt-4 mb-6">
                    <div class="space-x-2 flex text-sm font-bold">
                        <p class="text-sm text-slate-500">Adresse :' . $row["adresse"] . '</p>
                        <p class="text-sm text-slate-500">Date :' . $row["date_event"] . '</p>
                    </div>
                </div>
                <div>
                    <a class="a_event_supprimer" href="suppressionreservation?id_billet=' . $row["id_billet"] . '">Annuler</a>
                    <p class="text-sm font-medium text-slate-400 text_nombre_participant">nombre de participant: ' . $row["nombre_de_participants"] . '</p>
                </div>
            </form>
            </div>';
    }
    ?>


</body>

</html>