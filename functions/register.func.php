<?php

if (isset($_POST['submit'])) { // Teste si les formulaire est soumis 

    $nom = htmlspecialchars(trim($_POST['nom_user']));
    $prenom = htmlspecialchars(trim($_POST['prenom_user']));
    $email = htmlspecialchars(trim($_POST['email_user']));
    $motpass = htmlspecialchars(trim($_POST['motpass_user']));
    $motpass_repeat = htmlspecialchars(trim($_POST['motpass_repeat']));



    $token = token(30);

    if (
        !empty($nom) && !empty($prenom) && !empty($email)
        && !empty($motpass) && !empty($motpass_repeat)
    ) {

        $motpasslenght = strlen($motpass);
        if ($motpasslenght >= 8) {

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (email_taken($email)) {

                    $message = "<font color='red'>Cette adresse email est déjà utilisée !</font>";
                } else {

                    if ($motpass == $motpass_repeat) {

                        $longeurCle = 15;
                        $Cle = "";
                        for ($i = 1; $i < $longeurCle; $i++) {

                            $Cle .= mt_rand(0, 9);
                        }


                        userRegister($nom, $prenom, $email, $motpass, $Cle, $token);
                        $message = "<font color='green'>Utilisateur enregistré avec succès !</font>";
                    } else {
                        $message = "<font color='red'>Les deux mots de passes ne sont pas identiques !</font>";
                    }
                }
            } else {
                $message = "<font color='red'>Votre adresse email n'est pas valide !</font>";
            }
        } else {
            $message = "<font color='red'>Mot de passe trop court !</font>";
        }
    } else {

        $message = "<font color='red'>Tous les champs ne sont pas remplis !</font>";
    }
}


// La fonction qui permet à l'utilisateur de créer son compte
function userRegister($nom, $prenom, $email, $motpass,  $Cle, $token)
{

    global $db;
    $sql = "INSERT INTO users(nom_user, prenom_user, email_user, motpass_user, cle_user, token_user,  created) VALUES(:nom_user, :prenom_user, :email_user, :motpass_user, :cle_user, :token_user, NOW())";
    $req = $db->prepare($sql);
    $c = ([

        'nom_user'        => $nom,
        'prenom_user'     => $prenom,
        'email_user'      => $email,
        'motpass_user'    => sha1($motpass),
        'cle_user'        => $Cle,
        'token_user'      => $token,

    ]);
    $req->execute($c);
}


// La fonction qui permet de verifier si l'email a déjà été utilisee
function email_taken($email)
{

    global $db;

    $e = ['email_user'     => $email];

    $sql = "SELECT * FROM users WHERE email_user =:email_user";
    $req = $db->prepare($sql);
    $req->execute($e);
    $free = $req->rowCount();

    return $free;
}

// La fonction qui permet de generer un token à l'utilisateur crée
function token($length)
{

    $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
    return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
}
