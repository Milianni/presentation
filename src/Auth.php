<?php

namespace App;

use App\App;
use PDO;

class Auth
{
    private $pdo;
    public $loginPath;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
    }





    public static  function user(): ?User
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $id = $_SESSION['auth'] ?? null;
        if ($id === null) {
            return null;
        }


        $user[] = null;
        $query = App::getPDO()->prepare('SELECT * FROM users WHERE id= ?');
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?: null;
    }

    public static function requireRole(string ...$roles): void
    {
        $loginPath = self::$loginPath;
        $user = self::user();
        if ($user === null || !in_array($user->role, $roles)) {
            header("Location: {$loginPath}?forbid=1");
            exit();
        }
    }
    public static function login(string $username, string $password): ?User
    {
        //trouver l'utilisateur corespondant au username
        $query = App::getPDO()->prepare('SELECT * FROM users WHERE username= :username');
        $query->execute(['username' => $username]);
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
            $access = false;
            $message = "Acces refuser mot de passe ou pseudo incorrect.";
        }
        // ont verifie que password_verify que l'utilisateur corespond
        if (password_verify($password, $user->password)) {

            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $admin = null;
            $_SESSION['auth'] = $user->id;
            dump($_SESSION);
            if ($_SESSION['auth'] === 1) {
                $admin === true;
            }
            return $user;
            $access = true;
            $message = "Access autorisé bienvenue";
        }
        return null;
    }
}
