<?php
if(isset($_GET['id_event'])) {  
    $id_event = $_GET['id_event'];
    
    
    $id_utilisateur = 22;

    // Connexion à la base de données
    $DB_HOST = '127.0.0.1';
    $DB_NAME = 'bde_platform';
    $DB_CHARSET = 'utf8mb4';
    $DB_USER = 'root';
    $DB_PASSWORD = 'root';

    $dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
    $db = new PDO($dsn, $DB_USER, $DB_PASSWORD);

    
    $stmt = $db->prepare("INSERT INTO billet (id_utilisateur, id_event) VALUES (:id_utilisateur, :id_event)");
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':id_event', $id_event);
    
    if ($stmt->execute()) {
        echo "Billet créé avec succès!";
    } else {
        echo "Erreur lors de la création du billet.";
    }
} else {
    echo "ID de l'événement non spécifié.";
}
?>
