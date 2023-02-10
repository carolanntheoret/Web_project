<?php
include("views/parts/header.admin.php");
?>

<body>

    <header>
        <h1>ADMINISTRATION</h1>
        <a href="index">
            <img src="public/images/logo.png" alt="Logo Pub G4" height="120">
        </a>
    </header>

    <div id="app">
        <div class="menu_accueil">

            <?php include("includes/erreurs.admin.php"); ?>

            <div class="formulaire" id="accueil" v-if="page == 'accueil'">

                <h2 class="titre-admin">ESPACE ADMINISTRATEUR</h2>

                <!-- Menu d'accueil -->
                <div class="liens">
                    <?php if ($utilisateur["admin"] == 1) : ?>
                        <a href="" @click.prevent="changerPage('ajout_util')">Ajouter un utilisateur</a>
                    <?php endif; ?>
                    <a href="" @click.prevent="changerPage('ajout_menu')">Ajouter au Menu</a>
                    <?php if ($utilisateur["admin"] == 1) : ?>
                        <a href="" @click.prevent="changerPage('modif_util')">Modifier un utilisateur</a>
                    <?php endif; ?>
                    <a href="" @click.prevent="changerPage('modif_menu')">Modifer le Menu</a>
                </div>

            </div>
        </div>

        <!-- Ajouter un Utilisateur -->
        <div id="ajout_util" v-if="page == 'ajout_util'">
            <form action="compte-creation-submit" method="post" enctype="multipart/form-data">

                <div class="form_ajout">
                    <span>PRÉNOM:</span>
                    <label class="prenom_util">
                        <input type="text" name="prenom" class="form-control" required autofocus>
                    </label>
                </div>

                <div class="form_ajout">
                    <span>NOM:</span>
                    <label class="nom_util">
                        <input type="text" name="nom" class="form-control" required>
                    </label>
                </div>

                <div class="form_ajout">
                    <span>COURRIEL:</span>
                    <label class="courriel_util">
                        <input type="email" name="courriel" class="form-control" required>
                    </label>
                </div>

                <div class="form_ajout">
                    <span>MOT DE PASSE:</span>
                    <label class="mdp_util">
                        <input type="password" name="mot_de_passe" class="form-control" required>
                    </label>
                </div>

                <div class="submit">
                    <input type="submit" value="Créer le compte">
                </div>

            </form>

            <div class="retour">
                <p>
                    <a href="#" @click.prevent="changerPage('accueil')">RETOUR ↺</a>
                </p>
            </div>

        </div>

        <!-- Modifier un Utilisateur -->
        <div id="modif_util" v-if="page == 'modif_util'">
            <div class="nom_util_modif">
                <p>
                    <?php foreach ($utilisateurs as $utilisateur) : ?>
                        <?php if ($utilisateur["admin"] == null) : ?>
                            · <?= $utilisateur["prenom"] ?> <?= $utilisateur["nom"] ?>
                            <a class="" href="modification-utilisateur?id=<?= $utilisateur["id"] ?>&utilisateur">
                                ✎
                            </a>
                            <a class="" href="suppression-utilisateur?id=<?= $utilisateur["id"] ?>">
                                ⛔
                            </a>
                            </br>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </p>
            </div>

            <div class="retour">
                <p>
                    <a href="#" @click.prevent="changerPage('accueil')">RETOUR ↺</a>
                </p>
            </div>

        </div>

        <!-- Ajouter au Menu -->
        <div id="ajout_menu" v-if="page == 'ajout_menu'">
            <div class="form_ajout_menu">
                <form action="categorie-creation-submit" method="post" enctype="multipart/form-data">
                    <h2>Catégories</h2>

                    <span>Nom:</span>
                    <label class="form-label">
                        <input type="text" name="nom" class="form-control" required>
                    </label>

                    <div class="submit">
                        <input type="submit" value="Créer la catégorie">
                    </div>

                </form>

                <form action="plat-creation-submit" method="post" enctype="multipart/form-data" class="">
                    <h2>Plats</h2>

                    <span>Nom:</span>
                    <label class="form-label">
                        <input type="text" name="nom" class="form-control" required>
                    </label>

                    <span>Prix:</span>
                    <label class="form-label">
                        <input type="text" name="prix" class="form-control" required>
                    </label>

                    <span>Description:</span>
                    <label class="form-label">
                        <input type="text" name="description" class="form-control" required>
                    </label>

                    <span>Photo:</span>
                    <label class="form-label">
                        <input type="file" name="photo" class="form-control" required>
                    </label>

                    <span>Catégorie 1:</span>
                    <label class="form-label">
                        <select class="form-select" name="categorie_1" id="categorie_1" required>
                            <option value="">---Catégorie---</option>
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?= $categorie["id"] ?>">
                                    <?= $categorie["nom"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <span>Catégorie 2 (Facultatif):</span>
                    <label class="form-label">
                        <select class="form-select" name="categorie_2" id="categorie_2">
                            <option value="">---Catégorie---</option>
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?= $categorie["id"] ?>">
                                    <?= $categorie["nom"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <span>Catégorie 3 (Facultatif):</span>
                    <label class="form-label">
                        <select class="form-select" name="categorie_3" id="categorie_3">
                            <option value="">---Catégorie---</option>
                            <?php foreach ($categories as $categorie) : ?>
                                <option value="<?= $categorie["id"] ?>">
                                    <?= $categorie["nom"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <div class="submit">
                        <input type="submit" value="Créer le plat">
                    </div>
                </form>
            </div>

            <div class="retour">
                <p>
                    <a href="#" @click.prevent="changerPage('accueil')">Retour ↺</a>
                </p>
            </div>

        </div>

        <!-- Modifier le Menu -->
        <div id="modif_menu" v-if="page == 'modif_menu'">
            <div class="form_modif_menu">

                <h2>CATÉGORIES:</h2>
                <p>
                    <?php foreach ($categories as $categorie) : ?>
                        · <?= $categorie["nom"] ?>
                        <a href="modification-categories?id=<?= $categorie["id"] ?>&categorie">
                            ✎
                        </a>
                        <a class="" href="suppression-categories?id=<?= $categorie["id"] ?>">
                            ⛔
                        </a> </br>
                    <?php endforeach; ?>
                </p>

                <h2>PLATS:</h2>
                <p>
                    <?php foreach ($plats as $plat) : ?>
                        · <?= $plat["nom"] ?>
                        <a class="" href="modification-plats?id=<?= $plat["id"] ?>&plat">
                            ✎
                        </a>
                        <a class="" href="suppression-plats?id=<?= $plat["id"] ?>">
                            ⛔
                        </a> </br>
                    <?php endforeach; ?>
                </p>
            </div>

            <div class="retour">
                <p>
                    <a href="#" @click.prevent="changerPage('accueil')">RETOUR ↺</a>
                </p>
            </div>

        </div>
    </div>

<?php
    include("views/parts/footer.admin.php");
?>