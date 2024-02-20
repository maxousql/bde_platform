<h1>LOGIN</h1>

<form method="POST" action="../models/login.php">
    <label>Votre email</label>
    <input type="email" id="email" name="email" placeholder="Entrez votre mail..." required>
    <br>
    <label>Votre mot de passe</label>
    <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe..." required>
    <br>
    <input type="submit" value="Connexion" name="valid_login">
</form>