<?php

namespace Mamounenidam\TpElections\Models;

use PDO;
use Mamounenidam\TpElections\Config\Database;

class Candidat
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function ajouterCandidat(string $prenom, string $nom, int $election_id): bool
    {
        $sql = "INSERT INTO candidats (prenom, nom, election_id) VALUES (:prenom, :nom, :election_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'election_id' => $election_id
        ]);
    }

    public function getByElectionId(int $election_id): array
    {
        $sql = "SELECT * FROM candidats WHERE election_id = :election_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['election_id' => $election_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function supprimerCandidat(int $id): bool
    {
        $sql = "DELETE FROM candidats WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}