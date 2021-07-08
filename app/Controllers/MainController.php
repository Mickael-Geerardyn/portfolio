<?php

namespace App\Controllers;

use App\Models\Pokemon;

// On crée le Controller principal

class MainController extends CoreController {

    /**
     * Méthode qui va se charger de gérer l'affichage de la page principale
     *
     * @return void
     */
    public function home(){

        $pokemonModel = new Pokemon();

        $allPokemon = $pokemonModel->findAllPokemon();

        $this->show('homepage', $allPokemon);
    }

    /**
     * Méthode permettant l'affichage de la page détaillée d'un pokemon
     *
     * @return void
     */
    public function details($params) {

        $this->show('details');
    }

    public function notFound(){

        $this->show('404');
    }
}