<h1>Ajouter une ville</h1>
<?php
  if (empty($_POST["ville_nom"])) {?>
    <form action="#" method="post">
      <label for="ville_nom">Nom : </label>
      <input type="text" id="ville_nom" name="ville_nom" required>
      <input type="submit" value="Valider">
    </form>
  <?php }
  else {
    $row=$villeManager->existe($_POST["ville_nom"]);
    if ($row==0) {?>
      <img src="image/valid.png" alt="Valid">
      La ville "<span><?php
      $villeManager->ajouter($_POST["ville_nom"]);
      echo $_POST["ville_nom"]; ?></span>" a été ajoutée
    <?php }
    else {?>
      <img src="image/erreur.png" alt="Erreur">
      La ville "<span><?php echo $_POST["ville_nom"]; ?></span>" existe déjà dans la liste
    <?php }
  }?>
