<h1>Ajouter un parcours </h1>
<?php
$villes=$villeManager->getAllVille();
if (empty($_POST["kilometre"])){//premier appel
?>

<form name="info" action="index.php?page=5" method="POST">
    <label for="ville1">Ville 1 : </label>
    <select id="ville1" name="ville1">
      <?php
      foreach ($villes as $ville){ ?>
      <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ?> </option>
      <?php } ?>
    </select>

    <label for="ville2">Ville 2 : </label>
    <select id="ville2" name="ville2">
      <?php
      foreach ($villes as $ville){ ?>
        <option value="<?php echo $ville->getVilNum();?>"> <?php echo $ville->getVilNom() ?> </option>
      <?php } ?>
    </select>

    <label for="kilometre">Nombres de kilometre(s) : </label>
    <input type="number" id="kilometre" name="kilometre" ><br><br>
    <input type="submit" value="Valider">

</form>
<?php
} else {
$parcours = new Parcours($_POST);
$row=$parcoursManager->present($_POST["ville1"], $_POST["ville2"]);
if($row == 0){
  $retour=$parcoursManager->add($parcours);
  //on appelle la méthode add en lui passant un objet client

  if ($retour !=0){ //retour contient le nombre de lignes affectées?>
    <img src="image/valid.png" alt="Valid"> Le parcours a été ajoutée
  <?php
  } else
   echo "Problème";
 }else{?>
   <img src="image/erreur.png" alt="Valid">
    le parcours existe deja
  <?php }} ?>
