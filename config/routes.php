<?php
// Tableau associatif qui associe une route à une méthode du controller
// Structure: "nom de la route" => "nom de la méthode"
$routes = [
    "index" => "index",
    "contact" => "contact",
    "compte-connexion-submit" => "connecterSubmit",
    "admin" => "connexionCompte",
    "compte-admin" => "compteAdmin",
    "compte-creation-submit" => "creerCompteSubmit",
    "deconnection" => "seDeconnecter",
    "suppression-utilisateur" => "supprimerUnUtilisateur",
    "modification-utilisateur" => "modifierUnUtilisateur",
    "modification-utilisateur-submit" => "modifierUnUtilisateurSubmit",
    "categorie-creation-submit" => "categorieCreationSubmit",
    "modification-categories" => "modifierUneCategorie",
    "modification-categories-submit" => "modifierUneCategorieSubmit",
    "suppression-categories" => "supprimerUneCategorie",
    "plat-creation-submit" => "platCreationSubmit",
    "modification-plats" => "modifierUnPlat",
    "modification-plats-submit" => "modifierUnPlatSubmit",
    "suppression-plats" => "supprimerUnPlat",
    "infolettre-submit" => "infolettreSubmit",
    "infolettre-contact-submit" => "infolettreContactSubmit",
];