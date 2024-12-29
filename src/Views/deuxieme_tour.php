<h1 class="text-2xl font-bold mb-6">Deuxième Tour</h1>

<?php if (count($candidats) < 2): ?>
    <p class="text-red-500">Pas assez de candidats pour organiser un deuxième tour.</p>
<?php else: ?>
    <form method="post" action="?page=vote">
        <input type="hidden" name="election_id" value="<?= htmlspecialchars($_GET['election_id']) ?>">

        <h2 class="text-xl font-semibold mt-4">Votez pour un candidat :</h2>
        <div class="space-y-4 mt-4">
            <?php foreach ($candidats as $candidat): ?>
                <label class="block p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
                    <input type="radio" name="candidat_id" value="<?= $candidat['id'] ?>" required>
                    <?= htmlspecialchars($candidat['prenom'] . ' ' . $candidat['nom']) ?>
                </label>
            <?php endforeach; ?>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium mt-6">
            Voter
        </button>
    </form>
<?php endif; ?>