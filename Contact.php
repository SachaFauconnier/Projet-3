<?php

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