<?php
namespace Class;
class UriException extends \Exception {

    public function getUriMessage() {

        return '<div class="alert alert-danger">'.$this->getMessage().' <a href="index.php">Retour</a></div>';

    }
}