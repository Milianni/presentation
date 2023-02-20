<?php

namespace App;

class User
{

    public $id;

    public $username;

    public $password;

    public $role;

    public function __construct(string $id, string $username, string $password, string $role)
    {

        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
    public function utilisateur()
    {
        $query = App::getPDO()->query("SELECT * FROM users");
        $user = $query->fetchAll();
    }
}
