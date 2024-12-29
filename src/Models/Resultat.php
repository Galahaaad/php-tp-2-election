<?php

namespace Mamounenidam\TpElections\Models;

use PDO;
use Mamounenidam\TpElections\Config\Database;

class Resultat
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getResultats(int $election_id): array
    {
        $sql = "
            SELECT c.id, c.prenom, c.nom, 
                   COUNT(v.id) AS votes,
                   ROUND((COUNT(v.id) / (SELECT COUNT(*) FROM votes WHERE election_id = :election_id)) * 100, 2) AS pourcentage
            FROM candidats c
            LEFT JOIN votes v ON c.id = v.candidat_id
            WHERE v.election_id = :election_id
            GROUP BY c.id
            ORDER BY votes DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['election_id' => $election_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verifierElu(int $election_id): ?array
    {
        $resultats = $this->getResultats($election_id);
        foreach ($resultats as $candidat) {
            if ($candidat['pourcentage'] >= 75) {
                return $candidat;
            }
        }
        return null;
    }

    public function getDeuxMeilleurs(int $election_id): array
    {
        $sql = "
        SELECT c.id, c.prenom, c.nom, 
               COUNT(v.id) AS votes
        FROM candidats c
        LEFT JOIN votes v ON c.id = v.candidat_id
        WHERE v.election_id = :election_id
        GROUP BY c.id
        ORDER BY votes DESC
        LIMIT 2";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['election_id' => $election_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatistiques(int $election_id): array
    {
        $sqlTotal = "SELECT COUNT(*) AS total FROM votes WHERE election_id = :election_id";
        $stmt = $this->pdo->prepare($sqlTotal);
        $stmt->execute(['election_id' => $election_id]);
        $total = $stmt->fetchColumn();

        $sqlBlanc = "SELECT COUNT(*) AS blancs FROM votes WHERE election_id = :election_id AND type_vote = 'blanc'";
        $stmt = $this->pdo->prepare($sqlBlanc);
        $stmt->execute(['election_id' => $election_id]);
        $blancs = $stmt->fetchColumn();

        $sqlNul = "SELECT COUNT(*) AS nuls FROM votes WHERE election_id = :election_id AND type_vote = 'nul'";
        $stmt = $this->pdo->prepare($sqlNul);
        $stmt->execute(['election_id' => $election_id]);
        $nuls = $stmt->fetchColumn();

        return [
            'total' => $total,
            'blancs' => $blancs,
            'nuls' => $nuls,
            'valide' => $total - ($blancs + $nuls)
        ];
    }
}