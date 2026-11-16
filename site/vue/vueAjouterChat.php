<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un chat</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Ajouter un chat</h1>

<form method="POST" action="index.php?action=ajouterChat" enctype="multipart/form-data">
    <label>Nom du chat</label><br>
    <input type="text" name="nomC" placeholder="Nom" required><br>

    <label>Race</label><br>
    <select name="raceID" required>
        <?php foreach ($races as $race): ?>
            <option value="<?= $race['idR'] ?>"><?= $race['nomR'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Poids (kg)</label><br>
    <input type="number" name="poidsC" step="0.1" placeholder="4.5" required><br>

    <label>Taille (cm)</label><br>
    <input type="number" name="tailleC" step="0.1" placeholder="30" required><br>

    <label>Date de naissance</label><br>
    <input type="date" name="naissanceC" required><br>

    <label>Sexe</label><br>
    <select name="sexeC" required>
        <option value="M">Mâle</option>
        <option value="F">Femelle</option>
    </select><br>

    <label>Couleur(s) du chat</label><br>
    <?php foreach ($couleurs as $couleur): ?>
        <label>
            <input type="checkbox" name="couleurs[]" value="<?= $couleur['idCo'] ?>">
            <?= $couleur['nomCo'] ?>
        </label><br>
    <?php endforeach; ?>

    <label>Photo du chat (optionnel)</label><br>
    <input type="file" name="photo" accept="image/*"><br>

    <button type="submit">Ajouter ce chat</button>
    <a href="index.php?action=meschats">Passer cette étape</a>
</form>

</body>
</html>