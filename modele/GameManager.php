<!-- cette class GameManager dépend de la class Manager, 
elle s'occupe de chaque jeux que l'on a sur notre base de donnée -->

<?php

require_once "modele/Game.php";
// permet d'hériter la class GameManager de Manager
require_once "modele/Manager.php";

// gestion de l'entité game et des games dans notre app
class GameManager extends Manager {

    private $games;

    // push $game dans le tableau $games
    public function addGame($game) {
        $this->games[] = $game;
    }

    // renvoie le tableau $games
    public function getGames() {
        return $this->games;
    }

    // récupère tous les jeux de la bdd puis les stock dans $myGames
    public function loadGames() {
        $req = $this->getBdd()->prepare("SELECT * FROM games");
        $req->execute();
        // PDO::FETCH_ASSOC permet de ne pas avoir de doublon
        $myGames = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        // boucle qui affiche les jeux sur notre view
        foreach ($myGames as $game) {
            $g = new Game($game['id'], $game['title'], $game['nb_players']);
            $this->addGame($g);
        }
    }

    // Pour ajouter un jeu :

    // important de savoir comprendre et expliquer ça
    // fonction qui va recevoir les données et les envoyer à la bdd puis on sera rediriger vers la page games
    public function newGameDB($title, $nbPlayers) {
        $req = "INSERT INTO games (title, nb_players) VALUES (:title, :nbPlayers)";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":title", $title, PDO::PARAM_STR);
        $statement->bindValue(":nbPlayers", $nbPlayers, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();

        if($result) {
            // $game représente le nouveau jeu ajouté, revoir lastInsertId()
            $game = new Game($this->getBdd()->lastInsertId(), $title, $nbPlayers);
            $this->addGame($game);
        }
    }

    // Pour modifier un jeu sur notre view : 

    // cherche dans les jeux, si le jeu a le même id, renvoie le jeu
    public function getGameById($id) {
        foreach ($this->games as $game) {
            if($game->getId() == $id) {
                return $game;
            }
        }
    }

    // comme la fonction pour ajouter sauf qu'ici, on modifie notre jeu
    public function editGameDB($id, $title, $nbPlayers) {
        $req = "UPDATE games SET title = :title, nb_players = :nbPlayers WHERE id = :id";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $statement->bindValue(":title", $title, PDO::PARAM_STR);
        $statement->bindValue(":nbPlayers", $nbPlayers, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();

        if($result) {
            $this->getGameById($id)->setTitle($title);
            $this->getGameById($id)->setTitle($nbPlayers);
        }
    }

    // fonction qui supprime notre jeu
    public function deleteGameDB($id) {
        $req = "DELETE FROM games WHERE id = :id";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $statement->execute();
        $statement->closeCursor();

        if($result) {
            $game = $this->getGameById($id);
            unset($game);
        }
    }
}

