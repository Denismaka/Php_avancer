<?php
require('db.php');

if (isset($_POST['submit'])) { // Teste si les formulaire est soumis 

    $nom_etudiant = htmlspecialchars(trim($_POST['nom_etudiant']));
    $prenom_etudiant = htmlspecialchars(trim($_POST['prenom_etudiant']));
    $matricule_etudiant = 1;
    $date_naissance = htmlspecialchars(trim($_POST['date_naissance_etudiant']));
    $promotion = intval(htmlspecialchars(trim($_POST['id_promotion'])));

    $photo = $_FILES['image_etudiant']['name'];
    $chemin = "assets/images/etudiants/" . $photo;

    if (!empty($nom_etudiant) && !empty($prenom_etudiant) 
    && !empty($matricule_etudiant) && !empty($date_naissance)) {

        createEtudiant($nom_etudiant, $prenom_etudiant, $matricule_etudiant, $date_naissance, $promotion, $photo, $chemin);
        
        $message = "L'étudiant crée avec succéss";

    } else {
        $message = "Tous les champs ne sont pas remplis";
    } 
}
// Cette fonction permet l'insertion d'un post dans la BDD
function  createEtudiant($nom_etudiant, $prenom_etudiant, $matricule_etudiant, $date_naissance, $promotion, $photo, $chemin)
{

    global $db;
    $sql = "INSERT INTO etudiant(nom_etudiant, prenom_etudiant, matricule_etudiant, date_naissance_etudiant, id_promotion, image_etudiant, created) 
            VALUES(:nom_etudiant, :prenom_etudiant, :matricule_etudiant, :date_naissance_etudiant, :id_promotion, :image_etudiant,  NOW())";
    $req = $db->prepare($sql);
    $c = ([
        'nom_etudiant'               => $nom_etudiant,
        'prenom_etudiant'            => $prenom_etudiant,
        'matricule_etudiant'         => $matricule_etudiant,
        'date_naissance_etudiant'    => $date_naissance,
        'id_promotion'               => $promotion,
        'image_etudiant'             => $photo
        
    ]);
    move_uploaded_file($_FILES['image_etudiant']['tmp_name'], $chemin);
    $response = $req->execute($c);

  
    // if ($response) {

    //     header("Location: index.php");

    // } 
   
}


// 1.Compteur des etudiants
function Compteur_etudiant()
{

    global $db;

    $sql = "SELECT id_promotion FROM promotion";
    $req = $db->prepare($sql);
    $req->execute();

    $exist = $req->rowCount();

    return $exist;
}

$Compteur_etudiants = Compteur_etudiant();
