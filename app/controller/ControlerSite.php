<?php
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
        $vue = $root . '/app/view/viewAccueil.php';
        if (DEBUG)
            echo ("ControllerSite : Accueil : vue = $vue");
        require($vue);
    }
}
