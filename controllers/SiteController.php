<?php

require_once("bases/Controller.php");
require_once("models/Utilisateurs.php");
require_once("models/Categories.php");
require_once("models/Plats.php");
require_once("models/Infolettre.php");
require_once("utils/Upload.php");

class SiteController extends Controller
{
    /**
     * Affiche la page d'Accueil
     *
     * @return void
     */
    public function index()
    {
        $categories = (new Categories())->toutesCategories();
        $plats_categories = (new Categories())->tousPlatsCategories();


        include("views/index.view.php");
    }

    /**
     * Affiche la page de Contact
     *
     * @return void
     */
    public function contact()
    {
        include("views/contact.view.php");
    }

    /**
     * Valide le paramètre GET
     *
     * @param [type] $parametre_get
     * @return bool
     */
    public function validerGET($parametre_get)
    {
        // Validation
        if (!isset($parametre_get) || empty($parametre_get)) {
            return false;
        }
        return true;
    }

    /**
     * Affiche le formulaire de connexion de compte
     *
     * @return void
     */
    public function connexionCompte()
    {
        include("views/connexion.view.php");
    }

    /**
     * Traite les informations soumises lors de la création de compte
     *
     * @return bool
     */
    public function creerCompteSubmit()
    {
        // Empêcher le navigateur de visiter la route sans soumettre de formulaire
        if (!isset($_POST)) $this->rediriger("admin");
        if (empty($_POST)) $this->rediriger("admin?erreur=1");


        // Validation des champs
        if (empty(($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["courriel"]) || empty($_POST["mot_de_passe"]))) $this->rediriger("compte-admin?erreur_compte=1");

        // Récupération des informations
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $courriel = $_POST["courriel"];
        $mot_de_passe = $_POST["mot_de_passe"];

        // Création d'un utilisateur (insertion dans la BDD)
        $succes = (new Utilisateurs())->creer($prenom, $nom, $courriel, $mot_de_passe);

        // Redirection    
        if ($succes) $this->rediriger("compte-admin?compte_cree=1");
        $this->rediriger("compte-admin?erreur=1");
    }

    /**
     * Traite les informations de connexion
     *
     * @return void
     */
    public function connecterSubmit()
    {
        // Empêcher le navigateur de visiter la route sans soumettre de formulaire
        if (!isset($_POST)) $this->rediriger("admin");
        if (empty($_POST)) $this->rediriger("admin?erreur=1");


        // Validation des paramètres POST reçus
        if (empty(($_POST["courriel"]) || empty($_POST["mot_de_passe"]))) $this->rediriger("admin?erreur_connexion=1");

        $modele_utilisateurs = new Utilisateurs();

        // Vérification des informations
        // Redirection si utilisateur absent ou mot de passe erroné
        if (!$modele_utilisateurs->verifier($_POST["courriel"], $_POST["mot_de_passe"])) $this->rediriger("admin?erreur_connexion=1");

        // Redirection
        $this->rediriger("compte-admin");
    }

    /**
     * Affiche la page d'Administration
     *
     * @return void
     */
    public function compteAdmin()
    {
        $utilisateurs = (new Utilisateurs())->tousUtilisateurs();
        $utilisateur = (new Utilisateurs())->getUtilisateur($_SESSION["utilisateur_id"]);
        $categories = (new Categories())->toutesCategories();
        $plats = (new Plats())->tousPlats();

        include("views/administration.view.php");
    }

    /**
     * Déconnecte l'utilisateur et redirige à l'accueil
     * 
     * Lors de la déconnexion, la session est vidée
     *
     * @return void
     */
    function seDeconnecter()
    {
        // Vérification de la connexion de l'utilisateur et on vide la session
        if ($_SESSION["utilisateur_id"]) {
            $_SESSION = [];

            // Redirection
            header("location:admin?deconnexion_reussie=1");
            exit();
        }
        $this->rediriger("admin?erreur_deconnexion=1");
    }

    /**
     * Supprime un utilisateur spécifique
     *
     * @return bool $succes
     */
    public function supprimerUnUtilisateur()
    {
        // Si aucun paramètre GET = redirection
        if (!$this->validerGET($_GET["id"])) $this->rediriger("compte-admin?erreur=GET");

        // Récupération de l'Id de l'utilisateur à supprimer
        $utilisateur_id = $_GET["id"];

        $succes = (new Utilisateurs())->supprimerUtilisateur($utilisateur_id);

        // Redirection
        if ($succes) $this->rediriger("compte-admin?suppression_reussie=1");
        $this->rediriger("compte-admin?erreur_suppresion=1");
    }

