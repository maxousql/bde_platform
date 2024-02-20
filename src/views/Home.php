<?php $title = "ACCUEIL"; ?>

<?php ob_start(); ?>

<h1>ACCUEIL</h1>

<?php $content = ob_get_clean(); ?>

<?php require('./templates/layout.php') ?>