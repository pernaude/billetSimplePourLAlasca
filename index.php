<?php
// Fichiers de configuration et de fonctions 
include_once 'settings/config/config.php';
include_once 'settings/functions/functions.php';

// Création de l'autoloader du site pour charger automatiquement les classes
require_once 'settings/classes/Autoloader.php';
Autoloader::register();


// Recupération de la page demandée
if (isset($_GET['page']) AND !empty($_GET['page'])) {
    $page = trim(strtolower($_GET['page']));
} else {
    $page = 'home';
}


// Récupération de toutes les pages dans un tableau
$allPages = scandir('app/controllers/');

// On vérifie si la page demandée existe dans le tableau contenant toutes les pages
if (in_array($page.'_controller.php', $allPages)) {

    // On se connecte maintenant à la base de données
    include_once 'settings/config/db.php';

    // On inclut les différents composants de la page
    include_once 'app/models/'.$page.'_model.php';
    include_once 'app/controllers/'.$page.'_controller.php';
    include_once 'app/views/'.$page.'_view.php';

} else {

    // Si la page demandée n'existe pas, on affiche la page d'erreur
    include_once 'app/models/error_model.php';
    include_once 'app/controllers/error_controller.php';
    include_once 'app/views/error_view.php';

}