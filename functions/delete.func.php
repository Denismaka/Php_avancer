<?php
require('db.php');

if (isset($_POST['submitDelete'])) {

    $etudiant =  intval(htmlspecialchars(trim($_POST['id_etudiant'])));



    $reponse = deleteEtudiant($etudiant);
?>
    <script>
        window.location.replace('index.php');
    </script>
<?php

}

function deleteEtudiant($etudiant)
{
    global $db;

    $sql = "DELETE FROM etudiant WHERE id_etudiant =:id_etudiant";
    $query = $db->prepare($sql);
    $response = $query->execute(['id_etudiant' => $etudiant]);
}
