<?php

namespace App\Service;

use App\Entity\ClientContact;
use Doctrine\ORM\EntityManagerInterface;

class ClientContactService
{
    public function __construct(private EntityManagerInterface $entityManagerInterface)
    {
    }

    public function createClientContactEntityByInputBag(array $data): ClientContact
    {
        $clientContact = (new ClientContact())
            ->setUsername($data['form_username'])
            ->setLastname($data['form_lastname'])
            ->setEmail($data['form_email'])
            ->setMessage($data['form_message']);

        $this->entityManagerInterface->persist($clientContact);
        $this->entityManagerInterface->flush();

        return $clientContact;
    }
}