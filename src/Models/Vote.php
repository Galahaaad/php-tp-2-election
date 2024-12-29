<?php

namespace Mamounenidam\TpElections\Models;

use PDO;
use Mamounenidam\TpElections\Config\Database;

class Vote
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function enregistrerVote(int $election_id, int $votant_id, ?int $candidat_id, string $type_vote): bool
    {
        $sql = "INSERT INTO votes (election_id, votant_id, candidat_id, type_vote) 
                VALUES (:election_id, :votant_id, :candidat_id, :type_vote)";
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'election_id' => $election_id,
            'votant_id' => $votant_id,
            'candidat_id' => $candidat_id,
            'type_vote' => $type_vote
        ]);
    }

    public function getVotesByElection(int $election_id): array
    {
        $sql = "SELECT * FROM votes WHERE election_id = :election_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['election_id' => $election_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}