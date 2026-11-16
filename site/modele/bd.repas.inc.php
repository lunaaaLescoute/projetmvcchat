<?php
include_once 'bd.inc.php';

function getRepasByChat($idC) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT repas.*, typerepas.nomTR 
                          FROM repas 
                          JOIN typerepas ON repas.typeRe = typerepas.idTR 
                          WHERE repas.chatID = :idC
                          ORDER BY repas.dateRe ASC");
    $req->bindValue(':idC', $idC, PDO::PARAM_INT);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function getTypeRepas() {
    $cnx = connexionPDO();
    $req = $cnx->prepare("SELECT * FROM typerepas");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function addRepas($chatID, $dateRe, $quantiteRe, $typeRe) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("INSERT INTO repas (chatID, dateRe, quantiteRe, typeRe) 
                          VALUES (:chatID, :dateRe, :quantiteRe, :typeRe)");
    $req->bindValue(':chatID', $chatID, PDO::PARAM_INT);
    $req->bindValue(':dateRe', $dateRe, PDO::PARAM_STR);
    $req->bindValue(':quantiteRe', $quantiteRe, PDO::PARAM_STR);
    $req->bindValue(':typeRe', $typeRe, PDO::PARAM_INT);
    return $req->execute();
}

function delRepas($idRe) {
    $cnx = connexionPDO();
    $req = $cnx->prepare("DELETE FROM repas WHERE idRe = :idRe");
    $req->bindValue(':idRe', $idRe, PDO::PARAM_INT);
    return $req->execute();
}
?>