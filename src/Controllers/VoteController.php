<?php

namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Vote;
use Mamounenidam\TpElections\Models\Resultat;
use Mamounenidam\TpElections\Models\Personne;
use Mamounenidam\TpElections\Models\Election;

class VoteController
{
    private Vote $voteModel;

    public function __construct()
    {
        $this->voteModel = new Vote();
    }


    public function afficherVote(int $election_id)
    {
        $resultatModel = new Resultat();
        $personneModel = new Personne();
        $electionModel = new Election();

        $candidats = $resultatModel->getResultats($election_id);
        $election = $electionModel->getElectionById($election_id);

        if (!$election) {
            echo '<p class="text-red-500">Erreur : Élection introuvable.</p>';
            exit;
        }

        $votants = $personneModel->getByGroupeId($election['groupe_id']);

        require_once __DIR__ . '/../Views/vote.php';
    }


    public function enregistrerVote()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $election_id = $_POST['election_id'] ?? null;
            $votant_id = $_POST['votant_id'] ?? null;
            $candidat_id = $_POST['candidat_id'] ?? null;
            $type_vote = $_POST['type_vote'] ?? 'valide';

            if ($candidat_id === 'blanc') {
                $type_vote = 'blanc';
                $candidat_id = null;
            } elseif ($candidat_id === 'nul') {
                $type_vote = 'nul';
                $candidat_id = null;
            } else {
                $candidat_id = (int) $candidat_id;
            }

            if ($election_id && $votant_id && $type_vote) {
                $success = $this->voteModel->enregistrerVote($election_id, $votant_id, $candidat_id, $type_vote);

                if ($success) {
                    header('Location: /?page=vote&success=1');
                    exit;
                } else {
                    header('Location: /?page=vote&error=1');
                    exit;
                }
            }
        }

        header('Location: /?page=vote&error=1');
        exit;
    }
}