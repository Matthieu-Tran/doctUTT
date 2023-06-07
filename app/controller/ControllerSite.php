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

        $row = (count($results));
        if ($row > 0) {
            $personne = $results[0];
            $mdp = $personne->getPassword();
            if (password_verify($password, $mdp)) {
                // if ($data['estAdmin'] == 1)
                //     $_SESSION['Admin'] = 1;
                // if ($data['estModerateur'] == 1)
                //     $_SESSION['Moderateur'] = 1;
                // $_SESSION['numUtilisateur'] = $data['numUtilisateur'];
                // $_SESSION['user'] = $data['pseudoUtilisateur'];
                header('Location: router.php?action=acceuil');
            } else {
                setcookie("mdpDif", $_POST["login"], time() + 5);    // si l'utilisateur se trompe de mot de passe mais que le login est bon on initialise un cookie pour sauvegarder le login de l'utilisateur
                header('Location: router.php?action=connexion&login_err=password');
                die();
            }
        } else {
            header('Location: router.php?action=connexion&login_err=login');
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
        $rowCount = (count($results));

        // Si la requete renvoie un utilsateur alors, il existe deja
        if ($rowCount != 0) {
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            header('Location: router.php?action=inscription&reg_err=already');
            die();
        }
        if (strlen($prenom) > 40) {
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("login", $_POST["Login"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            header('Location: router.php?action=inscription&reg_err=prenom_length');
            die();
        }
        if (strlen($nom) > 40) {
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("login", $_POST["Login"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            header('Location: router.php?action=inscription&reg_err=nom_length');
            die();
        }
        if (strlen($adresse) > 40) {
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("login", $_POST["Login"], time() + 5);
            header('Location: router.php?action=inscription&reg_err=adresse_length');
            die();
        }
        if (strlen($login) > 20) { // On verifie que la longueur du login <= 100
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            header('Location: router.php?action=inscription&reg_err=pseudo_length');
            die();
        }
        if ($password != $password_retype) { // si les deux mdp saisis sont bon
            setcookie("login", $_POST["Login"], time() + 5);
            setcookie("nomUtilisateur", $_POST["Nom"], time() + 5);
            setcookie("prenomUtilisateur", $_POST["Prenom"], time() + 5);
            setcookie("adresse", $_POST["Adresse"], time() + 5);
            header('Location: router.php?action=inscription&reg_err=password');
            die();
        }
        // On hash le mot de passe avec Bcrypt, via un coût de 12
        $cost = ['cost' => 12];
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $cost);
        // On insère dans la base de données
        ModelPersonne::insert($nom, $prenom, $adresse, $login, $passwordHash, $statut, $specialite);
        $_SESSION['login'] = $login;
        header('Location: router.php?action=acceuil');
        die();
    }
}
