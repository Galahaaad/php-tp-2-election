<h1 class="text-2xl font-bold mb-6">Enregistrer un Vote</h1>

<?php if (isset($_GET['success'])): ?>
    <p class="text-green-500">Vote enregistré avec succès !</p>
<?php elseif (isset($_GET['error'])): ?>
    <p class="text-red-500">Erreur lors de l'enregistrement du vote.</p>
<?php endif; ?>

<?php if ($election['cloture']): ?>
    <p class="text-red-500">⚠️ Cette élection est clôturée. Aucun vote n'est autorisé.</p>
<?php else: ?>
    <form method="post" action="?page=vote" class="space-y-6">
        <input type="hidden" name="election_id" value="<?= htmlspecialchars($_GET['election_id']) ?>">

        <label class="block">
            Votant :
            <select name="votant_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700" required>
                <?php foreach ($votants as $votant): ?>
                    <option value="<?= $votant['id'] ?>">
                        <?= htmlspecialchars($votant['prenom'] . ' ' . $votant['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label class="block">
            Candidat :
            <select name="candidat_id" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700" required>
                <?php foreach ($candidats as $candidat): ?>
                    <option value="<?= $candidat['id'] ?>">
                        <?= htmlspecialchars($candidat['prenom'] . ' ' . $candidat['nom']) ?>
                    </option>
                <?php endforeach; ?>
                <option value="blanc">Vote blanc</option>
                <option value="nul">Vote nul</option>
            </select>
        </label>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium">
            Enregistrer le vote
        </button>
    </form>
<?php endif; ?>