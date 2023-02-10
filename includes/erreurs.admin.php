<!-- Erreur générale -->
<?php if (isset($_GET["erreur"])) : ?>
    <p class="erreur">Une erreur est survenue</p>
<?php endif; ?>

<!-- Erreurs Compte -->
<?php if (isset($_GET["erreur_compte"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la création du compte</p>
<?php endif; ?>

<?php if (isset($_GET["compte_cree"])) : ?>
    <p class="erreur">Le compte a bien été créé !</p>
<?php endif; ?>

<!-- Erreurs Utilisateurs -->
<?php if (isset($_GET["modif_util_reussie"])) : ?>
    <p class="erreur">L'utilisateur a bien été modifié !</p>
<?php endif; ?>

<?php if (isset($_GET["suppression_reussie"])) : ?>
    <p class="erreur">L'utilisateur a bien été supprimé !</p>
<?php endif; ?>

<?php if (isset($_GET["erreur_util"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la récupération des informations de l'utilisateur</p>
<?php endif; ?>

<?php if (isset($_GET["erreur_modif_util"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la modification des informations de l'utilisateur</p>
<?php endif; ?>


<!-- Erreurs générales Création-Modif-Suppression -->
<?php if (isset($_GET["erreur_creation"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la création</p>
<?php endif; ?>

<?php if (isset($_GET["erreur_modif"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la modification</p>
<?php endif; ?>

<?php if (isset($_GET["erreur_sup"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la suppression</p>
<?php endif; ?>


<!-- Erreurs Catégories -->
<?php if (isset($_GET["cat_cree"])) : ?>
    <p class="erreur">La catégorie a bien été créée !</p>
<?php endif; ?>

<?php if (isset($_GET["modif_cat_reussie"])) : ?>
    <p class="erreur">La catégorie a bien été modifiée !</p>
<?php endif; ?>

<?php if (isset($_GET["sup_cat_reussie"])) : ?>
    <p class="erreur">La catégorie a bien été supprimée !</p>
<?php endif; ?>

<?php if (isset($_GET["erreur_cat"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la récupération des informations de la catégorie</p>
<?php endif; ?>


<!-- Erreurs Plats -->
<?php if (isset($_GET["plat_cree"])) : ?>
    <p class="erreur">Le plat a bien été créée !</p>
<?php endif; ?>

<?php if (isset($_GET["modif_plat_reussie"])) : ?>
    <p class="erreur">Le plat a bien été modifié !</p>
<?php endif; ?>

<?php if (isset($_GET["sup_plat_reussie"])) : ?>
    <p class="erreur">Le plat a bien été supprimé !</p>
<?php endif; ?>

<?php if (isset($_GET["erreur_plat"])) : ?>
    <p class="erreur">Une erreur est survenue lors de la récupération des informations du plat</p>
<?php endif; ?>