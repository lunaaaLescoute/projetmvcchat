<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "connexion.php";
    $lesActions["inscription"] = "inscription.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["ajouterChat"] = "chat.php";
    $lesActions["meschats"] = "meschats.php";
    $lesActions["detailChat"] = "detailChat.php";
    $lesActions["supprimerChat"] = "chat.php";
    $lesActions["supprimerRappel"] = "detailChat.php";
    $lesActions["supprimerNote"] = "detailChat.php";
    $lesActions["supprimerRepas"] = "detailChat.php";
    $lesActions["notes"] = "notes.php";
    $lesActions["rappel"] = "rappel.php";
    $lesActions["suiviSante"] = "suiviSante.php";
    $lesActions["supprimerSuivi"] = "detailChat.php";
    $lesActions["modifierChat"] = "modifierChat.php";
    $lesActions["supprimerCommentaire"] = "meschats.php";
    $lesActions["supprimerPhotoChat"] = "modifierChat.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
}

?>