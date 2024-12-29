<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Resultat;

class DeuxiemeTourController
{
    private Resultat $resultatModel;

    public function __construct()
    {
        $this->resultatModel = new Resultat();
    }

    public function afficherDeuxiemeTour(int $election_id)
    {
        $candidats = $this->resultatModel->getDeuxMeilleurs($election_id);

        require_once __DIR__ . '/../Views/deuxieme_tour.php';
    }
}