<?php

require_once '../model/ModelPersonne.php';
class ControllerSite
{
    // --- page d'acceuil
    public static function Accueil()
    {
        include 'config.php';
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerSite : Accueil : vue = $vue");
        require($vue);
    }

    // --- page de connexion
    public static function Connexion()
    {
        include 'config.php';
        $vue = $root . '/app/view/connection/login.php';
        if (DEBUG)
            echo ("ControllerSite : Accueil : vue = $vue");
        require($vue);
    }

    // --- page de connexion
    public static function Inscription()
    {
        include 'config.php';
        $vue = $root . '/app/view/connection/inscription.php';
        if (DEBUG)
            echo ("ControllerSite : Accueil : vue = $vue");
        require($vue);
    }

    public static function connection_traitement()
    {
        $Login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $results = ModelPersonne::getUser($Login);
        $row = count($results);
        if ($row > 0) {
            $personne = $results[0];
            $mdp = $personne->getPassword();
            if (password_verify($password, $mdp)) {
                // if ($data['estAdmin'] == 1)
                //     $_SESSION['Admin'] = 1;
                // if ($data['estModerateur'] == 1)
                //     $_SESSION['Moderateur'] = 1;
                // $_SESSION['numUtilisateur'] = $data['numUtilisateur'];
                $statut = $personne->getStatut();
                $statutLabel = $personne->getStatusLabel($statut);
                $_SESSION['statut'] = $statutLabel;
                $_SESSION['login'] = $Login;
                $_SESSION['personne'] = $personne;
                echo '<script>window.location.href = "router.php?action=acceuil";</script>';
                die();
            } else {
                setcookie("mdpDif", $_POST["login"], time() + 5);    // si l'utilisateur se trompe de mot de passe mais que le login est bon on initialise un cookie pour sauvegarder le login de l'utilisateur
                echo '<script>window.location.href = "router.php?action=connexion&login_err=password";</script>';
                die();
            }
        } else {
            echo '<script>window.location.href = "router.php?action=connexion&login_err=login";</script>';
            die();
        }
        // ----- Construction chemin de la vue
        include 'config.php';
    }


    public static function inscription_traitement()
    {
        //include 'config.php';
        // Si les variables existent et qu'elles ne sont pas vides
        $adresse = htmlspecialchars($_POST['Adresse']);
        $nom = htmlspecialchars($_POST['Nom']);
        $prenom = htmlspecialchars($_POST['Prenom']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);
        $specialite = htmlspecialchars($_POST['specialite']);
        $statut = htmlspecialchars($_POST['statut']);
        $login = htmlspecialchars($_POST['Login']);
        $results = ModelPersonne::getUser($login);
        $rowCount = count($results);

        // Si la requete renvoie un utilsateur alors, il existe deja
        if ($rowCount != 0) {
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            echo '<script>window.location.href = "router.php?action=inscription&reg_err=already";</script>';
            die();
        }
        // Si le prénom est trop long alors on affiche une erreur pareil pour le nom, l'adresse et le login
        if (strlen($prenom) > 40) {
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("login", $_POST["Login"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            echo '<script>window.location.href = "router.php?action=inscription&reg_err=prenom_length";</script>';
            die();
        }
        if (strlen($nom) > 40) {
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("login", $_POST["Login"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            echo '<script>window.location.href = "router.php?action=inscription&reg_err=nom_length";</script>';
            die();
        }
        if (strlen($adresse) > 40) {
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("login", $_POST["Login"], time() + 5);
            echo '<script>window.location.href = "router.php?action=inscription&reg_err=adresse_length";</script>';
            die();
        }
        if (strlen($login) > 20) { // On verifie que la longueur du login <= 100
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            echo '<script>window.location.href = "router.php?action=inscription&reg_err=pseudo_length";</script>';
            die();
        }
        if ($password != $password_retype) { // si les deux mdp saisis sont bon
            setcookie("login", $_POST["Login"], time() + 5);
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            echo '<script>window.location.href = "router.php?action=inscription&reg_err=password";</script>';
            die();
        }
        // On hash le mot de passe avec Bcrypt, via un coût de 12
        $cost = ['cost' => 12];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $cost);
        // On insère dans la base de données
        ModelPersonne::insert($nom, $prenom, $adresse, $login, $passwordHash, $statut, $specialite);
        $results = ModelPersonne::getUser($login);
        $personne = $results[0];
        $statut = $personne->getStatut();
        $statutLabel = $personne->getStatusLabel($statut);
        $_SESSION['statut'] = $statutLabel;
        $_SESSION['login'] = $login;
        $_SESSION['personne'] = $personne;
        echo '<script>window.location.href = "router.php?action=acceuil";</script>';
        die();
    }


    public static function deconnexion()
    {
        session_destroy(); // on détruit la/les session(s), soit si vous utilisez une autre session, utilisez de préférence le unset()
        echo '<script>window.location.href = "router.php?action=acceuil";</script>'; // On redirige
        die();
    }
}
