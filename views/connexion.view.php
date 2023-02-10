<?php
include("views/parts/header.admin.php");
?>

<div id="app">
    <div class="menu_accueil">
        <div class="formulaire">
            <div class="connection">

                <?php include("includes/erreurs.connexion.php"); ?>

                <h2>ESPACE ADMINISTRATEUR</h2>

                <form action="compte-connexion-submit" method="POST" class="form">
                    <input type="text" name="courriel" placeholder="Adresse Courriel" class="courriel" required autofocus>
                    <input type="password" name="mot_de_passe" placeholder="Mot de passe" class="mdp" required>
                    <div class="submit"><input type="submit" value="CONNEXION"></div>
                </form>

            </div>

            <img src="public/images/cuisiniers.jpg" alt="Cuisiniers Pub G4" width="350" height="499">
            
        </div>
    </div>
</div>
<script src="js/main.js" type="module"></script>
</body>
</html>