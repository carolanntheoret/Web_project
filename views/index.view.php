<?php
include("views/parts/header.index.php");
?>

<main>
    <div id="app">
        <div class="entete">
            <div class="texte-entete">
                <h1>BIENVENUE CHEZ PUB G4</h1>
                <h2>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy. </h2>
                <a href="#" @click.prevent="reserver()" class="reservez liveToastBtn">RÉSERVEZ</a>
            </div>

            <img src="public/images/entete.png" alt="Burger & Frites" height="700" width="1900">
        </div>

        <!-- À PROPOS -->
        <a id="a-propos"></a>
        <div class="a-propos">

            <div class="img-propos"></div>
            <div class="texte-propos">
                <h1>À PROPOS DE NOUS</h1>
                <p class="texte1">
                    Depuis maintenant 20 ans, Pub G4 vous fait découvrir des plats de tout genre avec une touche raffinée que vous n’avez goutée nulle part ailleurs. Venez entre amis, pour une soirée romantique ou invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.
                </p>
                <p>
                    Aliquam vestibulum morbi blandit cursus risus at ultrices mi. Mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Eu sem integer vitae justo eget magna fermentum iaculis eu. Imperdiet dui accumsan sit amet nulla facilisi. In ornare quam viverra orci sagittis eu volutpat odio facilisis.
                </p>
            </div>

        </div>

        <!-- COMMENTAIRES -->
        <div class="commentaires">
            <div class="commentaire" v-for="commentaire of liste">
                <div class="contenu">
                    <img :src="commentaire.photo" alt="Avatar" class="avatar">
                    <p class="texte">{{commentaire.texte}}</p>
                    <img :src="commentaire.note" alt="" class="note">
                </div>
            </div>
        </div>

        <!-- MENU -->
        <a id="menu"></a>
        <div class="menu">
            <div class="categories_menu">
                <h1>MENU</h1>
                <h2>À LA CARTE</h2>
                <div class="categories">
                    <?php foreach ($plats_categories as $categorie_plats) : ?>
                        <a @click.prevent="allerAuMenu('cat<?= $categorie_plats["id"] ?>', '<?= $categorie_plats["plats"][0]["photo"] ?>', '<?= $categorie_plats["plats"][0]["nom"] ?>' )" href="#" class="categorie"><?= $categorie_plats["nom"] ?></a>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="img_select">
                <div class="plats">
                    <img :src="'public/uploads/' + image_active" :alt="nom_actif" height="650" width="500">
                    <p>{{nom_actif}}</p>
                </div>
            </div>

            <div class="plats_select">
                <div class="categories_plats">
                    <?php foreach ($plats_categories as $categorie_plats) : ?>
                        <h1 class="cat<?= $categorie_plats["id"] ?> titre_plat"><?= $categorie_plats["nom"] ?></h1>
                        <div class="plats">
                            <?php foreach ($categorie_plats["plats"] as $plat) : ?>
                                <div class="nom_prix">
                                    <p class="nom_plat"><?= $plat["nom"] ?></p>
                                    <p class="prix_plat"><?= $plat["prix"] ?>$</p>
                                </div>
                                <p class="description_plat"><?= $plat["description"] ?></p>
                                </br>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include("views/parts/footer.index.php");
?>