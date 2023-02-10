<?php

require_once("bases/Model.php");

class Categories extends Model
{
    /**
     * Nom de la table
     *
     * @var string
     */
    protected $table = "categories";

    /**
     * Affiche toutes les catégories
     *
     * @return array
     */
    public function toutesCategories()
    {

        $sql = "SELECT *
                FROM $this->table";


        // Préparation de la requête            
        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Affiche tous les plats associés à une catégorie
     *
     * @return array
     */
    public function tousPlatsCategories()
    {

        $sql = "SELECT *
                FROM $this->table";

        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute();

        $tableau = $stmt->fetchAll();

        foreach ($tableau as $cle => $colonne) {

            $id = $colonne["id"];

            $sql2 = "SELECT *
                FROM $this->table
                JOIN categories_plats 
                ON categories.id = categories_plats.categorie_id
                JOIN plats 
                ON categories_plats.plat_id = plats.id 
                WHERE categories_plats.categorie_id = :id";

            $stmt = $this->pdo()->prepare($sql2);

            $stmt->execute([
                ":id" => $id
            ]);

            $tableau2 = $stmt->fetchAll();

            $tableau[$cle]["plats"] = $tableau2;
        }
        return $tableau;
    }
    /**
     * Supprime une catégorie
     *
     * @param int $id
     * @return bool
     */
    public function supprimerCategorie($id)
    {
        $sql = "DELETE FROM $this->table
                  WHERE id = :id";

        $stmt = $this->pdo()->prepare($sql);

        try {

            $resultat = $stmt->execute([
                ":id" => $id
            ]);
            
        } catch (Exception $e) {

            $resultat = false;
        }
        return $resultat;
    }

    /**
     * Crée une catégorie
     *
     * @param string $nom
     * @return bool
     */
    public function creer($nom)
    {

        $sql = "INSERT INTO $this->table (nom) VALUES (:nom)";
        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":nom" => $nom,
        ]);
    }
    /**
     * Modifie une catégorie
     *
     * @param int $id
     * @param string $nom
     * @return bool
     */
    public function modifier($id, $nom)
    {

        $sql = "UPDATE $this->table
            SET 
            nom = :nom
            WHERE id = :id";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":id" => $id,
            ":nom" => $nom,
        ]);
    }
}
