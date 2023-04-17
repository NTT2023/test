<?php
namespace Class;

class Note {


public $notesObj;

public function __construct()
    {
        //$this->notesObj = json_decode(file_get_contents('https://www.ateliers.greta22sio.fr/note.json'));
        $this->notesObj = json_decode('[
            {
               "nom":"Laure",
               "epreuve":"U6",
               "note":"12"
            },
            {
               "nom":"Julian",
               "epreuve":"U6",
               "note":"15"
            },
            {
               "nom":"Sylvain",
               "epreuve":"U6",
               "note":"18"
            },
            {
               "nom":"Gwenig",
               "epreuve":"U6",
               "note":"9"
            },
            {
               "nom":"Laure",
               "epreuve":"U5",
               "note":"18"
            },
            {
               "nom":"Julian",
               "epreuve":"U5",
               "note":"10"
            },
            {
               "nom":"Sylvain",
               "epreuve":"U5",
               "note":"14"
            },
            {
               "nom":"Gwenig",
               "epreuve":"U5",
               "note":"11"
            }
          ]');
     }

public function getNotes() {
    return $this->notesObj ;
}

public function getNotesOrder() {
   $maFct = function($a, $b)
   {
       return ($b->note - $a->note);
   };
    usort($this->notesObj, $maFct);
    return $this->notesObj;
}


public function getBon($epreuve) {
    return array_filter($this->notesObj, function($a) use ($epreuve)
    {
        return ($a->epreuve == $epreuve);
    });
}

public function getBonOrder($epreuve) {
   $myArray = array_filter($this->notesObj, function($a) use ($epreuve)
    {
        return ($a->epreuve == $epreuve);
    });
    usort($myArray, function($a, $b)
    {
        return ($b->note - $a->note);
    });
    return $myArray;
}

}
?>