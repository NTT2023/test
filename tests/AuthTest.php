<?php

use PHPUnit\Framework\TestCase;
use Class\Auth;
use Class\User;
use Class\UriException;

class AuthTest extends TestCase
{
    const DSN = 'sqlite::memory:';
    const USERNAME = NULL;
    const PASSWORD = NULL;
    private $auth;
    private $session = [];

    public function setUp(): void
    {
        parent::setUp();
        $pdo = new PDO(self::DSN, self::USERNAME, self::PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        $pdo->query('CREATE TABLE "users" (
            "id"	INTEGER,
            "username"	TEXT,
            "mdp"	TEXT,
            "role"	INTEGER,
            PRIMARY KEY("id" AUTOINCREMENT)
        )');
        $pdo->query('INSERT INTO "users" ("id","username","mdp","role") VALUES (2,"admin","admin",1), (3,"toto","toto",2)');
        $this->auth = new Auth($pdo, $this->session);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        //unset ($this->session['user']);
        //unset ($this->auth);
    }


    //test fonction login()

    public function testLoginBadMdp()
    {
        $this->assertNull($this->auth->login('toto', 'test'));
    }
    public function testLoginBadUsername()
    {
        $this->assertNull($this->auth->login('test', 'admin'));
    }
    public function testLoginBonNameEtMdp()
    {
        $this->assertInstanceOf(User::class, $this->auth->login('toto', 'toto'));
    }
    public function testLoginBonNameEtMdpSession()
    {
        $this->auth->login('toto', 'toto');
        $this->assertEquals(3, $this->session['User']);
    }

    public function testLoginBonNameEtMdpPropriétées()
    {
        $user = $this->auth->login('toto', 'toto');
        $this->assertEquals('toto', $user->username);
        $this->assertEquals(2, $user->role);
    }

    //test fonction isconnect()
    public function testIsConnectSessionNotConnect()
    {
        $user = $this->auth->login('toto', 'bad');
        $this->assertNull($this->auth->isConnect());
    }

    public function testIsConnectSessionConnectBadSession()
    {
        $this->session['User'] = 'bad';
        $this->assertNull($this->auth->isConnect());
    }
    //test fonction logout()
    public function testlogout()
    {
        $this->auth->login('toto', 'toto');
        $this->expectException(UriException::class);
        $this->auth->logout();
        $this->assertEquals(false, isset($this->session['User']));
        $this->assertNull($this->auth->isConnect());
    }

    //test fonction acces page admin()
    public function testaccesPasConnect()
    {
        $this->expectException(UriException::class);
        $this->auth->acces('/Labo/blog/create.php');
    }

    public function testaccesConnectPasBonRole()
    {
        $this->expectException(UriException::class);
        $this->auth->login('toto', 'toto');
        $this->auth->acces('/Labo/blog/create.php');
    }

    public function testaccesConnectBonRole()
    {
        $this->auth->login('admin', 'admin');
        $this->assertNotFalse($this->auth->acces('/Labo/blog/create.php'));
    }

    //test fonction acces autre page
    public function testaccesHorsProtection()
    {
        $this->assertNotFalse($this->auth->acces('/Labo/blog/index.php'));
    }
}
