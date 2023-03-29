<?php 
try {
$pdo = new PDO('sqlite:data.db', null, null,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ]); 
} catch(PDOException $e) {
    echo 'PDO exception thrown: '.$e->getMessage();
}
?>