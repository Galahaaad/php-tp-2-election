<?php

namespace Mamounenidam\TpElections\Models;

use PDO;
use Mamounenidam\TpElections\Config\Database;

class Personne
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getByGroupeId(int $groupe_id): array
    {
        $sql = "SELECT id, prenom, nom FROM personnes WHERE groupe_id = :groupe_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['groupe_id' => $groupe_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajouterPersonne(string $prenom, string $nom, int $groupe_id): bool
    {
        $sql = "INSERT INTO personnes (prenom, nom, groupe_id) VALUES (:prenom, :nom, :groupe_id)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'prenom' => $prenom,
            'nom' => $nom,
            'groupe_id' => $groupe_id
        ]);
    }

    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM personnes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function supprimerPersonne(int $id): bool
    {
        $sql = "DELETE FROM personnes WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}