<h1 class="text-2xl font-bold mb-6">Gestion des Candidats</h1>

<?php if (isset($_GET['success'])): ?>
    <p class="text-green-500">Candidat ajouté avec succès !</p>
<?php elseif (isset($_GET['error'])): ?>
    <p class="text-red-500">Erreur lors de l'ajout du candidat.</p>
<?php endif; ?>

<form method="post" action="?page=candidats" class="space-y-6">
    <input type="hidden" name="election_id" value="<?= htmlspecialchars($_GET['election_id']) ?>">

    <label class="block">
        Prénom :
        <input type="text" name="prenom" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700" required>
    </label>

    <label class="block">
        Nom :
        <input type="text" name="nom" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700" required>
    </label>

    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium">
        Ajouter le candidat
    </button>
</form>

<h2 class="text-xl font-semibold mt-6 mb-4">Candidats actuels :</h2>
<ul class="space-y-4">
    <?php foreach ($candidats as $candidat): ?>
        <li class="p-4 bg-white dark:bg-gray-800 shadow rounded">
            <?= htmlspecialchars($candidat['prenom'] . ' ' . $candidat['nom']) ?>
        </li>
    <?php endforeach; ?>
</ul>