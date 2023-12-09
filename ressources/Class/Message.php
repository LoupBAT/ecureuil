<?php

class Message
{
    public int $id;
    public string $status;
    public string $email;
    public string $name;
    public string $message;

    public function __construct(int $id, string $status, string $email, string $name, string $message)
    {
        $this->id = $id;
        $this->status = $status;
        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status)
    {
        $this->status = $status;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public static function getAllMessages($bdd)
    {
        $queryMessages = $bdd->prepare("SELECT * FROM messages");
        $queryMessages->execute();

        $messages = [];

        while ($row = $queryMessages->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($row['id'], $row['status'], $row['email'], $row['name'], $row['message']);
        }

        return $messages;
    }

    public static function getAllMessagesToVerify($bdd)
    {
        $queryMessages = $bdd->prepare("SELECT * FROM messages where status = 'toVerify'");
        $queryMessages->execute();

        $messages = [];

        while ($row = $queryMessages->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message($row['id'], $row['status'], $row['email'], $row['name'], $row['message']);
        }

        return $messages;
    }

    public static function verifyMessage($id)
    {
        global $bdd;
        $queryMessages = $bdd->prepare("UPDATE messages SET status='verify'WHERE id=:id ");
        $queryMessages->execute(array('id' => $id));
    }
}
