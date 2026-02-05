<?php

require_once 'DBConnect.php';
require_once 'ContactManager.php';

class Commande
{
    public function list(): void {
        $db = new DBConnect();
        $manager = new ContactManager($db->getPDO());

        $contacts = $manager->findAll();

        if (empty($contacts)) {
            echo "Aucun contact trouvé.\n";
            return;
        }

        echo "\naffichage de la liste :\n\n";
        foreach ($contacts as $contact) {
            echo $contact . "\n"; 
        }
    }


// --------------------------------------DETAIL-------------------------------------------------
    public function detail(int $id): void {

        $db = new DBConnect();
        $manager = new ContactManager($db->getPDO());

        $contact = $manager->findbyId($id);

        if ($contact === null) {
            echo "contact non trouvé.\n";
            return;
        }

        echo "\naffichage du contact :\n\n";
        echo $contact . "\n"; 
    }


// --------------------------------------CREATE-------------------------------------------------
    public function create(string $name, string $email, string $phone_number): void {

        $db = new DBConnect();
        $manager = new ContactManager($db->getPDO());

        $success = $manager->create($name, $email, $phone_number);

        if (!$success) {
            echo "Erreur lors de la création du contact.\n";
            return;
        }

        echo "Contact créé avec succès !\n";
    }


// --------------------------------------DELETE-------------------------------------------------
    public function delete(int $id): void
    {
    $db = new DBConnect();
    $manager = new ContactManager($db->getPDO());

    $success = $manager->delete($id);

    if (!$success) {
        echo "Erreur lors de la suppression du contact.\n";
        return;
    }

    echo "Contact supprimé avec succès !\n";
}


// --------------------------------------UPDATE-------------------------------------------------
public function update(int $id, string $name, string $email, string $phone): void
{
    $db = new DBConnect();
    $manager = new ContactManager($db->getPDO());

    $success = $manager->update($id, $name, $email, $phone);

    if (!$success) {
        echo "Erreur lors de la modification du contact.\n";
        return;
    }

    echo "Contact modifié avec succès !\n";
}


// --------------------------------------HELP-------------------------------------------------
public function help(): void
{
    echo "\nCommandes disponibles :\n";
    echo "  list\n";
    echo "  detail <id>\n";
    echo "  create <nom>,<email>,<telephone>\n";
    echo "  delete <id>\n";
    echo "  update <id>,<nom>,<email>,<telephone>\n";
    echo "  help\n\n";
}














}


