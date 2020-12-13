<h1>Ajouter un parcours </h1>

<?php if (empty($_POST['par_km'])): ?>
<form action="#" method="POST">
    <label for="vil_num1">Ville 1 : </label>
    <select id="vil_num1" name="vil_num1">
      <?php $villes=$villeManager->getAllVille(); ?>
      <?php foreach ($villes as $ville): ?>
        <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ?> </option>
      <?php endforeach; ?>
    </select>

    <label for="vil_num2">Ville 2 : </label>
    <select id="vil_num2" name="vil_num2">
      <?php foreach ($villes as $ville): ?>
        <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ?> </option>
      <?php endforeach; ?>
    </select>

    <label for="par_km">Nombres de kilometre(s) : </label>
    <input id="par_km" type="number" name="par_km" required><br><br>

    <input type="submit" value="Valider">
</form>
<?php endif; ?>

<?php
  if (!empty($_POST['par_km'])) {
    $parcoursExiste=$parcoursManager->existe($_POST['vil_num1'], $_POST['vil_num2']);
    if ($parcoursExiste==true) {?>
      <img src="image/erreur.png" alt="Valid"> Le parcours existe déjà
    <?php
    }
    elseif ($parcoursExiste==false && $_POST['vil_num1']==$_POST['vil_num2']) {?>
      <img src="image/erreur.png" alt="Valid"> Les villes sont confondues
    <?php
    }
    else {
      $parcours = new Parcours($_POST);
      $ajoutSucces=$parcoursManager->ajouter($parcours);
      if ($ajoutSucces==true) {?>
        <img src="image/valid.png" alt="Valid"> Le parcours a été ajoutée
      <?php
      }
    }
  }
?>
