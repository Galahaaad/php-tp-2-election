<h1 class="text-2xl font-bold mb-6">Actions pour l'élection #<?= htmlspecialchars($election['id']) ?></h1>

<p class="mb-4">
    Groupe : <strong><?= htmlspecialchars($election['groupe_id']) ?></strong><br>
    Tour : <strong><?= htmlspecialchars($election['tour']) ?></strong><br>
    Statut : <?= $election['cloture'] ? '<span class="text-red-500">Clôturée</span>' : '<span class="text-green-500">Ouverte</span>' ?>
</p>

<div class="space-y-4">

    <?php if (!$election['cloture']): ?>
        <a href="?page=vote&election_id=<?= $election['id'] ?>" class="block p-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            🗳️ Voter
        </a>
    <?php endif; ?>

    <a href="?page=resultats&election_id=<?= $election['id'] ?>" class="block p-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
        📊 Voir les résultats
    </a>

    <a href="?page=deuxieme_tour&election_id=<?= $election['id'] ?>" class="block p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600">
        🥈 Organiser un deuxième tour
    </a>

    <a href="?page=resume&election_id=<?= $election['id'] ?>" class="block p-4 bg-green-500 text-white rounded-lg hover:bg-green-600">
        📄 Voir le résumé final
    </a>

    <?php if (!$election['cloture']): ?>
        <a href="?page=candidats&election_id=<?= $election['id'] ?>" class="block p-4 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">
            👥 Gérer les candidats
        </a>
    <?php endif; ?>

    <?php if (!$election['cloture']): ?>
        <a href="?page=cloture&election_id=<?= $election['id'] ?>" class="block p-4 bg-red-500 text-white rounded-lg hover:bg-red-600">
            🔒 Clôturer l'élection
        </a>
    <?php else: ?>
        <p class="text-red-500 font-bold">⚠️ Élection clôturée. Plus aucune action n'est possible.</p>
    <?php endif; ?>
</div>