<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier <?= $chat['nomC'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="index.php?action=detailChat&idC=<?= $chat['idC'] ?>">← Retour au chat</a>
<h1>Modifier <?= $chat['nomC'] ?></h1>

<form method="POST" action="index.php?action=modifierChat&idC=<?= $chat['idC'] ?>" enctype="multipart/form-data">
    
    <label>Nom du chat</label><br>
    <input type="text" name="nomC" value="<?= $chat['nomC'] ?>" required><br>

    <label>Race</label><br>
    <select name="raceID" required>
        <?php foreach ($races as $race): ?>
            <option value="<?= $race['idR'] ?>" 
                <?= $race['idR'] == $chat['raceID'] ? 'selected' : '' ?>>
                <?= $race['nomR'] ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    <label>Poids (kg)</label><br>
    <input type="number" name="poidsC" step="0.1" value="<?= $chat['poidsC'] ?>" required><br>

    <label>Taille (cm)</label><br>
    <input type="number" name="tailleC" step="0.1" value="<?= $chat['tailleC'] ?>" required><br>

    <label>Date de naissance</label><br>
    <input type="date" name="naissanceC" value="<?= $chat['naissanceC'] ?>" required><br>

    <label>Sexe</label><br>
    <select name="sexeC" required>
        <option value="M" <?= $chat['sexeC'] === 'M' ? 'selected' : '' ?>>Mâle</option>
        <option value="F" <?= $chat['sexeC'] === 'F' ? 'selected' : '' ?>>Femelle</option>
    </select><br>

    <!-- Couleurs -->
    <label>Couleurs</label><br>
    <?php
    $idsCouleursDuChat = array_column($couleursDuChat, 'idCo');
    foreach ($couleurs as $couleur): ?>
        <label>
            <input type="checkbox" name="couleurs[]" value="<?= $couleur['idCo'] ?>"
                <?= in_array($couleur['idCo'], $idsCouleursDuChat) ? 'checked' : '' ?>>
            <?= $couleur['nomCo'] ?>
        </label><br>
    <?php endforeach; ?>

    <!-- Photo -->
    <?php if ($photoChat): ?>
        <p>Photo actuelle :</p>
        <img src="<?= $photoChat['cheminPh'] ?>" style="max-width:200px;"><br>
        <a href="index.php?action=supprimerPhotoChat&idC=<?= $chat['idC'] ?>">Supprimer la photo</a><br>
    <?php endif; ?>

    <label>Nouvelle photo (optionnel)</label><br>
    <input type="file" name="photo" accept="image/*"><br>

    <button type="submit">Enregistrer les modifications</button>
</form>
</body>
</html>