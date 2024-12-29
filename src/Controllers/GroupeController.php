<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Groupe;

class GroupeController
{
    public Groupe $groupeModel;

    public function __construct()
    {
        $this->groupeModel = new Groupe();
    }

    public function index()
    {
        $groupes = $this->groupeModel->getAll();
        require_once __DIR__ . '/../Views/election.php';
    }
}