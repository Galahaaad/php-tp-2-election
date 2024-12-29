<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élections des Délégués</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <script>
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark');
            }
        });
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex">

<!-- Sidebar -->
<aside class="w-64 bg-white dark:bg-gray-800 h-screen shadow-lg flex flex-col">
    <div class="p-6 font-bold text-xl">Menu</div>
    <nav class="flex-grow">
        <ul class="space-y-4 p-6">
            <li><a href="?page=accueil" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Accueil</a></li>
            <li><a href="?page=election" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Élection</a></li>
            <li><a href="?page=resultats" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Résultats</a></li>
            <li><a href="?page=cloture" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Clôture</a></li>
            <li><a href="?page=vote" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Vote</a></li>
            <li><a href="?page=deuxieme_tour" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Deuxième Tour</a></li>
            <li><a href="?page=resume" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Résumé</a></li>
            <li><a href="?page=erreur" class="block p-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded">Erreur</a></li>
        </ul>
    </nav>
    <div class="p-6">
        <button onclick="toggleTheme()" class="p-2 w-full bg-gray-300 dark:bg-gray-700 rounded-full">
            🌙 / ☀️
        </button>
    </div>
</aside>

<main class="flex-grow p-8">
    <?php

    require_once __DIR__ . '/../vendor/autoload.php';

    $page = $_GET['page'] ?? 'accueil';
    define('BASE_PATH', dirname(__DIR__));
    $file = BASE_PATH . "/src/Views/$page.php";

    use Mamounenidam\TpElections\Controllers\ElectionController;
    use Mamounenidam\TpElections\Controllers\ResultatController;
    use Mamounenidam\TpElections\Controllers\DeuxiemeTourController;
    use Mamounenidam\TpElections\Controllers\VoteController;
    use Mamounenidam\TpElections\Controllers\ResumeController;
    use Mamounenidam\TpElections\Controllers\ClotureController;
    use Mamounenidam\TpElections\Controllers\CandidatController;
    use Mamounenidam\TpElections\Controllers\ElectionActionsController;


    $controller = new ElectionController();
    $elections = $controller->listerElections();
    switch ($page) {
        case 'deuxieme_tour':
            if (isset($_GET['election_id'])) {
                $controller = new DeuxiemeTourController();
                $controller->afficherDeuxiemeTour((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;

        case 'election_actions':
            if (isset($_GET['election_id'])) {
                $controller = new ElectionActionsController();
                $controller->afficherActions((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;

        case 'cloture':
            if (isset($_GET['election_id'])) {
                $controller = new ClotureController();
                $controller->cloturer((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;

        case 'candidats':
            $controller = new CandidatController();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->ajouterCandidat();
            } elseif (isset($_GET['election_id'])) {
                $controller->afficherCandidats((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;


        case 'resume':
            if (isset($_GET['election_id'])) {
                $controller = new ResumeController();
                $controller->afficherResume((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;

        case 'vote':
            $controller = new VoteController();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->enregistrerVote();
            } elseif (isset($_GET['election_id'])) {
                $controller->afficherVote((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;

        case 'resultats':
            if (isset($_GET['election_id'])) {
                $controller = new ResultatController();
                $controller->afficherResultats((int) $_GET['election_id']);
            } else {
                echo '<p class="text-red-500">Erreur : Aucun ID d\'élection fourni.</p>';
            }
            break;

        default:
            if (file_exists($file)) {
                include $file;
            } else {
                echo '<h1 class="text-2xl font-bold mb-6">Bienvenue sur l\'élection des délégués</h1>';
                echo '<p>Sélectionnez une page dans le menu pour continuer.</p>';
            }
            break;
    }

    ?>

</main>
</body>
</html>