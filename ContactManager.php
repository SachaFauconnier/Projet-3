<?php

require_once 'Contact.php';
require_once 'DBConnect.php';

class ContactManager
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

// Récupérer tous les contacts
    public function findAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM contact");
        $results = $stmt->fetchAll();
        $contacts = [];
        foreach ($results as $row) {
            $contacts[] = new Contact(
                $row['Id'],
                $row['name'],
                $row['email'],
                $row['phone_number']
            );
        }
        return $contacts;
    }


// Récupérer un seul contact
    public function findById(int $id): ?Contact
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contact WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return new Contact(
            $row['Id'],
            $row['name'],
            $row['email'],
            $row['phone_number']
        );
    }






// Creer un Id
    public function create(string $name, string $email, string $phone_number): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO contact (name, email, phone_number) VALUES (?, ?, ?)"
        );

        return $stmt->execute([$name, $email, $phone_number]);
    }

// Supprimer un contact par ID
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM contact WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

// Modifier un contact par ID
    public function update(int $id, string $name, string $email, string $phone): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE contact 
            SET name = ?, email = ?, phone_number = ?
            WHERE id = ?"
        );

        return $stmt->execute([$name, $email, $phone, $id]);
    }

}
