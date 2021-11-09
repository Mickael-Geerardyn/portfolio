<?php

// Affichage des erreurs sur la page (Fichier php.ini également modifié à la ligne : display_errors = on)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// On inclut l'autoloader qui permet de réécrire les routes passées dans l'url
require __DIR__ . '/../vendor/autoload.php';

// 1) On instancie la classe AltoRouter
$router = new AltoRouter();

// On fournit à Altorouter la base de l'url qui reste toujours la même et qui ne doit donc pas être comparée mais seulement utilisée. Pour se faire, on utilise la méthode setBasePath de l'objet Altorouter. On lui fournit la variable globale php $_SERVER à la clé 'BASE_URI' qui contient la route fixe. La valeur de $_SERVER['BASE_URI'] est donnée par le fichier .htaccess.
if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
};

// On créé ensuite les routes du site
$router->map(
    'GET', // La méthode HTTP qui est autorisée sur cette route
    '/', // L'url que l'on saisira dans le navigateur

    // 'target' ce tableau stocke les noms de l'action et du contrôleur qui vont se déclencher pour réagir à cette URL
    [
        'method' => 'home',
        'controller' => 'App\Controllers\MainController'
    ],
    'home'// Le nom donné à cette route
);

// Route pour l'affichage des détails d'un pokemon
$router->map(
    'GET', // Méthode HTTP autorisée pour l'affichage de cette route et de ses données
    '/details/[i:id]', //Nom de l'url amenant à la page détaillée d'un pokemon contenant une    partie dynamique (id)

    // Tableau contenant la méthode et le controller à enclencher
    [
        'method' => 'details',
        'controller' => 'App\Controllers\MainController'
    ],
    'details' // Nom de la route
);

// Si la route existe, la méthode match() renvoi un tableau de la route qui sera stocké dans la variable $match sinon elle renvoi le booléen false
$match = $router->match();

// Si la méthode retourne autre chose que false, c'est qu'une route existe dans Altorouter
if($match !== false) {

    // On récupère les informations de la route (le tableau déclaré dans $router->map())
    // Qui sont nécessaire au rendu html
    $routeData = $match['target'];

    // On va chercher la méthode à appeler
    $methodToCall = $routeData['method'];

    // On va chercher le controller concerné par la méthode
    $controllerToCall = $routeData['controller'];

    // On va chercher le paramètre dynamique s'il existe
    $routeParams = $match['params'];
} else {
    // Si aucune route n'existe, on retourne vers la page 404

    // On va chercher la méthode à appeler
    $methodToCall = 'notFound';

    // On va chercher le controleur à appeler dans lequel se trouve la méthode
    $controllerToCall = 'App\Controllers\MainController';

    // On initialise une variable de paramètre dynamique (tableau) à vide pour éviter un message d'erreur lorsqu'on doit arriver dans cette condition pour l'affichage de la page 404
    $routeParams = [];
}

// On instancie le controller qui sera appelé
$controller = new $controllerToCall();

// On transmet la méthode à appeler avec les paramètres dynamiques éventuels
$controller->$methodToCall($routeParams);