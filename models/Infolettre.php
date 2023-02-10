<?php

require_once("bases/Model.php");

class Infolettre extends Model
{
    /**
     * Nom de la table
     *
     * @var string
     */
    protected $table = "infolettre";

    /**
     * Ajoute les paramètres à la bdd
     *
     * @param string $prenom
     * @param string $courriel
     * @return bool
     */
    public function ajout($prenom, $courriel) {
        
        $sql = "INSERT INTO $this->table (prenom, courriel) VALUES (:prenom, :courriel)";
        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":prenom" => $prenom,
            ":courriel" => $courriel,
        ]);
    }
}