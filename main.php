<?php

require_once 'Command.php';

$db = new DBConnect();
$manager = new ContactManager($db->getPDO());


// Vérification du contenu avant de continuer

$contacts = $manager->findAll();

var_dump($contacts);
var_dump($matches);

if (empty($contacts)) {
    echo "Aucun contact trouvé.\n";
} 


while (true) {
    echo "\n---------------------------------------------------------\n";
    echo "---------------------------------------------------------\n\n";
    $line = readline("Entrez votre commande : ");

    if ($line === "list") {
        $command->list();
    }

    elseif (preg_match('/^detail\s+(\d+)$/', $line, $matches)) {
        $id = (int)$matches[1]; // récupération de l’ID
        echo "Commande detail avec ID : $id\n";
    }

    elseif (preg_match('/^create\s+(.+),(.+),(.+)$/', $line, $matches)) {
        $name = (string)$matches[1]; // récupération du name
        $email = (string)$matches[2]; // récupération de l’email
        $phone_number = (string)$matches[3]; // récupération du phone_number
        echo "Commande create avec nom : $name\n";
    } 

    elseif (preg_match('/^delete\s+(\d+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $command->delete($id);
    }

    elseif (preg_match('/^update\s+(\d+),(.+),(.+),(.+)$/', $line, $matches)) {
        $id = (int) $matches[1];
        $name = trim($matches[2]);
        $email = trim($matches[3]);
        $phone = trim($matches[4]);

        $command->update($id, $name, $email, $phone);
    }

    elseif ($line === "help") {
        $command->help();
    }

    else {
        echo "Vous avez saisi : $line\n";
    }
    
    
    
}




