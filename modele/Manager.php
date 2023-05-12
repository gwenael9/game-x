<!-- cette class Manager va nous permettre de faire le lien avec la base de donnée -->

<?php

abstract class Manager {

    private $pdo;

    private function setBdd() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=game_x;charset=utf8", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getBdd() {
        if ($this->pdo == null) {
            $this->setBdd();
        }
        return $this->pdo;
    }
}