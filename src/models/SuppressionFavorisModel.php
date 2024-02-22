<?php

namespace App\Models;

class SuppressionFavorisModel
{
    public function processsuppressionFavoris()
    {
        global $pdo;
if (!isset($_SESSION['id_user'])) {
    header("Location: page_de_connexion.php");
    exit();
}

if (!isset($_GET['id_event']) || !is_numeric($_GET['id_event'])) {
    header("Location: autre_page.php");
    exit();
}


$user_id = $_SESSION['id_user'];
$event_id = $_GET['id_event'];

$pdo->query("DELETE FROM favoris WHERE id_utilisateur = $user_id AND id_event = $event_id");

header("Location: mesfavoris");
exit();
    }
}

?>
