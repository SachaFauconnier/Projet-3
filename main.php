<?php

require_once 'Command.php';
require_once 'ContactManager.php';
require_once 'DBConnect.php';

$db = new DBConnect();
$manager = new ContactManager($db->getPDO());
$command = new Command($manager);

$contacts = $manager->findAll();

if (empty($contacts)) {
    echo "Aucun contact trouvé.\n";
}

while (true) {
    echo "\n---------------------------------------------------------\n";
    $line = trim(readline("Entrez votre commande : "));

    if ($line === "list") {
        $command->list();
    } 
    elseif (preg_match('/^detail\s+(\d+)$/', $line, $matches)) {
        $command->detail((int)$matches[1]);
    } 
    elseif (preg_match('/^create\s+([^,]+),([^,]+),(.+)$/', $line, $matches)) {
        $name = trim($matches[1]);
        $email = trim($matches[2]);
        $phone = trim($matches[3]);
        $command->create($name, $email, $phone);
    } 
    elseif (preg_match('/^delete\s+(\d+)$/', $line, $matches)) {
        $command->delete((int)$matches[1]);
    } 
    elseif (preg_match('/^update\s+(\d+),([^,]+),([^,]+),(.+)$/', $line, $matches)) {
        $id = (int)$matches[1];
        $name = trim($matches[2]);
        $email = trim($matches[3]);
        $phone = trim($matches[4]);
        $command->update($id, $name, $email, $phone);
    } 
    elseif ($line === "help") {
        $command->help();
    } 
    elseif ($line === "quit" || $line === "exit") {
    echo "Fermeture du programme...\n";
    break;
    }
    else {
        echo "Commande inconnue : $line\n";
    }
}
