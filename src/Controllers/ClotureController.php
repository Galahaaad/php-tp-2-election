<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Election;

class ClotureController
{
    private Election $electionModel;

    public function __construct()
    {
        $this->electionModel = new Election();
    }

    public function cloturer(int $election_id)
    {
        if ($this->electionModel->cloturerElection($election_id)) {
            header('Location: /?page=resume&election_id=' . $election_id . '&cloture=success');
            exit;
        } else {
            header('Location: /?page=resume&election_id=' . $election_id . '&cloture=error');
            exit;
        }
    }
}