<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un rappel</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php?action=detailChat&idC=<?= $idC ?>">← Retour au chat</a>

<h1>Ajouter un rappel</h1>

<form method="POST" action="index.php?action=rappel&idC=<?= $idC ?>">
    <input type="hidden" name="idC" value="<?= $idC ?>">
    <label>Type</label><br>
    <select name="typeRap" required>
        <option value="Alimentation">Alimentation</option>
        <option value="Vétérinaire">Vétérinaire</option>
        <option value="Santé">Santé</option>
        <option value="Entretien">Entretien</option>
    </select><br>
    <label>Date et heure</label><br>
    <input type="datetime-local" name="timeRap" required><br>
    <label>Description</label><br>
    <input type="text" name="descriptionRap" placeholder="Ex: Donner les croquettes" required><br>
    <label>Récurrence</label><br>
    <select name="recurrenceRap" required>
        <option value="unique">Une seule fois</option>
        <option value="quotidien">Tous les jours</option>
        <option value="hebdomadaire">Toutes les semaines</option>
        <option value="mensuel">Tous les mois</option>
    </select><br>
    <button type="submit">Ajouter le rappel</button>
</form>

</body>
</html>