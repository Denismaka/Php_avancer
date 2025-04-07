<?php
// require('db.php');

function etudiantSingle()
{
    global $db;
    $sql = "SELECT * FROM etudiant JOIN promotion ON etudiant.id_promotion = promotion.id_promotion WHERE etudiant.id_etudiant='{$_GET['id_etudiant']}'";

    $req = $db->query($sql);

    $result = $req->fetchObject();
    return $result;
}



$etudiant = etudiantSingle();
