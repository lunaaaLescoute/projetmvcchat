<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes chats</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Bonjour <?= $util['pseudoU'] ?> !</h1>
<a href="index.php?action=ajouterChat">+ Ajouter un chat</a>
<a href="index.php?action=deconnexion">Se déconnecter</a>

<h2>Mes chats</h2>

<?php if (empty($chats)): ?>
    <p>Vous n'avez pas encore de chat. 
        <a href="index.php?action=ajouterChat">En ajouter un ?</a>
    </p>
<?php else: ?>
    <?php foreach ($chats as $chat): ?>
        <div>
            <a href="index.php?action=detailChat&idC=<?= $chat['idC'] ?>">
                <h3><?= $chat['nomC'] ?></h3>
            </a>
            <p>Race : <?= $chat['nomR'] ?></p>
            <p>Poids : <?= $chat['poidsC'] ?> kg</p>
            <p>Né le : <?= $chat['naissanceC'] ?></p>
            <p>Sexe : <?= $chat['sexeC'] === 'M' ? 'Mâle' : 'Femelle' ?></p>
            <?php if ($photoChat): ?>
                <img src="<?= $photoChat['cheminPh'] ?>" alt="<?= $chat['nomC'] ?>" style="max-width:300px;">
            <?php endif; ?>
            <a href="index.php?action=modifierChat&idC=<?= $chat['idC'] ?>">Modifier</a><br />
            <a href="index.php?action=supprimerChat&idC=<?= $chat['idC'] ?>">Supprimer</a>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<h2>Commentaires</h2>

<form method="POST" action="index.php?action=meschats">
    <textarea name="texteCom" placeholder="Partagez une observation..." required></textarea><br>
    <button type="submit">Publier</button>
</form>

<?php if (empty($commentaires)): ?>
    <p>Aucun commentaire pour le moment.</p>
<?php else: ?>
    <?php foreach ($commentaires as $com): ?>
        <div>
            <p><strong><?= $com['pseudoU'] ?></strong> — <?= $com['datePublicationCom'] ?></p>
            <p><?= $com['texteCom'] ?></p>
            <?php if ($com['userID'] == $util['idU']): ?>
                <a href="index.php?action=supprimerCommentaire&idCom=<?= $com['idCom'] ?>">Supprimer</a>
            <?php endif; ?>
        </div>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>