    /**
     * Modifie un utilisateur spécifique
     * 
     * @return void
     */
    public function modifierUnUtilisateur()
    {
        // Si aucun paramètre GET = redirection
        if (!$this->validerGET($_GET["id"])) $this->rediriger("compte-admin?erreur=GET");

        // Récupération de l'Id de l'utilisateur à modifier
        $utilisateur_id = $_GET["id"];

        $utilisateur = (new Utilisateurs())->getUtilisateur($utilisateur_id);

        include("views/modification.view.php");
    }

    /**
     * Traite les informations de modification d'utilisateur
     *
     * @return bool
     */
    public function modifierUnUtilisateurSubmit()
    {
        // Récupérer et valider les parametres POST
        if (empty($_POST["id"] || empty(($_POST["prenom"]) || empty($_POST["nom"]) || empty($_POST["courriel"])))) $this->rediriger("compte-admin?erreur_util=1");

        $id = $_POST["id"];
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $courriel = $_POST["courriel"];
        $mot_de_passe = $_POST["mot_de_passe"];

        // Envoi des données au modèle pour mise à jour

        $succes = (new Utilisateurs())->modifierUtilisateur($id, $prenom, $nom, $courriel, $mot_de_passe);

        // Redirection si mise à jour réussie
        if ($succes) $this->rediriger("compte-admin?modif_util_reussie=1");
        $this->rediriger("compte-admin?erreur_modif_util=1");
    }

    /**
     * Supprime un plat
     *
     * @return bool
     */
    public function supprimerUnPlat()
    {
        // Si aucun paramètre GET = redirection
        if (!$this->validerGET($_GET["id"])) $this->rediriger("compte-admin?erreur=GET");

        // Récupération de l'Id du plat à supprimer
        $plat_id = $_GET["id"];

        $succes = (new Plats())->supprimerPlat($plat_id);

        // Redirection
        if ($succes) $this->rediriger("compte-admin?sup_plat_reussie=1");
        $this->rediriger("compte-admin?erreur_sup=1");
    }

    /**
     * Supprime une catégorie
     *
     * @return bool
     */
    public function supprimerUneCategorie()
    {

        // Si aucun paramètre GET = redirection
        if (!$this->validerGET($_GET["id"])) $this->rediriger("compte-admin?erreur=GET");

        // Récupération de l'Id de la catégorie à supprimer
        $categorie_id = $_GET["id"];

        $succes = (new Categories())->supprimerCategorie($categorie_id);

        // Redirection
        if ($succes) $this->rediriger("compte-admin?sup_cat_reussie=1");
        $this->rediriger("compte-admin?erreur_sup=1");
    }


    /**
     * Traite les informations soumises lors de la création d'une catégorie
     *
     * @return bool
     */
    public function categorieCreationSubmit()
    {
        // Empêcher le navigateur de visiter la route sans soumettre de formulaire
        if (!isset($_POST)) $this->rediriger("compte-admin");
        if (empty($_POST)) $this->rediriger("compte-admin?erreur=1");

        // Validation des champs
        if (empty($_POST["nom"])) $this->rediriger("compte-admin?erreur=1");

        // Récupération des informations
        $nom = $_POST["nom"];

        $succes = (new Categories())->creer($nom);

        // Redirection    
        if ($succes) $this->rediriger("compte-admin?cat_cree=1");
        $this->rediriger("compte-admin?erreur_creation=1");
    }

    /**
     * Traite les informations soumises lors de la création d'un plat'
     *
     * @return bool
     */
    public function platCreationSubmit()
    {
        // Empêcher le navigateur de visiter la route sans soumettre de formulaire
        if (!isset($_POST)) $this->rediriger("compte-admin");
        if (empty($_POST)) $this->rediriger("compte-admin?erreur=1");

        // Validation des champs
        if (empty($_POST["nom"]) || empty($_POST["prix"]) || empty($_POST["description"]) || empty($_POST["categorie_1"])) $this->rediriger("compte-admin?erreur=1");

        // Récupération des informations
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $description = $_POST["description"];
        $categorie_1 = $_POST["categorie_1"];
        $categorie_2 = $_POST["categorie_2"];
        $categorie_3 = $_POST["categorie_3"];

        // Traitement du média
        $upload = new Upload("photo", ["jpg", "jpeg", "png", "webp"]);

        // Si une photo a été fournie, elle est déplacée et on récupère le chemin dans la variable $photo
        // Sinon (aucune photo fournie), on place "null" dans cette variable
        $photo = $upload->estValide() ?
            $upload->placerDans("public/uploads") :
            null;

        // Création d'un utilisateur (insertion dans la BDD)
        $succes = (new Plats())->creer($nom, $prix, $description, $photo);

        $succes2 = (new Plats())->ajoutCategorie($categorie_1, $categorie_2, $categorie_3);

        // Redirection        
        if ($succes && $succes2) $this->rediriger("compte-admin?plat_cree=1");
        $this->rediriger("compte-admin?erreur_creation=1");
    }

