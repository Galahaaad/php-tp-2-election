<?php

namespace Mamounenidam\TpElections\Models;

use PDO;
use Mamounenidam\TpElections\Config\Database;

class Election
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAllElections(): array
    {
        $sql = "SELECT elections.id, groupes.nom as groupe, elections.tour, elections.cloture
                FROM elections
                JOIN groupes ON elections.groupe_id = groupes.id
                ORDER BY elections.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listerElections(): array
    {
        $sql = "SELECT e.id, e.tour, e.cloture, g.nom AS groupe
            FROM elections e
            JOIN groupes g ON e.groupe_id = g.id";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createElection(int $groupe_id, int $tour = 1): bool
    {
        $sql = "INSERT INTO elections (groupe_id, tour, cloture) VALUES (:groupe_id, :tour, FALSE)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['groupe_id' => $groupe_id, 'tour' => $tour]);
    }

    public function getElectionById(int $id): ?array
    {
        $sql = "SELECT * FROM elections WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $election = $stmt->fetch(PDO::FETCH_ASSOC);

        return $election ?: null;
    }

    public function cloturerElection(int $id): bool
    {
        $sql = "UPDATE elections SET cloture = 1 WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function estCloturee(int $id): bool
    {
        $sql = "SELECT cloture FROM elections WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return (bool) $stmt->fetchColumn();
    }
}