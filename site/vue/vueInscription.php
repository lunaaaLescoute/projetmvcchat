<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Créer un compte</h1>

<?php if (isset($erreur)): ?>
    <p style="color:red"><?= $erreur ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=inscription">
    <input type="text" name="pseudo" placeholder="Pseudo" required><br>
    <input type="email" name="mailU" placeholder="Email" required><br>
    <input type="password" name="mdpU" placeholder="Mot de passe" required><br>
    <button type="submit">S'inscrire</button>
</form>

<p>Déjà un compte ?
    <a href="index.php?action=connexion">Se connecter</a>
</p>
</body>
</html>