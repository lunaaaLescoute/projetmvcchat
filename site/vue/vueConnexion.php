<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Connexion</h1>

<?php if (isset($erreur)): ?>
    <p style="color:red"><?= $erreur ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=connexion">
    <input type="email" name="mailU" placeholder="Email" required><br>
    <input type="password" name="mdpU" placeholder="Mot de passe" required><br>
    <button type="submit">Se connecter</button>
</form>

<p>Pas encore de compte ?
    <a href="index.php?action=inscription">S'inscrire</a>
</p>
</body>
</html>