<?php

use PHPUnit\Framework\TestCase;
use Class\Post;

class PostTest extends TestCase
{

    private $post;
    
    protected function setUp():void
    {
        parent::setUp();
        $this->post = new Post();
    }
    //test fonction get time()

    public function testgetTimeTxtCourt()
    {
        $this->post->content = 'testgetTime';
        $this->assertEquals('1mn de lecture', $this->post->getTime());
    }
    public function testgetTimeTxtVide()
    {
        $this->post->content = '';
        $this->assertEquals('1mn de lecture', $this->post->getTime());
    }
    public function testgetTimeTxtLong()
    {
        $txt = '';
        for ($i = 0; $i < 180; $i++) {
            $txt .= ' test test ';
        }
        $this->post->content = $txt;
        $this->assertEquals('2mn de lecture', $this->post->getTime());
    }

    //test fonction getDate()
    public function testgetDatezero()
    {
        $this->post->date = 0;
        $this->assertEquals('Ecrit le : 1 janvier 1970', $this->post->getDate());
    }
    public function testgetDateValide()
    {
        $this->post->date = 1682247636;
        $this->assertEquals('Ecrit le : 23 avril 2023', $this->post->getDate());
    }
    public function testgetDateStringNegatif()
    {
        $this->post->date = '-1682247636';
        $this->assertEquals('Ecrit le : 10 septembre 1916', $this->post->getDate());
    }
    public function testgetDateNull()
    {
        $this->post->date = null;
        $this->assertEquals('Ecrit le : ', $this->post->getDate());
    }
    //test fonction getResume()
    public function testgetResumeTxtLong()
    {
        $txt = '';
        for ($i = 0; $i < 100; $i++) {
            $txt .= 't';
        }
        $this->post->content = $txt;
        $this->assertEquals(70, strlen($this->post->getResume()));
    }
    public function testgetResumeTxtCourt()
    {
        $txt = '';
        for ($i = 0; $i < 60; $i++) {
            $txt .= 't';
        }
        $this->post->content = $txt;
        $this->assertEquals(60, strlen($this->post->getResume()));
    }

    public function testgetResumeTxtVide()
    {
        $txt = '';
        $this->post->content = $txt;
        $this->assertEquals(0, strlen($this->post->getResume()), $txt);
    }
}
