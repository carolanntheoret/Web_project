<?php

// Affichage de toutes les erreurs pendant le développement
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupère le contrôleur du site
require_once "controllers/SiteController.php";
// Récupère $routes
require_once("config/routes.php");

// Démarrage de la session
session_start();

$controller = new SiteController();

// Sélection de la route demandée
$chemin = $_GET["path"] ?? "index";

// Méthode à appeler dans le controller
$methode = $routes[$chemin] ?? "erreur404";

// Appel dynamique de la méthode
$controller->{$methode}();