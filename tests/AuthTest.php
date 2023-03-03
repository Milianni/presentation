<?php

use PHPUnit\Framework\TestCase;
use App\Auth;

class AuthTest extends TestCase
{
    /**
     *@var Auth
     */
    private $auth;
    /**
     
     *@before
     * @return void
     */
    public function setAuth()
    { {
            $pdo = new PDO("sqlite::memory:", null, null, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
            $res = $pdo->query('CREATE TABLE users (username TEXT, password TEXT)');
            for ($i = 1; $i <= 10; $i++) {
                $password = password_hash("user$i", PASSWORD_BCRYPT);
                $pdo->query("INSERT INTO users(username, password) VALUES('user$i', 'user$i')");
            }
            $this->auth = new Auth($pdo, "/login");
        }
    }

    public function testLoginWithBadUsername()
    {
        $this->assertNull($this->auth->login('aze', "aze"));
    }
    public function testLoginWithBadPassword()
    {
        $this->assertNull($this->auth->login('user1', "admin"));
    }
}
