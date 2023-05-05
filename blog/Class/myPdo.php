<?php

namespace Class;
use PDO;

class MyPdo {
    const DSN = 'sqlite:data.db';
    const USERNAME = NULL;
    const PASSWORD = NULL;

    public static function Connect(): PDO {
        return new PDO(self::DSN, self::USERNAME, self::PASSWORD,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]); 
    }

}