<?php $title = "LOGIN"; ?>

<?php ob_start(); ?>

<h1>REGISTER</h1>

<form method="POST" action="/process_register">
    <label>Votre nom</label>
    <input type="text" id="name" name="name" placeholder="Entrez votre nom..." required>
    <br>
    <label>Votre prénom</label>
    <input type="text" id="firstname" name="firstname" placeholder="Entrez votre prénom..." required>
    <br>
    <label>Votre email</label>
    <input type="email" id="email" name="email" placeholder="Entrez votre mail..." required>
    <br>
    <label>Votre mot de passe</label>
    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe..." required>
    <br>
    <input type="submit" value="M'inscrire" name="valid_register">
</form>

<?php $content = ob_get_clean(); ?>

<?php require('./includes/layout.php') ?>