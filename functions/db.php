<?php
// session_start();

// Maniere avancée 
$dbhost = 'localhost';
$dbname = 'departement_science_informatique';
$dbuser = 'root';
$dbpassword = '';

try {
    // connection à la base de donnée
    $db = new PDO(
        'mysql:host=' . $dbhost . ';dbname=' . $dbname,
        $dbuser,
        $dbpassword,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)
    );
} catch (PDOexception $e) {
    die("Une erreur est survenue lors de la connexion à la base des données");
}
