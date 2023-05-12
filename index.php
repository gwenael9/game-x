<!-- Notre index.php va nous servir de routeur afin de parcourir nos pages -->

<?php 

// constance URL --> va nous donner un chemin dynamique absolue(toute les étapes pour aller d'un point A à un point B)
define("URL" , str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ));

// on a besoin du GameController
require_once "controller/GameController.php";
$gameController = new GameController;

// si on a juste : http://localhost/mini-projet/ , on affiche la page accueil
if(empty($_GET['page'])) {
    require_once "view/home.view.php";
}
else {
    // ex : sélectionne games dans --> http://localhost/mini-projet/games
    $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
    // $url[0] sélectionne le mot après : http://localhost/mini-projet/X
    switch($url[0]) {
        // quand on met accueil dans l'adresse ip cela nous emmène sur home.view
        case 'accueil' : require_once "view/home.view.php";
        break;
        case 'games' :
            // s'il n'y a rien après : http://localhost/mini-projet/games/...
            if(empty($url[1])) {
                $gameController->displayGames();
            }
            // page pour ajouter un jeu
            else if ($url[1] === "add") {
                $gameController->newGameForm();
            }
            // page quand on appuie sur ajouter de la page add
            else if ($url[1] === "gvalid") {
                $gameController->newGameValidation();
            }
            // page pour modifier un jeu
            else if ($url[1] === "edit") {
                $gameController->editGameForm($url[2]);
            }
            // page quand on appuie szur modifier de la page edit
            else if ($url[1] === "editvalid") {
                $gameController->editGameValidation();
            }
            // page pour supprimer un jeu
            else if ($url[1] === "delete") {
                $gameController->deleteGame($url[2]);
            }
        break;
    }
}
