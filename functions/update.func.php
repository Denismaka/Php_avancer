<?php
// require('db.php');

if (isset($_POST['submitUpdate'])) {
    $nom = htmlspecialchars(trim($_POST['nom_etudiant']));
    $prenom = htmlspecialchars(trim($_POST['prenom_etudiant']));
    $id_promotion = intval($_POST['id_promotion']);
    $matricule = 1; // Assurez-vous que cela est défini correctement
    $date_naissance = htmlspecialchars(trim($_POST['date_naissance_etudiant']));
    $id_etudiant = intval(htmlspecialchars(trim($_POST['id_etudiant'])));


    $photo = $_FILES['image_etudiant']['name'];
    $chemin = "assets/images/etudiants/" . $photo;


    // Traitement de la mise à jour de l'image de l'etudiant
    if (isset($_FILES['image_etudiant']) && !empty($_FILES['image_etudiant']['name'])) {

        $tailleMax = 2097152;
        $extensionValides = array('jpg', 'jpeg', 'png', 'gif');

        if ($_FILES['image_etudiant']['size'] <= $tailleMax) {

            $extensionUploads = strtolower(substr(strrchr($_FILES['image_etudiant']['name'], '.'), 1));

            if (in_array($extensionUploads, $extensionValides)) {

                $chemin = "assets/images/etudiants/" . $id_etudiant . "." . $extensionUploads;
                $deplacement = move_uploaded_file($_FILES['image_etudiant']['tmp_name'], $chemin);

                if ($deplacement) {
                    updateImageEtudiant($extensionUploads, $id_etudiant);
?>
                    <script>
                        window.location.replace("index.php");
                    </script>
<?php
                } else {
                    $message = "<font color='red'>L'image n'a pas été importée !</font>";
                }
            } else {
                $message = "<font color='red'>L'image de l'etudiant  doit être au format jpg, jpeg, png ou gif !</font>";
            }
        } else {
            $message = "<font color='red'>L'image de l'etudiant ne doit pas depasser 2Mo !</font>";
        }
    }
}



// Cette fonction permet la mise à jour de l'image de l'etudiant
function updateImageEtudiant($extensionUploads, $id_etudiant)
{

    global $db;
    $a = [

        'image_etudiant'     => $id_etudiant . "." . $extensionUploads,
        'id_etudiant'        => $id_etudiant
    ];
    $sql = "UPDATE etudiant SET image_etudiant =:image_etudiant WHERE id_etudiant = :id_etudiant";
    $req = $db->prepare($sql);
    $req->execute($a);
}

// Fonction pour mettre à jour les informations de l'étudiant
function updateEtudiant($nom, $prenom, $id_promotion, $matricule, $date_naissance, $id_etudiant)
{
    global $db;
    $c = [
        'nom_etudiant'               => $nom,
        'prenom_etudiant'            => $prenom,
        'id_promotion'               => $id_promotion,
        'matricule_etudiant'         => $matricule,
        'date_naissance_etudiant'    => $date_naissance,
        'id_etudiant'                => $id_etudiant
    ];

    $sql = "UPDATE etudiant SET nom_etudiant = :nom_etudiant, prenom_etudiant = :prenom_etudiant, id_promotion = :id_promotion, matricule_etudiant = :matricule_etudiant, date_naissance_etudiant = :date_naissance_etudiant, created = NOW() WHERE id_etudiant = :id_etudiant";
    $req = $db->prepare($sql);

    $response = $req->execute($c);
    if ($response) {
        header("Location: index.php");
        exit(); // Ajouter exit() après header pour éviter l'exécution du reste du code
    }
}

// function updateImage()
// Fonction pour récupérer les informations d'un étudiant spécifique
function etudiantSingle()
{
    global $db;

    if (isset($_GET['id_etudiant'])) {
        $id_etudiant = intval($_GET['id_etudiant']); // Sécuriser l'ID
        $sql = "SELECT * FROM etudiant JOIN promotion ON etudiant.id_promotion = promotion.id_promotion WHERE etudiant.id_etudiant = :id_etudiant";
        $req = $db->prepare($sql);
        $req->execute(['id_etudiant' => $id_etudiant]);

        return $req->fetchObject();
    } else {
        return null;
    }
}

$etudiant = etudiantSingle();

// Fonction pour récupérer toutes les promotions
function get_promotion()
{
    global $db;

    $req = $db->query("SELECT * FROM promotion ORDER BY id_promotion DESC");
    $results = [];

    while ($rows = $req->fetchObject()) {
        $results[] = $rows;
    }

    return $results;
}


$promotions = get_promotion();
