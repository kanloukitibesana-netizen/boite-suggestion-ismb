<?php
require "./../view/partials/header.php";
// require "./../controllers/controller.php";
require "./../functions/utilities.php";

const ALLOWED_ANONYMITY_MODES = [
    'anonyme' => 'Anonyme',
    'visible' => 'Visible',
];


const ALLOWED_CATEGORIES = [
    'enseignants' => 'Enseignement',
    'infrastructures' => 'Infrastructures',
    'bibliotheque' => 'Bibliothèque',
    'vie_etudiante' => 'Vie étudiante',
    'activites_sportives_et_culturelles' => 'Activités sportives et culturelles',
    'hygiene_et_proprete' => 'Hygiène et propreté',
    'securite' => 'Sécurité',
    'restauration' => 'Restauration',
    'autres' => 'Autre',
];

function escapeHtml(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Valide les champs envoyés par le formulaire sans effet de bord.
 *
 * @param array<string, mixed> $submittedFields
 * @return array{
 *     isValid: bool,
 *     suggestion: ?array{anonymat: string, categorie: string, sujet: string, contenu: string},
 *     errors: list<array{code: string, message: string}>
 * }
 */
function validateSuggestionForm(array $submittedFields): array
{
    $anonymat = trim((string) ($submittedFields['identite'] ?? ''));
    $categorie = trim((string) ($submittedFields['categories'] ?? ''));
    $sujet = trim((string) ($submittedFields['sujet'] ?? ''));
    $suggestion = trim((string) ($submittedFields['suggestion'] ?? ''));
    $nom = trim((string) ($submittedFields['nom'] ?? ''));
    $prenom = trim((string) ($submittedFields['prenom'] ?? ''));
    $statut = trim((string) ($submittedFields['statut'] ?? ''));
    $statut = trim((string) ($submittedFields['telephone'] ?? ''));
    $statut = trim((string) ($submittedFields['email'] ?? ''));


    //null coaelcing

    $errors = [];

    if (!array_key_exists($anonymat, ALLOWED_ANONYMITY_MODES)) {
        $errors[] = [
            'code' => 'INVALID_ANONYMITY',
            'message' => 'Veuillez choisir entre « Anonyme » et « Visible ».',
        ];
    }

    if (!array_key_exists($categorie, ALLOWED_CATEGORIES)) {
        $errors[] = [
            'code' => 'INVALID_CATEGORY',
            'message' => 'Veuillez sélectionner une catégorie valide.',
        ];
    }

    if ($sujet === '') {
        $errors[] = [
            'code' => 'EMPTY_SUBJECT',
            'message' => 'Le sujet est obligatoire.',
        ];
    }

    if ($contenu === '') {
        $errors[] = [
            'code' => 'EMPTY_CONTENT',
            'message' => 'Le contenu de la suggestion est obligatoire.',
        ];
    }

    if ($errors !== []) {
        return [
            'isValid' => false,
            'suggestion' => null,
            'errors' => $errors,
        ];
    }

    return [
        'isValid' => true,
        'suggestion' => [
            'anonymat' => $anonymat,
            'categorie' => $categorie,
            'sujet' => $sujet,
            'contenu' => $contenu,
        ],
        'errors' => [],
    ];
}

// Guard clause : empêche l'accès direct en GET à traitement.php
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    $validationErrors = [
        [
            'code' => 'METHOD_NOT_ALLOWED',
            'message' => 'Cette page attend une soumission de formulaire en POST.',
        ],
    ];
    $receivedSuggestion = null;
} else {
    $validationOutcome = validateSuggestionForm($_POST);
    $validationErrors = $validationOutcome['errors'];
    $receivedSuggestion = $validationOutcome['suggestion'];

    if (!$validationOutcome['isValid']) {
        http_response_code(422);
    }
}

dump($_POST);
?>

