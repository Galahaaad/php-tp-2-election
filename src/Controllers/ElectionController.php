<?php


namespace Mamounenidam\TpElections\Controllers;

use Mamounenidam\TpElections\Models\Election;

class ElectionController
{
    private Election $electionModel;

    public function __construct()
    {
        $this->electionModel = new Election();
    }

    public function listerElections(): array
    {
        return $this->electionModel->getAllElections();
    }

    public function creerElection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $groupe_id = $_POST['groupe_id'] ?? null;

            if ($groupe_id) {
                $success = $this->electionModel->createElection($groupe_id);
                if ($success) {
                    header('Location: /?page=election&success=1');
                    exit;
                } else {
                    header('Location: /?page=election&error=1');
                    exit;
                }
            }
        }
        header('Location: /?page=election&error=1');
        exit;
    }
}