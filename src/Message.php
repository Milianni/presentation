<?php

namespace App;

use DateTime;
use App\GuestBook;

class Message
{
    const LIMIT_USERNAME = 3;
    const  LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;

    public function __construct(string $username, string $message, ?DateTime $date = null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date ?: new DateTime();
    }
    public function is_valide(): bool
    {
        return empty($this->getErrors());
    }
    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $errors['username'] = 'Votre pseudo est trop court';
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $errors['message'] = 'Votre message est trop court';
        }
        return $errors;
    }
    public function toHTML()
    {
        $message = htmlentities($this->message);
        $username = htmlentities($this->username);
        $date = $this->date->format('d/m/Y à h:i');
        return <<<HTML
        <p>
            <strong>{$username}</strong><br/> <em>Le{$date}</em><br/>
            $message;
HTML;
    }
    public function toJSON()
    {
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }
}
