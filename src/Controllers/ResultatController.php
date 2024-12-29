<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Resultat;

class ResultatController
{
    private Resultat $resultatModel;

    public function __construct()
    {
        $this->resultatModel = new Resultat();
    }

    public function afficherResultats(int $election_id)
    {
        $resultats = $this->resultatModel->getResultats($election_id);
        $elu = $this->resultatModel->verifierElu($election_id);
        $resultats = $resultats ?? [];
        $elu = $elu ?? null;

        require_once __DIR__ . '/../Views/resultats.php';
    }
}