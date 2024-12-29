<h1 class="text-2xl font-bold mb-6">Résultats du Premier Tour</h1>

<?php $elu = $elu ?? null;  ?>

<?php if ($elu): ?>
    <p class="text-green-500 font-bold">🎉 <?= htmlspecialchars($elu['prenom'] . ' ' . $elu['nom']) ?> a été élu(e) au premier tour avec <?= $elu['pourcentage'] ?>% des votes !</p>
<?php else: ?>
    <p class="text-red-500">⚠️ Aucun candidat n'a atteint 75% des votes. Passage au deuxième tour requis.</p>
<?php endif; ?>

<h2 class="text-xl font-semibold mt-6 mb-4">Détails des résultats :</h2>

<?php if (!empty($resultats)): ?>
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
<?php else: ?>
    <p class="text-red-500">Aucun résultat trouvé pour cette élection.</p>
<?php endif; ?>