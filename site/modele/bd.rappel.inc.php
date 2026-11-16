<?php
include_once 'bd.inc.php';

function getRappelByChat($idC){
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT rappel.* FROM rappel WHERE rappel.chatID = :idC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addRappel($chatID,$typeRap,$timeRap,$descriptionRap,$recurrenceRap){
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO rappel 
        (chatID,typeRap,timeRap,descriptionRap,recurrenceRap) 
        VALUES (:chatID,:typeRap,:timeRap,:descriptionRap,:recurrenceRap)");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':typeRap', $typeRap, PDO::PARAM_STR);
    $req->bindValue(':timeRap', $timeRap, PDO::PARAM_STR);
    $req->bindValue(':descriptionRap', $descriptionRap, PDO::PARAM_STR);
    $req->bindValue(':recurrenceRap', $recurrenceRap, PDO::PARAM_STR);
    return $req->execute();
}


function delRappel($idRap) {
    $resultat = -1;
    try {
        $cnx = connexionPDO();

        $req = $cnx->prepare("DELETE FROM rappel WHERE idRap=:idRap");
        $req->bindValue(':idRap', $idRap, PDO::PARAM_INT);
        
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}
?>