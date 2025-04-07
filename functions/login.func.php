<?php



if (isset($_POST['submit'])) {

    $email_user = isset($_POST['email_user']) ? trim(htmlspecialchars($_POST['email_user'])) : '';
    $motpass_user = isset($_POST['motpass_user']) ? trim(htmlspecialchars($_POST['motpass_user'])) : '';

    if (!empty($email_user) && !empty($motpass_user)) {

        if (userConnect($email_user) == 1) {
            $pas = userInfo($email_user, $motpass_user);
            $motpass_user_hasher = sha1($motpass_user);

            if ($motpass_user_hasher == $pas['motpass_user']) {
                $userInfo = userInfo($email_user, $motpass_user);

                if (is_array($userInfo)) {
                    $userInfo = userInfo($email_user, $motpass_user);
                    $_SESSION['id_user'] = $userInfo['id_user'];
                    $_SESSION['nom_user'] = $userInfo['nom_user'];
                    $_SESSION['prenom_user'] = $userInfo['prenom_user'];
                    $_SESSION['email_user'] = $userInfo['email_user'];
                    $_SESSION['motpass_user'] = $userInfo['motpass_user'];
                    $_SESSION['id_role'] = $userInfo['id_role'];
                    $_SESSION['confirmation_user'] = $userInfo['confirmation_user'];
                    header('Location: create.php?id_user=' . $_SESSION['id_user']);
                } else {
                    $message = "<font color='red'>Erreur lors de la récupération des inforamations utilisateurs. </font>";
                }
            } else {
                $message = "<font color='red'>Mot de passe incorrect !</font>";
            }
        } else {
            $message = "<font color='red'>Cet utilisateur n'existe pas !</font>";
        }
    } else {
        $message = "<font color='red'>Tous les champs ne sont pas remplis !</font>";
    }
}


// Permet la connection de users à la DB
function userConnect($email_user)
{
    $motpass_user = htmlspecialchars(trim($_POST['motpass_user']));
    global $db;

    $a = ['email_user' => $email_user];

    $sql = "SELECT * FROM users WHERE email_user = :email_user";
    $req = $db->prepare($sql);
    $req->execute($a);

    $exist = $req->rowCount();

    return $exist;
}


// Permet de récuperé toutes les informations de l'user à la DB
function userInfo($email_user, $motpass_user)
{

    global $db;

    $a = [

        'email_user'     => $email_user,
        'motpass_user'   => sha1($motpass_user)
    ];


    $sql = "SELECT * FROM users WHERE email_user = :email_user AND motpass_user = :motpass_user";
    $req = $db->prepare($sql);
    $req->execute($a);

    $exist = $req->fetch();

    return $exist;
}