    /**
     * Modifie une catégorie 
     *
     * @return void
     */
    public function modifierUneCategorie()
    {
        // Si aucun paramètre GET = redirection
        if (!$this->validerGET($_GET["id"])) $this->rediriger("compte-admin?erreur=GET");

        // Récupération de l'id de la catégorie à modifer
        $categorie_id = $_GET["id"];

        $categories = (new Categories())->toutesCategories();
        $categorie_modif = (new Categories())->parId($categorie_id);

        include("views/modification.view.php");
    }

    /**
     *Traite les informations de modification de la catégorie
     *
     * @return bool
     */
    public function modifierUneCategorieSubmit()
    {
        // Récupérer et valider les parametres POST
        if (empty($_POST["id"]) || empty($_POST["nom"])) $this->rediriger("compte-admin?erreur_cat=1");

        $id = $_POST["id"];
        $nom = $_POST["nom"];

        $succes = (new Categories())->modifier($id, $nom);

        // Redirection 
        if ($succes) $this->rediriger("compte-admin?modif_cat_reussie=1");
        $this->rediriger("compte-admin?erreur_modif=1");
    }

    /**
     * Modifie un plat
     *
     * @return bool
     */
    public function modifierUnPlat()
    {
        // Si aucun paramètre GET = redirection
        if (!$this->validerGET($_GET["id"])) $this->rediriger("compte-admin?erreur=GET");

        // Récupération de l'id du plat à modifier
        $plat_id = $_GET["id"];

        $categories = (new Categories())->toutesCategories();
        $plat_modif = (new Plats())->parId($plat_id);
        $categories_plat = (new Plats())->categoriesParId($plat_id);

        include("views/modification.view.php");
    }

    /**
     * Traite les informations de modification d'un plat
     *
     * @return bool
     */
    public function modifierUnPlatSubmit()
    {
        // Récupérer et valider les parametres POST

        if (empty($_POST["id"]) || empty($_POST["nom"]))  $this->rediriger("compte-admin?erreur_plat=1");

        $id = $_POST["id"];
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $photo = $_POST["photo"];
        $description = $_POST["description"];
        $categorie_1 = $_POST["categorie_1"];
        $categorie_2 = $_POST["categorie_2"];
        $categorie_3 = $_POST["categorie_3"];

        // Envoi des données au modèle pour mise à jour

        $succes = (new Plats())->supprimerPlat($id);

        // Redirection si mise à jour réussie

        if (!$succes) $this->rediriger("compte-admin?erreur=2");

        if ((new Plats())->creer($nom, $prix, $description, $photo) && (new Plats())->ajoutCategorie($categorie_1, $categorie_2, $categorie_3)) $this->rediriger("compte-admin?modif_plat_reussie=1");
        $this->rediriger("compte-admin?erreur_modif=1");
    }
    /**
     * Traite les informations d'envoi des données de l'infolettre à la BDD 
     * (Page d'Accueil)
     * 
     * @return void
     */
    public function infolettreSubmit()
    {
        // Empêcher le navigateur de visiter la route sans soumettre de formulaire
        if (!isset($_POST)) $this->rediriger("index");
        if (empty($_POST)) $this->rediriger("index?info_erreur=1");

        // Validation des champs
        if (empty($_POST["prenom"]) || empty($_POST["courriel"])) $this->rediriger("admin?info_erreur=2");

        $prenom = $_POST["prenom"];
        $courriel = $_POST["courriel"];

        $succes = (new Infolettre())->ajout($prenom, $courriel);

        if ($succes) $this->rediriger("index?infolettre=1");

        $this->rediriger("index?info_erreur=1");

        include("views/index.view.php");
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function infolettreContactSubmit()
    {
        // Empêcher le navigateur de visiter la route sans soumettre de formulaire
        if (!isset($_POST)) $this->rediriger("index");
        if (empty($_POST)) $this->rediriger("index?info_erreur=1");

        // Validation des champs
        if (empty($_POST["prenom"]) || empty($_POST["courriel"])) $this->rediriger("admin?info_erreur=2");

        $prenom = $_POST["prenom"];
        $courriel = $_POST["courriel"];

        $succes = (new Infolettre())->ajout($prenom, $courriel);

        if ($succes) $this->rediriger("contact?infolettre=1");

        $this->rediriger("contact?info_erreur=1");

        include("views/contact.view.php");
    }
}
