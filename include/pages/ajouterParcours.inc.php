<h1>Ajouter un parcours </h1>
<?php
if (empty($_POST["kilometre"])){//premier appel ?>

<form name="info" action="index.php?page=5" method="POST">
    <label for="ville1">Ville 1 : </label>
    <select name="ville1">
      <?php
      $villes=$villeManager->getAllVille();
      foreach ($villes as $ville){ ?>
      <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ?> </option>
      <?php } ?>
    </select>

    <label for="ville2">Ville 2 : </label>
    <select name="ville2">
      <?php
      foreach ($villes as $ville){ ?>
        <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ?> </option>
      <?php } ?>
    </select>

    <label for="kilometre">Nombres de kilometre(s) : </label>
    <input type="number" name="kilometre" ><br><br>
    
    <input type="submit" value="Valider">

</form>
<?php
}
else {
  $parcoursExiste=$parcoursManager->existe($_POST["ville1"], $_POST["ville2"]);

  if($parcoursExiste==true){?>
    <img src="image/erreur.png" alt="Valid">Le parcours existe déjà
  <?php }
  else {
    $parcours = new Parcours($_POST);
    //on appelle la méthode add en lui passant un objet client
    $ajoutSucces=$parcoursManager->add($parcours);
    if ($ajoutSucces==true){ //retour contient le nombre de lignes affectées?>
      <img src="image/valid.png" alt="Valid"> Le parcours a été ajoutée
    <?php
    }
  }
}?>
