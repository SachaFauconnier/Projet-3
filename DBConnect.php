<?php

class DBConnect
{
    // Propriété privée pour stocker l'objet PDO
    private $pdo = null;

    // Constructeur : connexion
    public function __construct()
    {

        $host = '127.0.0.1'; 
        $dbname = 'projet-2';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->pdo = new PDO(
                'mysql:host=localhost;dbname=projet-2;charset=utf8',
                'root',
                '',
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                )
            );
        } catch (Exception $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    // Récupérer le PDO
    public function getPDO()
    {
        return $this->pdo;
    }
}
