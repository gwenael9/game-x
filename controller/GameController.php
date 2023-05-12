<!-- cette class va nous servir à controller notre site et notamment nos actions -->

<?php

require_once "modele/GameManager.php";

class GameController {
    private $gameManager;

    // notre constructor
    public function __construct() {
        $this->gameManager = new GameManager;
        $this->gameManager->loadGames();
    }

    // page games qui affiche nos jeux
    public function displayGames() {
        $games = $this->gameManager->getGames();
        require_once "view/games.view.php";
    }

    // page formulaire pour ajouter un jeu
    public function newGameForm() {
        require_once "view/new.game.view.php";
    }

    // quand on valide notre ajout de jeu
    public function newGameValidation() {
        $this->gameManager->newGameDB($_POST['title'], $_POST['nbPlayers']);
        header("Location:". URL . "games");
    }

    // page edit qui modifie le jeu selon l'id
    public function editGameForm($id) {
        $game = $this->gameManager->getGameById($id);
        require_once "view/edit.game.view.php";
    }

    // quand on valide notre modification
    public function editGameValidation() {
        $this->gameManager->editGameDB($_POST['id-game'], $_POST['title'], $_POST['nbPlayers']);
        header("Location:". URL . "games");
    }

    // pour supprimer notre jeu
    public function deleteGame($id) {
        $game = $this->gameManager->deleteGameDB($id);
        header("Location:". URL . "games");
    }
}