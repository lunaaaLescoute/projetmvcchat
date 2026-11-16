<?php
include_once 'bd.inc.php';

function getChatsByUser($idU) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT chat.*, race.nomR FROM chat 
                          JOIN race ON chat.raceID = race.idR 
                          WHERE chat.userID = :idU");
    $req->bindValue(':idU', $idU, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addChat($userID, $raceID, $nomC, $poidsC, $tailleC, $naissanceC, $sexeC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO chat 
        (userID, raceID, nomC, poidsC, tailleC, naissanceC, sexeC) 
        VALUES (:userID, :raceID, :nomC, :poidsC, :tailleC, :naissanceC, :sexeC)");
    $req->bindValue(':userID', $userID, PDO::PARAM_INT);
    $req->bindValue(':raceID', $raceID, PDO::PARAM_INT);
    $req->bindValue(':nomC', $nomC, PDO::PARAM_STR);
    $req->bindValue(':poidsC', $poidsC, PDO::PARAM_STR);
    $req->bindValue(':tailleC', $tailleC, PDO::PARAM_STR);
    $req->bindValue(':naissanceC', $naissanceC, PDO::PARAM_STR);
    $req->bindValue(':sexeC', $sexeC, PDO::PARAM_STR);
    $req->execute();
    return $cnx->lastInsertId(); // retourne l'id du chat créé
}

function delChat($idC) {
    $cnx = connexionPDO();
    
    // Supprimer tout ce qui est lié au chat
    $cnx->prepare("DELETE FROM couleurschat WHERE chatID = :idC")->execute([':idC' => $idC]);
    $cnx->prepare("DELETE FROM rappel WHERE chatID = :idC")->execute([':idC' => $idC]);
    $cnx->prepare("DELETE FROM notes WHERE chatID = :idC")->execute([':idC' => $idC]);
    $cnx->prepare("DELETE FROM repas WHERE chatID = :idC")->execute([':idC' => $idC]);
    $cnx->prepare("DELETE FROM suivisante WHERE chatID = :idC")->execute([':idC' => $idC]);
    $cnx->prepare("DELETE FROM photos WHERE chatID = :idC")->execute([':idC' => $idC]);
    
    // Supprimer le chat
    $req = $cnx->prepare("DELETE FROM chat WHERE idC = :idC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    return $req->execute();
}

function getRaces() {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM race");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getChatById($idC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT chat.*, race.nomR, race.descriptionR 
                          FROM chat 
                          JOIN race ON chat.raceID = race.idR 
                          WHERE chat.idC = :idC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

function updatePoidsEtTaille($idC, $poidsSS, $tailleSS) {
    $cnx = connexionPDO();
    
    if ($poidsSS && $tailleSS) {
        $req = $cnx->prepare("UPDATE chat SET poidsC = :poids, tailleC = :taille WHERE idC = :idC");
        $req->bindValue(':poids', $poidsSS, PDO::PARAM_STR);
        $req->bindValue(':taille', $tailleSS, PDO::PARAM_STR);
        $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    } elseif ($poidsSS) {
        $req = $cnx->prepare("UPDATE chat SET poidsC = :poids WHERE idC = :idC");
        $req->bindValue(':poids', $poidsSS, PDO::PARAM_STR);
        $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    } elseif ($tailleSS) {
        $req = $cnx->prepare("UPDATE chat SET tailleC = :taille WHERE idC = :idC");
        $req->bindValue(':taille', $tailleSS, PDO::PARAM_STR);
        $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    } else {
        return;
    }
    
    return $req->execute();
}

function updateChat($idC, $raceID, $nomC, $poidsC, $tailleC, $naissanceC, $sexeC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("UPDATE chat SET 
        raceID = :raceID,
        nomC = :nomC,
        poidsC = :poidsC,
        tailleC = :tailleC,
        naissanceC = :naissanceC,
        sexeC = :sexeC
        WHERE idC = :idC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->bindValue(':raceID', $raceID, PDO::PARAM_INT);
    $req->bindValue(':nomC', $nomC, PDO::PARAM_STR);
    $req->bindValue(':poidsC', $poidsC, PDO::PARAM_STR);
    $req->bindValue(':tailleC', $tailleC, PDO::PARAM_STR);
    $req->bindValue(':naissanceC', $naissanceC, PDO::PARAM_STR);
    $req->bindValue(':sexeC', $sexeC, PDO::PARAM_STR);
    return $req->execute();
}

?>
















