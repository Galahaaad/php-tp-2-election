<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Resultat;

class ResumeController
{
    private Resultat $resultatModel;

    public function __construct()
    {
        $this->resultatModel = new Resultat();
    }

    public function afficherResume(int $election_id)
    {
        $resultats = $this->resultatModel->getResultats($election_id);
        $statistiques = $this->resultatModel->getStatistiques($election_id);

        $elu = $this->resultatModel->verifierElu($election_id);

        $deuxMeilleurs = $this->resultatModel->getDeuxMeilleurs($election_id);

        require_once __DIR__ . '/../Views/resume.php';
    }
}