<!-- le_conterneur -->
<section class="">
    <div class="cadresuggestion">
        <form action="" id="formSuggestion" method="POST">
            <div class="suggestion">
                <h1>Déposer une suggestion</h1>
                <p>Votre avis est important pour <b>l'ISMB.</b>
                    Cette plateforme vous permet de partager
                    vos idées, remarques ou propositions afin de
                    contribuer à l'amélioration de la vie académique, des
                    services et de l'environnement de l'établissement.
                </p>
                <div id="listsuggestion">

                    <ol type="1">
                        <li> Choisissez si vous souhaitez rester <b>anonyme ou visible.</b></li>
                        <li>Remplissez les informations demandées.</li>
                        <li>Sélectionnez la catégorie de votre suggestion.</li>
                        <li>Rédigez votre suggestion de manière claire et respectueuse.</li>
                        <li>Cliquez sur <b> Envoyer.</b></li>
                    </ol>


                </div>
            </div>
            <div id="utilisateur">
                <div id="choi_utilisateur">

                    <?php foreach (ALLOWED_ANONYMITY_MODES as $key => $value): ?>
                        <label for="<?= $key ?>">
                            <input type="radio" id="<?= $key ?>" name="identite" value="<?= $key ?>">
                            <?= $value ?>
                        </label>

                    <?php endforeach ?>

                    
                </div>
                <!-- non et prenom -->
                <div id="nom_prenom">

                    <label for="nom">
                        Nom
                        <input type="text" id="nom" name="nom" required>
                    </label>
                    <label for="Prenom">
                        Prénom
                        <input type="text" id="prenom" name="prenom" required>
                    </label>

                    <label for="">
                        Telephone
                        <input type="tel" id="telephone" name="telephone" id="" required>
                    </label>
                    <label for="">
                        Email
                        <input type="email" id="email" name="email" required>
                    </label>


                </div>

                <!-- categorie -->
                <div id="categorie">
                    <h3>Catégorie de la suggestion</h3>

                    <select id="categories" name="categories">
                        <option value="" disabled> Choisissez une categorie</option>
                        <?php foreach (ALLOWED_CATEGORIES as $key => $value) : ?>
                            <option value="<?= $key ?>" > <?= $value ?></option>
                        <?php endforeach ?>
                    </select>


                    <!-- choix de status -->

                    <h3>Choisissez votre statut </h3>
                    <select id="statut" name="statut">
                        <option value="" disabled> Choisissez votre statut</option>
                        <option value="etudiant">Etudiant</option>
                        <option value="enseignants">Enseignants</option>
                        <option value="Parents">Parents</option>
                        <option value="Autres">Autres</option>
                    </select>
                </div>
                <div class="sujet">
                    <label for="">
                        sujet
                        <input type="text" name="sujet" id="sujet" required>
                    </label>
                    <label for="">
                        Votre suggestion
                        <textarea name="suggestion" id="suggestion" rows="5 " required></textarea>
                    </label>
                    <div>

                        <p id="messageereur"></p>
                    </div>
                    <div>
                        <button type="submit"><i class="fa-regular fa-paper-plane"></i>Envoyer</button>
                    </div>
                </div>
            </div>
            <p id="message"></p>

            <div>
                <button type="button"><i class="fa-regular fa-paper-plane"></i>Soumettre une nouvelle
                    suggestion</button>
            </div>
        </form>
        <p id="pfinsuggestion">Les informations personnelles ne sont demandées que si vous choisissez le mode
            <b>Visible</b>.
            Elles seront utilisées uniquement pour permettre à l'administration de vous recontacter
            si nécessaire.
        </p>
    </div>
    <footer id="footeracceuil">
        <p>© 2026 ISMB - Réalisé par les étudiants en <b>SI</b> promotion 2025-2026.</p>
    </footer>
</section>
<!-- gestion des nenu -->
<script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<script type="text/javascript">
    (function() {
        emailjs.init({
            publicKey: "2DN_73ugayD2BrecZ",
        });
    })();
</script>
<script src="./../scripts/script.js"></script>

<?php
require "./../view/partials/footer.php"
?>