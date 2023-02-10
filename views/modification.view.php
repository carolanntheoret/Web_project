<?php
include("views/parts/header.modif.php");
?>

<body>
    <div id="app">
        <?php if (isset($_GET["utilisateur"])) : ?>
            <!-- Modification d'un Utilisateur -->
            <div class="modif_util_form">

                <h2>MODIFICATION D'UN UTILISATEUR</h2>

                <form class="form" action="modification-utilisateur-submit" method="post">
                    <input type="hidden" name="id" value="<?= $utilisateur["id"] ?>">
                    <div>
                        <label for="titre">PRÉNOM:</label>
                        <input type="text" name="prenom" id="prenom" autocomplete="off" required value="<?= $utilisateur["prenom"] ?>">
                    </div>
                    <div>
                        <label for="titre">NOM:</label>
                        <input type="text" name="nom" id="nom" autocomplete="off" required value="<?= $utilisateur["nom"] ?>">
                    </div>
                    <div>
                        <label for="titre">COURRIEL:</label>
                        <input type="text" name="courriel" id="courriel" autocomplete="off" required value="<?= $utilisateur["courriel"] ?>">
                    </div>
                    <div>
                        <label for="titre">MOT DE PASSE:</label>
                        <input type="password" name="mot_de_passe" id="mot_de_passe" autocomplete="off" required placeholder="Mot de passe" value="">
                    </div>
                    <div class="submit">
                        <input type="submit" value="Envoyer">
                    </div>
                </form>

            </div>
        <?php endif; ?>

        <?php if (isset($_GET["categorie"])) : ?>
            <!-- Modification d'une catégorie -->
            <div class="modif_cat_form">

                <h2>MODIFICATION D'UNE CATÉGORIE</h2>

                <form class="form" action="modification-categories-submit" method="post">
                    <input type="hidden" name="id" value="<?= $categorie_modif["id"] ?>">
                    <div class="nom_modif">
                        <label for="nom">NOM:</label>
                        <input type="text" name="nom" id="nom" autocomplete="off" required value="<?= $categorie_modif["nom"] ?>">
                    </div>
                    <div class="submit">
                        <input type="submit" value="Envoyer">
                    </div>
                </form>

            </div>
        <?php endif; ?>

        <?php if (isset($_GET["plat"])) : ?>
            <!-- Modification d'un plat -->
            <div class="modif_plat_form">

                <h2>MODIFICATION D'UN PLAT</h2>

                <form class="form" action="modification-plats-submit" method="post">
                    <input type="hidden" name="id" value="<?= $plat_modif["id"] ?>">
                    
                    <div>
                        <label for="nom">NOM:</label>
                        <input type="text" name="nom" id="nom" autocomplete="off" required value="<?= $plat_modif["nom"] ?>">
                    </div>

                    <div>
                        <label for="prix">PRIX:</label>
                        <input type="text" name="prix" id="prix" autocomplete="off" required value="<?= $plat_modif["prix"] ?>">
                    </div>

                    <div>
                        <label for="description">DESCRIPTION:</label>
                        <input type="text" name="description" id="description" autocomplete="off" required value="<?= $plat_modif["description"] ?>">
                    </div>

                    <div>
                        <label class="form-label">
                            <input type="hidden" name="photo" class="form-control" value="<?= $plat_modif["photo"] ?>">
                        </label>
                    </div>

                    <div>
                        <label for="categorie_1">CATÉGORIE 1:</label>
                        <label class="form-label">
                            <select class="form-select" name="categorie_1" id="categorie_1" required>
                                <?php if ($categories_plat[0] == "") : ?>
                                    <option value="">---Veuillez choisir---</option>
                                <?php endif; ?>
                                <?php foreach ($categories as $categorie) : ?>
                                    <option value="
                                <?= $categorie["id"] ?>" <?php if (isset($categories_plat[0]) && $categories_plat[0]["id"] == $categorie["id"]) : ?> selected <?php endif; ?>>
                                        <?= $categorie["nom"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>

                    <div>
                        <label for="categorie_2">CATÉGORIE 2:</label>
                        <label class="form-label">
                            <select class="form-select" name="categorie_2" id="categorie_2">
                                <?php if ($categories_plat[1] == "") : ?>
                                    <option value="">---Veuillez choisir---</option>
                                <?php endif; ?>
                                <?php foreach ($categories as $categorie) : ?>
                                    <option value="
                                <?= $categorie["id"] ?>" <?php if (isset($categories_plat[1]) && $categories_plat[1]["id"] == $categorie["id"]) : ?> selected <?php endif; ?>>
                                        <?= $categorie["nom"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>

                    <div>
                        <label for="categorie_3">CATÉGORIE 3:</label>
                        <label class="form-label">
                            <select class="form-select" name="categorie_3" id="categorie_3">
                                <?php if ($categories_plat[2] == "") : ?>
                                    <option value="">---Veuillez choisir---</option>
                                <?php endif; ?>
                                <?php foreach ($categories as $categorie) : ?>
                                    <option value="
                                <?= $categorie["id"] ?>" <?php if (isset($categories_plat[2]) && $categories_plat[2]["id"] == $categorie["id"]) : ?> selected <?php endif; ?>>
                                        <?= $categorie["nom"] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>

                    <div class="submit">
                        <input type="submit" value="Envoyer">
                    </div>

                </form>

            </div>
        <?php endif; ?>

        <div class="retour_modif">
            <p>
                <a href="compte-admin">RETOUR ↺</a>
            </p>
        </div>

    </div>
    <script src="js/main.js" type="module"></script>
</body>
</html>