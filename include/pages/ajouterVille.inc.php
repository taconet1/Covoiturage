<h1>Ajouter une ville</h1>

<?php if (empty($_POST['vil_nom'])): ?>
  <form action="#" method="post">
    <label for="vil_nom">Nom : </label>
    <input id="vil_nom" name="vil_nom" type="text" pattern="[A-zÀ-ú]*-?[A-zÀ-ú]" required>
    <input type="submit" value="Valider">
  </form>
<?php else: ?>
  <?php if ($villeManager->existe($_POST['vil_nom'])==false): $villeManager->ajouter($_POST['vil_nom']);?>
    <img src="image/valid.png" alt="Valid"> La ville "<span><?php echo $_POST['vil_nom']; ?></span>" a été ajoutée
  <?php else: ?>
    <img src="image/erreur.png" alt="Erreur"> La ville "<span><?php echo $_POST['vil_nom']; ?></span>" existe déjà dans la liste
  <?php endif; ?>
<?php endif; ?>
