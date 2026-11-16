<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/authentification.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $mailU  = $_POST['mailU'];
    $mdpU   = $_POST['mdpU'];

    $userExistant = getUtilisateurByMailU($mailU);

    if ($userExistant) {
        $erreur = "Cet email est déjà utilisé";
    } else {
        addUtilisateur($mailU, $mdpU, $pseudo);
        login($mailU, $mdpU);
        header('Location: index.php?action=ajouterChat');
        exit();
    }
}

require "$racine/vue/vueInscription.php";
?>