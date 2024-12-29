<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Election;

class ElectionActionsController
{
    private Election $electionModel;

    public function __construct()
    {
        $this->electionModel = new Election();
    }

    public function afficherActions(int $election_id)
    {
        $election = $this->electionModel->getElectionById($election_id);

        if (!$election) {
            echo '<p class="text-red-500">Erreur : Élection introuvable.</p>';
            exit;
        }

        require_once __DIR__ . '/../Views/election_actions.php';
    }
}