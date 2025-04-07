<?php
require('db.php');

function get_etudiant()
{
    global $db;
    $requetteJoin = "SELECT * FROM etudiant ORDER BY id_etudiant DESC";
    $req =  $db->query($requetteJoin);
    $results = [];
    while ($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}
$etudiants = get_etudiant();

// 1.Compteur des etudiants
// function Compteur_clients()
// {
//     global $db;
//     $sql = "SELECT id_etudiant FROM etudiant";
//     $req = $db->prepare($sql);
//     $req->execute();
//     $exist = $req->rowCount();
//     return $exist;
// }
// $Compteur_etudiants = Compteur_clients();
// 
