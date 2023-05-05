<?php

namespace Class;
use PDO;

class Auth
{
    private $pdo;
    private $session;

    function __construct(PDO $pdo, array &$session)
    {
        $this->pdo = $pdo;
        $this->session = &$session;
    }


    public function isConnect(): ?User {
        if(!isset($this->session['User'])) { return null;
        exit(); }
        $id = $this->session['User'];
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
            $this->session['User'] = $user->id;
            return $user;
        }
        return null;
    }
}
