<?php
include 'layouts/header.php';

$id = $_GET['id_etudiant'];
$sql = "DELETE FROM etudiant WHERE id_etudiant =:id_etudiant";
$query = $db->prepare($sql);
$response = $query->execute(['id_etudiant' => $id]);
if ($response) {

    header("Location: index.php");
}
