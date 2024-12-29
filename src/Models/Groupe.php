<?php

namespace Mamounenidam\TpElections\Models;

use PDO;
use Mamounenidam\TpElections\Config\Database;

class Groupe
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM groupes";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM groupes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}