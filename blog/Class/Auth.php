<?php

namespace Class;

use PDO;
class Auth
{

    public $pdo;

    function __construct()
    {
        $this->pdo = myPdo::Connect();
    }


    public function isConnect(): ?User {
        if(!isset($_SESSION['User'])) { return null;
        exit(); }
        $id = $_SESSION['User'];
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id= :id');
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $query->fetch();
        if ($user === false) {
            return null;
        }
        else {
            return $user;
        }
    }

    public function login(string $username, string $mdp): ?User
    {

        $query = $this->pdo->prepare('SELECT * FROM users WHERE username= :username');
        $query->execute(['username' => $username]);
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);
        $user = $query->fetch();
        //$user = $query->fetchObject(User::class);

        if ($user === false) {
            return null;
        }

        //   if(password_verify($mdp, $user->mdp)) 
        if ($mdp == $user->mdp) {
            $_SESSION['User'] = $user->id;
            return $user;
        }
        return null;
    }
}
