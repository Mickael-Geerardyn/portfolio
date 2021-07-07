<?php

namespace App\Models;

// Class mère des models qui possèdera uniquement un getter car l'ID est généré par la BDD, elle ne prendra qu'un seul paramètre commun : l'ID
class CoreModel {

    // propriété id de la class
    protected $id;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}