<?php

namespace App\Service;

class ClientContactValidator
{
    private array $errorList = [];
    public function __construct()
    {
    }
    public function validateClientContactData(array $data)
    {
        $this->errorList = [];

        return $this->isValidteUsername($data['form_username'])
            && $this->isValidLastname($data['form_lastname'])
            && $this->isValidEmail($data['form_email'])
            && $this->isValidMessage($data['form_message']);
    }

    public function isValidteUsername(?string $username): bool
    {
        return $this->textIsNullOrEmpty($username, "username");
    }

    public function isValidLastname(?string $lastname): bool
    {
        return $this->textIsNullOrEmpty($lastname, "lastname");
    }

    public function isValidEmail(?string $email): bool
    {
        if (!$this->textIsNullOrEmpty($email, "email") || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorList["email"] = "E-mail ma nieprawidłowy format!";
            return false;
        }

        return true;
    }

    public function isValidMessage(?string $message): bool
    {
        return $this->textIsNullOrEmpty($message, "message");
    }

    public function getErrorList(): array
    {
        return $this->errorList;
    }

    private function textIsNullOrEmpty(?string $text, string $argumentName): bool
    {
        if ($text == null || trim($text) == "") {
            $this->errorList[$argumentName] = $argumentName . " jest nieprawidłowy!";
            return false;
        }

        return true;
    }
}