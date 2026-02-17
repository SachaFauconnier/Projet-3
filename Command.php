<?php

require_once 'ContactManager.php';

class Command
{
    private ContactManager $manager;

    public function __construct(ContactManager $manager)
    {
        $this->manager = $manager;
    }

    public function list(): void
    {
        $contacts = $this->manager->findAll();
        if (empty($contacts)) {
            echo "Aucun contact trouvé.\n";
            return;
        }

        echo "\nListe des contacts :\n";
        foreach ($contacts as $contact) {
            echo $contact . "\n";
        }
    }

    public function detail(int $id): void
    {
        $contact = $this->manager->findById($id);
        if (!$contact) {
            echo "Contact non trouvé.\n";
            return;
        }

        echo "\nDétails du contact :\n";
        echo "ID: " . $contact->getId() . "\n";
        echo "Nom: " . $contact->getName() . "\n";
        echo "Email: " . $contact->getEmail() . "\n";
        echo "Téléphone: " . $contact->getPhoneNumber() . "\n";
    }

    public function create(string $name, string $email, string $phone_number): void
    {
        if ($this->manager->create($name, $email, $phone_number)) {
            echo "Contact créé avec succès !\n";
        } else {
            echo "Erreur lors de la création du contact.\n";
        }
    }

    public function delete(int $id): void
    {
        if ($this->manager->delete($id)) {
            echo "Contact supprimé avec succès !\n";
        } else {
            echo "Erreur lors de la suppression du contact.\n";
        }
    }

    public function update(int $id, string $name, string $email, string $phone): void
    {
        if ($this->manager->update($id, $name, $email, $phone)) {
            echo "Contact modifié avec succès !\n";
        } else {
            echo "Erreur lors de la modification du contact.\n";
        }
    }

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
