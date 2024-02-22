<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="GET">
        <input type="text" name="search" placeholder="Rechercher un événement">
        <button type="submit">Rechercher</button>
    </form>

    <?php
    global $pdo;

    // Définition du nombre d'événements par page
    $eventsPerPage = 10;

    // Récupération du numéro de page à partir de l'URL, par défaut à 1 si non spécifié
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    // Calcul de l'offset pour la pagination
    $offset = ($page - 1) * $eventsPerPage;

    // Initialisation du terme de recherche
    $searchTerm = '';

    // Vérifie si un terme de recherche a été soumis
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
    }

    // Requête SQL pour récupérer les événements correspondant au terme de recherche et paginés
    $sql = "SELECT * FROM event 
        INNER JOIN categorie_event ON event.id_categorie = categorie_event.id_categorie
        WHERE nom_event LIKE '%$searchTerm%'
        LIMIT $eventsPerPage OFFSET $offset";

    $data = $pdo->query($sql)->fetchAll();

    if (isset($_SESSION['email'])) {
        $btnReservationFavoris = '<a class="a_event_reserver" href="reservation?id_event=' . $row["id_event"] . '">Réserver</a>
                    <a class="a_event_reserver" href="favoris?id_event=' . $row["id_event"] . '">Favoris</a>';
    }

    foreach ($data as $row) {
        // Votre code pour afficher chaque événement
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
                    ' . $btnReservationFavoris . '
                    <p class="text-sm font-medium text-slate-400 text_nombre_participant">nombre de participant: ' . $row["nombre_de_participants"] . '</p>
                </div>
            </form>
            </div>';
    }

    // Ajout des liens vers la page précédente et suivante avec le terme de recherche conservé dans l'URL
    $prevPage = $page > 1 ? $page - 1 : 1;
    $nextPage = $page + 1;

    echo "<a href='?search=$searchTerm&page=$prevPage'>Page précédente</a>";
    echo "<a href='?search=$searchTerm&page=$nextPage'>Page suivante</a>";
    ?>
</body>

</html>