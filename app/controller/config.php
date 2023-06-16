<!-- ----- debut config -->
<?php

// Utile pour le débugage car c'est un interrupteur pour les echos et print_r.
if (!defined('DEBUG')) {
    define('DEBUG', FALSE);
}

// ===============
// Configuration de la base de données sur dev-isi
$dsn = 'mysql:dbname=schuler1;host=localhost;charset=utf8';
$username = 'schuler1'; // Remplacez par votre nom d'utilisateur
$password = 'ns5MnYeg'; // Remplacez par votre mot de passe

if (!defined('LOCAL')) {
    define('LOCAL', TRUE);
}

if (LOCAL) {
    // Configuration de la base de données sur localhost
    $dsn = 'mysql:dbname=schuler1;host=localhost;charset=utf8';
    $username = 'schuler1'; // Remplacez par votre nom d'utilisateur
    $password = 'ns5MnYeg'; // Remplacez par votre mot de passe
}

// chemin absolu vers le répertoire du projet SUR DEV-ISI 
$root = dirname(dirname(__DIR__)) . "/";


if (DEBUG) {
    echo ("<ul>");
    echo (" <li>dsn = $dsn</li>");
    echo (" <li>username = $username</li>");
    echo (" <li>password = $password</li>");
    echo ("<li>---</li>");
    echo (" <li>root = $root</li>");

    echo ("</ul>");
}
?>