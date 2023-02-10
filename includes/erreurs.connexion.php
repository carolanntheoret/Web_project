<!-- Erreur générale -->
<?php if (isset($_GET["erreur"])) : ?>
    <p class="erreur_conn">Une erreur est survenue</p>
<?php endif; ?>

<!-- Erreur Infos Incorrectes -->
<?php if (isset($_GET["erreur_connexion"])) : ?>
    <p class="erreur_conn">Les informations de connexion sont incorrectes</p>
<?php endif; ?>

<!-- Déconnexion -->
<?php if (isset($_GET["deconnexion_reussie"])) : ?>
    <p class="erreur_conn">Vous êtes bien déconnecté ! Merci !</p>
<?php endif; ?>

<!-- Erreur Déconnexion -->
<?php if (isset($_GET["erreur_deconnexion"])) : ?>
    <p class="erreur_conn">Une erreur est survenue pendant la déconnection</p>
<?php endif; ?>