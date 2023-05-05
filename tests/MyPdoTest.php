<?php
use PHPUnit\Framework\TestCase;
use Class\MyPdo;
use PDO;

class MyPdoTest extends TestCase
{
    public function testConnectOk() {
        $this->assertInstanceOf('PDO', myPdo::Connect());
    }

    public function testConnectAttributs() {
        $pdo =  myPdo::Connect();
        $attributes = array(
            "ERRMODE"=>2, "DEFAULT_FETCH_MODE"=>5
            );
       
        foreach ($attributes as $attribute => $attendu ) {
            $this->assertEquals($attendu,$pdo->getAttribute(constant( "PDO::ATTR_$attribute")));
        }
    }

}