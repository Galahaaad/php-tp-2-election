<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Candidat;

class CandidatController
{
    private Candidat $candidatModel;

    public function __construct()
    {
        $this->candidatModel = new Candidat();
    }
    public function afficherCandidats(int $election_id)
    {
        $candidats = $this->candidatModel->getByElectionId($election_id);
        require_once __DIR__ . '/../Views/candidats.php';
    }

    public function ajouterCandidat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = $_POST['prenom'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $election_id = (int) ($_POST['election_id'] ?? 0);

            if (!empty($prenom) && !empty($nom) && $election_id > 0) {
                $success = $this->candidatModel->ajouterCandidat($prenom, $nom, $election_id);
                header('Location: /?page=candidats&election_id=' . $election_id . '&success=' . (int) $success);
                exit;
            }
        }
        header('Location: /?page=candidats&election_id=' . $election_id . '&error=1');
        exit;
    }
}