<?php

require_once("bases/Model.php");

class Utilisateurs extends Model
{ 
    /**
     * Nom de la table
     *
     * @var string
     */
    protected $table = "utilisateurs";

    /**
     * Crée un nouvel utilisateur
     *
     * @param string $prenom
     * @param string $nom
     * @param string $courriel
     * @param string $mot_de_passe
     * @return bool
     */
    public function creer($prenom, $nom, $courriel, $mot_de_passe)
    {

        $sql = "INSERT INTO 
                $this->table (nom, prenom, courriel, mot_de_passe) 
                VALUES (:nom, :prenom, :courriel, :mot_de_passe)";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":courriel" => $courriel,
            ":mot_de_passe" => password_hash($mot_de_passe, PASSWORD_DEFAULT),
        ]);
    }

    /**
     * Vérifie si l'utilisateur existe et si le mot de passe fourni correspond aux données
     *
     * @param string $courriel
     * @param string $mot_de_passe  Mot de passe reçu du formulaire
     * 
     * @return bool Retourne false si l'utilisateur n'existe pas ou si le mot de passe est erroné
     */
    public function verifier($courriel, $mot_de_passe)
    {

        $sql = "SELECT *
                FROM $this->table
                WHERE courriel = :courriel";

        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute([
            ":courriel" => $courriel
        ]);

        $entree = $stmt->fetch();

        // Vérification de l'existence de l'utilisateur
        if (!$entree) {
            return false;
        }

        // Vérification du mot de passe
        $mot_de_passe_ok = password_verify($mot_de_passe, $entree["mot_de_passe"]);

        if (!$mot_de_passe_ok) {
            return false;
        }

        // Ajout de l'id de l'utilisateur à la session
        $_SESSION["utilisateur_id"] = $entree["id"];

        return true;
    }

    /**
     * Retourne tous les utilisateurs
     *
     * @return array
     */
    public function tousUtilisateurs()
    {
        $sql = "SELECT *
                FROM $this->table";

        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Retourne un utilisateur spécifique
     * 
     * @param int $id L'id d'une utilisateur
     */
    public function getUtilisateur($id)
    {
        $sql = "SELECT *
                FROM $this->table
                WHERE id = :id";

        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch();
        
    }
    
    /**
     * Modifie un utilisateur
     *
     * @param int $id
     * @param string $prenom
     * @param string $nom
     * @param string $courriel
     * @param string $mot_de_passe
     * @return bool
     */
    public function modifierUtilisateur($id, $prenom, $nom, $courriel, $mot_de_passe)
    {
        $mdp_encrypte = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        $sql = "UPDATE utilisateurs
            SET 
            prenom = :prenom,
            nom = :nom,
            courriel = :courriel,
            mot_de_passe = :mot_de_passe
            WHERE id = :id";

        $stmt = $this->pdo()->prepare($sql);
        
        return $stmt->execute([
            ":id" => $id,
            ":prenom" => $prenom,
            ":nom" => $nom,
            ":courriel" => $courriel,
            ":mot_de_passe" => $mdp_encrypte,
        ]);
    }

    /**
     * Supprime un utilisateur
     *
     * @param int $id
     * @return bool
     */
    public function supprimerUtilisateur($id)
    {

        $sql = "DELETE FROM $this->table
                WHERE id = :id";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }
}
