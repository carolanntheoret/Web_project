<footer>

<?php if (isset($_GET["infolettre"])) : ?>
    <p class="infolettre">Merci pour votre abonnement !</p>
<?php endif; ?>

<?php if (isset($_GET["info-erreur"])) : ?>
    <p class="infolettre">Un erreur est survenue lors de l'abonnement</p>
<?php endif; ?>

<div class="infolettre">
    <h3>INSCRIVEZ-VOUS À NOTRE INFOLETTRE</h3>
    <p>Restez à l'affût des nouveautés de notre menu !</p>

    <form action="infolettre-contact-submit" method="post" enctype="multipart/form-data">
        <div>
            <label class="form-label">
                <input type="text" name="prenom" autocomplete="off" placeholder="Prénom" required>
            </label>
            <label class="form-label">
                <input type="email" name="courriel" placeholder="Adresse Courriel" required>
            </label>
            <div class="submit">
                <input type="submit" value="S'ABONNER">
            </div>
        </div>
    </form>

</div>

<div class="onglets">

    <a href="index#a-propos">À PROPOS</a>
    <a href="contact">CONTACT</a>
    <a href="#" class="liveToastBtn">RÉSERVEZ</a>

    <div class="socials">
        <div class="facebook">
            <a href="https://www.facebook.com/">
                <img src="public/images/facebook-logo.png" alt="Facebook Logo">
            </a>
        </div>
        <div class="instagram">
            <a href="https://www.instagram.com">
                <img src="public/images/instagram-logo.png" alt="Instagram Logo">
            </a>
        </div>
        <div class="twitter">
            <a href="https://twitter.com">
                <img src="public/images/twitter-logo.png" alt="Twitter Logo">
            </a>
        </div>
    </div>

</div>

<div class="copyright">Ⓒ PUB G4 - Tous droits réservés</div>

</footer>

<script src="js/main.js" type="module"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>