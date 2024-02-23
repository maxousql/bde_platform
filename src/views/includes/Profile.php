<?php
global $pdo;


// Requête pour récupérer les données de l'utilisateur avec l'ID 1
$id_utilisateur = $_SESSION['id_user'];
$query = $pdo->prepare("SELECT * FROM utilisateur
INNER JOIN ecole ON utilisateur.id_ecole = ecole.id_ecole 
INNER JOIN promotion ON utilisateur.id_promotion = promotion.id_promotion
WHERE id_utilisateur=:id_user");
$query->bindParam(':id_user', $id_utilisateur);
$query->execute();
$user = $query->fetch();
?>
<section id="concept" class="container">
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <h2></h2>
        </div>

        <div class="col-md-8 col-sm-12 row">
            <article class="col-md-6 col-sm-12">
                <img src="img/utilisateur.png">
                <h3>Nom :</h3>
                <p><?php echo $user['nom']; ?></p>
            </article>
            <article class="col-md-6 col-sm-12">
                <img src="img/utilisateur.png">
                <h3>Prénom :</h3>
                <p><?php echo $user['prenom']; ?></p>
            </article>
            <article class="col-md-6 col-sm-12">
                <img src="img/utilisateur.png">
                <h3>Adresse mail :</h3>
                <p><?php echo $user['email']; ?></p>
            </article>
            <article class="col-md-6 col-sm-12">
                <img src="img/utilisateur.png">
                <h3>Ecole/Promotion :</h3>
                <p><?php echo $user['nom_ecole']; ?> / <?php echo $user['nom_promotion']; ?></p>
            </article>
            <article class="col-md-12 col-sm-12 d-flex align-items-center justify-content-center">
                <a href="#" class="btnb blanc">Modifier</a>
            </article>
        </div>
    </div>
    </div>
</section>
<main>