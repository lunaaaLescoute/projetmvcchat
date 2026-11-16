<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une note</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php?action=detailChat&idC=<?= $idC ?>">← Retour au chat</a>

<h1>Ajouter une note</h1>

<form method="POST" action="index.php?action=notes&idC=<?= $idC ?>" enctype="multipart/form-data">
    <input type="hidden" name="idC" value="<?= $idC ?>">
    <textarea name="contenuN" placeholder="Votre note..." required></textarea><br>
    <label>Photo (optionnel)</label><br>
    <input type="file" name="photo" accept="image/*"><br>
    <button type="submit">Ajouter la note</button>
</form>

</body>
</html>