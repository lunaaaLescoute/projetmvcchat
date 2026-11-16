<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.chat.inc.php";
include_once "$racine/modele/bd.rappel.inc.php";
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.notes.inc.php";
include_once "$racine/modele/bd.repas.inc.php";
include_once "$racine/modele/bd.suivisante.inc.php";
include_once "$racine/modele/bd.couleurs.inc.php";
include_once "$racine/modele/bd.photos.inc.php";

if (!isLoggedOn()) {
    require "$racine/vue/vueConnexion.php";
    exit();
}

$idC = $_GET['idC'] ?? null;

if (isset($_GET['action']) && $_GET['action'] === 'supprimerRappel') {
    delRappel($_GET['idRap']);
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}
if (isset($_GET['action']) && $_GET['action'] === 'supprimerNote') {
    delNote($_GET['idN']);
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}
if (isset($_GET['action']) && $_GET['action'] === 'supprimerRepas') {
    delRepas($_GET['idRe']);
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}
if (isset($_GET['action']) && $_GET['action'] === 'supprimerSuivi') {
    delSuivi($_GET['idSS']);
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && $_POST['type'] === 'note') {
        addNote($idC, $_POST['contenuN']);
    } elseif (isset($_POST['type']) && $_POST['type'] === 'repas') {
        addRepas($idC, $_POST['dateRe'], $_POST['quantiteRe'], $_POST['typeRe']);
    } elseif (isset($_POST['type']) && $_POST['type'] === 'rappel') {
        addRappel($idC, $_POST['typeRap'], $_POST['timeRap'], $_POST['descriptionRap'], $_POST['recurrenceRap']);
    }
    header('Location: index.php?action=detailChat&idC=' . $idC);
    exit();
}

$chat = getChatById($idC);
$rappels = getRappelByChat($idC);
$notes = getNotesByChat($idC);
$repas = getRepasByChat($idC);
$typesRepas = getTypeRepas();
$suivis = getSuiviByChat($idC);
$mailU = getMailULoggedOn();
$photoChat = getPhotoByChat($idC);

require "$racine/vue/vueDetailChat.php";
?>