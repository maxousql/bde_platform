<?php $title = "ACCUEIL"; ?>

<?php ob_start(); ?>

<h1>ACCUEIL</h1>

<img src="https://latavernedutesteur.files.wordpress.com/2017/11/testss.png" alt="">

<?php $content = ob_get_clean(); ?>

<?php require('./includes/layout.php') ?>