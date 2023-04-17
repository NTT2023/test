<?php
namespace Class;

class Post {
public $id;
public $name;
public $content;
public $date;

public function __construct(int $id, string $name, string $content, ?int $date)
    {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
        $this->date = $date;
    }

public function getResume():?string {
    return substr($this->content, 0 , 70);
}

public function getDate() {
    $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::NONE);
    return "Ecrit le : ".$formatter->format($this->date);
}

}
?>