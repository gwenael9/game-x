<!-- cette class Game prend les paramètres de nos jeux (id, nb de joueurs et son nom) -->

<?php

class Game {

    private int $id;
    private string $title;
    private int $nbPlayers;

    public function __construct($id, $title, $nbPlayers) {
        $this->id = $id;
        $this->title = $title;
        $this->nbPlayers = $nbPlayers;
    }

    // id
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    // title
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    // nbplayers
    public function getNbPlayers() {
        return $this->nbPlayers;
    }

    public function setNbPlayers($nbPlayers) {
        $this->nbPlayers = $nbPlayers;
        return $this;
    }
}


