
<!-- permet de lire le code html suivant -->
<?php ob_start() ?>

<table class="table table-hover text-center">

  <thead class="table-primary">
    <tr>
      <th>Titre</th>
      <th>Nombre de joueurs</th>
      <th colspan="2">Action</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($games as $game) : ?>
      <tr>
        <td><div class="btn"><?= $game->getTitle() ?></div></td>
        <td><div class="btn"><?= $game->getNbPlayers() ?></div></td>

        <td><a class="btn" href="<?= URL ?>games/edit/<?= $game->getId() ?>"><i class="fas fa-edit"></i></a></td>

        <td>
          <form action="<?= URL ?>games/delete/<?= $game->getId() ?>" method="POST" onSubmit="return confirm('Êtes-vous certains ?')">
            <button class="btn" type="submit"><i class="fas fa-trash"></i></button>
          </form>
        </td>

      </tr>
    <?php endforeach; ?>
  </tbody>

</table>

<a href="<?= URL ?>games/add" class="btn btn-success my-3" >Ajouter un jeu</a>

<?php

$title = "Liste de jeux";
// ob_get_clean va apl ob_start et donc le code html
$content = ob_get_clean();
require_once "base.html.php";

?>
