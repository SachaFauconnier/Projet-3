<?php

class DBConnect
{
    // Propriété privée pour stocker l'objet PDO
    private $pdo = null;

    // Constructeur : connexion
    public function __construct()
    {
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
                    $row['Name'],
                    $row['email'],
                    $row['phone_number']
                    );
            }
        return $contacts;
    }
}

class Contact{

    private int $id;
    private string $name;
    private string $email;
    private string $phone_number;

    // Constructeur pour initialiser un contact
    public function __construct(int $id, string $name, string $email, string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    // afficher le contact
    public function __toString(): string
    {
        return "ID: {$this->id}, Name: {$this->name}, Email: {$this->email}, Phone: {$this->phone_number}";
    }

}

$db = new DBConnect();
$manager = new ContactManager($db->getPDO());


// Vérification du contenu avant de continuer

$contacts = $manager->findAll();

var_dump($contacts);

if (empty($contacts)) {
    echo "Aucun contact trouvé.\n";
} 


while (true) {
    echo "\n---------------------------------------------------------\n";
    echo "---------------------------------------------------------\n\n";
    $line = readline("Entrez votre commande : ");


    if ($line == "list") {
        echo "\naffichage de la liste :\n\n";
        foreach ($contacts as $contact) {
        echo $contact . "\n"; // utilise la méthode __toString() de Contact
}
    } else {
        echo "Vous avez saisi : $line\n";
    }
}


