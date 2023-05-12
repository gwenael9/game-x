<?php ob_start() ?>

<form method="POST" action="<?= URL ?>games/editvalid">
    <div class="form-group">
        <label for="title">Titre du jeu</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $game->getTitle() ?>">
    </div>
    <div class="form-group">
        <label for="nbPlayers" >Nombre de joueurs</label>
        <input type="number" class="form-control" name="nbPlayers" id="nbPlayers" value="<?= $game->getNbPlayers() ?>">
    </div>
    <input type="hidden" name="id-game" value="<?= $game->getId() ?>">
    <button type="submit" class="btn btn-warning my-3">Modifier</button>
</form>

<?php

$title = "Modifier : " . $game->getTitle();
$content = ob_get_clean();
require_once "base.html.php";

?>