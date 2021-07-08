<?php

namespace App\Controllers;

// Controller général s'occupant d'afficher les templates avec les données
class CoreController {

    /**
     * Méthode permettant d'afficher les pages du site
     *
     * @param string $viewName
     * @param array $viewVars
     * @return void
     */
    public function show($viewName, $viewVars=[]){
        
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'].'/assets/';
        extract($viewVars);
        // $viewVars est déclaré à vide ce qui signifie qu'il est optionnel. Il permet d'être utilisé dans chaque fichier de vue
        require_once __DIR__ . '/../views/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/footer.tpl.php';
    }
}