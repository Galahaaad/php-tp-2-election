<?php
require_once '../vendor/autoload.php';

use Mamounenidam\TpElections\Controllers\GroupeController;

$controller = new GroupeController();
$groupes = $controller->groupeModel->getAll();
?>

<main class="flex-grow p-8">
    <h1 class="text-2xl font-bold mb-6">Organisation des élections</h1>
    <form method="post" action="?page=vote" class="space-y-6">
        <label class="block">
            Groupe :
            <select name="groupe" class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700">
                <option value="1">24-25-3OLENCyber</option>
                <option value="2">24-25-3OLEN-Dev</option>
            </select>
        </label>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-medium">Commencer l'élection</button>
    </form>
</main>