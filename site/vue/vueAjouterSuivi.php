<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un suivi santé</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a href="index.php?action=detailChat&idC=<?= $idC ?>">← Retour au chat</a>

<h1>Ajouter un suivi santé</h1>

<form method="POST" action="index.php?action=suiviSante&idC=<?= $idC ?>">
    <input type="hidden" name="idC" value="<?= $idC ?>">
    
    <label>Poids (kg)</label><br>
    <input type="number" name="poidsSS" step="0.1" placeholder="Ex: 4.5" ><br>

    <label>Taille (cm)</label><br>
    <input type="number" name="tailleSS" step="0.1" placeholder="Ex: 30" ><br>

    <label>Date</label><br>
    <input type="date" name="dateSS" required><br>

    <label>Commentaire</label><br>
    <textarea name="commentaireSS" placeholder="Ex: Chat en bonne santé..."></textarea><br>

    <button type="submit">Ajouter le suivi</button>
</form>

</body>
</html>