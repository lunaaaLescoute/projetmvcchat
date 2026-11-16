<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.chat.inc.php";
include_once "$racine/modele/bd.commentaires.inc.php";
include_once "$racine/modele/authentification.inc.php";

if (!isLoggedOn()) {
    header('Location: index.php?action=meschats');
    exit();
}

$mailU = getMailULoggedOn();
$util  = getUtilisateurByMailU($mailU);

// Ajouter un commentaire
if (isset($_GET['action']) && $_GET['action'] === 'supprimerCommentaire') {
    delCommentaire($_GET['idCom']);
    header('Location: index.php?action=meschats');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addCommentaire($util['idU'], $_POST['texteCom']);
    header('Location: index.php?action=meschats');
    exit();
}

$chats = getChatsByUser($util['idU']);
$commentaires = getCommentaires();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['texteCom']) && !empty($_POST['texteCom'])) {
        addCommentaire($util['idU'], $_POST['texteCom']);
    }
    header('Location: index.php?action=meschats');
    exit();
}

require "$racine/vue/vueMesChats.php";
?>