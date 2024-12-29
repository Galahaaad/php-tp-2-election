<h1 class="text-2xl font-bold mb-6">Bienvenue sur l'élection des délégués</h1>
<p>Sélectionnez une page dans le menu pour continuer.</p>

<h1 class="text-2xl font-bold mb-6">Élections en cours</h1>

<?php if (!empty($elections)): ?>
    <ul class="space-y-4">
        <?php foreach ($elections as $election): ?>
            <li class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <a href="?page=election_actions&election_id=<?= htmlspecialchars($election['id']) ?>"
                   class="text-blue-500 hover:underline">
                    🗳️ Élection #<?= htmlspecialchars($election['id']) ?> - Groupe <?= htmlspecialchars($election['groupe'] ?? 'Inconnu') ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucune élection en cours.</p>
<?php endif; ?>