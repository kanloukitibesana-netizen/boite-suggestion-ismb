<?php
require "./view/partials/header.php"
?>

<!-- le_conterneur -->
<section class="">
    <div class="contact">
        <h1>Contactez-nous</h1>
        <p>Vous avez une question, une préoccupation ou besoin d'une assistance concernant la plateforme de
            suggestions ?
            Notre équipe est à votre écoute. N'hésitez pas à nous contacter.
        </p>
    </div>

    <div id="cadremessage">
        <h1>Evoiyer votre message</h1>
        <form action="">

            <div id="message">
                <label for="">

                    Nom: <input type="text" name="non" id="" required>
                </label>
                <label for="">

                    Prénom: <input type="text" name="prenom" id="" required>
                </label>
                <label for="">

                    <i class="fa-solid fa-phone"></i>Téléphone:<input type="tel" name="non" id="" required>
                </label>
                <label for="">

                    <i class="fa-regular fa-envelope"></i>Email:<input type="email" name="non" id="" required>
                </label>
                <button type="submit"><i class="fa-regular fa-paper-plane"></i>Envoiyer</button>
            </div>
        </form>
    </div>
    <div id="address">
        <p><b>Address:</Address></b> L'Institut superieur Monseigneur BAKPESSI
            est situé au Quartier Tomdè,
            à Coté de l’Evêché de Kara,
            Côté Ouest de Radio Maria Kara</p>
        <p><i class="fa-solid fa-phone"></i>Telephone<a href="tel:+228 72896602">+228 72 89 66 02</a></p>
        <p><i class="fa-regular fa-envelope"></i>Email <a href=" mailto:tkanloukitibe@gmai.com">contact@institut-bakpessi.com</a></p>

    </div>
    <footer id="footercontacte">
        <h4>Réseaux sociaux</h4>
        <p><i class="fa-brands fa-tiktok"></i><a href="https://vm.tiktok.com/ZS9hUcDpKooe9-ulGUp/" target="_blank">Tik Tok</a></p>
        <p><i class="fa-brands fa-facebook"></i><a href="https://www.facebook.com/61573502627954/posts/122192714258783420/?app=fbl" target="_blank">Facebook</a></p>
        <p>© 2026 ISMB - Tous droits réservés </p>
    </footer>
</section>


<?php
require "./view/partials/footer.php"
?>