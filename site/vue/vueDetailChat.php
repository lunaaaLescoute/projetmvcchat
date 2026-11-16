<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $chat['nomC'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<a href="index.php?action=meschats">← Retour à mes chats</a>

<h1><?= $chat['nomC'] ?></h1>
<p>Race : <?= $chat['nomR'] ?></p>
<p>Description : <?= $chat['descriptionR'] ?></p>
<p>Poids : <?= $chat['poidsC'] ?> kg</p>
<p>Taille : <?= $chat['tailleC'] ?> cm</p>
<p>Né le : <?= $chat['naissanceC'] ?></p>
<p>Sexe : <?= $chat['sexeC'] === 'M' ? 'Mâle' : 'Femelle' ?></p>
<p><strong>Couleurs :</strong> 
<?php 
$couleursDuChat = getCouleursByChat($chat['idC']);
foreach ($couleursDuChat as $couleur): ?>
    <span><?= $couleur['nomCo'] ?> </span>
<?php endforeach; ?>
</p>
<?php 
$photoChat = getPhotoByChat($chat['idC']);
if ($photoChat): ?>
    <img src="<?= $photoChat['cheminPh'] ?>" alt="<?= $chat['nomC'] ?>" style="max-width:300px;">
<?php endif; ?>

<hr>

<h2>Repas de la semaine</h2>

<?php
$jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];


$repasSemaine = [];
foreach ($repas as $r) {
    $jour = date('N', strtotime($r['dateRe'])); 
    $repasSemaine[$jour][] = $r;
}
?>

<table border="1" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <?php foreach ($jours as $index => $jour): ?>
                <th><?= $jour ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php for ($i = 1; $i <= 7; $i++): ?>
                <td style="vertical-align:top; padding:8px;">
                    <?php if (isset($repasSemaine[$i])): ?>
                        <?php foreach ($repasSemaine[$i] as $r): ?>
                            <div style="margin-bottom:8px; padding:5px; background:#f9f9f9; border-radius:4px;">
                                <strong><?= $r['nomTR'] ?></strong><br>
                                <?= $r['quantiteRe'] ?>g<br>
                                <?= date('H:i', strtotime($r['dateRe'])) ?>
                                <a href="index.php?action=supprimerRepas&idRe=<?= $r['idRe'] ?>&idC=<?= $chat['idC'] ?>" style="color:red; font-size:12px;">X</a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </td>
            <?php endfor; ?>
        </tr>
    </tbody>
</table>


<h2>Ajouter un repas</h2>
<form method="POST" action="index.php?action=detailChat&idC=<?= $chat['idC'] ?>">
    <input type="hidden" name="type" value="repas">

    <label>Type de repas</label><br>
    <select name="typeRe" required>
        <?php foreach ($typesRepas as $type): ?>
            <option value="<?= $type['idTR'] ?>"><?= $type['nomTR'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Quantité (g)</label><br>
    <input type="number" name="quantiteRe" placeholder="Ex: 50" required><br>

    <label>Date et heure</label><br>
    <input type="datetime-local" name="dateRe" required><br>

    <button type="submit">Ajouter le repas</button>
</form>


<h2>Notes</h2>

<a href="index.php?action=notes&idC=<?= $chat['idC'] ?>">+ Ajouter une note</a>
<?php if (empty($notes)): ?>
    <p>Aucune note pour ce chat.</p>
<?php else: ?>
    <?php foreach ($notes as $note): ?>
        <div>
        <p><?= $note['contenuN'] ?></p>
        <p>Le : <?= $note['dateCreationN'] ?></p>
        <?php 
        $photoNote = getPhotoByNote($note['idN']);
        if ($photoNote): ?>
            <img src="<?= $photoNote['cheminPh'] ?>" style="max-width:200px;">
        <?php endif; ?>
        <p></p>
        <a href="index.php?action=supprimerNote&idN=<?= $note['idN'] ?>&idC=<?= $chat['idC'] ?>">Supprimer</a>
    </div>
    <?php endforeach; ?>
<?php endif; ?>


<h2>Rappels</h2>

<a href="index.php?action=rappel&idC=<?= $chat['idC'] ?>">+ Ajouter un rappel</a>
<?php if (empty($rappels)): ?>
    <p>Aucun rappel pour ce chat.</p>
<?php else: ?>
    <?php foreach ($rappels as $rappel): ?>
        <div>
            <p><strong><?= $rappel['typeRap'] ?></strong></p>
            <p>Date : <?= $rappel['timeRap'] ?></p>
            <p>Description : <?= $rappel['descriptionRap'] ?></p>
            <a href="index.php?action=supprimerRappel&idRap=<?= $rappel['idRap'] ?>&idC=<?= $chat['idC'] ?>">Supprimer</a>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<h2>Suivi santé</h2>
<a href="index.php?action=suiviSante&idC=<?= $chat['idC'] ?>">+ Ajouter un suivi</a>

<?php if (empty($suivis)): ?>
    <p>Aucun suivi enregistré.</p>
<?php else: ?>
    <?php foreach ($suivis as $suivi): ?>
        <div>
            <p>Date : <?= $suivi['dateSS'] ?></p>
            <p>Poids : <?= $suivi['poidsSS'] ?> kg</p>
            <p>Taille : <?= $suivi['tailleSS'] ?> cm</p>
            <p>Commentaire : <?= $suivi['commentaireSS'] ?></p>
            <a href="index.php?action=supprimerSuivi&idSS=<?= $suivi['idSS'] ?>&idC=<?= $chat['idC'] ?>">Supprimer</a>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>
    
<a href="index.php?action=meschats">← Retour à mes chats</a>
</body>
</html>