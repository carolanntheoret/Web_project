<?php

require_once("bases/Model.php");

class Plats extends Model
{
    /**
     * Nom de la table
     *
     * @var string
     */
    protected $table = "plats";

    /**
     * Affiche tous les plats
     *
     * @return array
     */
    public function tousPlats()
    {
        $sql = "SELECT *
                FROM $this->table";
          
        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Supprime un plat
     *
     * @param int $id
     * @return bool
     */
    public function supprimerPlat($id)
    {
        $sql = "DELETE FROM $this->table
                WHERE id = :id";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }

    /**
     * Crée un plat
     *
     * @param string $nom
     * @param string $prix
     * @param string $description
     * @param string $photo
     * @return bool
     */
    public function creer($nom, $prix, $description, $photo)
    {

        $sql = "INSERT INTO $this->table 
                (nom, prix, description, photo) 
                VALUES 
                (:nom, :prix, :description, :photo)";

        $stmt = $this->pdo()->prepare($sql);

        return $stmt->execute([
            ":nom" => $nom,
            ":prix" => $prix,
            ":description" => $description,
            ":photo" => $photo,
        ]);
    }

    /**
     * Ajoute les catégories associées au plat
     *
     * @param string $categorie_1
     * @param string $categorie_2
     * @param string $categorie_3
     * @return void
     */
    public function ajoutCategorie($categorie_1, $categorie_2, $categorie_3)
    {
        $categories = [$categorie_1, $categorie_2, $categorie_3];

        $id = (new Plats())->dernierId();
        
        foreach ($categories as $categorie) {

            if(empty($categorie)){
                continue;
            }

            $sql = "INSERT INTO categories_plats 
                    (categorie_id, plat_id) 
                    VALUES 
                    (:categorie, :id)";

            $stmt = $this->pdo()->prepare($sql);

            $tableau = $stmt->execute([
                ":categorie" => $categorie,
                ":id" => $id,
            ]);
           
        }
        return $tableau;
    }

    /**
     * Retourne un élément du modèle selon un id
     *
     * @param integer $id
     * @return array|false Tableau associatif ou false si erreur
     */
    public function categoriesParId(int $id): array
    {

        $sql = "SELECT categories.*
                FROM $this->table
                JOIN categories_plats 
                ON plats.id = categories_plats.plat_id 
                JOIN categories 
                ON categories_plats.categorie_id = categories.id 
                WHERE categories_plats.plat_id = :id";

        $stmt = $this->pdo()->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetchAll();
    }
}
