<?php
namespace Class;


class UriException extends \Exception {
    
    public function run() {
        header('Location: login.php');
    }

}