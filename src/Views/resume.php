<h1 class="text-2xl font-bold mb-6">Résumé de l'élection</h1>

<h2 class="text-xl font-semibold mt-6 mb-4">Résultats :</h2>
<table class="w-full text-left border-collapse">
    <thead>
    <tr class="border-b">
        <th class="p-2">Candidat</th>
        <th class="p-2">Votes</th>
        <th class="p-2">Pourcentage</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultats as $candidat): ?>
        <tr class="border-b">
            <td class="p-2"><?= htmlspecialchars($candidat['prenom'] . ' ' . $candidat['nom']) ?></td>
            <td class="p-2"><?= $candidat['votes'] ?></td>
            <td class="p-2"><?= $candidat['pourcentage'] ?>%</td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<h2 class="text-xl font-semibold mt-6 mb-4">Élu principal :</h2>
<?php if ($elu): ?>
    <p class="text-green-500 font-bold">🎉 <?= htmlspecialchars($elu['prenom'] . ' ' . $elu['nom']) ?> (<?= $elu['pourcentage'] ?>%)</p>
<?php else: ?>
    <p class="text-red-500">⚠️ Aucun candidat n'a atteint 75%. Passage au deuxième tour requis.</p>
<?php endif; ?>

<h2 class="text-xl font-semibold mt-6 mb-4">Suppléant :</h2>
<?php if (count($deuxMeilleurs) == 2): ?>
    <p class="text-blue-500">🏅 <?= htmlspecialchars($deuxMeilleurs[1]['prenom'] . ' ' . $deuxMeilleurs[1]['nom']) ?></p>
<?php else: ?>
    <p class="text-red-500">⚠️ Aucun suppléant défini.</p>
<?php endif; ?>

<h2 class="text-xl font-semibold mt-6 mb-4">Statistiques :</h2>
<ul class="space-y-2">
    <li>Total des votes : <?= $statistiques['total'] ?></li>
    <li>Votes valides : <?= $statistiques['valide'] ?></li>
    <li>Votes blancs : <?= $statistiques['blancs'] ?></li>
    <li>Votes nuls : <?= $statistiques['nuls'] ?></li>
</ul>

<?php if (!$election['cloture']): ?>
    <form method="post" action="?page=cloture&election_id=<?= $election_id ?>">
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg">
            Clôturer l'élection
        </button>
    </form>
<?php else: ?>
    <p class="text-green-500">✅ Cette élection est clôturée.</p>
<?php endif; ?>